<?php $user_info = $this->db->get_where('users', array('user_id' => $this->session->userdata('user_id')))->row();?>
<section id="exam_summery">
    <div class="container">
          <div class="box">
             <div class="row">
                <div class="col-xs-10 col-xs-offset-1">
                    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
                    <?=(isset($message)) ? $message : ''; ?>
                </div>
                <div class="col-md-10 col-sm-12 col-md-offset-1 col-sm-offset-0">
                    <ol class="breadcrumb hidden-print">
                        <?php if ($this->session->userdata('log')) { ?>
                            <li><a href="<?= base_url('dashboard/' . $this->session->userdata('user_id')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li> 
                        <?php } ?>                
                        <li><a href="<?= base_url('exam_control/view_all_mocks') ?>"><i class="fa fa-puzzle-piece"></i> Exams</a></li> 
                        <li class="active">Exam Summery</li>
                    </ol>
                    <div class="big-gap"></div>
                    <h3><span class="text-muted"># </span> <?= $mock->title_name ?></h3>
                    <div class="big-gap"></div>
  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">Exam Summery:</div>        
                                <div class="panel-body">
                                       <table class="table table-condensed">
                                        <tr>
                                            <th>Title:</th>
                                            <td><?= $mock->title_name ?></td>
                                        </tr>
                                        <tr>
                                            <th>Category:</th>
                                            <td><?=$mock->category_name.'/'.$mock->sub_cat_name;?></td>
                                        </tr>
                                        <tr>
                                            <th>Price:</th>
                                            <td><?=($mock->exam_price)?$currency_code.' '.$currency_symbol.$mock->exam_price:'Free' ?></td>
                                        </tr>
                                    </table>
                                </div>        
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">Rules:</div>        
                                <div class="panel-body">
                                    <table class="table table-condensed">
                                        <tr>
                                            <th>Total Questions:</th>
                                            <td><?= $mock->random_ques_no ?></td>
                                        </tr>
                                        <tr>
                                            <th>Passing Score:</th>
                                            <td><?= $mock->pass_mark ?>%</td>
                                        </tr>
                                        <tr>
                                            <th>Duration:</th>
                                            <td><?=$mock->time_duration ?> <span class="text-muted"> hours</span></td>
                                        </tr>
                                    </table>
                                </div>        
                            </div>
                        </div>
                    </div>


                    <h3 class="text-muted">Syllabus:</h3>
                    <p class=""><?= $mock->syllabus; ?></p>


                    <div class="big-gap"></div>

                    <?php if ($mock->exam_price) {
                        if (($this->session->userdata('log')) && ($user_info->subscription_id != 0) && ($user_info->subscription_end > now())) {
                            $payment_info = 'view_exam_instructions';
                        }else{
                            $payment_info = 'payment_process'; 
                        }
                    }else{
                        $payment_info = 'view_exam_instructions';
                    }
                    ?>
                    <a href="<?=base_url('exam_control/'.$payment_info.'/'.$mock->title_id) ?>" class="btn btn-success col-xs-5"> <?php echo ($payment_info == 'payment_process')?'Pay with PayPal':'Start Exam' ?></a>  
                    <div class="big-gap"><br/></div>
                    <p class="result-note"><strong>Note: </strong>The value of this exam certificate is only valid under the terms and conditions of <?= $brand_name ?>.</p>

                </div>
            </div>
        </div> 
    </div>
</section><!--/#pricing-->