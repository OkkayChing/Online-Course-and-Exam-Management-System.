<section id="contact">
    <div class="container">
        <div class="box">
            <div class="row">
                <div class="col-sm-12">
                    <h3>Find Us</h3>
                    <p>Write a message, we will get back to you.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 col-sm-12">
                    <div class="status alert alert-success" style="display: none"></div>
                    <?=form_open(base_url('guest/contact'), 'role="form" id="contact_form" class="contact-form"'); ?>
                        <input type="hidden" name="token" value="<?=time();?>">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12 minpadding">
                               <?=form_input('name', '', 'placeholder="Your Name " class="form-control" id="name" required="required"') ?>
                            </div>
                            <div class="col-sm-6 col-xs-12 minpadding">
                               <?=form_input('email', '', 'id="email" pattern="^[a-zA-Z0-9.!#$%&'."'".'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="you@domain.com" placeholder="Your Email Address" type="email" class="form-control" required="required"') ?>
                            </div>
                            <div class="col-sm-12 minpadding">
                                <?=form_input('subject', '', 'id="subject" placeholder="Subject" class="form-control" required="required"') ?>
                            </div>
                            <div class="col-sm-12 minpadding">
                                <div class="form-group">
                                    <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-info  btn-outline btn-lg"><i class="fa fa-envelope-o"></i> Send Message</button>
                            </div>
                        </div>
                    <?=form_close(); ?>
                </div><!--/.col-md-6 col-sm-5-->
                <div class="col-md-5 col-sm-12">
                    <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?=urlencode($address)?>&output=embed"></iframe>
                </div><!--/.col-md-4 col-sm-5-->

                <div class="col-md-2 col-md-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <h3 style="margin-top: 0px;">Location </h3>
                            <?php $address = str_replace(',','<br/>',$address); ?>
                            <address>
                                <?=$address;?>
                                <br/>
                                Phone: <?=$support_phone;?>
                            </address>
                        </div><!--/.col-md-12 col-sm-6-->
                        <div class="col-md-12 col-sm-6">
                            <h3>Be Social</h3>
                            <ul class="social">
                                <?php if ($facbook_url): ?>
                                    <li><a class="text-muted" href="<?= $facbook_url; ?>" target="_blank"><i class="fa fa-facebook"></i> Facebook</a></li>
                                <?php endif; ?>
                                <?php if ($googleplus_url): ?>
                                    <li><a class="text-muted" href="<?= $googleplus_url; ?>" target="_blank"><i class="fa fa-google-plus"></i> Google Plus</a></li>
                                <?php endif; ?>
                                <?php if ($linkedin_url): ?>
                                    <li><a class="text-muted" href="<?= $linkedin_url; ?>" target="_blank"><i class="fa fa-linkedin"></i> Linkedin</a></li>
                                <?php endif; ?>
                                <?php if ($twitter_url): ?>
                                    <li><a class="text-muted" href="<?= $twitter_url; ?>" target="_blank"><i class="fa fa-twitter"></i> Twitter</a></li>
                                <?php endif; ?>
                                <?php if ($you_tube_url): ?>
                                    <li><a class="text-muted" href="<?= $you_tube_url; ?>" target="_blank"><i class="fa fa-youtube"></i> Youtube</a></li>
                                <?php endif; ?>
                                <?php if ($pinterest_url): ?>
                                    <li><a class="text-muted" href="<?= $pinterest_url; ?>" target="_blank"><i class="fa fa-pinterest"></i> Pinterest</a></li>
                                <?php endif; ?>
                                <?php if ($flickr_url): ?>
                                    <li><a class="text-muted" href="<?= $flickr_url; ?>" target="_blank"><i class="fa fa-flickr"></i> Flickr</a></li>
                                <?php endif; ?>
                            </ul>
                        </div><!--/.col-md-12 col-sm-6-->
                    </div><!--/.row-->
                </div><!--/.col-md-2 col-sm-5-->
            </div><!--/.row-->
        </div><!--/.box-->
    </div><!--/.container-->
</section><!--/#contact-->
