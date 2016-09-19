<section id="login">
    <div class="container">
        <div class="box">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
                    <?=(isset($message)) ? $message : ''; ?>
                </div>
                <div class="col-md-4 col-sm-8 col-md-offset-4 col-sm-offset-2">
                    <div class="center">
                        <h3>Password Recovery</h3>
                    </div><!--/.center-->   
                    <div class="big-gap"></div>
                        <?=form_open(base_url('login_control/forgot_password'), 'role="form" class="form-horizontal"'); ?>
                            <?=form_input('email', '', 'pattern="^[a-zA-Z0-9.!#$%&'."'".'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="you@domain.com" placeholder="Put your email address" class="form-control" required="required"') ?>
                            <button type="submit" class="btn btn-warning btn-lg btn-block">Recover Password</button>
                        <?=form_close() ?>
                    <div class="big-gap"></div>
                </div>
                </div>
            </div>
        </div> 
    </div>
</section><!--/#login-->