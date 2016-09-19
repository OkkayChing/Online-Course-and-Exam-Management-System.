<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> <?=$title; ?></li>
        </ol>
            <?php 
            if ($message) {
                echo $message;
            }
            ?>
    </div>
</div><!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-cogs"></i> Settings</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="<?=base_url('admin_control');?>">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">Profile Settings</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?=base_url('exam_control/view_results');?>">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <i class="fa fa-puzzle-piece fa-5x"></i>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">View Result</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?=base_url('exam_control/view_all_mocks');?>">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <i class="fa fa-rocket fa-5x"></i>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">Take New Exam</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div><!-- /.row -->
            </div>
        </div>
    </div>
</div><!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-tasks"></i> Your last few results</h3>
            </div>
            <div class="panel-body">
               <div class="col-sm-12">
                <?php if (isset($results) != NULL) { ?>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Exam Title</th>
                                <th class="hidden-xxs">Assessment</th>
                                <th class="hidden-xxs">Score</th>
                                <th class="hidden-xs">Date</th>
                                <th class="text-center" style=" width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            foreach ($results as $result) {
                                if ($i > 5){
                                    break;
                                }
                                ?>
                                <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                    <td><?= $result->title_name; ?></td>
                                    <td class="hidden-xxs"><?= ($result->result_percent >= $result->pass_mark) ? '<span class="label label-primary">PASS</span>' : '<span class="label label-warning">FAIL</span>' ?></td>
                                    <td class="hidden-xxs"><?php echo $result->result_percent; ?>%</td>
                                    <td class="hidden-xs"><?= date("D, d M", strtotime($result->exam_taken_date)); ?></td>
                                    <td class="text-center" style=" width: 17%">
                                        <div class="btn-group">
                                            <a class="btn btn-default btn-sm" href = "<?= base_url('exam_control/view_result_detail/' . $result->result_id); ?>"><i class="glyphicon glyphicon-eye-open"></i><span class="invisible-on-md">  View</span></a>
                                            <a onclick="return delete_confirmation()" href = "<?= base_url('exam_control/delete_results/' . $result->result_id); ?>" class="btn btn-sm btn-default" ><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete </span></a>
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
                    echo 'No results!';
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->