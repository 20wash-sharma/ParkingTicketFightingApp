
<?php
        $viewVehicle = checkPermission('Vehicle', 'View', $permission);
        $addVehicle = checkPermission('Vehicle', 'Add', $permission);
        $editVehicle = checkPermission('Vehicle', 'Edit', $permission);
        $deleteVehicle = checkPermission('Vehicle', 'Delete', $permission);
?>
<!-- START BREADCRUMB -->
<input type="hidden" id="hdnUserId" value="<?=$userProfile[0]->UserID?>" />
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">User</a></li>
    <li class="active">User Profile</li>
</ul>
<!-- END BREADCRUMB -->                                                
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-body profile">
                    <div class="profile-image" id="user_image">
                        <?php if($userProfile[0]->profileImage != NULL & $userProfile[0]->UserID != ''): ?>
                            <img id="userProfImage" src="<?=base_url().'/uploads/'.$userProfile[0]->profileImage?>" class="img-thumbnail"/>
                        <?php else: ?>
                            <img id="userProfImage" src="<?php echo admin_asset_url(); ?>assets/images/users/user2.jpg" class="img-thumbnail"/>
                        <?php endif; ?>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name"><?=$userProfile[0]->firstname . ' ' . $userProfile[0]->lastname ?></div>
                    </div>                                    
                </div>    
                <div class="panel-body active">   
                    <a href="#" class="btn btn-info btn-block btn-rounded" data-toggle="modal" data-target="#modal_change_photo">Change Photo</a>
                   

                    </div>
                <div class="panel-body list-group border-bottom">
                    <p class="list-group-item active">Profile</p>
                    <p class="list-group-item">Joined <span class="badge badge-default" style="background: none;color: #000;font-weight: bold;"><?=date("m.d.Y",strtotime($userProfile[0]->creationtime))?></span></p>
                    <p class="list-group-item">Last seen <span class="badge badge-default" style="background: none;color: #000;font-weight: bold;"><?=date("m.d.Y",strtotime($userProfile[0]->lastseen))?></span></p>
                    <p class="list-group-item">Real Name <span class="badge badge-default" style="background: none;color: #000;font-weight: bold;"><?=$userProfile[0]->firstname . ' ' . $userProfile[0]->lastname ?></span></p>
                    <p class="list-group-item">Role <span class="badge badge-default" style="background: none;color: #000;font-weight: bold;"><?=$userProfile[0]->name?></span></p>
                </div>
                <div class="panel-body list-group border-bottom">
                    <p class="list-group-item active"><span class="fa fa-dashboard"></span> Activity</p>
                    <p class="list-group-item"><span class="fa fa fa-ticket"></span> Tickets <span class="badge badge-default">0</span></p>                                
                    <p class="list-group-item"><span class="fa fa-users"></span> Fights <span class="badge badge-default">0</span></p>
                    <p class="list-group-item"><span class="fa fa-folder"></span> Wins <span class="badge badge-default">0</span></p>
                    <p class="list-group-item"><span class="fa fa-save"></span> Fines Saved <span class="badge badge-default">$0</span></p>
                </div>
            </div>                            

        </div>

        <div class="col-md-9">
            <!-- PAGE CONTENT TABBED -->
                <div class="page-tabs">
                     <?php if ($viewVehicle ): ?>
                                                     <a href="#first-tab" class="active">Vehicles</a>
                                                <?php endif; ?>
                   
                    <a href="#second-tab"<?php if(!$viewVehicle) echo ' class="active"';?>>Payment Accounts</a>
                    <a href="#third-tab">Tickets</a>
                    <a href="#fourth-tab">Profile Settings</a>
                </div>
                <?php if ($viewVehicle ): ?>
                                                   
                                               
                <div class="page-content-wrap page-tabs-item active" id="first-tab">
                    <div class="panel-heading">                                
                        <?php if($addVehicle): ?>        
                            <button type="button" class="addVehicle btn btn-info popup" data-toggle="modal" data-target="#modal_Vehicle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Vehicle"><i class="fa fa-plus"></i>Add Vehicle</button>
                        <?php endif; ?>
                        <?php if($deleteVehicle): ?>
                            <button id="deleteSel" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Selected"><i class="glyphicon glyphicon-remove"></i>Delete</button>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <!-- START DEFAULT DATATABLE -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table" id="vehicleData">
                                        <thead>
                                            <tr>
                                                <th>IsExpiry</th>
                                                <?php if($deleteVehicle): ?>
                                                    <th><input type="checkbox" class="checkall" /></th>
                                                <?php endif; ?>
                                                <th>#</th>
                                                <th>Nick Name</th>
