<div class="container">
    <div id="note">
        <noscript><div class="alert alert-danger">Your browser does not support JavaScript or JavaScript is disabled! Please use JavaScript enabled browser to take this exam.</div></noscript>
        <?php 
        if ($message) {
            echo $message;
        }
        if ($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
        }
        ?>
    </div>
    <ol class="breadcrumb hidden-print">
        <li><a href="<?= base_url('dashboard/' . $this->session->userdata('user_id')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
        <li><a href="<?= base_url('exam_control/view_all_mocks') ?>"><i class="fa fa-puzzle-piece"></i> Exams</a></li> 
        <li><a href="<?=base_url('exam_control/view_exam_summery/' . $quiz->title_id) ?>"><i class="fa fa-tasks"></i> Exam Summery</a></li> 
        <li class="active">Exam Instructions</li>
    </ol>
</div>
<div class="container">
    <div class="col-md-12">
        <p class="lead"><span class="text-muted">Exam Title: </span> <?= $quiz->title_name ?></p>
    </div>
</div>
<div class="container">
    <div class="col-md-12">
        <h3>Requirements:</h3>
        <div class="well well-sm">
            <ul>
                <li>You need javascript enabled browser to take this exam.</li>
                <li>Use latest browser to have the best experience.</li>
            </ul>
        </div>
    </div>
    <div class="col-md-12">
        <h3>Instructions:</h3>
        <div class="well well-sm">
            <ul>
                <li>Each question has between 2 and 8 options. You have to choose one or more correct answers.</li>
                <li>There are no penalties for incorrect answers.So attempt all questions.</li>
                <li>You can review and change your answers before final submit.</li>
                <li>There is no partial marking! If any question have more than one correct answers, you have mark all correct answers </li>
                <li>Unanswered questions will be count as wrong answers.</li>
                <li>You must answer all questions before the time duration shown on the top.</li>
                <li>You can't resume the exam.</li>
            </ul>
        </div>
    </div>
</div><br/><br/>
<div class="container">
    <a href="<?=base_url('course/start_quiz/'.$quiz->title_id) ?>" id="start-exam" class="btn btn-lg btn-success col-xs-5 col-xs-offset-1">Start Quiz</a>    
    <a href="<?=base_url('exam_control/view_all_mocks') ?>" class="btn btn-lg btn-default col-xs-offset-1">Cancel</a>    
</div><br/><br/>
<div class="container">
    <p class="result-note"><strong>Note: </strong>The value of this exam certificate is only valid under the terms and conditions of <?= $brand_name ?>.</p>
</div>
<script>
$(document).ready(function() {
   $("#start-exam").removeAttr("disabled");
})    
</script>
<script language="JavaScript"><!--
javascript:window.history.forward(1);
//--></script>