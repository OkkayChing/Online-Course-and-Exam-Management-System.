<?php //echo "<pre/>"; print_r($courses); exit(); ?>
<?php  if ($message)  echo $message; ?>
<?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Create New Course </p></div>
    </div>
    <div class="block-content">
    <?=form_open_multipart(base_url('course/update_course/'.$courses->course_id), 'role="form" class="form-horizontal"'); ?>
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>
        <div class="row">
            <?php $categories = $this->db->get('categories')->result();
            $option = array();
            foreach ($categories as $category) {
                if ($category->active) {
                    $option[$category->category_id] = $category->category_name;
                }
            }
            $sub_categories = $this->db->get('sub_categories')->result();
            $option2 = array();
            foreach ($sub_categories as $sub_cat) {
                if($sub_cat->cat_id == $courses->cat_id){
                    $option2[$sub_cat->id] = $sub_cat->sub_cat_name;
                }
            }
            ?>
            <div class="form-group">
                <label for="parent-category" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Select Category:</label>
                <div class="col-lg-3 col-sm-4 col-xs-4">
                    <?php echo form_dropdown('parent-category', $option, $courses->cat_id, 'id="parent-category" class="form-control"') ?>
                </div>
                <div class="col-lg-3 col-sm-4 col-xs-4">
                    <?php echo form_dropdown('category', $option2, $courses->id, 'id="category" class="form-control"') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_title" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Course Title:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'course_title',
                        'placeholder' => 'Course Title',
                        'id'          => 'course_title',
                        'value'       => $courses->course_title,
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_intro" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Course Introduction:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'course_intro',
                        'placeholder' => 'Course Introduction',
                        'id'          => 'course_intro',
                        'value'       => $courses->course_intro,
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_description" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Course Description:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'course_description',
                        'placeholder' => 'Course Description',
                        'id'          => 'course_description',
                        'value'       => $courses->course_description,
                        'rows'        => '3',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_requirement" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Course Requirement:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'course_requirement',
                        'placeholder' => 'Course Requirements',
                        'id'          => 'course_requirement',
                        'value'       => $courses->course_requirement,
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="course_description" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Target Audience:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'target_audience',
                        'placeholder' => 'Target Audience',
                        'id'          => 'target_audience',
                        'value'       => $courses->target_audience,
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="what_i_get" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">What I get?:</label>
                <div class="col-lg-8 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'what_i_get',
                        'placeholder' => 'What skill user will learn from this course?',
                        'id'          => 'what_i_get',
                        'value'       => $courses->what_i_get,
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="feature_image" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Feature Image: </label>
                <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                    <?=form_upload('feature_image', '', 'id="feature_image" class="form-control"') ?>
                    <p class="help-block"><i class="glyphicon glyphicon-warning-sign"></i> Allowed only max_size = 150KB, max_width = 1024px, max_height = 768px, types = gif | jpg | png .</p>
                </div>
            </div>
            <div class="form-group">
                <label for="Course_price" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Price:</label>
                <div class="col-sm-3 col-xs-6 col-mb">
                    <div class="input-group">
                      <?php echo form_input('price', $courses->course_price, 'id="Course_price" placeholder="Course Price" class="form-control" required="required"') ?>
                      <span class="input-group-addon"> <?=$currency_symbol?> </span>
                    </div>            
                </div>
            </div>
            <div class="form-group">
              <label class="col-xs-offset-3 col-sm-8 col-xs-offset-2 col-xs-9">
                  <p class="text-muted"><i class="glyphicon glyphicon-info-sign"> </i> All fields are Required.</p>
              </label>
            </div>
            <br/><hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Save</button>
                    <button type="reset" class="btn btn-warning col-xs-offset-1">Reset</button>
                </div>
            </div>
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