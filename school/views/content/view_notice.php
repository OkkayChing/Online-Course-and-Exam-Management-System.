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
                            <h1 class="text-center"><?=$notice->notice_title; ?></h1>
                            <div class="blog-caption"><em>Created by: <?=$notice->notice_created_by.', Published: '. date("F j, Y", strtotime($notice->notice_start)); ?></em></div>
                            <div class="blog-body"><?=$notice->notice_descr; ?></div>
                        </div>
                    </div><!-- /.row End-->
                </div><!--/.col-md-10-->
            </div><!--/.row-->
        </div><!--/.box-->
    </div><!--/.container-->
</section><!--/#services-->