<?php //echo "<pre/>"; print_r($memberships); exit(); ?>
<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
    <?=(isset($message)) ? $message : ''; ?>
</div>

<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row">
            <p class="text-muted">Membership Offers 
                <a class="btn custom_navbar-btn btn-primary pull-right col-sm-3" href="#top_feature" data-toggle="modal"><i class="glyphicon glyphicon-cog"></i>&nbsp; Set top offer </a>
            </p>
        </div>
    </div>

    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">

                <?php if (isset($memberships) != NULL) { ?>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 40%">Title</th>
                                <th class="text-center">Price (<?=$currency_symbol; ?>)</th>
                                <th class="text-center">Validity Period</th>
                                <th class="text-center">Top Feature</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($memberships as $membership) {
                                ?>
                                <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                    <td><?=$membership->price_table_title; ?>
                                        <div class="collapse" id="collapse_<?=$membership->price_table_id; ?>"><br/>
                                            <p class="notice-css"><span class="text-muted">Feature list: </span> 
                                            <?php foreach ($features as $feature) { $i == 0;
                                                if ($feature->parent_id == $membership->price_table_id) {
                                                    echo '<br/>'.$i.'. '.$feature->feature_item;
                                                    $i++;
                                                }
                                            } ?>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="text-center"><?=$membership->price_table_cost?></td>
                                    <td class="text-center"><?=$membership->offer_duration.' '.$membership->offer_type;?></td>
                                    <td class="text-center"><?=($membership->price_table_top)?'Yes':''; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="#collapse_<?= $membership->price_table_id; ?>"  data-toggle="collapse" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-resize-small"></i><span class="invisible-on-sm"> Quick View</span></a>
                                            <a class="btn btn-default btn-sm" href = "<?php echo base_url('membership/edit/' . $membership->price_table_id); ?>"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">  Modify</span></a>
                                            <?php if ($this->session->userdata['user_role_id'] <= 2) { ?>
                                                <a onclick="return delete_confirmation()" href = "<?php echo base_url('membership/delete/' . $membership->price_table_id); ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete</span></a>
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
                    echo 'Not data available!';
                }
                ?>
            </div>
        </div>
    </div>
</div><!--/span-->

<!-- Set top feature Modal -->
<div class="modal fade" id="top_feature" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="TRUE">  
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="TRUE">&times;</button>
        <h4 class="modal-title">Set top offer</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url() . 'membership/set_top_offer','role="form" class="form-horizontal"'); ?>
          <div class="form-group">
            <label for="question" class="col-xs-3 control-label">Select Top Offer :</label>
            <div class="col-xs-8">
              <?php
              $option = array();
              $option[0] = 'Select membership';
              foreach ($memberships as $value) {
                      $option[$value->price_table_id] = $value->price_table_title;
                      if ($value->price_table_top) {
                          $old = $value->price_table_id;
                      }
              }
              ?>
              <?php echo form_dropdown('membership_id', $option, $old,'class="form-control"') ?>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"') ?>
        <?php echo form_close() ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->