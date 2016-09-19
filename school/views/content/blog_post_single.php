<section id="blog">
    <div class="container">
        <div class="box">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
                    <?=(isset($message)) ? $message : ''; ?>
                </div>
                <div class="col-md-10 col-sm-12 col-md-offset-1 col-sm-offset-0">
                    <div class="blog"><!-- /.row Start-->
                        <div class="blog-post">
                            <h1 class="text-center"><?=$post->blog_title; ?></h1>
                            <div class="blog-caption"><em>Author: <?=$post->user_name.', Published: '. date("F j, Y", strtotime($post->blog_post_date)); ?></em></div>
                            <div class="blog-body"><?=$post->blog_body; ?></div>
                        </div>
                    </div><!-- /.row End-->
                </div><!--/.col-md-10-->
            </div><!--/.row-->
            <div class="row">
                <div class="col-md-10 col-sm-12 col-md-offset-1 col-sm-offset-0">
                <div class="blog-comments">
                    <hr/>
                    <h5><?=count($post_comments)?> Comments</h5>
                    <?=form_open('blog/comment');?>
                        <input type="hidden" name="blog_id" value="<?=$post->blog_id;?>">
                        <div class="col-xm-12">
                            <textarea name="blog_comment" class="form-control" placeholder="Leave your comment here..." rows="2"></textarea>                            
                            <div class="text-right"><button type="submit" class="btn btn-sm btn-warning">Submit</button></div>
                        </div>
                    <?=form_close(); ?>
                    <div class="row comment-section">
                    <?php foreach ($post_comments as $value) { ?>
                        <div class="old-comments col-xs-12">
                            <div class="avatar col-xs-1"><img src="<?=base_url('user-avatar/avatar-placeholder.jpg')?>"></div>
                            <div class="comment-body-section col-xs-11">
                                <h5><?=$value->user_name;?> <small class="pull-right"><em> Posted: <?=date('D, d M Y', strtotime($value->comment_date));?> </em></small></h5>
                                <blockquote>
                                    <?=$value->comment_body;?>
                                </blockquote>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>                
                </div><!--/.col-md-10-->
            </div><!--/.row-->

        </div><!--/.box-->
    </div><!--/.container-->
</section><!--/#services-->