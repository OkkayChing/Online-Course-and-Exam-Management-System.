<?php
    $num_of_ques = count($questions);
    $count = 1;
?>
<section id="start_exam">
    <div class="container">
        <div class="box">
            <div class="row">
                <div class="col-md-10 col-sm-12 col-md-offset-1 col-sm-offset-0">
                    <div id="note">
                        <noscript><div class="alert alert-danger">Your browser does not support JavaScript or JavaScript is disabled! Please use JavaScript enabled browser to take this exam.</div></noscript>
                        <?php if ($message) echo $message; ?>
                    </div>
                    <h3># <?= $mock->title_name ?></h3>
                    <hr>
                    <form id="anserForm" action="<?php echo base_url('exam_control/index'); ?>" method="post">
                        <div class="question_content">
                            <input type="hidden" name="exam_id" value="<?= $mock->title_id; ?>">
                            <input type="hidden" name="token" value="<?= time(); ?>">
                            <div id="Carousel" class="carousel col-md-12" data-interval="false" data-wrap="false" style="margin-bottom: 30px;">
                                <div class="carousel-inner">
                                    <?php 
                                    foreach ($questions as $ques): $type = ($ques->option_type == 'Radio') ? 'radio' : 'checkbox'; ?>
                                        <div class="item <?= ($count == $num_of_ques) ? 'active' : '' ?>">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p>Question <?= ($num_of_ques - $count + 1) . ' of ' . $num_of_ques; ?> 
                                                        <span class="pull-right">Time Remaining: 
                                                            <span class="time-duration"></span>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3><?= $ques->question ?></h3><br/>

                                                    <?php if (!empty($ques->media_type) AND ($ques->media_type != '')  AND ($ques->media_link != '')) {
                                                        switch ($ques->media_type) {
                                                            case 'youtube':
                                                                parse_str(parse_url($ques->media_link, PHP_URL_QUERY));
                                                                echo '<div class="embed-responsive embed-responsive-16by9">';
                                                                echo '<iframe class="embed-responsive-item" src="//www.youtube.com/embed/'.$v.'" frameborder="0"></iframe>';
                                                                echo "</div>";
                                                                break;
                                                            case 'audio':
                                                                $link = '<audio controls>';
                                                                  $link .= '<source src="'.base_url("question-media/".$ques->media_link).'" type="audio/mpeg">';
                                                                  $link .= '<source src="'.base_url("question-media/".$ques->media_link).'" type="audio/ogg">';
                                                                  $link .= '<source src="'.base_url("question-media/".$ques->media_link).'" type="audio/wav">';
                                                                $link .= '</audio>';
                                                                echo $link;
                                                                break;
                                                            case 'video':
                                                                $link = '<p><video width="600" height="400" controls>';
                                                                  $link .= '<source src="'.base_url("question-media/".$ques->media_link).'" type="video/mp4">';
                                                                  $link .= '<source src="'.base_url("question-media/".$ques->media_link).'" type="video/ogg">';
                                                                  $link .= '<source src="'.base_url("question-media/".$ques->media_link).'" type="video/webm">';
                                                                $link .= '</audio></p>';
                                                                echo $link;
                                                                break;
                                                            case 'image':
                                                                echo '<img src="'.base_url("question-media/".$ques->media_link).'" alt="image" height="auto" width="100%">';
                                                                break;                                    
                                                            default:
                                                                break;
                                                        }
                                                        echo "<br/><br/>";
                                                    }
                                                    ?>
                                                    <?php
                                                    foreach ($answers[$ques->ques_id][0] as $ans) { ?>
                                                        <div class="<?= $type ?>" style="margin-left: 23px; margin-top:10px;">
                                                            <label><input type="<?= $type ?>" name="ans[<?= $ques->ques_id; ?>]<?= ($type == 'checkbox') ? '[]' : '' ?>" value="<?=$ans->ans_id; ?>"> 
                                                                <?=form_prep($ans->answer); ?>
                                                            </label>
                                                        </div>
                                                    <?php 
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $count++;
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class=" me-control-btn">
                                    <a class="btn btn-lg btn-info col-xs-5 col-xs-offset-0 me-prev" href="#Carousel" data-slide="next" disabled> &laquo; Prev<span class="hidden-xxs">ious Question</span></a>
                                    <a class="btn btn-lg btn-info col-xs-5 col-xs-offset-2 me-next" href="#Carousel" data-slide="prev"> Next <span class="hidden-xxs">Question</span> &raquo; </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <p id="submit_button" style="margin: 30px 15px;"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script language="JavaScript"><!--
javascript:window.history.forward(1);
//--></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Set Time

        var count = <?= ($duration) ?>;
        var h, m, s, newTime;

        var counter = setInterval(timer, 1000);
        function timer() {
            count = count - 1;
            if (count < 0) {
                clearInterval(counter);
                return;
            }
            h = Math.floor(count / 3600);
            m = Math.floor(count / 60) - (h * 60);
            s = count % 60;
            if (m.toString().length == 1)
                m = '0' + m;
            if (s.toString().length == 1)
                s = '0' + s;
            if (h) {
                if (h.toString().length == 1)
                    h = '0' + h;
                newTime = '<strong>' + h + ':' + m + ':' + s + '</strong> <small class="text-muted">Hours</small>';
            } else {
                newTime = '<strong>' + m + ':' + s + '</strong> <small class="text-muted">Minutes</small>';
            }
           
            //Update timer cookie
            var now = new Date();
            var time = now.getTime();
            time += count * 1000;
            now.setTime(time);
            document.cookie="ExamTimeDuration="+count+"; expires="+now.toUTCString()+"; path=/";
            
            //Update time to HTML
            $('.time-duration').html(newTime);
        }

        // Coltrol Buttons    
        var submit_btn = '<button type="submit" class="btn btn-lg btn-success col-xs-12" > <i class="fa fa-check-square-o"></i> Submit <span class="hidden-xxs">your answers </span></a>';
        var slide_count = 1;
        var num_of_ques = "<?php echo $num_of_ques; ?>";
        $('.me-next').click(function() {
            $('.me-prev').removeAttr('disabled');
            slide_count++;
            if (slide_count >= num_of_ques) {
                $('.me-next').attr('disabled', 'disabled');      //disable Nest button for last question.
                if (!$("#submit_button > button").length) {          //Check if the submit button already placed add if not.
                    $("#submit_button").append(submit_btn);
                }
            }
        });
        $('.me-prev').click(function() {
            $('.me-next').removeAttr('disabled');
            slide_count--;
            if (slide_count == 1) {
                $('.me-prev').attr('disabled', 'disabled');   //disable Prev button for fast question.
            }
        });

        //Sumbit after time out
        var timeout = <?= ($duration * 1000) ?>;
        setTimeout(function() {
            alert('TIME OUT!');
            $('#anserForm').submit();
        }, timeout);

    });

</script>