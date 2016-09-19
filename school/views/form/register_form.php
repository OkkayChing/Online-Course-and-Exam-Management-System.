<section id="login">
    <div class="container">
        <div class="box">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
                    <?=(isset($message)) ? $message : ''; ?>
                </div>
                <div class="col-md-8 col-xs-12 col-md-offset-2 col-xs-offset-0">
                    <div class="center"> <h3>Register</h3> </div><!--/.center--> 
                    <?=form_open(base_url('login_control/register'), 'role="form" class="form-horizontal"'); ?>
                        <div class="row">
                            <div class="col-md-12 minpadding">
                                <?=form_hidden('token', time()); ?>
                                <?=form_input('user_name', '', 'id="user_name" placeholder="User Name *" class="form-control" required="required"') ?>
                                <?=form_input('user_email', '', 'id="user_email" type="email" pattern="^[a-zA-Z0-9.!#$%&'."'".'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="you@domain.com" placeholder="Email address *" class="form-control" required="required"') ?>
                                <?=form_input('user_phone', '', 'id="user_phone" pattern="^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$" title="Enter Valid Phone Number" min="8" max="15" placeholder="Phone Number" class="form-control"') ?>
                            </div><!--/.col-md-12-->
                        </div><!--/.row-->
                            
                        <div class="row">
                            <div class="col-md-6 minpadding">
                                <?=form_password('user_pass', '', 'id="user_pass" placeholder="Password * (Minimum 6 character)" class="form-control" required="required"') ?>
                            </div>
                            <div class="col-md-6 minpadding">
                                <?=form_password('user_passcf', '', 'id="user_passcf" placeholder="Confirm Password *" class="form-control" required="required"') ?>
                            </div>
                        </div>
                        <div class="big-gap"></div>
                        <div class="row">
                            <div class="col-md-11 minpadding">
                                <button type="submit" class="btn btn-warning btn-lg btn-block">Register</button>
                            </div><!--/.col-md-11-->
                            <div class="col-md-1 minpadding">
                                <button type="reset" class="btn btn-default btn-lg btn-lg pull-right">Reset</button>
                            </div><!--/.col-md-1-->
                        </div><!--/.row-->
                    <?=form_close() ?>
                    <div class="big-gap"></div>
                    <i class="glyphicon glyphicon-bell"> </i> Have an account? <a href="<?=base_url('login_control'); ?>"> Login</a>
                </div><!--/.col-md-8 .col-xs-12-->
            </div><!--/.row-->
        </div><!--/.box-->
    </div><!--/.container-->
</section><!--/#login-->