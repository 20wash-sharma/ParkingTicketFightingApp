<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">User</a></li>
    <li><a href="#">Edit Profile</a></li>
    <li class="active"><?=$userProfile[0]->firstname . ' ' . $userProfile[0]->lastname ?></li>
</ul>
<!-- END BREADCRUMB -->                                                

<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-cogs"></span> Edit Profile</h2>
</div>
<!-- END PAGE TITLE -->                     

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">     

    <div class="row">                        
        <div class="col-md-3 col-sm-4 col-xs-5">

            <form action="#" class="form-horizontal">
            <div class="panel panel-default">                                
                <div class="panel-body">
                    <h3><span class="fa fa-user"></span> <?=$userProfile[0]->firstname . ' ' . $userProfile[0]->lastname ?></h3>
                    <div class="text-center" id="user_image">
                        <?php if($userProfile[0]->profileImage != NULL & $userProfile[0]->UserID != ''): ?>
                            <img id="userProfImage" src="<?=base_url().'/uploads/'.$userProfile[0]->profileImage?>" class="img-thumbnail"/>
                        <?php else: ?>
                            <img id="userProfImage" src="<?php echo admin_asset_url(); ?>assets/images/users/user2.jpg" class="img-thumbnail"/>
                        <?php endif; ?>
                    </div>                                    
                </div>
                <div class="panel-body form-group-separated">

                    <div class="form-group">                                        
                        <div class="col-md-12 col-xs-12">
                            <a href="#" class="btn btn-primary btn-block btn-rounded" data-toggle="modal" data-target="#modal_change_photo">Change Photo</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">#ID</label>
                        <div class="col-md-9 col-xs-7">
                            <input type="hidden" id="hdnUserId" value="<?=$userProfile[0]->UserID ?>" />
                            <input type="text" value="<?=$userProfile[0]->UserID ?>" class="form-control" disabled/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">Login</label>
                        <div class="col-md-9 col-xs-7">
                            <input type="text" value="<?=$userProfile[0]->username ?>" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">E-mail</label>
                        <div class="col-md-9 col-xs-7">
                            <input type="text" value="<?=$userProfile[0]->email ?>" class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">                                        
                        <div class="col-md-12 col-xs-12">
                            <a href="#" class="btn btn-danger btn-block btn-rounded" data-toggle="modal" data-target="#modal_change_password">Change password</a>
                        </div>
                    </div>

                </div>
            </div>
            </form>

        </div>
        <div class="col-md-6 col-sm-8 col-xs-7">
            <div id="successP" class="alert alert-success hide" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <p></p>
            </div>
            <div id="failP" class="alert alert-warning hide" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <p></p>
            </div>
            <form id="changeProfile" class="form-horizontal" role="form" action="#" >
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3><span class="fa fa-pencil"></span> Profile</h3>
                    <p>Please update your personal information.</p>
                </div>
                <div class="panel-body form-group-separated">
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">First Name</label>
                        <div class="col-md-9 col-xs-7">
                            <input type="text" value="<?=$userProfile[0]->firstname ?>" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">Last Name</label>
                        <div class="col-md-9 col-xs-7">
                            <input type="text" value="<?=$userProfile[0]->lastname ?>" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-5 control-label">Email</label>
                        <div class="col-md-9 col-xs-7">
                            <input type="text" value="<?=$userProfile[0]->email ?>" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-xs-5">
                            <button id="btnSaveProfile" class="btn btn-primary btn-rounded pull-right">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        
            <div class="panel panel-default">
                <div id="successA" class="alert alert-success hide" role="alert">
                    <button type="button" class="close successAC" data-dismiss="alert1"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <p></p>
                </div>
                <div id="failA" class="alert alert-warning hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <p></p>
                </div>
                <div class="panel-body">
                    <h3><span class="fa fa-cog"></span> Alert Settings</h3>
                    <p>Change the setting for alerts</p>
                </div>
                <div class="panel-body form-horizontal form-group-separated">
                    <form id="changeAlert" class="form-horizontal" role="form" action="#" >
                    <?php //var_dump($alerts); ?>
                    <?php foreach ($alerts as $singleAlert): ?>
                        <div class="form-group alertRows<?php if($singleAlert->alertDest == '' || $singleAlert->alertDest == NULL) echo ' alert-warning'; ?>">
                            <label class="col-md-6 col-xs-6 control-label">
                                <label class="check"><input <?php if($singleAlert->sendalert == "1") echo 'checked'; ?> name="alertStatus" type="checkbox" class="alertChk icheckbox" value="<?=$singleAlert->AlertsID?>"/> <?=$singleAlert->description?></label>
                            </label>
                            <div class="col-md-6 col-xs-6">
                                <select name="alertType" class="form-control select alertSel">
                                    <option value="0">Select</option>
                                    <option value="email" <?php if($singleAlert->alertType == 'email') echo 'selected'; ?>>Email</option>
                                    <option value="text" <?php if($singleAlert->alertType == 'text') echo 'selected'; ?>>Text</option>
                                    <option value="twitter" <?php if($singleAlert->alertType == 'twitter') echo 'selected'; ?>>Twitter</option>
                                    <option value="facebook" <?php if($singleAlert->alertType == 'facebook') echo 'selected'; ?>>Facebook</option>
                                </select>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group">
                        <div class="col-md-12 col-xs-5">
                            <button id="btnSaveAlert" class="btn btn-primary btn-rounded pull-right">Save</button>
                        </div>
                    </div>
                    </form>
                </div>
                
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default form-horizontal">
                <div class="panel-body">
                    <h3><span class="fa fa-info-circle"></span> Quick Info</h3>
                    <p>Some quick info about this user</p>
                </div>
                <div class="panel-body form-group-separated">                                    
                    <div class="form-group">
                        <label class="col-md-4 col-xs-5 control-label">Last visit</label>
                        <div class="col-md-8 col-xs-7 line-height-30"><?=date("m.d.Y",strtotime($userProfile[0]->lastseen))?></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-xs-5 control-label">Registration</label>
                        <div class="col-md-8 col-xs-7 line-height-30"><?=date("m.d.Y",strtotime($userProfile[0]->creationtime))?></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-xs-5 control-label">Role</label>
                        <div class="col-md-8 col-xs-7"><?=$userProfile[0]->name?></div>
                    </div>
                </div>

            </div>
            <div class="panel panel-default form-horizontal">
                <div id="successContact" class="alert alert-success hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <p></p>
                </div>
                <div id="failContact" class="alert alert-warning hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <p></p>
                </div>
                <div class="panel-body">
                    <h3><span class="fa fa fa-bell-o"></span> Contact Information</h3>
                </div>
                <div class="panel-body form-group-separated">
                    <form id="contactForm" class="form-horizontal" role="form" method="post" action="#">
                        <input type="hidden" id="hdnUserIdCont" value="<?=$userProfile[0]->UserID ?>" />
                    <div class="form-group">
                        <label class="col-md-4 col-xs-5 control-label">Phone #</label>
                        <div class="col-md-8 col-xs-7 line-height-30">
                            <input type="text" value="<?=$userProfile[0]->phone ?>" class="form-control" id="phone"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-xs-5 control-label">Twitter</label>
                        <div class="col-md-8 col-xs-7 line-height-30">
                            <input type="text" value="<?=$userProfile[0]->twitter ?>" class="form-control" id="twitter"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-xs-5 control-label">Facebook</label>
                        <div class="col-md-8 col-xs-7">
                            <input type="text" value="<?=$userProfile[0]->facebook ?>" class="form-control" id="facebook"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-xs-5">
                            <button id="btnSaveContact" class="btn btn-primary btn-rounded pull-right">Save</button>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
        </div>

    </div>


