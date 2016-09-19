<!-- Dynamic Form Script-->
<script type="text/javascript">
//Add basic 4 fields initially
var i = 5, s;
function add_form(val) {
  //  alert(val);
    i = 5;
    var opt = '<div class=row><div class="col-xs-offset-1 col-xs-10 col-sm-offset-2 col-sm-8">';
        opt += '<p class="text-primary"><i class="glyphicon glyphicon-flash"></i> Select correct answer/s from left redio/checkbox options.</p>';
        opt += '</div></div>';

    for (q = 1; q <= 4; q++) {
        opt += '<div class="form-group">';
        opt += '<label for="options[' + q + ']" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Option ' + q + ': </label>';
        opt += '<div class="col-lg-5 col-sm-8 col-xs-7 col-mb">';
        opt += '<div class="input-group">';
        opt += '<span class="input-group-addon">';
        if (val == 'Radio') {
            opt += '<input type="' + val + '" name="ans" onclick="put_right_ans(' + q + ')" required="required">  <span class="invisible-on-sm"> Correct Ans.</span>';
        } else if (val == 'Checkbox') {
            opt += '<input type="' + val + '" name="right_ans[' + q + ']">  <span class="invisible-on-sm"> Correct Ans.</span>';
        }
        opt += '</span>';
        if (q <= 2) {
            opt += '<input name="options[' + q + ']" class="form-control" type="text" required="required">';
        }
        if (q > 2) {
            opt += '<input name="options[' + q + ']" class="form-control" type="text">';
        }
        opt += '</div></div></div>';
    }
    opt += '<div id="add_more_field-5"></div>';
    opt += '<div class="form-group">';
    opt += '<label class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">&nbsp;</label><div class="col-lg-5 col-sm-8 col-xs-7 col-mb">';
    opt += '<button type="button" class="btn btn-info" id="add_btn" onclick="add_field()"><icon class="icon-plus"></icon> Add More Options</button>';
    opt += '</div></div>';
    document.getElementById('options').innerHTML = opt;
}

//Add more fields
function add_field() {
    var type;
    if (document.getElementById('radio1').checked) {
        type = 'radio';
    } else if (document.getElementById('checkbox1').checked) {
        type = 'checkbox';
    }
    if (i <= 8) {
        var str = '<div class="form-group"><label for="options[' + i + ']" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobil">Option ' + i + ': </label>';
        str += '<div class="col-lg-5 col-sm-8 col-xs-7 col-mb">';
        str += '<div class="input-group">';
        str += '<span class="input-group-addon">';
        if (type === 'radio') {
            str += '<input type="' + type + '" name="ans" onclick="put_right_ans(' + i + ')" required="required">  <span class="invisible-on-sm"> Correct Ans.</span>';
        } else if (type === 'checkbox') {
            str += '<input type="' + type + '" name="right_ans[' + i + ']">  <span class="invisible-on-sm"> Correct Ans.</span>';
        }    
        str += '</span>';
        str += '<input name="options[' + i + ']" class="form-control" type="text">';
        str += '</div></div></div><div id="add_more_field-' + (i + 1) + '"></div>';

        document.getElementById('add_more_field-' + i).innerHTML = str;
        i++;
    } else {
        alert('You added maximum number of options!');
    }
}

//Pick the righ answers and set the value to hidden field
function put_right_ans(val) {
    var ryt = '<input type="hidden" name="right_ans[' + val + ']" value="on">';
    document.getElementById('hidden_fields').innerHTML = ryt;
}
</script>

