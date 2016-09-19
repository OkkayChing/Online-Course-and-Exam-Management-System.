<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Munna Khan">
        <title><?=$brand_name?></title>
        <!--Header-->
        <?php echo $header; ?>
        <!--Page Specific Header-->
        <?php if (isset($extra_head)) echo $extra_head; ?>
    </head>
    <body>
        <div id="wrapper">
            <!-- Sidebar -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?=$brand_name;?></a>
                </div>
                <!-- This content will toggle -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>" style="margin-top: 7px;">Visit Site</a>

                    <!--Sidebar-->
                    <?php echo (isset($sidebar)) ? $sidebar : ''; ?>

                    <!--Top Navigation-->
                    <?php echo (isset($top_navi)) ? $top_navi : ''; ?>
                </div><!-- /.navbar-collapse -->
            </nav>
            <div id="page-wrapper">
                <div class="note">
                <?php if ($commercial) {
                    if(!$this->db->where('id',1)->get('paypal_settings')->row()->api_username){ ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>
                        Please setup the PayPal API from system setting.
                    </div>
                <?php }
                    if(!$this->db->get('price_table')->result()){ ?>
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>
                        Please create an offer for membership.
                    </div>
                <?php }
                } ?>
                <?php if(!$this->db->get('categories')->result()){?>
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>
                        Please create categories and sub-categories before create exams or courses.
                    </div>
                <?php }else if (!$this->db->get('sub_categories')->result()) { ?>
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>
                        Please create sub-categories before create exams or courses.
                    </div>
                <?php } ?>
                </div>
                <!--Content-->
                <?php echo (isset($content)) ? $content : ''; ?>
            </div><!-- /#page-wrapper -->
            <hr/>
            
            <!-- Modal Start -->
            <?php if (isset($modal)) echo $modal; ?>

            <!--Footer-->
            <?php echo $footer; ?>
       </div><!-- /#wrapper -->
       
        <!--Page Specific Footer-->
       <?php if (isset($extra_footer)) echo $extra_footer; ?>
    </body>
</html>