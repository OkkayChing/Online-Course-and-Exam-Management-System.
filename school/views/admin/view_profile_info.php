<?php //echo "<pre>"; print_r($profile_info); exit(); ?>
<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
    <?=(isset($message)) ? $message : ''; ?>
</div>
<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Profile Info </p></div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-sm-4 col-md-3">
                    <ul class="proile tabbable">
                        <li class="active">
                            <a data-toggle="tab" href="#tab-1"><i class="fa fa-cog"></i> Personal info </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#tab-2"><i class="fa fa-lock"></i> Change Password</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#tab-3"><i class="fa fa-lock"></i> Subscription</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-8 col-md-9 proile-info">
                    <div class="row">&nbsp;</div>
                    <div class="tab-content">
                        <div id="tab-3" class="tab-pane">
                        <?php if ($profile_info->subscription_id) { ?>
                            <?php $package = $this->db->get_where('price_table', array('price_table_id' => $profile_info->subscription_id))->row()->price_table_title; ?>
                            <p class="lead">You are subscribed in "<?=$package; ?>" package.</p>
                                <p>Subscription will expire on <?=date('F d, Y',$profile_info->subscription_end)?></p>                            
                        <?php }else{ ?>
                            <p class="lead">Currently you have not subscribed in package. </p>
                            <a href="<?=base_url('guest/pricing') ?>" class="btn btn-default"> Subscribe Now</a>
                        <?php } ?>
                        </div>

                        <div id="tab-2" class="tab-pane">
                            <?= form_open(base_url('admin_control/change_password'), 'role="form" class="form-horizontal"'); ?>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label invisible-on-sm">Current Password: </label>
                                <div class="col-sm-9">
                                    <?= form_password('old-pass', '', 'placeholder="Old Password" class="form-control" required="required"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label invisible-on-sm">New Password: </label>
                                <div class="col-sm-9">
                                    <?= form_password('new-pass', '', 'placeholder="New Password" class="form-control" required="required"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label invisible-on-sm">Re-type New Password: </label>
                                <div class="col-sm-9">
                                    <?= form_password('re-new-pass', '', 'placeholder="Re-type New Password" class="form-control" required="required"') ?>
                                </div>
                            </div><br/>                         
                            <hr/>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </div>
                            <?= form_close() ?>
                        </div>

                        <div id="tab-1" class="tab-pane active">
                            <div class="form-group">
                                <label class="col-md-2 col-xs-3 control-label">Name: </label>
                                <div class="col-md-10 col-xs-9">
                                    <p class="form-control-static">
                                        <a href="#" data-name="email" data-type="text" data-url="<?php echo base_url('admin_control/update_profile_info'); ?>" data-pk="<?= $profile_info->user_id ?>" class="data-modify-support no-style"><?= $profile_info->user_name ?></a>
                                    </p>
                                </div>
                            </div>
                            <br/><br/>
                            <div class="form-group">
                                <label class="col-md-2 col-xs-3 control-label">Phone: </label>
                                <div class="col-md-10 col-xs-9">
                                    <p class="form-control-static">
                                        <a href="#" data-name="phone" data-type="text" data-url="<?php echo base_url('admin_control/update_profile_info'); ?>" data-pk="<?= $profile_info->user_id ?>" class="data-modify-support no-style"><?= $profile_info->user_phone ?></a>
                                    </p>
                                </div>
                            </div><br/>                         
                            <div class="form-group">
                                <label class="col-md-2 col-xs-3 control-label">Email: </label>
                                <div class="col-md-10 col-xs-9">
                                    <p class="form-control-static"><?= $profile_info->user_email ?></p>
                                </div>
                            </div><br/>                         
                            <div class="form-group">
                                <label class="col-md-2 col-xs-3 control-label">Role: </label>
                                <div class="col-md-10 col-xs-9">
                                    <p class="form-control-static"><?= $profile_info->user_role_name ?></p>
                                </div>
                            </div><br/>                         
                            <hr/>
                            <div class="col-xs-10 col-xs-offset-1">
                                <a class="btn btn-primary col-sm-3 modify" name="modify-support" href = "#"><i class="glyphicon glyphicon-edit"></i> Modify</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/span-->