<?php
if ($message) {
    echo $message;
}
?>
<?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '';?>   
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row">
            <p class="text-muted">
                <span class=""><?php echo 'Exam Title: '.$mock_title; ?></span>
                <span class="pull-right"><?php echo 'Question No: '.$question_no; ?></span>
            </p>
        </div>
    </div><br/>
    <div class="block-content">
    <?=form_open_multipart(base_url('course/create_quiz_question'), 'role="form" class="form-horizontal"'); ?>
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
            </div>
        </div>

        <div id="hidden_fields"></div>
        <div class="row">
            <input type="hidden" name="ques_no" value="<?php echo $question_no; ?>">
            <input type="hidden" name="quiz_id" value="<?php echo $title_id; ?>">
            <input type="hidden" name="quiz_title" value="<?php echo $quiz_title; ?>">
            <div class="form-group">
                <label for="question" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Quiz Question: </label>
                <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                  <?php 
                    $data = array(
                        'name'        => 'question',
                        'placeholder' => 'Question Title',
                        'value'       => '',
                        'rows'        => '2',
                        'class'       => 'form-control textarea-wysihtml5',
                        'required' => 'required',
                    ); ?>
                    <?php echo form_textarea($data) ?>
                </div>
            </div>
            <div class="form-group" id="media-choose">
                <label for="upload-media-file" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Upload Media File: </label>
                <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                    <a href="#" class="btn btn-default" id='upload-media-file'>Choose</a>
                </div>
            </div>
            <div id="media-option"></div>
            <div id="media-field"></div>
            <div class="form-group">
                <label for="ans_type" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Answer Type: </label>
                <div class="col-lg-5 col-sm-8 col-xs-7 col-mb">
                    <label class="radio-inline">
                        <input type="radio" id="radio1" name="ans_type" required="required" value="Radio" onclick="add_form(this.value)"> <span>Radio </span>&nbsp;&nbsp;&nbsp;&nbsp;
                    </label>
                    <label class="radio-inline">
                        <input type="radio" id="checkbox1" name="ans_type" required="required" value="Checkbox" onclick="add_form(this.value)"> <span>Check Box</span>
                    </label>
                </div>
            </div><br/>
            <div id="options">
            </div>
            <br/><hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Next <i class="glyphicon glyphicon-hand-right"></i></button>
                    <button type="reset" class="btn invisible-on-sm btn-warning col-xs-offset-1"><i class="glyphicon glyphicon-refresh"></i> Reset</button>
                    <button type="submit" class="btn btn-lg btn-info col-sm-offset-0 col-xs-offset-1" name="done" value="done"><i class="glyphicon glyphicon-saved"></i> Finish</button>
                    <span class="text-info invisible-on-md"> <i class="glyphicon glyphicon-bell"></i> Last question? Click "Finish"!</span>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
</div>
<?=$this->load->view('plugin_scripts/bootstrap-wysihtml5');?>

<!-- Dynamic media file upload Script-->
<script type="text/javascript">
$('#upload-media-file').click(function(){
    var type = '<div class="form-group">'
                +'<label for="media_type" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Media Type: </label>'
                +'<div class="col-lg-5 col-sm-8 col-xs-7 col-mb" style="margin-top: 5px;">'
                        +'<input type="radio" value="youtube" name="media_type" required="required" onclick="add_media_field(this.value)"> <span>YouTube </span>&nbsp;&nbsp;&nbsp;&nbsp;'
                        +'<input type="radio" value="video" name="media_type" required="required" onclick="add_media_field(this.value)"> <span>Video </span>&nbsp;&nbsp;&nbsp;&nbsp;'
                        +'<input type="radio" value="image" name="media_type" required="required" onclick="add_media_field(this.value)"> <span>Image </span>&nbsp;&nbsp;&nbsp;&nbsp;'
                        +'<input type="radio" value="audio" name="media_type" required="required" onclick="add_media_field(this.value)"> <span>Audio </span>'
                +'</div>'
            +'</div>';
    $('#media-choose').hide();
    $('#media-option').append(type);
})

//Add media fields
function add_media_field(val) {
    var field = '<div class="form-group">'
                +'<label for="media_field" class="col-sm-offset-0 col-lg-2 col-xs-offset-1 col-xs-3 control-label mobile">Add Media: </label>'
                +'<div class="col-lg-5 col-sm-8 col-xs-7 col-mb"><input type="hidden" name="media_type" value="'+val+'">';
    if (val == 'video') {
            var types = 'mp4 | webm | ogg';
    }else if (val == 'audio') {
            var types = 'ogg | mp3 | wav';        
    }else if (val == 'image') {
            var types = 'gif | jpg | png';
    };

    switch(val){
        case 'youtube':
            field += '<input type="text" class="form-control" name="media">';
            break;
        case 'video':
        case 'image':
        case 'audio':
            field += '<input type="file" id="media" name="media" style="margin-top:8px;">';
            field += '<p class="help-block"><i class="glyphicon glyphicon-warning-sign"></i> Allowed types = '+ types +'.</p>';
            break;
    }
    field +='</div></div>';

    $('#media-option').hide();
    $('#media-field').append(field);
}
</script>