</div>
<!-- END PAGE CONTENT WRAPPER -->
        
        <!-- MODALS -->
        <div class="modal animated fadeIn" id="modal_change_photo" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="smallModalHead">Change photo</h4>
                    </div>                    
                    <form id="cp_crop" method="post" action="<?=base_url()?>index.php/administrator/user/cropimage">
                    <div class="modal-body">
                        <div class="text-center" id="cp_target">Use form below to upload file. Only .jpg files.</div>
                        <input type="hidden" name="cp_img_path" id="cp_img_path"/>
                        <input type="hidden" name="ic_x" id="ic_x"/>
                        <input type="hidden" name="ic_y" id="ic_y"/>
                        <input type="hidden" name="ic_w" id="ic_w"/>
                        <input type="hidden" name="ic_h" id="ic_h"/>                        
                    </div>                    
                    </form>
                    <form id="cp_upload" method="post" enctype="multipart/form-data" action="<?=base_url()?>index.php/administrator/user/uploadProfileImage">
                    <div class="modal-body form-horizontal form-group-separated">
                        <div class="form-group">
                            <label class="col-md-4 control-label">New Photo</label>
                            <div class="col-md-4">
                                <input type="file" class="fileinput btn-info" name="file" id="cp_photo" data-filename-placement="inside" title="Select file"/>
                            </div>                            
                        </div>                        
                    </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success disabled" id="cp_accept">Accept</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
              
        <!-- EOF MODALS -->