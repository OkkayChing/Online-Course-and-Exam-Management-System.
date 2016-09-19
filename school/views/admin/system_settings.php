<!DOCTYPE html>
<html class="no-js fuelux">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Install | Minor School</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.css') ?>" rel="stylesheet" media="screen">
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet" media="screen">
    <link href="<?php echo base_url('assets/fuelux/css/fuelux.min.css') ?>" rel="stylesheet" media="screen">
    <link href="<?php echo base_url('assets/fuelux/css/fuelux-responsive.min.css') ?>" rel="stylesheet" media="screen">
</head>
<body>
    <div class="row">
        <h2 class="text-center">Install | Minor School</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-xs-offset-1 col-xs-10">
                <?php 
                if ($message) {
                    echo $message;
                } else { 
                    echo '<div class="alert alert-success"><h4>Database setting successful! Now let the system know about your brand! :)</h4></div>'
                    .'<div class="alert alert-danger"><h5><i class="glyphicon glyphicon-warning-sign"> </i> Please DELETE the \'install\' directory to avoid overwrite the system info.</h5></div>'; 
                }
                ?>
                <div class="row">
                    <div class="col-xs-offset-1 col-xs-10">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    </div>
                </div>
                <div class="well wizard-example">
                <div id="my-wizard" class="wizard">
                    <ul class="steps">
                        <li data-target="#step1" class="active">Login Info<span class="chevron"></span></li>
                        <li data-target="#step2">Brand Info<span class="chevron"></span></li>
                        <li data-target="#step3">Social Link<span class="chevron"></span></li>
                        <li data-target="#step4">Front-End Content <span class="chevron"></span></li>
                        <li data-target="#step5">PayPal Settings<span class="chevron"></span></li>
                        <li data-target="#step6">Support Info<span class="chevron"></span></li>
                    </ul>
                </div>
                <div class="step-content" style="min-height: 380px;">
                <?php echo form_open(base_url() . 'admin/system_control/set_system_config', 'role="form" class="form-horizontal"'); ?>
                    <div class="step-pane active" id="step1">
                        <h4 class="hidden-xs"><i class="glyphicon glyphicon-fire"></i> Authentication Info for Super Admin.</h4>
                        <h5 class="visible-xs"><i class="glyphicon glyphicon-fire"></i> Authentication Info for Super Admin.</h5>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label for="user_name" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Full Name: *</label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('user_name', set_value('user_name'), 'id="user_name" placeholder="Full Name" class="form-control" required="required"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_email" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Email: *</label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('user_email',  set_value('user_email'), 'pattern="^[a-zA-Z0-9.!#$%&' . "'" . '*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" id="user_email" title="you@domain.com" placeholder="Email address" class="form-control" required="required"') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_phone" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Phone:</label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('user_phone',  set_value('user_phone'), 'pattern="^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$" id="user_phone" title="Enter Valid Phone Number" min="8" max="15" placeholder="Phone Number" class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_pass" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Password: *</label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_password('user_pass', '', 'id="user_pass" placeholder="Password (Minimum 6 character)" class="form-control" required="required"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_passcf" class="col-md-3 col-md-offset-0 col-sm-3 control-label hidden-xs">Confirm Pass.: *</label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_password('user_passcf', '', 'id="user_passcf" placeholder="Confirm Password" class="form-control" required="required"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-offset-3 col-sm-8 col-xs-offset-2 col-xs-9">
                                    <p class="text-muted">* Required fields.</p>
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <strong class="text-info col-lg-4 col-lg-push-8 col-md-5 col-md-push-7 col-sm-6 col-sm-push-6"><i class="glyphicon glyphicon-info-sign"> </i> Click 'Next' to continue.</strong>
                        </div>
                    </div>
                    <div class="step-pane" id="step2">
                        <h4 class="hidden-xs"><i class="glyphicon glyphicon-fire"></i> Brand Information.</h4>
                        <h5 class="visible-xs"><i class="glyphicon glyphicon-fire"></i> Brand Information.</h5>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label for="brand_name" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Brand Name: *</label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('brand_name',  set_value('brand_name'), 'id="brand_name" placeholder="Brand Name" class="form-control" required="required"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="brand_tagline" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Brand Slogan: </label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('brand_tagline',  set_value('brand_tagline'), 'id="brand_tagline" placeholder="Brand Slogan" class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="business_type" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Business Type: *</label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                <select class="form-control" name="business_type" id="business_type">
                                    <option value="1">Commercial</option>
                                    <option value="0">Non-commercial</option>
                                </select>
                                </div>
                            </div>                            
                            <?php
                            $option = array();
                            $option['none'] = 'Local Time Zone';
                            foreach ($time_zone as $value) {
                                    $option[$value->timezone_name] = $value->timezone_name;
                            }
                            ?>
                          <div class="form-group">
                                <label for="time_zone" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Time Zone: *</label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_dropdown('time_zone', $option, set_value('time_zone'),'class="form-control" id="time_zone"') ?>
                                </div>
                          </div>
                            <div class="form-group">
                                <label for="about" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">About Us: *</label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                  <?php 
                                    $data = array(
                                        'name'        => 'about',
                                        'id'          => 'about',
                                        'placeholder' => 'About Us, The message you want to show on \'About Us\' page.',
                                        'rows'        => '3',
                                        'class'       => 'form-control about textarea-wysihtml5',
                                        'required' => 'required',
                                    ); 
                                    ?>
                                    <?=form_textarea($data) ?>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-xs-offset-3 col-sm-8 col-xs-offset-2 col-xs-9">
                                  <p class="text-muted">* Required fields.</p>
                              </label>
                            </div>
                        </div>
                        <div class="row">
                            <strong class="text-info col-lg-4 col-lg-push-8 col-md-5 col-md-push-7 col-sm-6 col-sm-push-6"><i class="glyphicon glyphicon-info-sign"> </i> Click 'Next' to continue.</strong>
                        </div>
                    </div>
                    <div class="step-pane" id="step3">
                        <h4 class="hidden-xs"><i class="glyphicon glyphicon-fire"></i> Social Links. <small> Open your links on browser and copy the URLs.</small></h4>
                        <h5 class="visible-xs"><i class="glyphicon glyphicon-fire"></i> Social Links. <small> Open your links on browser and copy the URLs.</small></h5>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label for="fb" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Facebook: </label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('fb',  set_value('fb'), 'id="fb" placeholder="Facebook Page Link" class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="youtube" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">You Tube: </label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('youtube',  set_value('youtube'), 'id="youtube" placeholder="You Tube Video Link" class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="twitter" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Twitter: </label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('twitter',  set_value('twitter'), 'id="twitter" placeholder="Twitter Link" class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="googleplus" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Google+: </label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('googleplus',  set_value('googleplus'), 'id="googleplus" placeholder="Google Plus Link" class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="flickr" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Flickr: </label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('flickr',  set_value('flickr'), 'id="flickr" placeholder="Flickr Link" class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pinterest" class="col-md-2 col-md-offset-1 col-sm-3 control-label hidden-xs">Pinterest: </label>
                                <div class="col-md-8 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('pinterest',  set_value('pinterest'), 'id="pinterest" placeholder="Pinterest Link" class="form-control"') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <strong class="text-info col-lg-4 col-lg-push-8 col-md-5 col-md-push-7 col-sm-6 col-sm-push-6"><i class="glyphicon glyphicon-info-sign"> </i> Click 'Next' to continue.</strong>
                        </div>
                    </div>
                    <div class="step-pane" id="step4">
                        <h4 class="hidden-xs"><i class="glyphicon glyphicon-fire"></i> Front End Content. <small> Informations you want to show on front-end.</small></h4>
                        <h5 class="visible-xs"><i class="glyphicon glyphicon-fire"></i> Front End Content. <small> Informations you want to show on front-end.</small></h5>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label for="wc_msg_head" class="col-sm-4 control-label hidden-xs">Message Title: </label>
                                <div class="col-sm-7 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('wc_msg_head',  set_value('wc_msg_head'), 'id="wc_msg_head" placeholder="Welcome Message Head" class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="wc_message" class="col-md-offset-1 col-md-3 col-sm-3 control-label hidden-xs">Welcome Message: *</label>
                                <div class="col-md-7 col-sm-7 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <div class="form-group">
                                    <?php 
                                      $data = array(
                                          'name'        => 'wc_message',
                                          'placeholder' => 'Welcome Message, The message you want to show on \'Home Page\'.',
                                          'id'          =>'wc_message',
                                          'rows'        => '3',
                                          'class'       => 'form-control',
                                          'required'    => 'required',
                                      );
                                      ?>
                                      <?=form_textarea($data) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-6 control-label">Student can register him/herself: </label>
                                <div class="col-xs-3 col-sm-2 ">
                                <select class="form-control" name="student_can_register">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-4 col-sm-6 control-label">Display YouTude video on Landing Page: </label>
                                <div class="col-xs-3 col-sm-2 ">
                                <select class="form-control" name="show-video">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                              <label class="col-xs-offset-3 col-sm-8 col-xs-offset-2 col-xs-9">
                                  <p class="text-muted">* Required fields.</p>
                              </label>
                            </div>
                        </div>
                        <div class="row">
                            <strong class="text-info col-lg-4 col-lg-push-8 col-md-5 col-md-push-7 col-sm-6 col-sm-push-6"><i class="glyphicon glyphicon-info-sign"> </i> Click 'Next' to continue.</strong>
                        </div>
                    </div>
                    <div class="step-pane" id="step5">
                        <h4 class="hidden-xs"><i class="glyphicon glyphicon-fire"></i> PayPal API Settings. <small> Your PayPal payment gateway informations.</small></h4>
                        <h5 class="visible-xs"><i class="glyphicon glyphicon-fire"></i> PayPal API Settings. <small> Your PayPal payment gateway informations.</small></h5>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label for="pp_status" class="col-md-offset-1 col-md-3 col-sm-3 control-label hidden-xs">Paypal Status: </label>
                                <div class="col-md-7 col-sm-7 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                <?php
                                $option = array();
                                $option['0'] = 'Live';
                                $option['1'] = 'Sandbox';
                                echo form_dropdown('pp_status', $option, set_value('pp_status'), 'id="pp_status" class="form-control"') 
                                ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pp_username" class="col-sm-4 control-label hidden-xs">Paypal Username: </label>
                                <div class="col-sm-7 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('pp_username',  set_value('pp_username'), 'id="pp_username" placeholder="Paypal API Username" class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pp_pass" class="col-sm-4 control-label hidden-xs">Paypal Password: </label>
                                <div class="col-sm-7 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('pp_pass',  set_value('pp_pass'), 'id="pp_pass" placeholder="Paypal API Password" class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pp_sign" class="col-sm-4 control-label hidden-xs">Paypal API Signature: </label>
                                <div class="col-sm-7 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('pp_sign',  set_value('pp_sign'), 'id="pp_sign" placeholder="Paypal API Signature" class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="currency" class="col-md-offset-1 col-md-3 col-sm-3 control-label hidden-xs">Currency: </label>
                                <div class="col-md-7 col-sm-7 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                <?php
                                    $option = array();
                                    foreach ($currencies as $currency) {
                                        $option[$currency->currency_id] = $currency->currency_name.' ('.$currency->currency_symbol.')';
                                    }
                                    echo form_dropdown('currency', $option,'151', 'id="currency" class="form-control"') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <strong class="text-info col-lg-4 col-lg-push-8 col-md-5 col-md-push-7 col-sm-6 col-sm-push-6"><i class="glyphicon glyphicon-info-sign"> </i> Click 'Next' to continue.</strong>
                        </div>
                    </div>
                    <div class="step-pane" id="step6">
                        <h4 class="hidden-xs"><i class="glyphicon glyphicon-fire"></i> Support Info.</h4>
                        <h5 class="visible-xs"><i class="glyphicon glyphicon-fire"></i> Support Info.</h5>
                        <br>
                        <div class="row">
                            <div class="form-group">
                                <label for="support_email" class="col-md-3 col-md-offset-1 col-sm-3 control-label hidden-xs">Support Email: *</label>
                                <div class="col-md-7 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('support_email',  set_value('support_email'), 'pattern="^[a-zA-Z0-9.!#$%&' . "'" . '*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" id="support_email" title="you@domain.com" placeholder="Email address" class="form-control" required="required"') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="support_phone" class="col-md-3 col-md-offset-1 col-sm-3 control-label hidden-xs">Support Phone:</label>
                                <div class="col-md-7 col-sm-8 col-xs-10 col-xs-offset-1 col-sm-offset-0">
                                    <?php echo form_input('support_phone',  set_value('support_phone'), 'pattern="^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$" id="support_phone" title="Enter Valid Phone Number" min="8" max="15" placeholder="Phone Number" class="form-control"') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-offset-3 col-sm-8 col-xs-offset-2 col-xs-9">
                                    <p class="text-muted">* Required fields.</p>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <strong class="text-info col-sm-11 col-sm-push-1"><i class="glyphicon glyphicon-info-sign"> </i> Please check all info is given correctly. Click 'Save' to finish.</strong>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-xs-4 col-xs-push-7">
                            <button type="submit" name="submit" value="system_info" class="btn btn-lg btn-block btn-info">  <i class="glyphicon glyphicon-ok-circle"></i>  Save</button>
                        </div>
                        </div>
                    </div>
                <?php echo form_close() ?>
                </div>
                <br/>
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-lg btn-prev" id="btnWizardPrev" > <i class="glyphicon glyphicon-chevron-left"></i> Previous</button>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-lg btn-next" id="btnWizardNext" data-last="Finish">Next <i class="glyphicon glyphicon-chevron-right"></i></button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/jquery-2.0.3.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/fuelux/js/loader.min.js') ?>"></script>
    <script>
        $(document).ready(function() { 
            $('.btn-prev').on('click', function() {
                 $('#my-wizard').wizard('previous');
            });
            
            $('.btn-next').on('click', function() {
                 $('#my-wizard').wizard('next');
            });
        });
    </script>
<?=$this->load->view('plugin_scripts/bootstrap-wysihtml5');?>    
</body>
</html>