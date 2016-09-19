<footer>
    <div class="container">
        <p class="text-muted">Copyright &copy; <?=$brand_name.', '. date('Y')?></p>
    </div>
</footer>
<!-- bootstrap Scripts-->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

<!-- Data table Scripts-->
<?php
   $this->load->view('plugin_scripts/datatable_scripts');
?>
<!-- X-Editable Scripts-->
<?php
   $this->load->view('plugin_scripts/x-editable_scripts');
?>
