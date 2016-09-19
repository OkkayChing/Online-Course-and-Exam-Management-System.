<?php //echo "<pre/>"; print_r($video);print_r($videos); exit(); ?>
<style type="text/css">
    .list-group-item{
        cursor: move;
    }
    .ui-sortable-helper{
        padding: 10px 15px;
        height: 40px !important;
    }
    .ui-sortable-placeholder{
        height: 40px !important;
    }
    ul.inner-sortlist{
        list-style: none;
        padding-left: 0;
    }
    .inner-sortlist li{
        display: inline-block;
    }
</style>

<div id="note"> <?php  if ($message)  echo $message; 
    if ($this->session->flashdata('message')) echo $this->session->flashdata('message'); ?>
    <div id="message"></div>
</div>
<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row">
            <p class="text-muted"><?php echo $section->section_name; ?> 
                <?php $user_id = $this->db->get_where('courses', array('course_id' => $section->course_id))->row()->created_by;
                if ($user_id == $this->session->userdata['user_id']) { ?>
                <a class="btn custom_navbar-btn btn-primary pull-right col-sm-2" href="<?php echo base_url('course/add_course_videos_selected_section/'.$section->section_id); ?>"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add Video</a>
                <!--
                    <a class="btn custom_navbar-btn btn-primary pull-right col-sm-2" href="<?php echo base_url('course/add_course_audios_selected_section/'.$section->section_id); ?>"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add Audios</a>
                    <a class="btn custom_navbar-btn btn-primary pull-right col-sm-2" href="<?php echo base_url('course/add_course_docs_selected_section/'.$section->section_id); ?>"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add Docs</a>
                    <a class="btn custom_navbar-btn btn-primary pull-right col-sm-2" href="<?php echo base_url('course/add_quiz/'.$section->section_id); ?>"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add a quiz</a>
                -->
                    <?php } ?>
            </p>
        </div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">
                <ul id="sortlist" class="list-group">
                    <?php
                    $sl = 1;
                    foreach ($videos as $video) { ?>
                    <li id="ID_<?=$video->video_id;?>" class="ui-state-default list-group-item">
                        <ul class="inner-sortlist">
                            <li><?=$sl; ?> :  </li>
                            <li style="width: 50%;"> <span id="video_title-<?=$video->video_id;?>"><?=$video->video_title; ?></span></li>
                            <li><?php $splits = explode('.', $video->video_link);?> <?=end($splits); ?></li>
                            <li class="pull-right"><div class="btn-group">
                                    <a class="btn btn-xs btn-default videoplaylink"
                                       <?php
                                                                    $string= $video->youtube_link;
                                                                    $stringTrim= trim($string ,"<iframe");
                                                                    $stringRelp= str_replace('"', "*", $stringTrim);

                                                                       ?>
                                       data-toggle="modal" data-target="#videoModal" onclick="setModal('<?php  echo $stringRelp; ?>')" data-video-url="<?php echo base_url('course_videos/'.$video->course_id.'/'.$video->video_link); ?>"><i class="glyphicon glyphicon-expand"></i><span class="invisible-on-md"> Preview</span></a>
                                    <a class="btn btn-xs btn-default update"  data-update="<?=$video->video_id;?>" href="#update_video" data-toggle="modal"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md"> Modify Title</span></a>
                                    <a class="btn btn-xs btn-default" onclick="return delete_confirmation();" href = "<?php echo base_url('course/delete_video/' . $video->video_id); ?>"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md"> Delete</span></a>
                                </div></li>
                        </ul>
                    </li>
                        <?php
                        $sl++;
                    } ?>
                </ul>
                <a id="button" class="btn btn-sm btn-warning">Update orders</a> <i class="fa fa-warning"></i> You can reorder the view by dragging the list.
            </div>
        </div>
    </div>
</div><!--/span-->

<!-- script for take the old value. -->
<script type="text/javascript">
    //--------- SAVE THE ORDER
    $('#button').click(function(event){
        //alert('me');
        var order = $("#sortlist").sortable("serialize");
        $('#message').html('Saving changes..');
        $.post("<?php echo base_url();?>course/save_order_vdo",order,function(theResponse){
            $('#message').html(theResponse);
        });
        event.preventDefault();
    });
    //------------------------------ COOKIE SESSION SAVES

    $('.update').click(function() {
        var id = $(this).attr('data-update'); // Get the id
        var str = $.trim($('#video_title-'+id).html()); //Get the old value and trimed it

        $('#update_video_title').val(str); // Set the old value intu the field
        $('#update_video_id').val(id); // Set section_id that will be updated
    });
</script>

<!-- Question Update Modal -->
<div class="modal fade" id="update_video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="TRUE">  
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="TRUE">&times;</button>
                <h4 class="modal-title">Update Title</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url() . 'course/update_video','role="form" class="form-horizontal"'); ?>
                <input type="hidden" name="video_id" id="update_video_id" value="">
                <input type="hidden" name="section_id" value="<?php echo $section->section_id; ?>">
                <div class="form-group">
                    <label for="update_video_name" class="col-xs-3 control-label">New Title :</label>
                    <div class="col-xs-8">
                        <?php echo form_input('video_title', '', 'id="update_video_title" placeholder="video title" class="form-control" required="required"') ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"') ?>
                <?php echo form_close() ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Video playback-->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="TRUE">&times;</button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-expand"></i> <span id="modalVideotitle"></span>
                </h4>
            </div>
            <div class="modal-body" id="allvideo">
            
         
         
            </div>
            <div class="modal-footer" style=" text-align: center;">
                <button type="button" id="prevVideo" class="btn btn-default" >Previous Video</button>
                <button type="button" id="nextVideo" class="btn btn-default" >Next Video</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    function setModal(v){
        if(v== ""){
            document.getElementById("allvideo").innerHTML = "<video class='videoPlayer' width='100%' height='' controls autoplay src='' type='video/x-flv'/></video>";

        }else{
            var res = v.replace(/\*/g, '"');
            document.getElementById("allvideo").innerHTML = "<iframe "+res;
        }
    }

</script>