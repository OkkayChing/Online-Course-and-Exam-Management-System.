<!-- script for take the old value. -->
<script type="text/javascript">
$('.update').click(function() {
    var id = $(this).attr('data-update'); // Get the id
    var value = $.trim($('#question_title-'+id).html()); //Get the old value and trimed it
    $('#input').val(value); // Set the old value intu the field
    $('#ques_id').val(id); // Set ques_id that will be updated
});
</script>

<!-- Question Update Modal -->
<div class="modal fade" id="update_ques" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="TRUE">  
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="TRUE">&times;</button>
        <h4 class="modal-title">Question Update Form</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url() . 'admin_control/update_question','role="form" class="form-horizontal"'); ?>
            <input type="hidden" name="ques_id" id="ques_id" value="">
            <input type="hidden" name="exam_id" value="<?=$mock_title->title_id; ?>">
          <div class="form-group">
            <label for="question" class="col-xs-3 control-label">Question :</label>
            <div class="col-xs-8">
                <?php 
                $data = array(
                    'name'        => 'question',
                    'id'          => 'input',
                    'value'       => '',
                    'rows'        => '3',
                    'class'       => 'form-control',
                    'required' => 'required',
                ); ?>
               <?php echo form_textarea($data) ?>
            </div>
          </div>
          <br/>
          <p class="col-sm-offset-3 col-xs-offset-1"><i class="glyphicon glyphicon-warning-sign text-warning"></i><span class="text-muted"> Must be at least 8 characters in length.</span></p>
      </div>
      <div class="modal-footer">
        <?php echo form_submit('submit', 'Save', 'class="btn btn-primary"') ?>
        <?php echo form_close() ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->