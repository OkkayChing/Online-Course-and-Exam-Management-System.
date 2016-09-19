 <?php if (!isset($no_contact_form)) { ?>
    <!--Contact Form-->
   <?=$this->load->view('contact_form.php');?>
<?php } ?>

<!-- Modal Start -->
<?php if (isset($modal)) echo $modal; ?>
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p class="text-muted" style="margin: 10px 0;"> &copy; <?=$brand_name.', '. date('Y')?></p>
            </div>
        </div>
    </div>
</footer><!--/#footer-->

<div id="fade" class="black_overlay"></div> 
<!-- Common Scripts-->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- Custom JS  -->
<script src="<?php echo base_url('assets/js/jsscript.js') ?>"></script>