<?php 
if ($message) {
    echo $message;
}
?>
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted"><?=($msg_info->message_folder == 'draft')?'Edit Message':'Reply Message' ?></p></div>
    </div>
    <div class="block-content">
    <?php 
    if ($msg_info->message_folder == 'draft') {
        echo form_open(base_url('message_control/send_draft_message'), 'role="form" class="form-horizontal"');
    }else {
        echo form_open(base_url('message_control/send_reply'), 'role="form" class="form-horizontal"');
    }
    ?>
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="cat_name" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">To: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                    <?=form_hidden('message_id', $msg_info->message_id); ?>
                   <?php 
                    if ($msg_info->message_folder == 'draft') {
                        echo form_input('to',$msg_info->message_send_to, 'placeholder="To" class="form-control" required="required"'); 
                    } elseif ($msg_info->message_folder == 'send') {
                        echo form_input('to',$msg_info->message_send_to, 'placeholder="To" class="form-control" required="required" readonly'); 
                    } else {
                        echo form_input('to',$msg_info->message_sender.' ( '.$msg_info->sender_email.' )', 'placeholder="To" class="form-control" required="required" readonly'); 
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="subject" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Subject: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                   <?php 
                    if ($msg_info->message_folder == 'draft') {
                        echo form_input('subject', $msg_info->message_subject, 'placeholder="Subject" class="form-control" required="required"'); 
                    } else {
                        echo form_input('subject', 'Re: '.$msg_info->message_subject, 'placeholder="Subject" class="form-control" required="required" readonly'); 
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="cat_name" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px;">Message : </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'reply_message',
                        'placeholder' => 'Reply Message',
                        'value'       => '',
                        'rows'        => '10',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Send</button>
                    <span class="col-sm-1">&nbsp;</span>
                    <a href="<?=base_url('message_control');?>" class="btn btn-default">Cancel</a>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
    </div>
    </div>
</div>
<?=$this->load->view('plugin_scripts/bootstrap-wysihtml5');?>