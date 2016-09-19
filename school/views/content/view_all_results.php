<div id="note"> <?php if ($message) echo $message; ?> </div>

<div class="block"> 
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Results </p></div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">
                <?php if (isset($results) != NULL) { ?>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr>
                                <td class="hidden">1</td>
                                <th>Name of Student</th>
                                <th>Exam</th>
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
                                ?>
                                <?php if (($result->exam_title_user_id == $this->session->userdata('user_id')) OR ($this->session->userdata('user_role_id') <= 3)) { ?>
                                    <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                        <td class="hidden">1</td>
                                        <td><?= $result->user_name; ?></td>
                                        <td><?= $result->title_name; ?></td>
                                        <td class="hidden-xxs"><?= ($result->result_percent >= $result->pass_mark) ? '<span class="label label-primary">PASS</span>' : '<span class="label label-warning">FAIL</span>' ?></td>
                                        <td class="hidden-xxs"><?php echo $result->result_percent; ?>%</td>
                                        <td class="hidden-xs"><?= date("D, d M", strtotime($result->exam_taken_date)); ?></td>
                                        <td class="text-center" style=" width: 17%">
                                            <div class="btn-group">
                                                <a class="btn btn-default btn-xs" href = "<?= base_url('exam_control/view_exam_detail/' . $result->result_id); ?>"><i class="glyphicon glyphicon-list-alt"></i> Details</a>
                                                <a class="btn btn-default btn-xs" href = "<?= base_url('exam_control/view_result_detail/' . $result->result_id); ?>"><i class="glyphicon glyphicon-file"></i> Certificate</a>
                                                <?php if ($this->session->userdata['user_role_id'] < 3) { ?>
                                                <a onclick="return delete_confirmation()" href = "<?= base_url('exam_control/delete_results/' . $result->result_id); ?>" class="btn btn-xs btn-default" ><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete </span></a>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
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
</div><!--/span-->