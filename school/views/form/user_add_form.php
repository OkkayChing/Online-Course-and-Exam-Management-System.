<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php echo form_open(base_url() . 'user_control/add_user', 'role="form" class="form-horizontal"'); ?>
            <div class="row">
                <?php
                if (isset($message) && $message != '') {
                    echo $message;
                }
                ?>
                <h4>Add new user</h4>
            </div>
            <hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-10">
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                  <label for="user_name" class="col-sm-2 control-label col-xs-2">User Name: *</label>
                  <div class="col-xs-6">
                      <?php echo form_input('user_name', '', 'placeholder="User Name" class="form-control" required="required"') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_email" class="col-sm-2 control-label col-xs-2">Email: *</label>
                  <div class="col-xs-6">
                      <?php echo form_input('user_email', '', 'pattern="^[a-zA-Z0-9.!#$%&'."'".'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$" title="you@domain.com" placeholder="Email address" class="form-control" required="required"') ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="user_phone" class="col-sm-2 control-label col-xs-2">Phone:</label>
                  <div class="col-xs-6">
                      <?php echo form_input('user_phone', '', 'pattern="^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$" title="Enter Valid Phone Number" min="8" max="15" placeholder="Phone Number" class="form-control"') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_pass" class="col-sm-2 control-label col-xs-2">Password: *</label>
                  <div class="col-xs-6">
                      <?php echo form_password('user_pass', '', 'placeholder="Password (Minimum 6 character)" class="form-control" required="required"') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_passcf" class="col-sm-2 control-label col-xs-2">Confirm Pass.: *</label>
                  <div class="col-xs-6">
                      <?php echo form_password('user_passcf', '', 'placeholder="Confirm Password" class="form-control" required="required"') ?>
                  </div>
                </div>
                  <?php
                  $option = array();
                  $option[0] = 'User Type';
                  foreach ($user_role as $value) {
                      if ($value->user_role_id > $this->session->userdata('user_role_id')) {
                          $option[$value->user_role_id] = $value->user_role_name;
                      }
                  }
                  ?>
                <div class="form-group">
                  <label for="user_role" class="col-sm-2 control-label col-xs-2">Role: *</label>
                  <div class="col-xs-6">
                      <?php echo form_dropdown('user_role', $option,'','class="form-control"') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-xs-offset-3 col-sm-8 col-xs-offset-2 col-xs-9">
                      <p class="text-muted">* Required fields.</p>
                  </label>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-offset-1 col-sm-offset-2 col-xs-4">
                    <button type="submit" class="btn btn-primary col-xs-6">Save</button>&nbsp;
                    <button type="reset" class="btn btn-default">Reset</button>
                </div>
            </div>
            <?php echo form_close() ?>
            <br/>
        </div>
    </div> <!-- /.row -->
</div> <!-- /.container -->
<br/><br/>
    
