<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/_parts/admin_master_header_view'); 
$this->load->view('templates/_parts/admin_master_sidebar_view'); ?>
<!-- PAGE CONTENT -->
<div class="page-content">
    <?php 
        $this->load->view('templates/_parts/admin_master_contenttop_view');
        echo $the_view_content; 
    ?>
</div>
<!-- END PAGE CONTENT -->
<?php $this->load->view('templates/_parts/admin_master_footer_view');?>