<!--                                            <th>License Plate #</th>-->
                                                <th>Make</th>
                                                <th>Plate #</th>
                                                <th>Created On</th>
                                                <th>State</th>
                                                <th>Plate Type</th>
                                                <th>Plate Expiration</th>
                                                <th>Registered Name</th>
                                                <th>Has Ticker</th>
                                                <th>Sticker Expiration</th>
                                                 <?php if ($deleteVehicle || $editVehicle): ?>
                                                    <th>Actions</th>
                                                <?php endif; ?>

                                        </tr>
                                    </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                        </div>
                        <!-- END DEFAULT DATATABLE -->
                    </div>
                
                </div>
                <?php endif; ?>
                <div class="page-content-wrap page-tabs-item <?php if(!$viewVehicle) echo ' active';?>" id="second-tab">
                
                    <div class="row">
                        <!-- START DEFAULT DATATABLE -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Nick Name</th>
                                            <th>Account Type</th>
                                            <th>Account Number</th>
                                            <th>Routing Number</th>
                                            <th>Created On</th>
                                            <th>Expiry Date</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    <?php foreach($userPayment as $singlePayment): ?>
                                        <tr>
                                            <td><?=$count?></td>
                                            <td><?=$singlePayment->nickName?></td>
                                            <td><?=$singlePayment->accounttype?></td>
                                            <td><?=$singlePayment->accountnumber?></td>
                                            <td><?=$singlePayment->routingnumber?></td>
                                            <td><?=date('Y-m-d',strtotime($singlePayment->creationtime))?></td>
                                            <td><?=date('Y-m-d',strtotime($singlePayment->experationdate))?></td>
                                        </tr>
                                    <?php $count++; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                        </div>
                        <!-- END DEFAULT DATATABLE -->
                    </div>
                
                </div>
                <div class="page-content-wrap page-tabs-item" id="third-tab">
                
                    <div class="row">
                        <!-- START DEFAULT DATATABLE -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="ticketTable" class="table">
                                        <thead>
                                            <tr>
                                            <th>Ticket</th>
                                            <th>Date Issued</th>
                                            <th>Status</th>
                                            <th>Code</th>
                                            <th>Fine Amt</th>
                                            <th>Due Date</th>
                                            <th>Payment Plan</th>
                                            <th>Payment Plan Status</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php for($count = 1;$count <=40; $count++):?>
                                    <tr style="cursor: pointer;">
                                            <td><?=$count?></td>
                                            <td>3/07/2015</td>
                                            <td>[Paid]</td>
                                            <td>09-41-070</td>
                                            <td>60</td>
                                            <td>4/07/2015</td>
                                            <td><input type="checkbox" class="icheckbox"/></td>
                                            <td><span class="label label-success">OK</span></td>
                                        </tr>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                        </div>
                        <!-- END DEFAULT DATATABLE -->
                    </div>
                
                </div>
                
                <div class="page-content-wrap page-tabs-item" id="fourth-tab">
                     <div class="col-md-12 ">
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
                         </div>
                    <div class="col-md-8 col-sm-12 col-xs-12">
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
                    <div class="col-md-4">
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
            <!-- END PAGE CONTENT TABBED -->                     

        </div>

    </div>

</div>
<!-- END PAGE CONTENT WRAPPER -->

<div class="modal" id="modal_Vehicle" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Add New Vehicle</h4>
            </div>
            <div class="modal-body">
                <div id="successV" class="alert alert-success hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <p></p>
                </div>
                <div id="failV" class="alert alert-warning hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <p></p>
                </div>
                <form id="jvalidate" class="form-horizontal" role="form" action="#">
                    <input type="hidden" id="hidCUserID" value="<?=$userProfile[0]->UserID?>"/>
                    <input type="hidden" id="hidVehicleID" value="0"/>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nickname</label>
                            <div class="col-md-9">                                            
                                <input type="text" class="form-control" name="nickname" id="nickname"/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Are you the reg owner?</label>
                            <div class="col-md-1">                                            
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="isRegOwner" id="regOwnerYes" value="1"/>Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="isRegOwner" id="regOwnerNo" value="0" checked/>No
                                    </label>
                                </div>
                                <span class="help-block"></span>
                            </div>
                            <label class="col-md-3 control-label">Registered Owner:</label>
                            <div class="col-md-5">                                            
                                <input type="text" class="form-control" name="regOwnerName" id="regOwnerName"/>
                                <span class="help-block">Enter the last name only.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">State</label>
                            <div class="col-md-3">                                            
                                <select id="state" class="form-control select" name="state">
                                    <option value="0">--Select--</option>
                                    <?php foreach($state as $stateSingle): ?>
                                        <option value="<?=$stateSingle->StateID?>"><?=$stateSingle->StateName?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <label class="col-md-3 control-label">Make</label>
                            <div class="col-md-3">                                            
                                <select id="make" class="form-control select" name="make">
                                    <option value="0">--Select--</option>
                                    <?php foreach($makes as $makeSingle): ?>
                                        <option value="<?=$makeSingle->VehiclemakeID?>"><?=$makeSingle->vehiclemake?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Plate #</label>
                            <div class="col-md-3">                                            
                                <input type="text" class="form-control" name="plateNo" id="plateNo"/>
                                <span class="help-block"></span>
                            </div>
                            <label class="col-md-3 control-label">Plate Type</label>
                            <div class="col-md-3">                                            
                                <select id="platetype" class="form-control select" name="platetype">
                                    <option value="0">--Select--</option>
                                    <?php foreach($platetype as $platetypeSingle): ?>
                                        <option value="<?=$platetypeSingle->PlatetypesID?>"><?=$platetypeSingle->platetypesdesc?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Plate Expiry Date</label>
                            <div class="col-md-9">                                            
                                <input type="date" class="form-control  datepickerclassonly" name="expiryDate" id="expiryDate"/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Is City Sticker?</label>
                            <div class="col-md-1">                                            
                                <input type="checkbox" class="form-control checkbox" name="isCitySticker" id="isCitySticker"/>
                                <span class="help-block"></span>
                            </div>
                            <label class="col-md-3 control-label">City Sticker Expiry Date</label>
                            <div class="col-md-5">                                            
                                <input type="date" class="form-control datepickerclassonly" name="cityExpiryDate" id="cityExpiryDate"/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">VIN</label>
                            <div class="col-md-9">                                            
                                <input type="text" class="form-control" name="vin" id="vin"/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <input type="reset" id="userReset" class="btn btn-default" value="Clear Form" />
                        <input type="submit" id="vehicleSubmit" class="btn btn-primary pull-right" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Vehicle</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to remove this Vehicle?</p>                    
                <p>Press Yes if you sure.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <button class="btn btn-success btn-lg mb-control-yes">Yes</button>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MESSAGE BOX-->
 <!-- change password MODALS -->
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
        
              
        <!-- EOF change password MODALS -->
