</div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="<?php echo base_url(); ?>index.php/login/logout" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->
<!--         <div class="modal animated fadeIn" id="modal_change_password" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
            
        </div> -->
         <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn"  id="modal_change_password">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close mb-control-close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only ">Close</span></button>
                        <h4 class="modal-title" id="smallModalHead">Change password</h4>
                    </div>
                    <div id="successpassword" class="alert alert-success hide" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <p></p>
                    </div>
                    <div id="failpassword" class="alert alert-warning hide" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <p></p>
                    </div>
                    <div class="modal-body">
                        <p>Please enter the old password and new password to change your password.</p>
                    </div>
                    <form id="changePassword" class="form-horizontal" role="form" action="#">
                        <div class="modal-body form-horizontal form-group-separated">                        
                            <div class="form-group">
                                <label class="col-md-3 control-label">Old Password</label>
                                <div class="col-md-9">
                                    <input id="oldPassword" type="password" class="form-control" name="old_password"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">New Password</label>
                                <div class="col-md-9">
                                    <input id="newPassword" type="password" class="form-control" name="new_password"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Repeat New</label>
                                <div class="col-md-9">
                                    <input id="reNewPassword" type="password" class="form-control" name="re_password"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btnChangePassword" type="button" class="btn btn-danger">Proccess</button>
                            <button type="button" class="btn btn-default mb-control-close" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="<?php echo admin_asset_url(); ?>audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="<?php echo admin_asset_url(); ?>audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                  
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->
        
        <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins.js"></script>        
        <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/actions.js"></script>
        
        <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/settings.js"></script>
        <script type='text/javascript' src='<?php echo admin_asset_url(); ?>js/plugins/icheck/icheck.min.js'></script>        
        <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
              <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/general.js"></script>
        <?php if(!isset($scriptsfiles) || $scriptsfiles == null || count($scriptsfiles) <= 0): ?>
            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/datatables/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/common.js"></script>

            <!-- START THIS PAGE PLUGINS-->        
            
            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/scrolltotop/scrolltopcontrol.js"></script>

            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/morris/raphael-min.js"></script>
            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/morris/morris.min.js"></script>       

            <script type='text/javascript' src='<?php echo admin_asset_url(); ?>js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
            <script type='text/javascript' src='<?php echo admin_asset_url(); ?>js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
            <script type='text/javascript' src='<?php echo admin_asset_url(); ?>js/plugins/bootstrap/bootstrap-datepicker.js'></script>                
            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/owl/owl.carousel.min.js"></script>                 

            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/moment.min.js"></script>
            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/daterangepicker/daterangepicker.js"></script>


            <!-- END THIS PAGE PLUGINS-->        

            <!-- START TEMPLATE -->
            

            

            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/demo_dashboard.js"></script>
            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/rickshaw/d3.v3.js"></script>
            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/rickshaw/rickshaw.min.js"></script>
            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/demo_charts_morris.js"></script>
            <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/sparkline/jquery.sparkline.min.js"></script>
            <script type='text/javascript' src='<?php echo admin_asset_url(); ?>js/plugins/jquery-validation/jquery.validate.js'></script>
        <?php endif; ?>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         
    <?php
        if(isset($scriptsfiles) && $scriptsfiles != NULL && count($scriptsfiles) > 0):
        foreach($scriptsfiles as $files): 
    ?>
        <script type='text/javascript' src='<?php echo admin_asset_url(); ?>js/<?=$files?>'></script>
    <?php     
        endforeach;
        endif;
    ?>
    <?php if($userData[0]->Role_roleID == 23): ?>
        <script>
            $(document).ready(function(){
                $(".x-navigation-minimize").trigger("click");
            });
        </script>
    <?php endif; ?>
    <?php echo $before_body;?>
        
</body>
</html>
