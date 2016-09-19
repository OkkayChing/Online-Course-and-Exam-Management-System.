<!-- script for take the old message and sender info. -->
<script type="text/javascript">
$('.reply').click(function() {
    var id = $(this).attr('data-update'); // Get the id
    var value = $.trim($('#question_title-'+id).html()); //Get the old value and trimed it
    $('#input').val(value); // Set the old value intu the field
    $('#ques_id').val(id); // Set ques_id that will be updated
});
</script>

<div class="modal fade modal-compose-mail" id="compose" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="TRUE">  
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-compose-mail-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="TRUE">&times;</button>
                <p class="modal-title">Compose Message</p>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('message_control/send_message'), 'role="form" class="form-horizontal"'); ?>
                <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
                <div class="form-group">
                   <?php echo form_input('from', 'From: '.$this->session->userdata['brand_name'].' <'.$this->session->userdata['support_email'].'>', 'placeholder="From" class="form-control" required="required" disabled') ?>
                </div>
                <div class="form-group">
                   <?php echo form_input('to', '', 'pattern="^[a-zA-Z0-9.!#$%&' . "'" . '*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="you@domain.com" placeholder="To" type="email" class="form-control" required="required"') ?>
                </div>
                <div class="form-group">
                   <?php echo form_input('subject', '', 'placeholder="Subject" class="form-control" required="required"') ?>
                </div>
                <div class="form-group modal-compose-mail-body">
                   <textarea name="message" placeholder="Your Message" class="form-control textarea-wysihtml5" rows="10" maxlength="250" required="required"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-envelope-o"></i> Send</button>
                <button type="submit" name="save" value="save" class="btn btn-default"><i class="fa fa-save"></i> Save as draft</button>
                <?php echo form_close() ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?=$this->load->view('plugin_scripts/bootstrap-wysihtml5');?>