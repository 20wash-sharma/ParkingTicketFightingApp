<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>                    
    <li><a href="#">Plate Types</a></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE TITLE -->
<div class="page-title">                    
    <h2><span class="fa fa-tag"></span> Plate Types</h2>
</div>
<!-- END PAGE TITLE -->                

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

    <div class="row">
        <div class="col-md-12">
            <?php
                $addPlateType = checkPermission('Plate Types', 'Add', $permission);
                $editPlateType = checkPermission('Plate Types','Edit', $permission);
                $deletePlateType = checkPermission('Plate Types','Delete', $permission);
            ?>
            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default" id="plateTypePanel">
                <div class="panel-heading">                                
                    <h3 class="panel-title">All Plate Types&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php if($addPlateType): ?>
                            <button type="button" class="addPlateType btn btn-info popup" data-toggle="modal" data-target="#modal_PlateType" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Plate Type"><i class="fa fa-tag"></i>New Plate Type</button>
                        <?php endif; ?>
                        <?php if($deletePlateType): ?>
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
                        <table id="plateTypeTable" class="table">
                            <thead>
                                <tr>
                                    <?php if($deletePlateType): ?>
                                        <th><input type="checkbox" class="checkall" /></th>
                                    <?php endif; ?>
                                    <th>#</th>
                                    <th>Plate Type</th>
                                    <th>Description</th>
                                    <?php if($editPlateType == TRUE || $deletePlateType == TRUE): ?>                                    
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
            <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Plate Type(s)</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to remove this plate type(s)?</p>                    
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

<div class="modal" id="modal_PlateType" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Add New Plate Type</h4>
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
                    <input type="hidden" id="hidPlateTypeID" value="0"/>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Plate Type</label>
                            <div class="col-md-9">                                            
                                <input type="text" class="form-control" name="plateType" id="plateType"/>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Description</label>
                            <div class="col-md-9">                                            
                                <textarea class="form-control" rows="5" id="description"></textarea>
                                <span class="help-block">Enter code for state.</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <input type="reset" id="plateTypeReset" class="btn btn-default" value="Clear Form" />
                        <input type="submit" id="plateTypeSubmit" class="btn btn-primary pull-right" value="Submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>