<?php //echo "<pre/>"; print_r($courses); exit(); ?>
<div id="note">
    <?php if ($message) echo $message; ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
</div>
<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Course List </p></div>
    </div>
    <div class="block-content">
    <div class="row">
    <div class="col-sm-12">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
            <thead>
                <tr>
                    <th>Course Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($courses as $course) {
                ?>
                <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                    <td>
                        <p class="lead"><?=$course->course_title?>
                        </p>
                        <span class="text-muted">Category: </span> <?=$course->category_name; ?>
                        &nbsp;
                        <span class="text-muted">Sub-category: </span> <?=$course->sub_cat_name; ?>
                        &nbsp;
                        <span class="text-muted">Price: </span>
                        <?= $currency_code . ' ' . $currency_symbol ?><?= $course->course_price; ?>
                        <span class="pull-right">
                            <span class="text-muted">Author: </span>
                            <?php echo $course->user_name; ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-success btn-sm" href = "<?= base_url('course/course_detail/' . $course->course_id); ?>"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">  View Sections</span></a>
                            <a class="btn btn-primary btn-sm" href = "<?= base_url('course/edit_course_detail/' . $course->course_id); ?>"><i class="glyphicon glyphicon-eye-open"></i><span class="invisible-on-md">  View Detail</span></a>
                            <a onclick="return delete_confirmation()" href = "<?php echo base_url('course/delete_course/' . $course->course_id); ?>" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete</span></a>
                        </div>
                    </td>
                </tr>
                <?php
                $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
    </div>
</div><!--/span-->

