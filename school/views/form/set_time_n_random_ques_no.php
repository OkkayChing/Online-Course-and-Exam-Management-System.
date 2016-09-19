<?php 
if ($message) {
    echo $message;
}
?>
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Set Time Duration for " <?=$exam_title;?> "</p></div>
    </div>
    <div class="block-content">
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>
        <div class="row">
            <?=form_open(base_url('admin_control/update_time_n_random_ques_no'), 'role="form" class="form-horizontal"'); ?>
            <input type="hidden" name="exam_id" value="<?=$exam_id; ?>">
            <input type="hidden" name="exam_title" value="<?=$exam_title; ?>">
            <input type="hidden" name="ques_count" value="<?=$ques_count; ?>">
            <div class="form-group">
                <label for="timepicker1" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Time Duration:</label>
                <div class="col-lg-2 col-md-3 col-xs-6 col-mb">
                    <div class="input-group">
                      <?php echo form_input('duration', '', 'id="timepicker1" placeholder="hh:mm:ss" class="form-control" required="required"') ?>
                      <span class="input-group-addon"> <i class="glyphicon glyphicon-time"></i> </span>
                    </div>            
                </div>
            </div>
            <div class="form-group">
                <label for="random_ques" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Total Random Question:</label>
                <div class="col-lg-2 col-md-3 col-xs-6 col-mb">
                    <?php echo form_input('random_ques', '', 'id="random_ques" placeholder="Numbers only" class="form-control" required="required"') ?>
                </div>
                <div class="col-lg-4 col-md-3 col-xs-6 col-mb">
                    <p class="help-inline"><i class="glyphicon glyphicon-info-sign"></i> Number of question have to answer.</p>
                    <p class="help-block info"><strong><i class="glyphicon glyphicon-warning-sign"></i> Not more than <?=$ques_count;?> </strong></p>
                </div>
            </div>
            <br/><hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Save</button>
                </div>
            </div>
            <?=form_close() ?>
        </div>
    </div>
    </div>
    </div>
</div>
<?php echo $this->load->view('plugin_scripts/bootstrap-timepicker');?>