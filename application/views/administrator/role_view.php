<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>                    
    <li><a href="#">Roles</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-users"></span> Roles</h2>
</div>
<!-- END PAGE TITLE -->                

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default" id="rolePanel">
                <div class="panel-heading">                                
                    <h3 class="panel-title">All Roles&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php if(checkPermission('Role','Add', $permission)): ?>
                            <button type="button" class="addRole btn btn-info popup" data-toggle="modal" data-target="#modal_basic" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Role"><i class="fa fa-users"></i>New Role</button>
                        <?php endif; ?>
                        <?php if(checkPermission('Role','Delete', $permission)): ?>
                            <button id="deleteSel" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Selected"><i class="glyphicon glyphicon-remove"></i>Delete</button>
                        <?php endif; ?>
                    </h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                            $editRole = checkPermission('Role','Edit', $permission);
                            $deleteRole = checkPermission('Role','Delete', $permission);
                            $viewPermission = checkPermission('Permission','View', $permission);
                        ?>
                        <table id="roleTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <?php if(checkPermission('Role','Delete', $permission)): ?>
                                        <th><input type="checkbox" class="checkall" /></th>
                                    <?php endif; ?>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Level</th>
                                    <th>Created On</th>
                                    <?php if($editRole == true || $deleteRole == true || $viewPermission == true): ?>
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

<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Role(s)</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to remove this role(s)?</p>                    
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

<div class="modal" id="modal_basic" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Add New Role</h4>
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
                <form id="jvalidate" class="form-horizontal" role="form" action="#">
                    <input type="hidden" id="hidRoleID" value="0"/>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name</label>
                            <div class="col-md-9">                                            
                                <input type="text" class="form-control" name="role" id="role"/>
                                <span class="help-block">Required, max size = 15</span>
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
                                <span class="help-block">Change the status of the role.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Level</label>
                            <div class="col-md-9">                                            
                                <input type="text" class="form-control spinner_default" name="level" id="level"/>
                                <span class="help-block">Level is the rank of the role.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Description</label>
                            <div class="col-md-9">                                            
                                <textarea class="form-control" rows="5" id="description"></textarea>
                                <span class="help-block">Enter the description of the role.</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <input type="reset" id="roleReset" class="btn btn-default" value="Clear Form" />
                        <input type="submit" id="roleSubmit" class="btn btn-primary pull-right" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal_permission" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Role Permission</h4>
            </div>
            <div class="modal-body">
                <div id="successP" class="alert alert-success hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <p></p>
                </div>
                <div id="failP" class="alert alert-warning hide" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <p></p>
                </div>
                <form id="permissionForm" class="form-horizontal" role="form" action="#">
                    <input type="hidden" id="hidRoleIDP" value="0"/>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Modules</th>
                                    <th>View</th>
                                    <th>Add</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="permissionTable">
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer">
                        <input type="reset" id="permissionReset" class="btn btn-default" value="Clear Form" />
                        <input type="submit" id="permissionSubmit" class="btn btn-primary pull-right" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>