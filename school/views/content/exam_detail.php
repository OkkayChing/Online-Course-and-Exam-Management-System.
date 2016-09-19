<style type="text/css">
    .data-red{
        color: red;
    }
    .data-green{
        color: green;
    }
    ul{
        list-style: none;
    }

</style>
<div id="note">
<?php if ($message) echo $message;
   // echo "<pre/>"; print_r($results);
    $tmp = (array) json_decode($results->result_json);
?>
</div>

<div class="block"> 
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Result Details: <?=$results->title_name;?> </p></div>
    </div>
    <div class="block-content">
    <div class="row">
        <div class="col-sm-12">
        <ul class="">
        <?php foreach ($tmp as $key => $value) { 
            $question = $this->db->where('ques_id', $key)->get('questions')->row(); ?>
            <li class=""><strong>Q: <?=$question->question;?></strong>
                <ul class="list-group" style="margin-top: 12px;"><strong>Answers: </strong>
                    <?php $answers = $this->db->where('ques_id', $key)->get('answers')->result();
                    $temp_ans = explode(',', $value);
                    foreach ($answers as $val) { ?>
                        <li class="list-group-item" ><input type="<?=$question->option_type;?>" disabled="disabled" <?=(in_array($val->ans_id, $temp_ans))?'checked':''?>/> <span style="margin-left: 10px;"><?=$val->answer;?></span> 
                        <?php if($val->right_ans == 1){ ?>
                            <span class="badge"><i class="glyphicon glyphicon-ok"></i></span>
                        <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            </li>
        <?php } ?>
        </ul>
<?php 
// echo "<pre/>"; print_r($results);
// $t = (array) json_decode($results->result_json);
// echo "<pre/>"; print_r($t);
// $t = array_keys($t);
// echo "<pre/>"; print_r($t);
// $t = array([0] => 'munnnaa',[1] => 'munnnaa',[2] => 'munn,naa',[3] => 'munnnaa' );
// if (in_array(2, $t)) {
//     echo "string";
// }else{
//     echo "wrong";
// }
// exit();
?>
        </div>
    </div>
    </div>
</div><!--/span-->