<?php
if ($message) {
    echo $message;
}
?>
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Create Sub-category </p></div>
    </div>
    <div class="block-content">
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>
        <div class="row">
            <?=form_open(base_url('admin_control/create_subcategory'), 'role="form" class="form-horizontal"'); ?>
            <?php
            $option = array();
            $option[''] = 'Select Category';
            foreach ($categories as $category) {
                if ($category->active) {
                    $option[$category->category_id] = $category->category_name;
                }
            }
            ?>
            <div class="form-group">
                <label for="category" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Select Category:</label>
                <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                    <?php echo form_dropdown('category', $option, $cat_id, 'id="category" class="form-control"') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="sub_cat_name" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Sub-category Name:</label>
                <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                    <?php echo form_input('sub_cat_name', '', 'id="sub_cat_name" placeholder="Sub-category Name" class="form-control" required="required"') ?>
                </div>
            </div>
            <br/><hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Save</button>
                </div>
            </div>
            <?=form_close() ?>
        </div>
    </div>
    </div>
    </div>
</div>