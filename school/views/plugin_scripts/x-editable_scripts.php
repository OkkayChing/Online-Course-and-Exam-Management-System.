<script src="<?php echo base_url('assets/X-editable/js/bootstrap-editable.js') ?>"></script>
<link href="<?php echo base_url('assets/X-editable/css/bootstrap-editable.css') ?>" rel="stylesheet" media="screen">
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('.modify').click(function(e) {
            var message = '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    + '<i class="glyphicon glyphicon-info-sign"></i> '
                    +' Click over the field you want to modify.'
                    + '</div>';
            $('#note').html(message); //Display the message
            e.preventDefault(); //Deactivate default submit
            e.stopPropagation(); //Stop the click event.
            var str = this.name; //Select name attribute
            var id = '.data-' + str; //Create the dom id

            $(id).editable({
                toggle: 'click',
                mode: 'inline',
                validate: function(value) {
                    if ($.trim(value) == '') {
                        return 'This field is required';
                    }
                },
                success: function(response) {
                    var alert_code,message;
                    if (response == 'TRUE') { //If Data updated Successfully
                        alert_code  = 'success';
                        message     = 'Successfully Saved!';
                    } else {                      //If Data updated Fail
                        alert_code  = 'danger';
                        message     = 'An ERROR occurred! Please try again.';
                    }
                    message = '<div class="alert alert-'+alert_code+' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'+ message+ '</div>';
                    $('#note').html(message);
                    $(this).html();
                }
            })
        });
    });
</script>