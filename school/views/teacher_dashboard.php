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
                <h3 class="panel-title"><i class="fa fa-tasks"></i> Overview</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="<?=base_url('mocks');?>">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <i class="fa fa-puzzle-piece fa-5x"></i>
                                        </div>
                                        <div class="col-xs-6 text-center">
                                            <p class="dashboard-heading"><?=$total_exam;?></p>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">Total Exams</p>
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
                                        <div class="col-xs-6">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-6 text-center">
                                            <p class="dashboard-heading"><?=$exam_taken_new;?></p>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">New Participants</p>
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
                                        <div class="col-xs-6">
                                            <i class="fa fa-bookmark-o fa-5x"></i>
                                        </div>
                                        <div class="col-xs-6 text-center">
                                            <p class="dashboard-heading"><?=$exam_taken;?></p>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">Total Participants</p>
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
                        <a href="<?=base_url('create_mock');?>">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <i class="fa fa-puzzle-piece fa-5x"></i>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">Create Exam</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?=base_url('create_category');?>">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-12 text-center">
                                            <i class="fa fa-sitemap fa-5x"></i>
                                        </div>
                                        <div class="col-xs-12">
                                            <p class="dashboard-text text-center">Create Category</p>
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