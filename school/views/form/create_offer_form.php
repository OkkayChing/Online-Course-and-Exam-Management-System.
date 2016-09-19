<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php echo form_open(base_url() . 'membership/save', 'role="form" class="form-horizontal"'); ?>
            <div class="row">
                <?php if (isset($message) && $message != '') echo $message; ?>
                <h4>Create new offer</h4>
            </div>
            <hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-7">
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                  <label for="membership_type" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Membership Type:*</label>
                  <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                    <?php echo form_input('membership_type', set_value('membership_type'), 'placeholder="Membership title" id="membership_type" class="form-control" required="required"') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="validity_period" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Validity Period:*</label>
                  <div class="col-lg-3 col-sm-4 col-xs-4 col-mb">
                    <?php echo form_input('validity_period', set_value('validity_period'), 'placeholder="Validity period" id="validity_period" class="form-control" required="required"') ?>
                  </div>
                  <div class="col-sm-2 col-xs-2">
                      <?php
                      $option = array(
                        'months' => 'Month',
                        'years' => 'Year',
                        'days' => 'Day');
                      ?>
                      <?php echo form_dropdown('validity_type', $option, $offer->offer_type,'class="form-control"') ?>
                  </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Price:*</label>
                    <div class="col-sm-3 col-xs-6 col-mb">
                        <div class="input-group">
                          <?php echo form_input('price', '', 'id="price" placeholder="Price" class="form-control" required="required"') ?>
                          <span class="input-group-addon"> <?=$currency_symbol?> </span>
                        </div>            
                    </div>
                </div>
                <div class="form-group">
                    <label for="feature_1" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Feature 1:*</label>
                    <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                      <?php 
                        $data = array(
                            'name'        => 'feature[]',
                            'placeholder' => 'feature 1',
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
                            'placeholder' => 'feature 2',
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
                            'placeholder' => 'feature 3',
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
    
