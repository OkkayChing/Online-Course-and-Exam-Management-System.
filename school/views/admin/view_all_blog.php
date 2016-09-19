<?php //echo "<pre/>"; print_r($blogs); exit(); ?>
<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
    <?=(isset($message)) ? $message : ''; ?>
</div>

<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row">
            <p class="text-muted">Blog posts 
                <a class="btn custom_navbar-btn btn-primary pull-right col-sm-3" href="<?php echo base_url('blog/add'); ?>"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add Post </a>
            </p>
        </div>
    </div>

    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">

                <?php if (isset($blogs) != NULL) { ?>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50%">Post</th>
                                <th class="col-sm-1 mobile">Date</th>
                                <th class="col-sm-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($blogs as $blog) {
                                ?>
                                <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                    <td><?= $blog->blog_title; ?>
                                        <div class="collapse" id="collapse_<?= $blog->blog_id; ?>"><br/>
                                            <p class="notice-css"><span class="text-muted">Content: </span> 
                                                <?= $blog->blog_body; ?>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="col-xs-1 mobile"><?= $blog->blog_post_date; ?></td>
                                    <td class="col-xs-3 text-center">
                                        <div class="btn-group">
                                            <a href="#collapse_<?= $blog->blog_id; ?>"  data-toggle="collapse" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-resize-small"></i><span class="invisible-on-sm"> View</span></a>
                                            <a class="btn btn-default btn-sm" href = "<?php echo base_url('blog/edit/' . $blog->blog_id); ?>"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">  Modify</span></a>
                                            <?php if ($this->session->userdata['user_role_id'] <= 2) { ?>
                                                <a onclick="return delete_confirmation()" href = "<?php echo base_url('blog/delete/' . $blog->blog_id); ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete</span></a>
                                                    <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo 'No blogs!';
                }
                ?>
            </div>
        </div>
    </div>
</div><!--/span-->
