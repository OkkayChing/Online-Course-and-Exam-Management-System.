<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="TRUE">  
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="TRUE">&times;</button>
                <h3 class="modal-title">Write Us</h3>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url() . '', 'role="form" class="form-horizontal"'); ?>
                <?php echo validation_errors('<div class="alert alert-error">', '</div>'); ?>
                <div class="form-group">
                    <label for="name" class="col-xs-3 control-label">Name:</label>
                    <div class="col-xs-8">
                        <?php echo form_input('name', '', 'placeholder="Your Name (Required)" class="form-control" required="required"') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-xs-3 control-label">Email:</label>
                    <div class="col-xs-8">
                        <?php echo form_input('email', '', 'pattern="^[a-zA-Z0-9.!#$%&' . "'" . '*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="you@domain.com" placeholder="Your Email address (Required)" type="email" class="form-control" required="required"') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message" class="col-xs-3 control-label">Message:</label>
                    <div class="col-xs-8">
                        <textarea name="message" placeholder="Your Message (Required)" class="form-control" rows="3" maxlength="250" required="required"></textarea>
                    </div>
                </div>
                <br/>
                <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="glyphicon glyphicon-envelope"></i> Send</button>
                <?php echo form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
