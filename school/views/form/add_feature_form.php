<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php echo form_open(base_url() . 'membership/save_features', 'role="form" class="form-horizontal"'); ?>
            <div class="row">
                <?php if (isset($message) && $message != '') echo $message; ?>

                <h4>Add new feature</h4>
            </div>
            <hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-7">
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                </div>
            </div>
            <div class="row">
                  <?php
                  $option = array();
                  $option[0] = 'Select membership';
                  foreach ($memberships as $value) {
                          $option[$value->price_table_id] = $value->price_table_title;
                  }
                  ?>
                <div class="form-group">
                  <label for="membership_id" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Membership Type:*</label>
                  <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                      <?php echo form_dropdown('membership_id', $option,'','class="form-control"') ?>
                  </div>
                </div>
                <div class="form-group">
                    <label for="feature_1" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Feature 1:*</label>
                    <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                      <?php 
                        $data = array(
                            'name'        => 'feature[]',
                            'placeholder' => 'new feature 1',
                            'id'          => 'feature_1',
                            'value'       => '',
                            'rows'        => '2',
                            'class'       => 'form-control textarea-wysihtml5',
                            'required' => 'required',
                        ); ?>
                        <?php echo form_textarea($data) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="feature_2" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Feature 2:</label>
                    <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                      <?php 
                        $data = array(
                            'name'        => 'feature[]',
                            'placeholder' => 'new feature 2',
                            'id'          => 'feature_2',
                            'value'       => '',
                            'rows'        => '2',
                            'class'       => 'form-control textarea-wysihtml5',
                        ); ?>
                        <?php echo form_textarea($data) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="feature_3" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Feature 3:</label>
                    <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                      <?php 
                        $data = array(
                            'name'        => 'feature[]',
                            'placeholder' => 'new feature 3',
                            'id'          => 'feature_3',
                            'value'       => '',
                            'rows'        => '2',
                            'class'       => 'form-control textarea-wysihtml5',
                        ); ?>
                        <?php echo form_textarea($data) ?>
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
<?=$this->load->view('plugin_scripts/bootstrap-wysihtml5');?>
    
