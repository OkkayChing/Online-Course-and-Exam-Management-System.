<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
    <?=(isset($message)) ? $message : ''; ?>
</div>
<div class="block"> 
    <div class="navbar block-inner block-header">
        <div class="row">
            <ul class="nav nav-pills">
                <li><p class="text-muted">Category List </p></li>
                <li class=" pull-right"><a href="#muted" data-toggle="pill">Inactive</a></li>
                <li class="active pull-right"><a href="#running" data-toggle="pill">Active</a></li>
            </ul>
        </div>
    </div>
    <div class="block-content">
    <div class="row">
    <div class="col-sm-12">
        <div class="tab-content">
        <?php if (isset($categories) != NULL) { ?>
        <div class="tab-pane fade" id="muted">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th class="hidden-xxs">Have Exams</th>
                    <th class="hidden-xxs">Author</th>
                    <th style="width: 13%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1;
            foreach ($categories as $category) { ?>
              <?php if ($category->category_active == 0) {?>  
                <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                    <td><?=$category->category_name; ?></td>
                    <td class="hidden-xxs"><?php echo $mock_count[$category->category_id]; ?></td>
                    <td class="hidden-xxs"><?php echo $category->user_name; ?></td>
                    <td style="width: 13%">
                        <a class="btn btn-primary" href = "<?php echo base_url('admin_control/activate_category/' . $category->category_id); ?>"><i class="glyphicon glyphicon-check"></i><span class="invisible-on-md">  Activate </span></a>
                    </td>
                </tr>
                <?php $i++;
                }
            } ?>
            </tbody>
        </table>
        </div>
        <div class="tab-pane fade active in" id="running">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="example">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th class="hidden-xxs">Have Exams</th>
                    <th class="hidden-xxs">Author</th>
                    <th class="col-sm-3" style="width: 27%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1;
            foreach ($categories as $category) { ?>
              <?php if ($category->category_active == 1) {?>  
                <tr class="<?=($i & 1) ? 'even' : 'odd'; ?>">
                    <td>
                        <a href="#" data-name="cat_name" data-type="text" data-url="<?php echo base_url('admin_control/update_category_name'); ?>" data-pk="<?=$category->category_id; ?>" class="data-modify-<?=$category->category_id; ?> no-style"><?=$category->category_name; ?></a>
                    </td>
                    <td class="hidden-xxs"><?php echo $mock_count[$category->category_id]; ?></td>
                    <td class="hidden-xxs"><?php echo $category->user_name; ?></td>
                    <td class="col-sm-3" style="width: 27%">
                    <div class="btn-group">
                        <a class="btn btn-default btn-sm modify" name="modify-<?=$category->category_id; ?>" href = "#"><i class="glyphicon glyphicon-edit"></i><span class="invisible-on-md">  Modify</span></a>
                        <a class="btn btn-default btn-sm" href = "<?php echo base_url('admin_control/mute_category/' . $category->category_id); ?>"><i class="glyphicon glyphicon-off"></i><span class="invisible-on-md">  Deactivate </span></a>
                        <a onclick="return delete_confirmation()" href = "<?php echo base_url('admin_control/delete_category/' . $category->category_id); ?>" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-trash"></i><span class="invisible-on-md">  Delete</span></a>
                    </div>
                    </td>
                </tr>
                <?php $i++;
                }
            } ?>
            </tbody>
        </table>
        </div>
        <?php
        } else {
            echo 'No data available!';
        }
        ?>
        </div>
    </div>
    </div>
    </div>
</div><!--/span-->