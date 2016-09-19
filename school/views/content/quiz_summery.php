<?php 
    $user_info = $this->db->get_where('users', array('user_id' => $this->session->userdata('user_id')))->row();
?>

<div class="container">
    <div id="note">
    <?php 
    if ($message) {
        echo $message;    
    }
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');     
    }
    ?>
    </div>
 
</div>
<div class="container">
    <div class="col-md-12">
        <h4><span class="text-muted">Exam Title: </span> <?= $quiz->title_name ?></h4>
    </div>
</div>
<div class="container">
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">Exam Summery:</div>        
            <div class="panel-body">
                <dl class="dl-horizontal">
                    <dt class="text-muted">Title:</dt>
                    <dd><strong><?= $quiz->title_name ?></strong></dd>
                    
                </dl>
            </div>        
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">Rules:</div>        
            <div class="panel-body">
                <dl class="dl-horizontal">
                    <dt class="text-muted">Total Questions: </dt>
                    <dd><strong><?= $quiz->random_ques_no ?> </strong> <small class="text-muted"> Multiple choice questions</small></dd>
                    <dt class="text-muted">Passing Score: </dt>
                    <dd><strong><?= $quiz->pass_mark ?>%</strong></dd>
                    <dt class="text-muted">Duration: </dt>
                    <dd><strong><?=$quiz->time_duration ?> <span class="text-muted"> hours</span></strong></dd>
                </dl>
            </div>        
        </div>
    </div>
</div>
<br/><br/>
<div class="container">
    <a href="<?=base_url('course/view_quiz_instructions/'.$quiz->title_id) ?>" class="btn btn-success col-xs-5 col-xs-offset-1">Start Quiz</a>    
    <a href="<?=base_url('course/view_all_mocks') ?>" class="btn btn-default col-xs-offset-1">Cancel</a>    
</div><br/><br/>
<div class="container">
    <p class="result-note"><strong>Note: </strong>The value of this exam certificate is only valid under the terms and conditions of <?= $brand_name ?>.</p>
</div>
