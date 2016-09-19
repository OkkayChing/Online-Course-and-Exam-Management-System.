<div id="note">
    <?=validation_errors('<div class="alert alert-danger">', '</div>'); ?>
    <?=($this->session->flashdata('message')) ? $this->session->flashdata('message') : '' ?>        
    <?=(isset($message)) ? $message : ''; ?>
</div>
<?php $grp = $this->db->where('faq_grp_id',$faq_grp_id)->get('faq_grp')->row();
?>
<!-- block -->
<div class="block">
    <div class="navbar block-inner block-header">
        <div class="row"><p class="text-muted">Update FAQs </p></div>
    </div>
    <div class="block-content">
    <form action="<?php echo base_url().'faq_control/update_faq_grp/'.$grp->faq_grp_id; ?>" method="post" role="form" class="form-horizontal">  
    <div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="form-group">
                <label for="faq_grp_name" class="col-sm-offset-0 col-md-2 col-xs-offset-1 col-xs-3 control-label mobile">Group Name: </label>
                <div class="col-sm-8 col-xs-7 col-mb">
                    <?php echo form_input('faq_grp_name', $grp->faq_grp_name, 'placeholder="FAQ Group Name" class="form-control" required="required"') ?>
                </div>
            </div>
            <br/><hr/>
            <div class="row">
                <div class="col-xs-offset-1 col-xs-11 col-sm-offset-2 col-md-8">
                    <button type="submit" class="btn btn-primary col-xs-5 col-sm-3">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
</div>