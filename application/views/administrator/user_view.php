<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>                    
    <li><a href="#">Users</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-user"></span> Users</h2>
</div>
<!-- END PAGE TITLE -->                

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default" id="userPanel">
                <div class="panel-heading">
                    <?php
                        $viewProfile = checkPermission('Profile', 'View', $permission);
                        $addUser = checkPermission('User','Add', $permission);
                        $editUser = checkPermission('User','Edit', $permission);
                        $deleteUser = checkPermission('User','Delete', $permission);
                    ?>
                    <h3 class="panel-title">All Users&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php if($addUser): ?>
                            <button type="button" class="addUser btn btn-info popup" data-toggle="modal" data-target="#modal_User" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Role"><i class="fa fa-user"></i>New User</button>
                        <?php endif; ?>
                        <?php if($deleteUser): ?>
                            <button id="deleteSel" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Selected"><i class="glyphicon glyphicon-remove"></i>Delete</button>
                        <?php endif; ?>
                    </h3>
                    
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="userTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <?php if($deleteUser): ?>
                                        <th><input type="checkbox" class="checkall" /></th>
                                    <?php endif; ?>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th># of Vehicles</th>
                                    <th># of Payment Accounts</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created on</th>
                                    <?php if($editUser == true || $deleteUser == true || $viewProfile == TRUE): ?>
                                        <th>Actions</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->

        </div>
    </div>                                

</div>
<!-- PAGE CONTENT WRAPPER -->

<div class="modal" id="modal_User" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Add New User</h4>
            </div>
            <div class="modal-body">
                <div id="success" class="alert alert-success hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <p></p>
                </div>
                <div id="fail" class="alert alert-warning hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <p></p>
                </div>
                <form id="jvalidate" class="form-horizontal" role="form" action="#" name="frmUser">
                    <input type="hidden" id="hidUserID" value="0"/>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">First Name</label>
                            <div class="col-md-9">                                            
                                <input type="text" class="form-control" name="firstName" id="firstName"/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last Name</label>
                            <div class="col-md-9">                                            
                                <input type="text" class="form-control" name="lastName" id="lastName"/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Username</label>
                            <div class="col-md-9">                                            
                                <input type="text" class="form-control" name="userName" id="userName"/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email</label>
                            <div class="col-md-9">                                            
                                <input type="email" class="form-control" name="email" id="email"/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password</label>
                            <div class="col-md-9">                                            
                                <input type="password" class="form-control" name="password" id="password"/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Role</label>
                            <div class="col-md-9">                                            
                                <select id="role" class="form-control select" name="roleID">
                                    <option value="0">--Select--</option>
                                    <?php foreach($role as $roleSingle): ?>
                                        <option value="<?=$roleSingle->RoleID?>"><?=$roleSingle->name?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Status</label>
                            <div class="col-md-9">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" id="statusEnable" value="1" checked/>Active
                                    </label>
                                    <label>
                                        <input type="radio" name="status" id="statusDisable" value="0"/>Not Active
                                    </label>
                                </div>
                                <span class="help-block">Change the status of the user.</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <input type="reset" id="userReset" class="btn btn-default" value="Clear Form" />
                        <input type="submit" id="userSubmit" class="btn btn-primary pull-right" value="Submit"/>
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
            <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>User</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to remove this user?</p>                    
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
