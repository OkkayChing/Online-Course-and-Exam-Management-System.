<?php //echo "<pre/>"; print_r($mock); exit(); ?>
<?php  if ($message)  echo $message; ?>
<?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Update Exam  </p></div>
    </div>
    <div class="block-content">
    <?=form_open_multipart(base_url('admin_control/update_mock/'.$mock->title_id), 'role="form" class="form-horizontal"'); ?>
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="mock_title" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Exam Title:</label>
                <div class=" col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'mock_title',
                        'placeholder' => 'Exam Title',
                        'id'          => 'mock_title',
                        'value'       => $mock->title_name,
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <?php $categories = $this->db->get('categories')->result();
            $option = array();
            foreach ($categories as $category) {
                $option[$category->category_id] = $category->category_name;
            }
            $sub_categories = $this->db->get('sub_categories')->result();
            $option2 = array();
            foreach ($sub_categories as $sub_cat) {
                if($sub_cat->cat_id == $mock->cat_id){
                    $option2[$sub_cat->id] = $sub_cat->sub_cat_name;
                }
            }
            ?>
            <div class="form-group">
                <label for="parent-category" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Select Category:</label>
                <div class=" col-sm-4 col-xs-4">
                    <?php echo form_dropdown('parent-category', $option, $mock->cat_id, 'id="parent-category" class="form-control"') ?>
                </div>
                <div class=" col-sm-4 col-xs-4">
                    <?php echo form_dropdown('category', $option2, $mock->id, 'id="category" class="form-control"') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_id" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Associated Course:</label>
                <div class="col-sm-8 col-xs-7 col-mb">
                    <select name="course_id" class="form-control">
                        <option value="">None</option>
                        <?php $courses = $this->db->get('courses')->result();
                        foreach ($courses as $course) { ?>
                            <option value="<?=$course->course_id;?>" <?=($course->course_id == $mock->course_id)?'selected':'';?>><?=$course->course_title;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="syllabus" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Syllabus:</label>
                <div class=" col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'mock_syllabus',
                        'id'          => 'syllabus',
                        'placeholder' => 'Syllabus ',
                        'value'       => $mock->syllabus,
                        'rows'        => '3',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required'
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="feature_image" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Feature Image: </label>
                <div class=" col-sm-8 col-xs-7 col-mb">
                    <?=form_upload('feature_image', '', 'id="feature_image" class="form-control"') ?>
                    <p class="help-block"><i class="glyphicon glyphicon-warning-sign"></i> Allowed only max_size = 150KB, max_width = 1024px, max_height = 768px, types = gif | jpg | png .</p>
                </div>
            </div>
            <div class="form-group">
                <label for="passing_score" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Passing Score:</label>
                <div class="col-sm-3 col-xs-6 col-mb">
                    <div class="input-group">
                      <?php echo form_input('passing_score', $mock->pass_mark, 'id="passing_score" placeholder="Passing Score" class="form-control" required="required"') ?>
                      <span class="input-group-addon"> % </span>
                    </div>            
                </div>
            </div>
            <div class="form-group">
                <label for="exam_price" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Price:</label>
                <div class="col-sm-3 col-xs-6 col-mb">
                    <div class="input-group">
                      <?php echo form_input('price', $mock->exam_price, 'id="exam_price" placeholder="Exam Price" class="form-control"') ?>
                      <span class="input-group-addon"> <?=$currency_symbol?> </span>
                    </div>            
                      <p class="help-block info"><i class="glyphicon glyphicon-warning-sign"></i> Enter 0 if FREE.</p>
                </div>
            </div>
            <div class="form-group">
                <label for="public" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Public:</label>
                <div class="col-sm-3 col-xs-6 col-mb">
                    <select name="public" class="form-control">
                        <option value="1" <?=(1 == $mock->public)?'selected':'';?> >Yes</option>
                        <option value="0" <?=(0 == $mock->public)?'selected':'';?> >No</option>
                    </select>
                </div>
                <p class="help-block info"><strong><i class="glyphicon glyphicon-warning-sign"></i> If No, This exam will only available for courses.  </strong></p>
            </div>
            <div class="form-group">
                <label for="timepicker1" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Time Duration:</label>
                <div class="col-sm-2 col-md-3 col-xs-6 col-mb">
                    <div class="input-group">
                      <?php echo form_input('duration', $mock->time_duration, 'id="timepicker1" placeholder="hh:mm:ss" class="form-control" required="required"') ?>
                      <span class="input-group-addon"> <i class="glyphicon glyphicon-time"></i> </span>
                    </div>            
                </div>
            </div>
            <div class="form-group">
                <label for="random_ques" class="col-sm-2 col-sm-offset-1 col-xs-3 control-label mobile">Total Random Questions</label>
                <div class="col-sm-2 col-md-3 col-xs-6 col-mb">
                    <?php echo form_input('random_ques', $mock->random_ques_no, 'id="random_ques" placeholder="Numbers only" class="form-control" required="required"') ?>
                </div>
                <div class=" col-md-3 col-xs-6 col-mb">
                    <p class="help-block info"><strong><i class="glyphicon glyphicon-warning-sign"></i> Not more than <?=$ques_count;?> </strong></p>
                </div>
            </div>

            <div class="form-group">
              <label class="col-xs-offset-3 col-sm-8 col-xs-offset-2 col-xs-9">
                  <p class="text-muted"><i class="glyphicon glyphicon-info-sign"> </i> All fields are Required.</p>
              </label>
            </div>
            <br/><hr/>
            <div class="row">
                <div class="col-sm-offset-3">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Update</button>
                    <button type="reset" class="btn btn-warning col-sm-offset-1">Reset</button>
                </div>
            </div>
            <br/>
            <?=form_close(); ?>
        </div>
    </div>
    </div>
    </div>
</div>
<?=$this->load->view('plugin_scripts/bootstrap-wysihtml5');?>

<script>
$('select#parent-category').change(function() {

    var category = $(this).val();
    var link = '<?php echo base_url()?>'+'admin_control/get_subcategories_ajax/'+category;
    $.ajax({
        data: category,
        url: link
    }).done(function(subcategories) {

        console.log(subcategories);
        $('#category').html(subcategories);
    });
});
</script>