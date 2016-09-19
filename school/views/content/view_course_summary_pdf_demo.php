<div id="note">
    <?php 
    if ($message) {
        echo $message;    
    }
    ?>
</div>
<div class="container">
    <div class="col-md-3">
        <div>

        <?php if ($course->feature_image) { ?>
            <img class="course-summary-thumbnail" width="250" src="<?php echo base_url('course-images/'.$course->feature_image); ?>" alt="...">
        <?php }else{ ?>
            <img class="course-summary-thumbnail" width="250" src="<?php echo base_url('course-images/placeholder.png'); ?>" alt="...">
        <?php } ?>
        </div><br/><br/>
        <p class="lead">Category: <?=$course->category_name.' / '.$course->sub_cat_name; ?></p>
        <div>
            <span>Instructor</span>
            <h4><img style="height: 50px; width: 50px;" src="<?=base_url('user-avatar/avatar-placeholder.jpg')?>">
            <?=$course->user_name?></h4>
        </div>

    </div>
    <div class="col-md-7">
        <p class="lead"><b><?=$course->course_title?></b></p>
        <p><?=$course->course_intro; ?></p>
        <p>
            <img src="<?=base_url('course-images/CPkGq6G.png')?>"/>
            <img src="<?=base_url('course-images/CPkGq6G.png')?>"/>
            <img src="<?=base_url('course-images/CPkGq6G.png')?>"/>
            <img src="<?=base_url('course-images/CPkGq6G.png')?>"/>
            <img src="<?=base_url('course-images/CPkGq6G.png')?>"/>
            <?=$course->course_count_reviews;?> Reviews
        </p><hr/>
        <p><?=$course->course_description; ?></p>
        <div>
            <h4>Course requirement</h4>
            <div><?=$course->course_requirement; ?></div>
            <h4>What am I going to get from this course?</h4>
            <div><?=$course->what_i_get; ?></div>
            <h4>What is the target audience?</h4>
            <div><?=$course->target_audience; ?></div>
        </div>
        <div>
            <h3>CURRICULUM</h3>
            <div class="course-video-container">
            <ul class="listUl">
            <?php $i = 1;
                  $b = 1;
                       
                foreach ($sections as $value) {
             ?>
                <div class="chap-title" data-video-section="<?=' '.$value->section_title;?>" ><b>Section<?= $b++;?> : </b> <h5 class="sectiontitle" ><?=' '.$value->section_title;?> </h5></div>
                <?php 
                    $docs = explode(',', $value->doc_ids);
                    foreach ($docs as $doc) { 
                        $doc_info = $this->db->get_where('course_docs', array('doc_id'=>$doc))->row();
                        $doc_preview = $this->db->get_where('course_docs', array('doc_id'=>$doc,'preview_type'=>'free'))->row();
//$a=$dideo_info->video_id;
// next($a[0]);
                ?>
                    <li class="lec" >
                        <div class="lec-left">
                            <span class="course-no"><?=$i;?> </span>
                        </div>
                        <div class="lec-right">
                            <div class="lec-url">
                                <div class="lec-main fxac">
                                    <div class="lec-title" >
                                        
                                        <?php if (!$this->session->userdata('log')) {?>
                                        <!-- Video playlist -->
                                        
                                            <?php if(!empty($docdoc_preview)) {?>
                                            <i class="glyphicon glyphicon-expand"></i> <?=$doc_info->vdoc_title; ?>

                                            <button class="videoplaylink" data-toggle="modal" data-target="#videoModal" data-video-url="<?php echo base_url('course_videos/'.$doc_preview->course_id.'/'.$doc_preview->doc_link); ?>" type="button" id="nextSec" class="btn btn-default">Preview</button>
                                            <?php }else{ ?>
                                            <i class="glyphicon glyphicon-expand"></i> <?=$doc_info->doc_title; ?>
                                        <div id="fade" class="black_overlay"></div>

                                            <?php } ?>
                                            <?php }else{ ?>
                                        


                                        <!-- Video playlist -->
                                        <a href="" class="videoplaylink" data-toggle="modal" data-target="#videoModal" data-video-url="<?php echo base_url('course_docs/'.$doc_info->course_id.'/'.$doc_info->doc_link); ?>" ><i class="glyphicon glyphicon-expand"></i> <?=$doc_info->doc_title; ?></a>
                                        <div id="fade" class="black_overlay"></div>
                                        <?php } ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                 <?php $i++; } ?>
             <?php } ?>
                  
                                          
            </ul>




<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="modalClose" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4  class="modal-title" id="myModalLabel">
                    <span id="modaltitle"></span>
                    <span id="modalVideotitle"></span>
                </h4>
            </div>
            <div class="modal-body">
                <!-- <video class="videoPlayer" width="100%" height="365" controls autoplay src="" type="video/x-flv" /> -->
                <embed  width="100%" height="365" >

    <!-- </video> -->
            </div>
            <div class="modal-footer" style=" text-align: center;">
                <button type="button" id="prevSec" class="btn btn-default">Previous Section</button>
                <button type="button" id="prevVideo" class="btn btn-default" >Previous Video</button>
                <button type="button" id="nextVideo" class="btn btn-default" >Next Video</button>
                
                <button type="button" id="nextSec" class="btn btn-default">Next Section</button>
            </div>
        </div>
    </div>
</div>


            </div>
        </div>

    </div>
    <div class="col-md-2">
        <div class="pb-t">
            <div class="pb-p">
                <span class="pb-ph">PRICE:</span>
                <span class="pb-pr ">
                    $99</span>
            </div> 
            <div class="pb-ta">
                <a class="btn btn-primary ">
                        Take This Course                
                </a>
            </div>           
        </div><hr/>
        <div style="background-color: #e0e0e0;">
            <h4 class="related_courses">Related courses: </h4>
            <?php 
                $related_courses = $this->db->get_where('courses', array('category_id'=>$course->category_id))->result();
                foreach ($related_courses as $value) { 
             ?>
                <div class="thumbnail">
                <a href="#" type="button" class="wishlist btn btn-warning btn-xs"><i class="glyphicon glyphicon-heart"></i> Wishlist</a>
                <a href="<?php echo base_url('course/course_summary/'.$course->course_id); ?>">
                    <?php if ($value->feature_image) { ?>
                        <img class="exam-thumbnail" src="<?php echo base_url('course-images/'.$course->feature_image); ?>" data-src="holder.js/300x300" alt="...">
                    <?php }else{ ?>
                        <img class="exam-thumbnail" src="<?php echo base_url('course-images/placeholder.png'); ?>" data-src="holder.js/300x300" alt="...">
                    <?php } ?>
                    <div class="caption">
                        <p class="course-title"><?=$value->course_title;?></p><hr/>
                        <p class="course-info"> 
                        <ul>
                            <li class="course-info-price"> <p>Price <br/> <?=$currency_symbol.$value->course_price?></p></li>
                            <li class="course-info-reviews"> <p><?=$value->course_count_reviews;?> Reviews <br/> <?=($value->course_rating)?$value->course_rating:'0.0'?></p></li>
                            <li class="course-info-students"> <p>Students <br/><i class="glyphicon glyphicon-user"></i> <?=($value->course_view_count)?$value->course_view_count:'0'?></p></li>                            
                        </ul>
                        </p>
                        <hr/>
                        <p class="court-instractor-info">
                            <img style="height: 30px; width: 30px;" src="<?=base_url('user-avatar/avatar-placeholder.jpg')?>">
                            <span> <?=$value->user_name;?></span>
                        </p>
                    </div>
                </a>
                </div>                
             <?php } ?>
        </div>
    </div>
</div>
