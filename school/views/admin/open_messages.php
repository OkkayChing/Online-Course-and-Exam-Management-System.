<?php  // echo '<pre>';   print_r($msg); exit();
function wordlimit($string, $length = 5, $ellipsis = " ...") {
   $words = explode(' ', $string);
   if (count($words) > $length) {
       return implode(' ', array_slice($words, 0, $length)) . $ellipsis; 
   } else {
       return $string;
   }
}
?>
<ol class="breadcrumb">
  <li><a href="<?=base_url('dashboard/'.$this->session->userdata('user_id')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li><a href="<?=base_url('message_control');?>"><i class="fa fa-envelope-o"></i> Inbox</a></li>
  <li class="active">Message</li>
</ol>
<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
    <?=(isset($message)) ? $message : ''; ?>
</div>
<div class="display-message">
 <div class="message-display-head">
    <p>Topic: 
        <span class="display-message-subject"><?=$msg->message_subject; ?></span>
    </p>
    <span class="message-display-sender">
        <?php 
        if (($msg->message_folder == 'draft')OR($msg->message_folder == 'send')) {
            echo 'To: '.'< '.$msg->message_send_to.' > '; 
        } else {
            echo 'Sender: '.$msg->message_sender.'< '.$msg->sender_email.' > '; 
        }
        ?>
    </span>
    <span class="label label-default"> <?=$msg->message_folder; ?> </span> 
    <div class="btn-group pull-right hidden-xs">
        <a href="<?php echo base_url('message_control/reply_message/' . $msg->message_id); ?>" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="invisible-on-md"> Reply </span></a>
        <a onclick="return delete_confirmation()" href="<?=base_url('message_control/delete_message/'.$msg->message_id); ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md"> Delete </span></a>
        <a href="<?php echo base_url('message_control/move_message/spam/' . $msg->message_id) ; ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-minus-sign"></i><span class="invisible-on-md"> Spam </span></a>
    </div>
</div>
<div class="row visible-xs">
    <div class="btn-group pull-right col-xs-pull-1">
        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> Reply </a>
        <a onclick="return delete_confirmation()" href="<?=base_url('message_control/delete_message/'.$msg->message_id); ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i> Delete </a>
        <a href="#" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-minus-sign"></i> Spam </a>
    </div>
</div>
<?php
if (isset($msg_replies) && !empty($msg_replies)):
    $arraySize = sizeof($msg_replies);   ?><br/>
<div class="panel-group accordion accordion-2" id="accordion">
<div class="panel panel-default">
    <a class="accordion-toggle glyphicons collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-main">
        <div class="panel-heading">
          <h4 class="panel-title">
              <?=wordlimit($msg->message_body); ?>
              <span class="pull-right"><?=date("D, d M g:i a", strtotime($msg->message_date)); ?></span>
          </h4>
        </div>
    </a>
    <div id="collapse-main" class="panel-collapse collapse">
        <div class="panel-body message_body">
            <?=$msg->message_body; ?>
        </div>
    </div>
</div>
    <?php
    $i = 1;
    foreach ($msg_replies as $reply) { 
    ?>
    <div class="panel panel-default">
        <a class="accordion-toggle glyphicons collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?=$reply->message_reply_id; ?>">
            <div class="panel-heading">
              <h4 class="panel-title">
                  <?=wordlimit($reply->replied_messages); ?>
                  <span class="pull-right"><?=date("D, d M g:i a", strtotime($reply->replied_time)); ?></span>
              </h4>
            </div>
        </a>
        <div id="collapse-<?=$reply->message_reply_id; ?>" class="panel-collapse panel-bg-control <?=($i == $arraySize)?'in':'collapse'?>">
            <div class="panel-body message_body">
                <?=$reply->replied_messages; ?>
            </div>
        </div>
    </div>
   <?php 
       $i++; 
    } ?>
</div>
<?php else: ?>    
<p>
    <div class="panel-body message-display-single message_body">
        <?=$msg->message_body; ?>
    </div>
</p>
<?php endif; ?>  
</div>
