<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
    <?=(isset($message)) ? $message : ''; ?>
</div>

<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row">
            <p class="text-muted">Messages 
                <a class="btn custom_navbar-btn btn-primary pull-right col-sm-3" href="#compose" data-toggle="modal"><i class="glyphicon glyphicon-edit"></i>&nbsp; Compose New Message </a>
            </p>
        </div>
    </div>

    <div class="block-content">
    <div class="row">
    <div class="col-sm-12">
    <?php if (isset($messages) != NULL) { ?>
        
    <!--BEGIN TABS-->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_Inbox" data-toggle="tab">Inbox</a></li>
            <li><a href="#tab_Send" data-toggle="tab">Send</a></li>
            <li><a href="#tab_Drafts" data-toggle="tab">Drafts</a></li>
            <li><a href="#tab_Spam" data-toggle="tab">Spam</a></li>
            <li><a href="#tab_Trash" data-toggle="tab">Trash</a></li>
        </ul>
        <div class="tab-content info-display">
            <div class="tab-pane" id="tab_Trash">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-hover">
                   <thead>
                       <tr>
                           <th><span><input type="checkbox"></span></th>
                           <th class="col-sm-2 mobile">Sender</th>
                           <th class="col-sm-6">Subject</th>
                           <th class="col-sm-2 invisible-on-sm">Directory</th>
                           <th class="col-sm-2 text-center">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                   <?php
                    $i = 1; 
                    $j = 0;
                    foreach ($messages as $msg) {
                        if ($msg->trash == 1) {
                            $j = 1;
                   ?>
                   <tr class="<?=($i & 1) ? 'even' : 'odd'; echo($msg->message_read == 0) ? ' bold-text ' : ' '; ?>" href="<?=base_url('message_control/open_message/'.$msg->message_id); ?>">
                       <td><span><input type="checkbox"></span></td>
                       <td class="col-sm-2 mobile clickableRow"><?=$msg->message_sender; ?></td>
                       <td class="col-sm-5 clickableRow"><?=$msg->message_subject; echo($msg->numOfReply != 0) ? ' ('.++$msg->numOfReply.')' : ''; ?></td>
                       <td class="col-sm-2  invisible-on-sm clickableRow"><?=$msg->message_folder; ?></td>
                       <td class="col-sm-2 text-center">
                           <div class="btn-group">
                               <a href="<?php echo base_url('message_control/move_message/untrash/' . $msg->message_id); ?>" class="btn btn-sm btn-default"><i class="fa fa-reply"></i><span class="invisible-on-sm"> Inbox</span></a>
                               <button type="button" class="btn  btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                               </button>
                               <ul class="dropdown-menu text-left" role="menu">
                                  <li><a href="<?php echo base_url('message_control/move_message/untrash/' . $msg->message_id) ; ?>"><i class="glyphicon glyphicon-envelope"></i><span class="invisible-on-sm"> Move to</span> Inbox </a></li>
                                  <li class="divider"></li>
                                  <li><a onclick="return delete_confirmation()" href = "<?php echo base_url('message_control/delete_message/' . $msg->message_id); ?>"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete forever</span></a></li>
                               </ul>
                           </div>
                       </td>
                   </tr>
                   <?php
                        }
                        $i++;                       
                    }
                    if ($j == 0) {
                        echo '<tr><td colspan="5"><h4>  Trash is empty!</h4> <td></tr>';
                    }
                    ?>
                   </tbody>
                </table>
           </div>

            <div class="tab-pane" id="tab_Spam">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-hover">
                   <thead>
                       <tr>
                           <th><span><input type="checkbox"></span></th>
                           <th class="col-sm-2 mobile">Sender</th>
                           <th class="col-sm-6">Subject</th>
                           <th class="col-sm-2 invisible-on-sm">Directory</th>
                           <th class="col-sm-2 text-center">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                   <?php
                    $i = 1; 
                    $j = 0;
                    foreach ($messages as $msg) {
                        if (($msg->trash == 0) && ($msg->spam == 1)) {
                            $j = 1;
                   ?>
                   <tr class="<?=($i & 1) ? 'even' : 'odd'; echo($msg->message_read == 0) ? ' bold-text ' : ' '; ?>" href="<?=base_url('message_control/open_message/'.$msg->message_id); ?>">
                       <td><span><input type="checkbox"></span></td>
                       <td class="col-sm-2 mobile clickableRow"><?=$msg->message_sender; ?></td>
                       <td class="col-sm-5 clickableRow"><?=$msg->message_subject; echo($msg->numOfReply != 0) ? ' ('.++$msg->numOfReply.')' : ''; ?></td>
                       <td class="col-sm-2  invisible-on-sm clickableRow"><?=$msg->message_folder; ?></td>
                       <td class="col-sm-2 text-center">
                           <div class="btn-group">
                               <a href="<?php echo base_url('message_control/move_message/unspam/' . $msg->message_id) ; ?>" class="btn btn-sm btn-default"><i class="fa fa-reply"></i><span class="invisible-on-sm"> Inbox</span></a>
                               <button type="button" class="btn  btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                               </button>
                               <ul class="dropdown-menu text-left" role="menu">
                                  <li><a href="<?php echo base_url('message_control/move_message/unspam/' . $msg->message_id) ; ?>"><i class="glyphicon glyphicon-ok"></i><span class="invisible-on-sm"> Not Spam</span></a></li>
                                  <li class="divider"></li>
                                  <li><a onclick="return delete_confirmation()" href = "<?php echo base_url('message_control/delete_message/' . $msg->message_id); ?>"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete forever</span></a></li>
                               </ul>
                           </div>
                       </td>
                   </tr>
                   <?php
                        }
                        $i++;                       
                    }
                    if ($j == 0) {
                        echo '<tr><td colspan="5"><h4>  No Spam.</h4> <td></tr>';
                    }
                    ?>
                   </tbody>
                </table>
           </div>
            
            <div class="tab-pane" id="tab_Drafts">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-hover">
                   <thead>
                       <tr>
                           <th><span><input type="checkbox"></span></th>
                           <th class="mobile">To</th>
                           <th class="col-sm-5">Subject</th>
                           <th class="mobile">Sender</th>
                           <th class="invisible-on-sm">Date Time</th>
                           <th class="col-sm-2 text-center">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                   <?php
                    $i = 1; 
                    $j = 0;
                    foreach ($messages as $msg) {
                        if (($msg->trash == 0) && ($msg->spam == 0) && ($msg->message_folder == 'draft') ) {
                            $j = 1;
                    ?>
                   <tr class="<?=($i & 1) ? 'even' : 'odd'; echo($msg->message_read == 0) ? ' bold-text ' : ' '; ?>" href="<?=base_url('message_control/open_message/'.$msg->message_id); ?>">
                       <td><span><input type="checkbox"></span></td>
                       <td class="mobile clickableRow"><?=$msg->message_send_to; ?></td>
                       <td class="col-sm-5 clickableRow"><?=$msg->message_subject; echo($msg->numOfReply != 0) ? ' ('.++$msg->numOfReply.')' : ''; ?></td>
                       <td class="mobile clickableRow"><?=$msg->message_sender; ?></td>
                       <td class="invisible-on-sm clickableRow"><?=date("D, d M g:i a", strtotime($msg->message_date)); ?></td>
                       <td class="col-sm-2 text-center">
                           <div class="btn-group">
                               <a href="<?php echo base_url('message_control/reply_message/' . $msg->message_id); ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-sm"> Edit</span></a>
                               <a onclick="return delete_confirmation()" href = "<?php echo base_url('message_control/delete_message/' . $msg->message_id); ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-sm"> Delete</span></a>
                           </div>
                       </td>
                   </tr>
                   <?php
                        }
                        $i++;                       
                    }
                    if ($j == 0) {
                        echo '<tr><td colspan="5"><h4> No Draft.</h4><td></tr>';
                    }
                   ?>
                   </tbody>
                </table>
           </div>

            <div class="tab-pane" id="tab_Send">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-hover">
                   <thead>
                       <tr>
                           <th><span><input type="checkbox"></span></th>
                           <th class="mobile">To</th>
                           <th class="col-sm-5">Subject</th>
                           <th class="mobile">Sender</th>
                           <th class="invisible-on-sm">Date Time</th>
                           <th class="col-sm-2 text-center">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                   <?php
                    $i = 1; 
                    $j = 0;
                    foreach ($messages as $msg) {
                        if (($msg->trash == 0) && ($msg->spam == 0) && ($msg->message_folder == 'send') ) {
                            $j = 1;
                   ?>
                   <tr class="<?=($i & 1) ? 'even' : 'odd'; echo($msg->message_read == 0) ? ' bold-text ' : ' '; ?>" href="<?=base_url('message_control/open_message/'.$msg->message_id); ?>">
                       <td><span><input type="checkbox"></span></td>
                       <td class="mobile clickableRow"><?=$msg->message_send_to; ?></td>
                       <td class="col-sm-5 clickableRow"><?=$msg->message_subject; echo($msg->numOfReply != 0) ? ' ('.++$msg->numOfReply.')' : ''; ?></td>
                       <td class="mobile clickableRow"><?=$msg->message_sender; ?></td>
                       <td class="invisible-on-sm clickableRow"><?=date("D, d M g:i a", strtotime($msg->message_date)); ?></td>
                       <td class="col-sm-2 text-center">
                           <div class="btn-group">
                               <a href="<?php echo base_url('message_control/reply_message/' . $msg->message_id); ?>" class="btn btn-sm btn-default"><i class="fa fa-reply"></i><span class="invisible-on-sm"> Reply</span></a>
                               <button type="button" class="btn  btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                               </button>
                               <ul class="dropdown-menu text-left" role="menu">
                                  <li><a href="<?php echo base_url('message_control/move_message/spam/' . $msg->message_id) ; ?>"><i class="glyphicon glyphicon-minus-sign"></i><span class="invisible-on-sm"> Mark as</span> Spam </a></li>
                                  <li class="divider"></li>
                                  <li><a href = "<?php echo base_url('message_control/move_message/trash/' . $msg->message_id) ; ?>"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-sm"> Move to</span> Trash</a></li>
                               </ul>
                           </div>
                       </td>
                   </tr>
                   <?php
                        }
                        $i++;                       
                    }
                    if ($j == 0) {
                        echo '<tr><td colspan="5"><h4> Send directory is empty.</h4><td></tr>';
                    }
                   ?>
                   </tbody>
                </table>
           </div>

            <div class="tab-pane active" id="tab_Inbox">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-hover">
                   <thead>
                       <tr>
                           <th><span><input type="checkbox"></span></th>
                           <th class="col-sm-2 mobile">Sender</th>
                           <th class="col-sm-6">Subject</th>
                           <th class="col-sm-2 invisible-on-sm">Date Time</th>
                           <th class="col-sm-2 text-center">Action</th>
                       </tr>
                   </thead>
                   <tbody>
                   <?php
                    $i = 1; 
                    $j = 0;
                    foreach ($messages as $msg) {
                        if (($msg->trash == 0) && ($msg->spam == 0) && ($msg->message_folder == 'inbox') ) {
                            $j = 1;
                    ?>
                   <tr class="<?=($i & 1) ? 'even' : 'odd'; echo($msg->message_read == 0) ? ' bold-text ' : ' '; ?>" href="<?=base_url('message_control/open_message/'.$msg->message_id); ?>">
                       <td><span><input type="checkbox"></span></td>
                       <td class="col-sm-2 mobile clickableRow"><?=$msg->message_sender; ?></td>
                       <td class="col-sm-5 clickableRow"><?=$msg->message_subject; echo($msg->numOfReply != 0) ? ' ('.++$msg->numOfReply.')' : ''; ?></td>
                       <td class="col-sm-2  invisible-on-sm clickableRow"><?=date("D, d M g:i a", strtotime($msg->message_date)); ?></td>
                       <td class="col-sm-2 text-center">
                           <div class="btn-group">
                               <a href="<?php echo base_url('message_control/reply_message/' . $msg->message_id); ?>" class="btn btn-sm btn-default"><i class="fa fa-reply"></i><span class="invisible-on-sm"> Reply</span></a>
                               <button type="button" class="btn  btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                               </button>
                               <ul class="dropdown-menu text-left" role="menu">
                                  <li><a href="<?php echo base_url('message_control/move_message/spam/' . $msg->message_id); ?>"><i class="glyphicon glyphicon-minus-sign"></i><span class="invisible-on-sm"> Mark as</span> Spam </a></li>
                                  <li class="divider"></li>
                                  <li><a href = "<?php echo base_url('message_control/move_message/trash/' . $msg->message_id) ; ?>"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-sm"> Move to</span> Trash</a></li>
                               </ul>
                           </div>
                       </td>
                   </tr>
                   <?php
                        }
                        $i++;                       
                    }
                    if ($j == 0) {
                        echo '<tr><td colspan="5"><h4> Inbox is empty.</h4><td></tr>';
                    }
                   ?>
                   </tbody>
                </table>
            </div>
       </div>
    <!--END TABS-->
    <?php
    } else {
        echo '<h4> No Message!</h4> ';
    }
    ?>
    </div>
    </div>
    </div>
</div><!--/span-->
