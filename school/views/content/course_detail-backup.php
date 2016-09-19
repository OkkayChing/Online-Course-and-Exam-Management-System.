<?php //echo "<pre/>"; print_r($courses);print_r($sections);print_r($video); exit(); ?>
<div id="note">
    <?php 
    if ($message) 
        echo $message; 

    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
    }

    ?>
</div>
<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row">
            <p class="text-muted">Corse Title: <?php echo $courses->course_title; ?> 
            <?php 
            if ($courses->user_id == $this->session->userdata['user_id']) {
            ?>
                <a class="btn custom_navbar-btn btn-info pull-right col-sm-2" href="#add_section" data-toggle="modal"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add Section</a>
                <a class="btn custom_navbar-btn btn-primary pull-right col-sm-2" href="<?php echo base_url('course/add_course_videos/'.$courses->course_id); ?>"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add Video</a>
            <?php 
            } ?>
            </p>
        </div>
    </div>
    <div class="block-content">
    <div class="row">
    <div class="col-sm-12">
    <table id="sortlist" cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="col-sm-1">Sl.</th>
                <th>Sections</th>
                <th class="col-sm-3">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            foreach ($sections as $section) {
        ?>
        <tr id="ID_<?=$section->section_id;?>" class="ui-state-default accordion-group <?=($i & 1) ? 'even' : 'odd'; ?>">
            <td class="col-sm-1"><?=$i; ?> : </td> 
            <td class="accordion-heading">
                <a id="section_title-<?=$section->section_id;?>" href="#collapse_<?=$i; ?>"  data-toggle="collapse" class="accordion-toggle" style="text-decoration: none; padding: 0; color: #363636;">
                    <?=$section->section_name.': '.$section->section_title; ?>
                </a>
                <div class="accordion-body collapse" id="collapse_<?php echo $i; ?>">
                    <div class="accordion-inner"><br/>
                    <?php 
                    $videos = $this->db->get_where('course_videos', array('section_id' => $section->section_id, 'course_id' => $courses->course_id))->result();
                   // print_r($video);
                    if ($videos) { ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>sl.</th>
                                    <th>Video Title</th>
                                    <th>Format</th>
                                    <th style="width: 15%">Action</th>
                                </tr>
                            </thead>
                            <?php
                            $sl = 1;
                            foreach ($videos as $video) { ?>
                                <tr>
                                    <td style="width: 5%"><?php echo $sl; ?></td>
                                    <td>
                                        <a href="#" data-name="ans-text" data-type="textarea" data-rows="2" data-url="<?php echo base_url('admin_control/update_answer/'.$video->video_id); ?>" data-pk="<?=$video->video_id; ?>" class="data-modify-<?=$video->video_id; ?> no-style"><?=$video->video_title; ?></a>
                                    </td>
                                    <td>
                                    <?php $splits = explode('.', $video->video_link);
                                     ?>
                                    <?=end($splits); ?>
                                    </td>
                                    <td class="btn-group">
                                        <a class="btn btn-sm btn-default modify" name="modify-<?=$ans->ans_id; ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a class="btn btn-sm btn-default" onclick="return delete_confirmation();" href = "<?php echo base_url('admin_control/delete_answer/' . $ans->ans_id); ?>"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $sl++;
                            } ?>
                        </table>
                        <?php
                        } else { ?>
                        <table class="table table-bordered">
                            <tr><th>Empty !!!</th><tr>
                        </table>
                        <?php } ?>
                    </div>
                </div>
            </td>
            <td class="col-xs-3">
                <div class="btn-group">
                    <a href="#collapse_<?=$i; ?>"  data-toggle="collapse" class="btn btn-sm btn-default accordion-toggle "><i class="glyphicon glyphicon-resize-small"></i><span class="invisible-on-sm"> View</span></a>
                    <a class="btn btn-sm btn-default update"  data-update="<?=$section->section_id;?>" href="#update_section" data-toggle="modal"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">  Modify</span></a>
                    <a onclick="return delete_confirmation()" href = "<?php echo base_url('course/delete_section/' . $section->section_id); ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete</span></a>
                </div>
            </td>
        </tr>
        <?php
            $i++;
        }
        ?>
        </tbody>
    </table>
    </div>
    </div>
    </div>
</div><!--/span-->

<!-- Question Update Modal -->
<div class="modal fade" id="add_section" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="TRUE">  
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="TRUE">&times;</button>
        <h4 class="modal-title">Add Section</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url() . 'course/add_section','role="form" class="form-horizontal"'); ?>
          <input type="hidden" name="course_id" id="course_id" value="<?php echo $courses->course_id; ?>">
          <div class="form-group">
            <label for="section_name" class="col-xs-3 control-label">Section Name :</label>
            <div class="col-xs-8">
                <?php echo form_input('section_name', '', 'id="section_name" placeholder="Section Name" class="form-control" required="required"') ?>
            </div>
          </div>
          <div class="form-group">
            <label for="section_title" class="col-xs-3 control-label">Section Title :</label>
            <div class="col-xs-8">
                <?php 
                $data = array(
                    'name'        => 'section_title',
                    'id'          => 'section_title',
                    'value'       => '',
                    'rows'        => '2',
                    'class'       => 'form-control',
                    'required' => 'required',
                ); ?>
               <?php echo form_textarea($data) ?>
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


<!-- script for take the old value. -->
<script type="text/javascript">
$('.update').click(function() {
    var id = $(this).attr('data-update'); // Get the id
    var str = $.trim($('#section_title-'+id).html()); //Get the old value and trimed it
    var value = str.split(": ");

    $('#update_section_name').val(value[0]); // Set the old value intu the field
    $('#update_section_title').val(value[1]); // Set the old value intu the field
    $('#update_section_id').val(id); // Set section_id that will be updated
});
</script>

<!-- Question Update Modal -->
<div class="modal fade" id="update_section" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="TRUE">  
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="TRUE">&times;</button>
        <h4 class="modal-title">Update Section</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url() . 'course/update_section','role="form" class="form-horizontal"'); ?>
          <input type="hidden" name="course_id" id="course_id" value="<?php echo $courses->course_id; ?>">
          <input type="hidden" name="section_id" id="update_section_id" value="">
          <div class="form-group">
            <label for="update_section_name" class="col-xs-3 control-label">Section Name :</label>
            <div class="col-xs-8">
                <?php echo form_input('section_name', '', 'id="update_section_name" placeholder="Section Name" class="form-control" required="required"') ?>
            </div>
          </div>
          <div class="form-group">
            <label for="update_section_title" class="col-xs-3 control-label">Section Title :</label>
            <div class="col-xs-8">
                <?php 
                $data = array(
                    'name'        => 'section_title',
                    'id'          => 'update_section_title',
                    'value'       => '',
                    'rows'        => '2',
                    'class'       => 'form-control',
                    'required' => 'required',
                ); ?>
               <?php echo form_textarea($data) ?>
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

