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
                    <div class="block-search">
                        <?=form_open(base_url('blog/find'), 'method="GET" role="form" class="form-horizontal"'); ?>
                            <input name="keyword" type="search" class="form-control" placeholder="Search..." />
                        <?=form_close(); ?>
                    </div>
                    <div class="blog"><!-- /.row Start-->
                        <?php if(empty($blogs)) echo "<h3>No result found!</h3>"; ?>            
                        <?php foreach ($blogs as $value) { ?>
                            <div class="blog-post">
                                <h1 class="text-center"><a href="<?=base_url('blog/post/'.$value->blog_id); ?>"><?=$value->blog_title; ?></a></h1>
                                <div class="blog-caption"><em>Author: <?=$value->user_name.', Published: '. date("F j, Y", strtotime($value->blog_post_date)); ?></em></div>
                                <div class="blog-body"><?=$value->blog_body; ?></div>
                                <div class="read-more"><a href="<?=base_url('blog/post/'.$value->blog_id); ?>" class="btn btn-default btn-sm col-sm-4 col-sm-offset-4"> Read More </a></div>
                            </div>
                        <?php } ?>
                    </div><!-- /.row End-->
                    
                    <div class="text-center">
                         <?=$this->pagination->create_links(); ?>
                    </div>
                </div><!--/.col-md-4-->
            </div><!--/.row-->
        </div><!--/.box-->
    </div><!--/.container-->
</section><!--/#services-->