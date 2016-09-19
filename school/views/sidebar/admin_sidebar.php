<!-- \ css class control -->
<?php
if (isset($class)) {
    $active = floor($class/10); //The numeric value to round
}
?>
<!-- \ Sidebar -->
<ul class="nav sidebar">
    <li>
        <a href="<?=base_url('dashboard/'.$this->session->userdata('user_id')); ?>">
            <i class="fa fa-dashboard fa-2x"></i> Dashboard
        </a>
    </li>
    <?php if ($this->session->userdata['user_role_id'] <= 3) { ?>
    <li><a href="#" class="sub <?=($active==1)?"active":'';?>"><i class="fa fa-user"> </i> User Control</a>
        <ul>
            <li><a href="<?=base_url('user_control');?>" class="<?=($class==11)?"current":'';?>">View Users</a></li>
            <li><a href="<?=base_url('user_control/user_add_form');?>" class="<?=($class==12)?"current":'';?>">Add New User</a></li>
            <li><a href="<?=base_url('user_control/view_banned_users');?>" class="<?=($class==13)?"current":'';?>">Banned / Inactive Users</a></li>
        </ul>
    </li>
    <?php } ?>
    <?php if ($this->session->userdata['user_role_id'] <= 4) { ?>
    <li><a href="#" class="sub <?=($active==9)?"active":'';?>"><i class="fa fa-book"></i> Course Control</a>
        <ul>
            <li><a href="<?=base_url('course/view_all_courses');?>" class="<?=($class==91)?"current":'';?>">View Courses</a></li>
            <li><a href="<?=base_url('course/create_course');?>" class="<?=($class==92)?"current":'';?>">Create Course</a></li>
        </ul>
    </li>
    <?php } ?>
    <?php if ($this->session->userdata['user_role_id'] <= 4) { ?>
    <li><a href="#" class="sub <?=($active==2)?"active":'';?>"><i class="fa fa-bullseye"></i> Exam Control</a>
        <ul>
            <li><a href="<?=base_url('mocks');?>" class="<?=($class==21)?"current":'';?>">View Exams</a></li>
            <li><a href="<?=base_url('create_mock');?>" class="<?=($class==22)?"current":'';?>">Create Exam</a></li>
            <li><a href="<?=base_url('exam_control/view_results');?>" class="<?=($class==25)?"current":'';?>">View Results</a></li>
        </ul>
    </li>
    <?php } else { ?>
        <li><a href="<?=base_url('exam_control/view_results');?>" class="<?=($active==2)?"active":'';?>"><i class="fa fa-puzzle-piece"></i> View Results</a></li>
    <?php } ?>
    <?php if ($this->session->userdata['user_role_id'] <= 4) { ?>
    <li><a href="#" class="sub <?=($active==6)?"active":'';?>"><i class="fa fa-code-fork"></i> Categories</a>
        <ul>
            <li><a href="<?=base_url('admin_control/view_categories');?>" class="<?=($class==61)?"current":'';?>">View Categories</a></li>
            <li><a href="<?=base_url('create_category');?>" class="<?=($class==62)?"current":'';?>">Create New Category</a></li>
            <li><a href="<?=base_url('admin_control/view_subcategories');?>" class="<?=($class==63)?"current":'';?>">View Sub-Categories</a></li>
            <li><a href="<?=base_url('admin_control/subcategory_form');?>" class="<?=($class==64)?"current":'';?>">Create Sub-Category</a></li>
        </ul>
    </li>
    <?php }?>
    <?php if ($commercial) { ?>
    <?php if ($this->session->userdata['user_role_id'] <= 2) { ?>
    <li><a href="#" class="sub <?=($active==8)?"active":'';?>"><i class="fa fa-list"> </i> Membership</a>
        <ul>
            <li><a href="<?=base_url('membership');?>" class="<?=($class==81)?"current":'';?>">View Membership</a></li>
            <li><a href="<?=base_url('membership/add');?>" class="<?=($class==82)?"current":'';?>">Create Offer</a></li>
            <li><a href="<?=base_url('membership/add_feature');?>" class="<?=($class==83)?"current":'';?>">Add New Feature</a></li>
        </ul>
    </li>
    <?php } ?>
    <?php } ?>
    <?php if ($this->session->userdata['user_role_id'] <= 4) { ?>
    <li><a href="#" class="sub <?=($active==7)?"active":'';?>"><i class="fa fa-comment"> </i> Blog</a>
        <ul>
            <li><a href="<?=base_url('blog/view_all');?>" class="<?=($class==71)?"current":'';?>">View Posts</a></li>
            <li><a href="<?=base_url('blog/add');?>" class="<?=($class==72)?"current":'';?>">Add Post</a></li>
        </ul>
    </li>
    <?php } ?>
    <?php if ($this->session->userdata['user_role_id'] <= 3) { ?>
    <li><a href="#" class="sub <?=($active==3)?"active":'';?>"><i class="fa fa-cogs"> </i> Admin Area</a>
        <ul>
            <li><a href="<?=base_url('admin_control');?>" class="<?=($class==31)?"current":'';?>">Profile Settings</a></li>
            <?php if ($this->session->userdata['user_role_id'] <= 2) { ?>
            <li><a href="<?=base_url('admin/system_control/view_settings');?>" class="<?=($class==32)?"current":'';?>">System Settings</a></li>
            <li><a href="<?=base_url('noticeboard'); ?>" class="<?=($class==34)?"current":'';?>"> Noticeboard</a></li>        
            <li><a href="<?=base_url('message_control'); ?>" class="<?=($class==36)?"current":'';?>"> Inbox</a></li>        
            <li><a href="<?=base_url('admin_control/view_payment_history'); ?>" class="<?=($class==35)?"current":'';?>"> Payment History</a></li>        
            <?php }?>
            <li><a href="<?=base_url('faq_control');?>" class="<?=($class==33)?"current":'';?>">FAQ</a></li>
        </ul>
    </li>
    <?php } else { ?>
        <li><a href="<?=base_url('admin_control');?>" class="<?=($active==3)?"active":'';?>"><i class="fa fa-cogs"> </i> Profile Settings</a></li>
    <?php } ?>
    <?php if ($this->session->userdata['user_role_id'] > 2) { ?>
        <li><a class="<?=($active==4)?"active":'';?>" href="<?=base_url('message_control/contact_form');?>" class="<?=($class==42)?"current":'';?>"><i class="fa fa-envelope-o"></i> Contact Admin</a></li>
    <?php }?>
    <li><a href="<?=base_url('login_control/logout'); ?>"><i class="fa fa-power-off"></i> Logout</a></li>
</ul>
<!-- /End Sidebar -->
