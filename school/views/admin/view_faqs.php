<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
    <?=(isset($message)) ? $message : ''; ?>
</div>

<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row">
            <p class="text-muted">FAQs 
                <?php if ($this->session->userdata['user_role_id'] < 4) { ?>
                    <a class="btn custom_navbar-btn btn-info pull-right col-sm-2" href="#addGrp" data-toggle="modal"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; New Group </a>
                    <a class="btn custom_navbar-btn btn-primary pull-right col-sm-2" href="<?=base_url('faq_control/faq_form'); ?>"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; New FAQ </a>
                <?php } ?>
            </p>
        </div>
    </div>

    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">
                <?php 
                $faq_grps = $this->db->get('faq_grp')->result(); 
                    if (isset($faqs) != NULL) { 
                        foreach ($faq_grps as $faq_grp) { $i = 1;
                            echo "<h5>".$faq_grp->faq_grp_name."</h5>"; ?>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th class="col-sm-1 mobile">Update</th>
                                        <th class="col-sm-3 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($faqs as $faq) { 
                                        if($faq_grp->faq_grp_id == $faq->faq_grp_id){ ?>
                                            <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                                <td>
                                                    <a href="#" data-name="faq_title" data-type="text" data-url="<?=base_url('faq_control/update_faq'); ?>" data-pk="<?= $faq->faq_id; ?>" class="data-modify-<?= $faq->faq_id; ?> no-style"><?= $faq->faq_ques; ?></a>
                                                    <div class="collapse" id="collapse_<?= $faq->faq_id; ?>">
                                                        <p class=""><br/><span class="text-muted">Answer: </span> 
                                                            <?= $faq->faq_ans; ?>
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="col-xs-1 mobile"><?= $faq->faq_last_update; ?></td>
                                                <td class="col-xs-3 text-center">
                                                    <div class="btn-group">
                                                        <?php if ($this->session->userdata['user_role_id'] <= 3) { ?>
                                                            <a href="#collapse_<?= $faq->faq_id; ?>"  data-toggle="collapse" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-resize-small"></i><span class="invisible-on-sm"> View</span></a>
                                                            <a class="btn btn-default btn-xs" href = "<?=base_url('faq_control/update_faq/'.$faq->faq_id); ?>"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">  Modify</span></a>
                                                            <a onclick="return delete_confirmation()" href = "<?=base_url('faq_control/delete_faq/' . $faq->faq_id); ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete</span></a>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                    <?php
                    }
                } else {
                    echo 'No FAQ!';
                }
                ?>
            </div>
        </div>
    </div>
</div><!--/.block-->

<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row"> <p class="text-muted">Groups</p> </div>
    </div>

    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Group Name</th>
                            <th class="col-sm-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($faq_grps as $faq_grp) { ?>
                            <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                <td><?= $faq_grp->faq_grp_name; ?></td>
                                <td class="col-xs-3 text-center">
                                    <div class="btn-group">
                                        <?php if ($this->session->userdata['user_role_id'] <= 3) { ?>
                                            <a class="btn btn-default btn-xs" href = "<?=base_url('faq_control/update_faq_grp/'.$faq_grp->faq_grp_id); ?>"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">  Modify</span></a>
                                            <a onclick="return delete_confirmation()" href = "<?=base_url('faq_control/delete_faq_grp/' . $faq_grp->faq_grp_id); ?>" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete</span></a>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>  
        </div>  
    </div>  
</div>

<!-- Question Update Modal -->
<div class="modal fade" id="addGrp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="TRUE">  
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="TRUE">&times;</button>
        <h4 class="modal-title">Create New Group</h4>
      </div>
      <div class="modal-body">
        <?=form_open(base_url('faq_control/add_grp'),'role="form" class="form-horizontal"'); ?>
          <div class="form-group">
            <label for="faq_grp_name" class="col-xs-3 control-label">Group Name :</label>
            <div class="col-xs-8">
                <?=form_input('faq_grp_name', '', 'id="update_video_title" placeholder="Group Name" class="form-control" required="required"') ?>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <?=form_submit('submit', 'Save', 'class="btn btn-primary"') ?>
        <?=form_close() ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
