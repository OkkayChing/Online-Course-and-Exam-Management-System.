<div id="note">
    <?php
    if ($message) {
        echo $message;
    }
    ?>
</div>
<div class="block">  
    <div class="navbar block-inner block-header">
        <div class="row">
            <ul class="nav nav-pills">
                <li><p class="text-muted">User List </p></li>
                <li class=" pull-right"><a href="#inactive" data-toggle="pill">Inactive</a></li>
                <li class="active pull-right"><a href="#banned" data-toggle="pill"> Banned </a></li>
            </ul>
        </div>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="tab-content">
                    <?php 
                    if (isset($users) != NULL) { 
                    ?>
                        <div class="tab-pane fade" id="inactive">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="hidden-xxs">Phone Number</th>
                                        <th class="hidden-xxs">Email</th>
                                        <th class="hidden-xxs">Role</th>
                                        <th style="width: 22%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($users as $user) {
                                        if (($user->active == 0) && ($user->user_role_id > $this->session->userdata['user_role_id'])) {
                                            ?>
                                            <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                                <td><?= $user->user_name; ?></td>
                                                <td class="hidden-xxs"><?= $user->user_phone; ?></td>
                                                <td class="hidden-xxs"><?= $user->user_email; ?></td>
                                                <td class="hidden-xxs"><?= $user->user_role_name; ?></td>
                                                <td style=" width: 13%">
                                                    <a onclick="return are_you_sure()" class="btn btn-primary" href = "<?php echo base_url('user_control/activate_user_account/' . $user->user_id); ?>"><i class="glyphicon glyphicon-check"></i><span class="invisible-on-md">  Activate </span></a>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane active fade in" id="banned">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatable" id="example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="hidden-xxs">Phone Number</th>
                                        <th class="hidden-xxs">Email</th>
                                        <th class="hidden-xxs">Role</th>
                                        <th style="width: 22%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                foreach ($users as $user) {
                                    if (($user->banned == 1) && ($user->user_role_id > $this->session->userdata['user_role_id'])) {
                                        ?>
                                            <tr class="<?= ($i & 1) ? 'even' : 'odd'; ?>">
                                                <td><?= $user->user_name; ?></td>
                                                <td class="hidden-xxs"><?= $user->user_phone; ?></td>
                                                <td class="hidden-xxs"><?= $user->user_email; ?></td>
                                                <td class="hidden-xxs"><?= $user->user_role_name; ?></td>
                                                <td style=" width: 13%">
                                                    <a onclick="return are_you_sure()" class="btn btn-primary" href = "<?php echo base_url('user_control/unban_user_account/' . $user->user_id); ?>"><i class="glyphicon glyphicon-check"></i><span class="invisible-on-md">  Unban </span></a>
                                                </td>
                                            </tr>
                                <?php
                                $i++;
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    <?php
                    } else {
                        echo 'You have no mocks!';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div><!--/span-->
<?php $this->load->view('plugin_scripts/are_you_sure'); ?>
 