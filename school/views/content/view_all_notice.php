<section id="noticeboard">
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
                        <?php if(empty($notices)) echo "<h3>No result found!</h3>"; ?>            
                        <?php foreach ($notices as $value) { ?>
                            <div class="blog-post">
                                <h1 class="text-center"><a href="<?=base_url('noticeboard/notice/'.$value->notice_id); ?>"><?=$value->notice_title; ?></a></h1>
                                <div class="blog-caption"><em>Created by: <?=$value->notice_created_by.', Published: '. date("F j, Y", strtotime($value->notice_start)); ?></em></div>
                                <div class="blog-body"><?=$value->notice_descr; ?></div><br/>
                                <div class="read-more"><a href="<?=base_url('noticeboard/notice/'.$value->notice_id); ?>" class="btn btn-default btn-sm col-sm-4 col-sm-offset-4"> Read More </a></div>
                            </div>
                        <?php } ?>
                    </div><!-- /.row End-->
                </div><!--/.col-md-4-->
            </div><!--/.row-->
        </div><!--/.box-->
    </div><!--/.container-->
</section><!--/#noticeboard-->