<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Parking Ticket Fighting Mobile Application</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="<?php echo admin_asset_url(); ?>favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo admin_asset_url(); ?>css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->    
    </head>
    <body>
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <?php if($status == 1): ?>
                    <div id="fail" class="alert alert-warning hide" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <p></p>
                    </div>
                    <div class="login-body">
                        <div class="login-title"><strong>Welcome</strong>, Please create your password.</div>
                        <form action="<?=base_url().'index.php/login/createpassword'?>" class="form-horizontal" method="post">
                            <input type="hidden" id="userID" name="userID" value="<?=$userID?>" />
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input name="password" id="password" type="password" class="form-control" placeholder="New Password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input name="repassword" id="repassword" type="password" class="form-control" placeholder="Re-enter Password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <button id="activate" class="btn btn-info btn-block">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        <p>Invalid activation code.</p>
                    </div>
                <?php endif; ?>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; <?= date('Y'); ?> Parking Ticket Fighting
                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            
            </div>
            
        </div>
        <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo admin_asset_url(); ?>js/plugins/bootstrap/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#activate').click(function(event){
                    event.preventDefault();
                    var newpassword = $('#password').val();
                    var repassword = $('#repassword').val();
                    var userID = $('#userID').val();
                    if(newpassword != repassword)
                    {
                        $('#fail p').html('Both password do not match.');
                        $('#fail').removeClass('hide');
                    } else {
                        jQuery.ajax({
                            type: "POST",
                            url: "<?=base_url()?>index.php/login/createpassword",
                            dataType: 'json',
                            data: {password: newpassword, userID: userID},
                            success: function(res){
                                if(res){
                                    if(res['status'] == 1){
                                        window.location.href = res['redirect'];
                                    } else {
                                        $('#fail p').html(res['msg']);
                                        $('#fail').removeClass('hide');
                                    }
                                }
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>