<div id="note">
    <?php
    if ($message) {
        echo $message;
    }
    ?>
</div>
<?php
$str = '[';
foreach ($categories as $value) {
    $str .= "{value:" . $value->category_id . ",text:'" . $value->category_name . " '},";
}
$str = substr($str, 0, -1);
$str .= "]";
?>

<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Mock List </p></div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">
                <?php if (isset($quizs) AND !empty($quizs)) { ?>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                        <thead>
                            <tr>
                                <th>Mock Title</th>
                                <th style="width: 25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($quizs as $mock) {
                            ?>
                                <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                    <td>
                                        <p class="lead">
                                            <a href="#" data-name="exam_title" data-type="textarea" data-rows="2" data-url="<?php echo base_url('admin_control/update_mock_title'); ?>" data-pk="<?= $mock->title_id; ?>" class="data-modify-<?= $mock->title_id; ?> no-style"><?= $mock->title_name; ?></a>
                                        </p>
                                        <span class="text-muted">Syllabus: </span>
                                        <a href="#" data-name="exam_syllabus" data-type="textarea" data-rows="2" data-url="<?php echo base_url('admin_control/update_mock_title'); ?>" data-pk="<?= $mock->title_id; ?>" class="data-modify-<?= $mock->title_id; ?> no-style"><?= $mock->syllabus . '.'; ?></a>
                                        &nbsp;
                                        <span class="text-muted">Passing Score(%): </span>
                                        <a href="#" data-name="passing_score" data-type="text" data-url="<?php echo base_url('admin_control/update_mock_title'); ?>" data-pk="<?= $mock->title_id; ?>" class="data-modify-<?= $mock->title_id; ?> no-style"><?= $mock->pass_mark; ?></a>
                                        &nbsp;
                                        <span class="text-muted">Category: </span>
                                        <a href="#" data-name="cat_id" data-type="select" data-url="<?php echo base_url('admin_control/update_mock_title'); ?>" data-source="<?= $str; ?>" data-value="<?= $mock->category_id; ?>" data-pk="<?= $mock->title_id; ?>" class="data-modify-<?= $mock->title_id; ?> no-style"><?= $mock->category_name; ?></a>
                                        &nbsp;
                                        <span class="text-muted">Sub-category: </span>
                                        <a href="#" data-name="cat_id" data-type="select" data-url="<?php echo base_url('admin_control/update_mock_title'); ?>" data-source="<?= $str; ?>" data-value="<?= $mock->category_id; ?>" data-pk="<?= $mock->title_id; ?>" class="data-modify-<?= $mock->title_id; ?> no-style"><?= $mock->sub_cat_name; ?></a>
                                        &nbsp;
                                        <span class="text-muted">Price: </span>
                                        <?= $currency_code . ' ' . $currency_symbol ?><a href="#" data-name="exam_price" data-type="text" data-url="<?php echo base_url('admin_control/update_mock_title'); ?>" data-pk="<?= $mock->title_id; ?>" class="data-modify-<?= $mock->title_id; ?> no-style"><?= $mock->exam_price; ?></a>
                                        <span class="pull-right">
                                            <span class="text-muted">Active: </span>
                                            <a href="#" data-name="active" data-type="select" data-url="<?php echo base_url('admin_control/update_mock_title'); ?>" data-source="[{value:1,text:'Yes'},{value:0,text:'No'}]" data-value="<?= $mock->exam_active; ?>" data-pk="<?= $mock->title_id; ?>" class="data-modify-<?= $mock->title_id; ?> no-style"><?= ($mock->exam_active == 1) ? 'Yes' : 'No'; ?></a>
                                            &nbsp;
                                            <span class="text-muted">Author: </span>
                                            <?php echo $mock->user_name; ?>
                                        </span>
                                    </td>
                                    <td style="width: 25%">
                                        <div class="btn-group">
                                            <a class="btn btn-default btn-sm" href = "<?= base_url('mock_detail/' . $mock->title_id); ?>"><i class="glyphicon glyphicon-eye-open"></i><span class="invisible-on-md">  Detail</span></a>
                                            <a class="btn btn-default btn-sm modify" name="modify-<?= $mock->title_id; ?>" href = "#"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">  Modify</span></a>
                                            <a onclick="return delete_confirmation()" href = "<?php echo base_url('admin_control/delete_exam/' . $mock->title_id); ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete</span></a>
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

