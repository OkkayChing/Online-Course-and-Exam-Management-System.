<?php //echo "<pre/>"; print_r($courses);print_r($sections);print_r($video); exit(); ?>
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

<div id="note">
    <?php 
    if ($message) 
        echo $message; 

    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
    }
    ?>
        <div id="message"></div>
</div>
<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row">
            <p class="text-muted">Corse Title: <?=$courses->course_title; ?> 
            <?php 
            if ($courses->user_id == $this->session->userdata['user_id']) {
            ?>
                <a class="btn custom_navbar-btn btn-info pull-right col-sm-2" href="<?=base_url('course/add_section/'.$courses->course_id); ?>" data-toggle="modal"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add Section</a>
                <a class="btn custom_navbar-btn btn-primary pull-right col-sm-2" href="<?=base_url('course/add_course_videos/'.$courses->course_id); ?>"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add Video</a>
<!--                 <a class="btn custom_navbar-btn btn-primary pull-right col-sm-2" href="<?=base_url('course/add_course_audios/'.$courses->course_id); ?>"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add Audios</a>
                <a class="btn custom_navbar-btn btn-primary pull-right col-sm-2" href="<?=base_url('course/add_course_docs/'.$courses->course_id); ?>"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add Docs</a> -->
                
            <?php 
            } ?>
            </p>
        </div>
    </div>
    <div class="block-content">
    <div class="row">
    <div class="col-sm-12">
        <ul id="sortlist" class="list-group">
        <?php foreach ($sections as $section) { ?>
        <li id="ID_<?=$section->section_id;?>" class="ui-state-default list-group-item">
            <ul class="inner-sortlist">
                <li style="width: 60%;"><a id="section_title-<?=$section->section_id;?>" ><?=$section->section_name.': '.$section->section_title; ?>
                </a></li>
                <li> 
                    <?=$this->db->where('course_id', $courses->course_id)->where('section_id', $section->section_id)->from('course_videos')->count_all_results(); ?> videos
                </li>                                
                <li class="pull-right">
                    <div class="btn-group pull-right">
                        <a href="<?= base_url('course/section_detail/' . $section->section_id); ?>"  class="btn btn-xs btn-success "><i class="glyphicon glyphicon-resize-small"></i><span class="invisible-on-sm"> View</span></a>
                        <a class="btn btn-xs btn-primary update"  data-update="<?=$section->section_id;?>" href="#update_section" data-toggle="modal"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">  Modify</span></a>
                        <a onclick="return delete_confirmation()" href = "<?=base_url('course/delete_section/' . $section->section_id); ?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete</span></a>
                    </div>
                </li>                                
            </ul>
        </li>
        <?php
        }
        ?>
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
       $.post("<?=base_url();?>course/save_order",order,function(theResponse){
                     $('#message').html(theResponse);
                     });
       event.preventDefault();
});

//------------------------------ COOKIE SESSION SAVES

$('.update').click(function() {
    var id = $(this).attr('data-update'); // Get the id
    var str = $.trim($('#section_title-'+id).html()); //Get the old value and trimed it
    var value = str.split(": ");

    // $('#update_section_name').val(value[0]); // Set the old value intu the field
    $('#update_section_title').val(value[1]); // Set the old value intu the field
    $('#update_section_id').val(id); // Set section_id that will be updated
});
</script>


