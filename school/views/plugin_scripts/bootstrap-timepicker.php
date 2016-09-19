<link href="<?php echo base_url('assets/timepicker-gh/bootstrap-timepicker.min.css') ?>" rel="stylesheet" media="screen">
<script src="<?php echo base_url('assets/timepicker-gh/bootstrap-timepicker.min.js') ?>"></script>
<script type="text/javascript" charset="utf-8">
    $('#timepicker1').timepicker({
        minuteStep: 1,
        secondStep: 10,
        defaultTime: '00:02:00',
        appendWidgetTo: 'body',
        showSeconds: TRUE,
        showMeridian: FALSE,
    });
</script>