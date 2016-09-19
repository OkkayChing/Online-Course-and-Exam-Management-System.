<?php //echo "<pre/>"; print_r($courses); exit();; ?>
<div class="my-fluid-container">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 col-lg-2 sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="list-group">
                <a class="list-group-item list-group-item-heading active" href="<?php echo base_url('category/all'); ?>">All Categories</a>
                <?php 
                foreach ($categories as $cat) { 
                ?>
                    <a class="list-group-item" href="<?php echo base_url('category/' . $cat->category_id); ?>">
                        <span class="badge pull-right <?php echo ($course_count[$cat->category_id] > 0) ? 'badge-warning' : 'badge-success'; ?>"><?php echo $course_count[$cat->category_id]; ?></span>
                        <?php echo $cat->category_name; ?>
                    </a>
                <?php 
                }
                ?>
            </div>
        </div><!--/span-->

        <div class="col-xs-12 col-sm-9 col-lg-10">
            <p class="pull-left visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">View Category</button>
            </p>
            <?php
            if (isset($message) AND $message != '') {
                echo $message;
            }
            ?>
            <div class="row title-row">

            <div class="col-xs-12 exam-list-heading">
            <label class="header-label">Browsing</label>
            <h3 class="heade-title"><?php echo isset($category_name)?$category_name:'All Courses'; ?></h3>
            <div class="header-control btn-group pull-right">
                <a href="<?=base_url('course/index') ?>" class="btn btn-default">All</a>
                <a href="<?=base_url('course/courses_type/paid') ?>" class="btn btn-default">Paid</a>
                <a href="<?=base_url('course/courses_type/free') ?>" class="btn btn-default">Free</a>
            </div>
            </div>
            
            </div>
            <div class="row">
            <div class="exam-list">
            <?php 
                if (isset($courses) AND !empty($courses)) { 
                $i = 1;
                foreach ($courses as $course) {
            ?>
              <div class="col-xs-6 col-lg-3 col-md-4 exam-item">
                <div class="thumbnail">
                <a href="#" type="button" class="wishlist btn btn-warning btn-xs"><i class="glyphicon glyphicon-heart"></i> Wishlist</a>
                <a href="<?php echo base_url('course/course_summary/'.$course->course_id); ?>">
                    <?php if ($course->feature_image) { ?>
                        <img class="exam-thumbnail" src="<?php echo base_url('course-images/'.$course->feature_image); ?>" data-src="holder.js/300x300" alt="...">
                    <?php }else{ ?>
                        <img class="exam-thumbnail" src="<?php echo base_url('course-images/placeholder.png'); ?>" data-src="holder.js/300x300" alt="...">
                    <?php } ?>
                    <div class="caption">
                        <p class="course-title"><?=$course->course_title;?></p><hr/>
                        <p class="course-info"> 
                        <ul>
                            <li class="course-info-price"> <p>Price <br/> <?=$currency_symbol.$course->course_price?></p></li>
                            <li class="course-info-reviews"> <p><?=$course->course_count_reviews;?> Reviews <br/> <?=($course->course_rating)?$course->course_rating:'0.0'?></p></li>
                            <li class="course-info-students"> <p>Students <br/><i class="glyphicon glyphicon-user"></i> <?=($course->course_view_count)?$course->course_view_count:'0'?></p></li>                            
                        </ul>
                        </p>
                        <hr/>
                        <p class="court-instractor-info">
                            <img style="height: 30px; width: 30px;" src="<?=base_url('user-avatar/avatar-placeholder.jpg')?>">
                            <span> <?=$course->user_name;?></span>
                        </p>
                    </div>
                </a>
                </div>   
              </div>
            <?php
                        $i++;
                }
            } else {
                echo '<div class="col-xs-12 exam-list-heading"><h3>No course available!</h3></div>';
            }
            ?>
            </div>            
            </div>            
        </div>
    </div><!--/row-->
</div><!--/.container-->
