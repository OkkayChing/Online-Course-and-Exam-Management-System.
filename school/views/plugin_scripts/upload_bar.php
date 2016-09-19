<script src="<?php echo base_url('assets/js/jquery.form.js') ?>"></script>
<script>
(function() {
    
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
       
    $('form').ajaxForm({
        beforeSend: function() {
            $('.progress').removeClass('hidden');
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            // bar.width(percentVal);
            $('.progress-bar').css('width', percentVal);
            $('.progress-percent').text(percentVal);
            // percent.html(percentVal);
        },
        success: function(data) {
            // console.log(data);
            window.location = "<?=base_url('admin_control/create_question');?>";
            // var percentVal = '100%';
            // bar.width(percentVal)
            // percent.html(percentVal);
        },
        complete: function(xhr) {
            $('.progress').add('hidden');
            // status.html(xhr.responseText);
        }
    }); 

})();       
</script>