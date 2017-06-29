<?php //var_dump($userData); ?>
<!-- START PAGE SIDEBAR -->
<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="xn-logo">
            <a href="<?php echo base_url(); ?>index.php/administrator/">ATLANT</a>
            <a href="<?php echo base_url(); ?>index.php/administrator/" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <input type="hidden" id="passwordUserId" value="<?=$userData[0]->UserID ?>" />
            <a href="#" class="profile-mini">
                <?php if($userData[0]->profileImage != NULL & $userData[0]->UserID != ''): ?>
                    <?php if(file_exists(base_url().'/uploads/'.$userData[0]->profileImage)): ?>
                        <img id="userProfImage" src="<?=base_url().'/uploads/'.$userData[0]->profileImage?>" class="img-thumbnail"/>
                    <?php else: ?>
                        <img id="userProfImage" src="<?php echo admin_asset_url(); ?>assets/images/users/user2.jpg" class="img-thumbnail"/>
                    <?php endif; ?>
                <?php else: ?>
                    <img id="userProfImage" src="<?php echo admin_asset_url(); ?>assets/images/users/user2.jpg" class="img-thumbnail"/>
                <?php endif; ?>
                
            </a>
            <div class="profile">
                <div class="profile-image">
                    <?php if($userData[0]->profileImage != NULL & $userData[0]->UserID != ''): ?>
                        <a href="<?php echo base_url(); ?>index.php/administrator/user/profile/<?=$userData[0]->username?>">
                           <img id="userProfImage" src="<?=base_url().'/uploads/'.$userData[0]->profileImage?>" class="img-thumbnail"/>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo base_url(); ?>index.php/administrator/user/profile/<?=$userData[0]->username?>">
                            <img id="userProfImage" src="<?php echo admin_asset_url(); ?>assets/images/users/user2.jpg" class="img-thumbnail"/>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name"><?=$userData[0]->firstname . ' ' . $userData[0]->lastname; ?></div>
                </div>
                <!--<div class="profile-controls">
                    <a href="<?php echo base_url(); ?>index.php/administrator/user/profile/<?=$userData[0]->username?>" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="<?php echo base_url(); ?>index.php/administrator/user/editprofile/<?=$userData[0]->username?>" class="profile-control-right"><span class="fa fa-cog"></span></a>
                </div>-->
            </div>                                                                        
        </li>
        <li class="xn-title">Navigation</li>
        <?php if(checkPermission('Accounting','View', $permission)):?>
            <li>
                <a href="#"><span class="fa fa-briefcase"></span> <span class="xn-text"> Accounting Module</span></a>
            </li>
        <?php endif; ?>
        <li class="active">
            <a href="<?php echo base_url(); ?>index.php/administrator/"><span class="fa fa-desktop"></span> <span class="xn-text"> Dashboard</span></a>                        
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-envelope"></span> <span class="xn-text"> Mailbox</span></a>
            <ul>
                <li><a href="<?php echo base_url(); ?>index.php/administrator/inbox"><span class="fa fa-inbox"></span> Inbox</a></li>
                <li><a href="pages-mailbox-message.html"><span class="fa fa-file-text"></span> Message</a></li>
                <li><a href="pages-mailbox-compose.html"><span class="fa fa-pencil"></span> Compose</a></li>
            </ul>
        </li>
        <?php if(checkPermission('Letter Template','View', $permission)):?>
            <li><a href="pages-tasks.html"><span class="fa fa-edit"></span><span class="xn-text"> Manage Letter Templates</span></a></li>
        <?php endif; ?>
        <?php if(checkPermission('Gateway','View', $permission)):?>
            <li><a href="pages-tasks.html"><span class="fa fa-usd"></span><span class="xn-text"> Manage Payment Gateway</span></a></li>
        <?php endif; ?>
        <?php if(checkPermission('User','View', $permission)):?>
            <li><a href="<?php echo base_url(); ?>index.php/administrator/user"><span class="fa fa-user"></span><span class="xn-text"> User Profiles</span></a></li>
        <?php endif; ?>
        <?php if(checkPermission('Tickets', 'View', $permission)): ?>
            <li><a href="<?php echo base_url(); ?>index.php/administrator/tickets"><span class="fa fa-ticket"></span><span class="xn-text"> Tickets</span></a></li>
        <?php endif; ?>
        <?php 
            $viewMake = checkPermission('Vehicle Make','View', $permission);
            $viewRole = checkPermission('Role','View', $permission);
            $viewState = checkPermission('States', 'View', $permission);
            $viewPlateType = checkPermission('Plate Types', 'View', $permission)
        ?>
        <?php if($viewMake == TRUE || $viewRole == TRUE || $viewState == TRUE || $viewPlateType == TRUE): ?>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text"> Other Settings</span></a>
            <ul>
                <?php if($viewMake):?>
                    <li><a href="<?php echo base_url(); ?>index.php/administrator/vehiclemake"><span class="fa fa fa-tag"></span> Vehicle Make</a></li>
                <?php endif; ?>
                <?php if($viewRole):?>
                    <li><a href="<?php echo base_url(); ?>index.php/administrator/role"><span class="fa fa-users"></span><span class="xn-text"> User Roles</span></a></li>
                <?php endif; ?>
                <?php if($viewState):?>
                    <li><a href="<?php echo base_url(); ?>index.php/administrator/state"><span class="fa fa-tag"></span><span class="xn-text"> States</span></a></li>
                <?php endif; ?>
                <?php if($viewPlateType): ?>
                    <li><a href="<?php echo base_url(); ?>index.php/administrator/platetype"><span class="fa fa-tag"></span><span class="xn-text"> Plate Types</span></a></li>
                <?php endif; ?>
            </ul>    
        </li>
        <?php endif; ?>
    </ul>
    <!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->
