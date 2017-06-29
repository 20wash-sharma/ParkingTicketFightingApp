<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title><?php echo $page_title;?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="<?php echo admin_asset_url(); ?>favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" href="<?php echo admin_asset_url(); ?>css/cropper/cropper.min.css"/>
        <!--  EOF CSS INCLUDE -->
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo admin_asset_url(); ?>css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo admin_asset_url(); ?>css/datatables/dataTables.colReorder.min.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo admin_asset_url(); ?>css/datatables/dataTables.colVis.min.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo admin_asset_url(); ?>css/datatables/dataTables.colvis.jqueryui.css"/>
    </head>
    <body>
        <input type="hidden" id="hdnURL" value="<?php echo admin_asset_url(); ?>" />
        <input type="hidden" id="hdnBase" value="<?php echo base_url(); ?>" />
        <!-- START PAGE CONTAINER -->
        <div class="page-container">