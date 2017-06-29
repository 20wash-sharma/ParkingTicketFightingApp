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
                <div id="fail" class="alert alert-warning hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <p></p>
                </div>
                <div class="login-body">
                    <div class="login-title"><strong>Welcome</strong>, Please login</div>
                    <form action="#" class="form-horizontal" method="post">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input id="username" type="text" class="form-control" placeholder="Username" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" placeholder="Password" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
                            </div>
                            <div class="col-md-6">
                                <button id="login" class="btn btn-info btn-block">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                $('#login').click(function(event){
                    event.preventDefault();
                    var email = $('#username').val();
                    var password = $('#password').val();
                    jQuery.ajax({
                        type: "POST",
                        async: true,
                        //url: "<?=base_url()?>index.php/login/check",
                        url: "http://128.199.191.31/ptfa/index.php/api/user/checklogin",
                        dataType: 'json',
                        data: {username: email, password: password},
                        timeout: 10000,
                        success: function(res){
                            if(res){
                                if(res['status'] == 1){
                                    alert('hi');
                                    //window.location.href = res['redirect'];
                                } else {
                                    $('#fail p').html(res['msg']);
                                    $('#fail').removeClass('hide');
                                }
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>