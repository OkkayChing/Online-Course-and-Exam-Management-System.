
<?php
if ($message) {
    echo $message;
}
?>
<?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row">
            <p class="text-muted">
                <span class=""><?=$course_title.': '.$section_name;; ?></span>
            </p>
        </div>
    </div><br/>
    <div class="block-content">
    <?=form_open_multipart(base_url('course/upload_course_videos_selected_section'), 'role="form" class="form-horizontal"'); ?>
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>
        <div id="hidden_fields"></div>
        <div class="row">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <input type="hidden" name="course_title" value="<?php echo $course_title; ?>">
            <input type="hidden" name="section" value="<?php echo $section_id; ?>">
            <div class="form-group">
                <label for="" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Video Title: </label>
                <div class="col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'video_title',
                        'placeholder' => 'Video Title',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Free: </label>
                <div class="col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'free',
                        'id'          => 'free',
                        'value'       => 'free',
                        // 'checked'     => TRUE,
                        'style'       => 'margin:10px',
                        ); ?>
                    <?php echo form_checkbox($data); ?>
                </div>
            </div>            
            <div class="form-group" id="media-choose">
                <label for="upload-media-file" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Choose video: </label>
                <div class="col-sm-8 col-xs-7 col-mb">
                    <input type="file" id="media" name="media" style="margin-top:8px;">
                    <p class="help-block"><i class="glyphicon glyphicon-warning-sign"></i> Allowed types = mp4 | webm | ogg | flv | avi</p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-8 col-xs-7 col-sm-offset-2 col-xs-offset-0">
                    <div id="progressBar" style="display:none;"><img src="<?=base_url('assets/images/progress.gif')?>" /></div>
                </div>
            </div>
            <br/><hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" onclick="$('#progressBar').show();" class="btn btn-primary col-xs-5 col-sm-3"> <i class="glyphicon glyphicon-ok"></i> Save and Add More</button>
                    <button type="submit" onclick="$('#progressBar').show();" class="btn btn-info col-xs-offset-1" name="done" value="done"><i class="glyphicon glyphicon-saved"></i> Save and Done</button>
                </div>
            </div>
            <br/>
            <?=form_close();?>
        </div>
    </div>
    </div>
    </div>
</div>
<?=$this->load->view('plugin_scripts/bootstrap-wysihtml5');?>