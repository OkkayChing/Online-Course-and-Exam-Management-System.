<?php
// Start the session
session_start();
?>
<header id="header" role="banner">
        <div class="container">
            <div id="navbar" class="navbar navbar-default">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                        <a class="navbar-brand" href="http://eshosikhi.com/<?=($this->session->userdata('log'))?'dashboard/'.$this->session->userdata('user_id'):''?>">
                        <?php if (file_exists('./logo.png')) { ?>
                            <img src="<?=base_url();?>logo.png" width="0px" height="0px">
                        <?php }else{ 
                            echo ($brand_name)?$brand_name:'এসোশিখি';
                        } ?>
                        </a> <!-- Brand Title -->
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                      <!--  <li class="<?//=($this->uri->segment(1) == '')?'active':''; ?>"><a href="<?//=base_url();?>"><i class="fa fa-home"></i></a></li> -->
                       <!--  <li class="<?=($this->uri->segment(1) == '')?'active':''; ?>"><a href="http://eshosikhi.com/"><i class="fa fa-home"></i></a></li>-->
                       <li class="<?=($this->uri->segment(1) == '')?'active':''; ?>"><a href="courses/index.php">Home</a></li>
                        <li class="<?=($this->uri->segment(1) == 'course')?'active':''; ?>"><a href="<?=base_url('course');?>">Courses</a></li>
                        <li class="<?=($this->uri->segment(1) == 'exam_control')?'active':''; ?>"><a href="<?=base_url('exam_control/view_all_mocks');?>">Exams</a></li>
                        <!--  <li class="<?=($this->uri->segment(2) == 'pricing')?'active':''; ?>"><a href="<?=base_url('guest/pricing');?>">Subscription</a></li> -->
                       <!--  <li class="<?=($this->uri->segment(1) == 'blog')?'active':''; ?>"><a href="<?=base_url('blog');?>">Blog</a></li>  -->                   
                        <?php if ($this->session->userdata('log') || $_SESSION["log"]) { ?>
                            <li class="<?=($this->uri->segment(1) == 'noticeboard')?'active':''; ?>"><a href="<?=base_url('noticeboard/notices');?>">Notice</a></li>
                            <li class="<?=($this->uri->segment(2) == 'view_faqs')?'active':''; ?>"><a href="<?=base_url('guest/view_faqs');?>">FAQ</a></li>
                            <?php if($_SESSION["user_role_id"]==5){ ?>
                             <li class=""><a href="<?=base_url('login_control');?>">Dashboard</a></li>
                            <?php } ?>
                            <li><a href="<?=base_url('login_control/logout'); ?>"><i class="fa fa-power-off"></i></a></li>
                        <?php } ?>
                    </ul>
                </div>
                 </div>
        </div>
        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65149701-1', 'auto');
  ga('send', 'pageview');

</script>
        
    </header><!--/#header-->