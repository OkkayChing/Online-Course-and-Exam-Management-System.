<?php   //  echo "<pre/>"; print_r($mocks); exit(); ?>
<div id="note"> <?php  if ($message) echo $message; ?> 
<?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
</div>

<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Exam List </p></div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">
                <?php if (isset($mocks) AND !empty($mocks)) { ?>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>Exam Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($mocks as $mock) {
                            ?>
                                <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                    <td>
                                        <p class="lead"><?= $mock->title_name; ?></p>
                                        <?php if ($mock->course_id) { ?>
                                            <span class="text-muted">Associated Course: </span><?= $mock->course_id; ?>&nbsp;
                                        <?php } ?>
                                        <span class="text-muted">Public: </span><?= ($mock->public == 1) ? 'Yes' : 'No'; ?>&nbsp;
                                        <span class="text-muted">Passing Score(%): </span><?= $mock->pass_mark; ?>&nbsp;
                                        <span class="text-muted">Category: </span><?=$mock->category_name.' / '.$mock->sub_cat_name; ?>&nbsp;
                                        <br/>
                                        <span class="text-muted">Syllabus: </span><?= $mock->syllabus . '.'; ?>&nbsp;
                                        <span class="pull-right">
                                            <span class="text-muted">Price: </span>
                                            <?php if ($mock->exam_price) {
                                                $currency_code . ' ' . $currency_symbol.' '.$mock->exam_price; 
                                            }else{
                                                echo "Free";
                                            } ?>
                                            <span class="text-muted">Active: </span><?= ($mock->exam_active == 1) ? 'Yes' : 'No'; ?>&nbsp;
                                            <span class="text-muted">Author: </span>
                                            <?php echo $mock->user_name; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-success btn-sm" href = "<?= base_url('mock_detail/' . $mock->title_id); ?>"><span class="invisible-on-md">  View Questions</span></a>
                                            <a class="btn btn-info btn-sm" href = "<?= base_url('admin_control/edit_mock_detail/' . $mock->title_id); ?>"><span class="invisible-on-md">  View Detail</span></a>
                                            <a onclick="return delete_confirmation()" href = "<?php echo base_url('admin_control/delete_exam/' . $mock->title_id); ?>" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete</span></a>
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
                    echo '<h3>No result found!</h3>';
                }
                ?>
            </div>
        </div>
    </div>
</div><!--/span-->

