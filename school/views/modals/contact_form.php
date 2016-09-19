<div class="modal fade  modal-compose-mail" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="TRUE">  
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-compose-mail-header" style="padding: 15px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="TRUE">&times;</button>
                <p class="modal-title">Write Us</p>
            </div>
            <?php echo form_open(base_url('guest/contact'), 'role="form" id="contact_form" class="form-horizontal"'); ?>
             <input type="hidden" name="token" value="<?=time();?>">
            <div class="modal-body">
                <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
                <div class="form-group">
                   <?php echo form_input('name', '', 'placeholder="Your Name (Required)" class="form-control" id="name" required="required"') ?>
                </div>
                <div class="form-group">
                   <?php echo form_input('email', '', 'id="email" pattern="^[a-zA-Z0-9.!#$%&'."'".'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="you@domain.com" placeholder="Your Email address (Required)" type="email" class="form-control" required="required"') ?>
                </div>
                <div class="form-group">
                    <?php echo form_input('subject', '', 'id="subject" placeholder="Subject (Required)" class="form-control" required="required"') ?>
                </div>
                <div class="form-group modal-compose-mail-body">
                   <textarea name="message" id="message" placeholder="Your Message (Required)" class="form-control textarea-wysihtml5" rows="10" maxlength="250" required="required"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-envelope-o"></i> Send</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            <?php echo form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?=$this->load->view('plugin_scripts/bootstrap-wysihtml5');?>