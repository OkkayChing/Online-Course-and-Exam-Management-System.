<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="এসোশিখি">
        <title>এসোশিখি</title>
        <!--Header-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,600,700' rel='stylesheet' type='text/css'>
<!-- Bootstrap core CSS -->
<link href="http://eshosikhi.com/courses/assets/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">

<!-- Font Awesome -->
<link href="http://eshosikhi.com/courses/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" media="screen">

<!-- Custom CSS  -->
<link href="http://eshosikhi.com/courses/assets/css/front.css" rel="stylesheet" media="screen">
<!--<link href="" rel="stylesheet" media="screen"> -->
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="http://eshosikhi.com/courses/assets/js/jquery-2.0.3.min.js"></script>
<!-- <script src="http://eshosikhi.com/courses/assets/js/video.js"></script> -->
        <!--Page Specific Header-->
            </head>
    <body>
      
        <!--Content-->
        <section id="login">
    <div class="container-fluid">
        <div class="box">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                                                
                                    </div>
                <div class="col-md-8 col-xs-12 col-md-offset-2 col-xs-offset-0">
                   <!-- <div class="center"> <h3>Register</h3> </div>--><!--/.center--> 
                    <form accept-charset="utf-8" method="post" class="form-horizontal" role="form" action="http://eshosikhi.com/courses/login_control/register">                        <div class="row">
                            <div class="col-md-12 minpadding">
                                
<input type="hidden" value="<?php echo rand(9999,99999999);?>" name="token">
                                <input type="text" required="required" class="form-control" placeholder="User Name *" id="user_name" value="" name="user_name" kl_virtual_keyboard_secure_input="on">                                <input type="text" required="required" class="form-control" placeholder="Email address *" title="you@domain.com" pattern="^[a-zA-Z0-9.!#$%&amp;'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" id="user_email" value="" name="user_email" kl_virtual_keyboard_secure_input="on">                                <input type="text" class="form-control" placeholder="Phone Number" max="15" min="8" title="Enter Valid Phone Number" pattern="^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$" id="user_phone" value="" name="user_phone" kl_virtual_keyboard_secure_input="on">                            </div><!--/.col-md-12-->
                        </div><!--/.row-->
                            
                        <div class="row">
                            <div class="col-md-6 minpadding">
                                <input type="password" required="required" class="form-control" placeholder="Password * (Minimum 6 character)" id="user_pass" value="" name="user_pass" kl_virtual_keyboard_secure_input="on">                            </div>
                            <div class="col-md-6 minpadding">
                                <input type="password" required="required" class="form-control" placeholder="Confirm Password *" id="user_passcf" value="" name="user_passcf" kl_virtual_keyboard_secure_input="on">                            </div>
                        </div>
                        <div class="big-gap"></div>
                        <div class="row">
                            <div class="col-md-11 minpadding">
                                <button class="btn btn-warning btn-lg btn-block" type="submit">Register</button>
                            </div><!--/.col-md-11-->
                           <!-- <div class="col-md-1 minpadding">
                                <button class="btn btn-default btn-lg btn-lg pull-right" type="reset">Reset</button>
                            </div> --><!--/.col-md-1-->
                        </div><!--/.row-->
                    </form>                    <div class="big-gap"></div>
                 <!--   <i class="glyphicon glyphicon-bell"> </i> Have an account? <a href="http://eshosikhi.com/courses/login_control"> Login</a>-->
                </div><!--/.col-md-8 .col-xs-12-->
            </div><!--/.row-->
        </div><!--/.box-->
    </div><!--/.container-->
</section><!--/#login-->
        