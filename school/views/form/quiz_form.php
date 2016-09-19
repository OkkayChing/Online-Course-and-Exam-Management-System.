<?php 
if ($message) {
    echo $message;
}
?>
<?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
<!-- block -->

<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Create New Quiz </p></div>
        <div class="row">
            <p class="text-muted">
                <span class=""><?php echo 'Course Title: '.$course_title; ?></span>
                <span class="pull-right"> </span>
                <p class="text-muted">Section Name: <?php echo $section_name; ?></p>
            </p>
        </div>
    </div>
    <div class="block-content">
    <?=form_open_multipart(base_url('course/create_quiz'), 'role="form" class="form-horizontal"'); ?>
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>
        
            <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
            <div class="form-group">
                <label for="quiz_title" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Quiz Title:</label>
                <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'quiz_title',
                        'placeholder' => 'Quiz Title',
                        'id'          => 'quiz_title',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            
            <div class="form-group">
                <label for="feature_image" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Feature Image: </label>
                <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                    <?=form_upload('feature_image', '', 'id="feature_image" class="form-control"') ?>
                    <p class="help-block"><i class="glyphicon glyphicon-warning-sign"></i> Allowed only max_size = 150KB, max_width = 1024px, max_height = 768px, types = gif | jpg | png .</p>
                </div>
            </div>
            <div class="form-group">
                <label for="passing_score" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Passing Score:</label>
                <div class="col-sm-3 col-xs-6 col-mb">
                    <div class="input-group">
                      <?php echo form_input('passing_score', '', 'id="passing_score" placeholder="Passing Score" class="form-control" required="required"') ?>
                      <span class="input-group-addon"> % </span>
                    </div>            
                </div>
            </div>

            
            <div class="form-group">
              <label class="col-xs-offset-3 col-sm-8 col-xs-offset-2 col-xs-9">
                  <p class="text-muted"><i class="glyphicon glyphicon-info-sign"> </i> All fields are Required.</p>
              </label>
            </div>
            <br/><hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Next</button>
                    <button type="reset" class="btn btn-warning col-xs-offset-1">Reset</button>
                </div>
            </div>
            <?=form_close(); ?>
        </div>
    </div>
    </div>
    </div>
</div>
<?=$this->load->view('plugin_scripts/bootstrap-wysihtml5');?>

