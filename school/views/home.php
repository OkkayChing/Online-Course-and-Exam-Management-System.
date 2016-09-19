<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="এসোশিখি">
        <title>এসোশিখি</title>
        <!--Header-->
        <?=$header; ?>
        <!--Page Specific Header-->
        <?php  if (isset($extra_head)) echo $extra_head; ?>
    </head>
   
    <body>
        <!--Top Navigation-->
        <?=(isset($top_navi)) ? $top_navi : ''; ?>
        <!--Sidebar-->
        <?=(isset($sidebar)) ? $sidebar : ''; ?>

        <!--Content-->
        <?=(isset($content)) ? $content : ''; ?>

        <!--Footer-->
        <?=$footer; ?>
        <!--Page Specific Footer-->
        <?php if (isset($extra_footer)) echo $extra_footer; ?>
    </body>
</html>