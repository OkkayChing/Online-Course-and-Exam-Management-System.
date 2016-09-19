<div id="note">
    <?php 
    if ($message) {
        echo $message;    
    }
    ?>
</div>
<ol class="breadcrumb hidden-print">
    <li><a href="<?=base_url('dashboard/'.$this->session->userdata('user_id')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
    <li><a href="<?=base_url('exam_control/view_results')?>"><i class="fa fa-puzzle-piece"></i> Results</a></li> 
    <li class="active">Result Detail</li>
</ol>
<div class="container hidden-print">
    <p class="col-sm-1 col-sm-offset-9">    
        <a href="javascript:window.print()" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-print"></i>&nbsp; Print </a>
    </p>
</div>
<div class="container visible-print">
    <div class="result-head text-center ">
        <h3><?=$brand_name?></h3>
        <h4>Certificate</h4>
    </div>
</div>
<div class="result-info">
    <div class="row">
        <div class="col-sm-6 col-xs-6">
            <div class="panel panel-default">
                <div class="panel-body result-info-exam">
                    <h4>Exam Detail:</h4>
                    <dl class="dl-horizontal">
                        <dt>Title: </dt>
                        <dd><?=$results->title_name?></dd>
                        <dt>Total Question: </dt>
                        <dd><?=$results->question_answered?></dd>
                        <dt>Passing Score: </dt>
                        <dd><?=$results->pass_mark?>%</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-6">
            <div class="panel panel-default">
                <div class="panel-body result-info-user">
                    <h4>Student Detail:</h4>
                    <dl class="dl-horizontal">
                        <dt>Name: </dt>
                        <dd><?=$results->user_name?></dd>
                        <dt>Email: </dt>
                        <dd><?=$results->user_email?></dd>
                        <dt>Phone: </dt>
                        <dd><?=$results->user_phone?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
    <h3 class="text-center">*** Result ***</h3>
    <div class="container">
        <dl class="dl-horizontal">
            <dt class="assessment">Assessment: </dt>
            <dd>
                <blockquote>
                    <p class="lead">
                        <?=($results->result_percent >= $results->pass_mark) ? '<span class="label label-primary">PASS</span>' : '<span class="label label-warning">FAIL</span>' ?>
                    </p>
                </blockquote>
            <dd>
        </dl>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="result-score">
                <p><?=$results->user_name?>'s Score (<?=$results->result_percent?>%)</p>
            </div>
            <div class="progress progress-striped">
                <div class="progress-bar progress-bar-<?=($results->result_percent >= $results->pass_mark)?'success':'danger'?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$results->result_percent?>%">
                    <span class="sr-only"><?=$results->result_percent?>% Complete (success)</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="result-score">
                <p>Passing Score (<?=$results->pass_mark?>%)</p>
            </div>
            <div class="progress progress-striped">
                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$results->pass_mark?>%">
                    <span class="sr-only"><?=$results->pass_mark?>% Complete (success)</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container sign-panel visible-print">
        <div class="col-xs-offset-1 col-xs-5">
            <h4 class="text-center">Signature <?=$brand_name?></h4>
        </div>
        <div class="col-xs-push-1 col-xs-5">
            <h4 class="text-center">Signature Student</h4>
        </div>
    </div>
</div>
<div class="container">
    <p class="result-note"><strong>Note: </strong>This certificate is only valid under the terms and conditions of <?=$brand_name?>.</p>
</div>
<link href="<?php echo base_url('assets/css/print-result.css') ?>" rel="stylesheet" media="print">
