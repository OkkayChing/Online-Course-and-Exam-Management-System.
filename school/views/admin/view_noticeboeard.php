<?php //echo "<pre/>"; print_r($notices); exit(); ?>
<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
    <?=(isset($message)) ? $message : ''; ?>
</div>

<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row">
            <p class="text-muted">Noticeboard 
                <?php if ($this->session->userdata['user_role_id'] < 3) { ?>
                    <a class="btn custom_navbar-btn btn-primary pull-right col-sm-3" href="<?php echo base_url('noticeboard/add'); ?>"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Add Notice </a>
                <?php } ?>
            </p>
        </div>
    </div>

    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">

                <?php if (isset($notices) != NULL) { ?>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50%">Notice</th>
                                <th class="col-sm-1 mobile">Starts</th>
                                <th>Ends</th>
                                <th>Status</th>
                                <th class="col-sm-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($notices as $notice) {
                                ?>
                                <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                    <td><?= $notice->notice_title; ?>
                                        <div class="collapse" id="collapse_<?= $notice->notice_id; ?>"><br/>
                                            <p class="notice-css"><span class="text-muted">Description: </span> 
                                                <?= $notice->notice_descr; ?>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="col-xs-1 mobile"><?= $notice->notice_start; ?></td>
                                    <td><?= $notice->notice_end; ?></td>
                                    <td><?= ($notice->notice_status)?'Active':'Inactive'; ?></td>
                                    <td class="col-xs-3 text-center">
                                        <div class="btn-group">
                                            <a href="#collapse_<?= $notice->notice_id; ?>"  data-toggle="collapse" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-resize-small"></i><span class="invisible-on-sm"> View</span></a>
                                            <a class="btn btn-default btn-sm" href = "<?php echo base_url('noticeboard/edit/' . $notice->notice_id); ?>"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">  Modify</span></a>
                                            <?php if ($this->session->userdata['user_role_id'] <= 2) { ?>
                                                <a onclick="return delete_confirmation()" href = "<?php echo base_url('noticeboard/delete/' . $notice->notice_id); ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete</span></a>
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
                    echo 'No notice!';
                }
                ?>
            </div>
        </div>
    </div>
</div><!--/span-->
