<script type="text/javascript">
var i = 6;
//Add more fields
function add_field() {
    var str = '<div class="form-group"><label for="section_' + i + '" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Section Title ' + i + ': </label>';
    str += '<div class="col-lg-6 col-sm-8 col-xs-7 col-mb">';
    str += '<textarea name="section[]" placeholder="Section Title ' + i + '" class="form-control textarea-wysihtml5" row="2"></textarea>';
    str += '</div></div><div id="add_more_field-' + (i + 1) + '"></div>';

    document.getElementById('add_more_field-' + i).innerHTML = str;
    i++;
}
    
</script>

<?php 
if ($message) { 
    echo $message;
}
?>
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Add Sections </p></div>
    </div>
    <div class="block-content">
    <form action="<?php echo base_url().'course/save_sections'?>" method="post" id="ajax-form" role="form" class="form-horizontal">  
        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
        <input type="hidden" name="course_title" value="<?php echo $course_title; ?>">
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label for="section_1" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px;">Section Title 1: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'section[]',
                        'placeholder' => 'Section Title 1',
                        'id'          => 'section_1',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="section_2" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px;">Section Title 2: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'section[]',
                        'placeholder' => 'Section Title 2',
                        'id'          => 'section_2',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="section_3" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px;">Section Title 3: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'section[]',
                        'placeholder' => 'Section Title 3',
                        'id'          => 'section_3',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="section_4" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px;">Section Title 4: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'section[]',
                        'placeholder' => 'Section Title 4',
                        'id'          => 'section_4',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group">
                <label for="section_5" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px;">Section Title 5: </label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'section[]',
                        'placeholder' => 'Section Title 5',
                        'id'          => 'section_5',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div id="add_more_field-6"></div>
            <div class="form-group">
                <label for="section_5" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile" style="padding-top: 50px;"></label>
                <div class="col-lg-6 col-sm-8 col-xs-7 col-mb">
                    <button type="button" class="btn btn-warning" id="add_btn" onclick="add_field()"><icon class="icon-plus"></icon> Add More</button>
                </div>
            </div><hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
</div>
<?=$this->load->view('plugin_scripts/bootstrap-wysihtml5');?>