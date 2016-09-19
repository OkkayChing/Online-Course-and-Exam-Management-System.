<ul class="nav navbar-nav navbar-right">
    <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$this->session->userdata('user_name')?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="<?=base_url('admin_control');?>"><i class="fa fa-user"></i> Profile</a></li>
            <li class="divider"></li>
            <li><a href="<?=base_url('login_control/logout'); ?>"><i class="fa fa-power-off"></i> Log Out</a></li>
        </ul>
    </li>
</ul>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65149701-1', 'auto');
  ga('send', 'pageview');

</script>