     <section id="main-slider" class="carousel">
        <div class="col-xs-10 col-xs-offset-1 " style="margin-top: -90px;">
            <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
            <?=(isset($message)) ? $message : ''; ?>
        </div>
        <div class="carousel-inner">
            <?php $i = 0;
            $sliders = $this->db->where('content_type', 'slider_text')->get('content')->result();
            foreach ($sliders as $slider) { $i++; ?>
            <div class="item <?=($i==1)?'active':'';?>">
                <div class="container">
                    <div class="carousel-content">
                        <h1><?=$slider->content_heading;?></h1>
                        <p class="lead"><?=$slider->content_data;?></p>
                    </div>
                </div>
            </div><!--/.item-->
            <?php } ?>
        </div><!--/.carousel-inner-->
        <?php if (!$this->session->userdata('log')): ?>
            <div class="center">
                <?php if ($student_can_register): ?>
                    <a href="#register" class="btn btn-primary btn-home-slider btn-lg register_open">Register</a>
                <?php endif; ?>
                <a href="#login" class="btn btn-primary btn-home-slider btn-lg login_open">Login</a>
            </div>
        <?php endif; ?>
        <a class="prev" href="#main-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
        <a class="next" href="#main-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>
    </section><!--/#main-slider-->

    <section id="about-us">
        <div class="container">
            <div class="box first">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-md-offset-0 col-sm-offset-0">
                        <div class="center">
                            <?php $temp = $this->db->get_where('content', array('content_type' => 'about_us'))->row(); ?>
                            <!-- <i class="fa fa-apple fa fa-md fa fa-color1"></i> -->
                            <h1><?//=$temp->content_heading; ?></h1>
                          <p><?//=$temp->content_data;  ?></p>
                            
                         
                        </div>
                    </div><!--/.col-md-4-->
                </div><!--/.row-->
            </div><!--/.box-->
        </div><!--/.container-->
    </section>
    <!--/#services-->