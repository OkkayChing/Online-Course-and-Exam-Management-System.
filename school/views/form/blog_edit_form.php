<?php //echo "<pre/>"; print_r($notice); exit(); ?>
<?php 
if ($message) { 
    echo $message;
}
?>
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Edit Post </p></div>
    </div>
    <div class="block-content">
    <form action="<?php echo base_url('blog/update/'.$blog->blog_id)?>" method="post" role="form" class="form-horizontal">  
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="blog_title" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Title: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                    <?php echo form_input('blog_title', $blog->blog_title, 'placeholder="Post title" id="title" class="form-control" required="required"') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="blog_body" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px;">Content : </label>
                <div class="col-lg-9 col-sm-9 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'blog_body',
                        'id'          => 'blog_body',
                        'value'       =>  $blog->blog_body,
                        'rows'        => '20',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <br/><hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Save</button>

                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
</div>
<?=$this->load->view('plugin_scripts/bootstrap-wysihtml5');?>
