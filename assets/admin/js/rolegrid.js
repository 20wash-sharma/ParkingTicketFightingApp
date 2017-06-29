var baseURL = $("#hdnBase").val();
var roleTableAjax;
var checkID;

$(document).ready(function(){
    $( ".spinner_default" ).spinner({
      spin: function( event, ui ) {
        if ( ui.value > 20 ) {
          $( this ).spinner( "value", 1 );
          return false;
        } else if ( ui.value < 1 ) {
          $( this ).spinner( "value", 20 );
          return false;
        }
      }
    });
    
    roleTableAjax = $("#roleTable").DataTable({
        "ajax": baseURL + "index.php/administrator/role/allrolejson",
        /*"aoColumnDefs": [{ 
            "bSortable": false, "aTargets":[0,1]}
        ]*/
    });
    
    $.fn.serializeObject = function()
    {
       var o = {};
       var a = this.serializeArray();
       $.each(a, function() {
           if (o[this.name]) {
               if (!o[this.name].push) {
                   o[this.name] = [o[this.name]];
               }
               o[this.name].push(this.value || '');
           } else {
               o[this.name] = this.value || '';
           }
       });
       return o;
    };
    
    $('#deleteSel').click(function(){
        var rows = null;
        var box = $("#mb-remove-row");
        box.addClass("open");
        
        //var roleId = $(this).attr('data-roleID');
        
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");
            
            var selected = new Array();
            
            $(roleTableAjax.rows().nodes()).find(':checkbox').each(function () {
                $this = $(this);
                if($this.prop('checked') == true){
                    selected.push($this.val());
                }
            });
            // convert to a string
            var rolesIDs = selected.join();
            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/role/deleteselected",
                dataType: 'json',
                data: {roleIDs: rolesIDs},
                success: function(res){
                    if(res){
                        if(res['status'] == 1){
                            roleTableAjax.ajax.reload();
                            //$(".panel-refresh").trigger("click");
                        } else{
                            alert(res['msg']);
                        }
                    } else{
                        alert('There was some problem. Please try again later.');
                    }
                }
            });
            
        });
    });
    
    $('#roleSubmit').click(function(event){
        event.preventDefault();
        var roleId = $('#hidRoleID').val();
        var role = $('#role').val();
        var level = $('#level').val();
        var status = 1;
        var statusEnable = $('#statusEnable').is(':checked');
        var statusDisable = $('#statusDisable').is(':checked');
        var description = $('#description').val();
        if(statusEnable)
            status = 1;
        else
            status = 0;

        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/role/addedit",
            dataType: 'json',
            data: {roleID: roleId, role: role, status: status, level: level, description: description},
            success: function(res){
                if(res){
                    if(res['status'] == 1){
                        $('#success p').html(res['msg']);
                        $('#success').removeClass('hide');
                        $('#hidRoleID').val('0');
                        $('#role').val('');
                        $('#statusEnable').attr('checked', true);
                        $('#description').val('');
                        $('#level').val(1);
                        roleTableAjax.ajax.reload();
                        //$(".panel-refresh").trigger("click");
                    } else{
                        $('#fail p').html(res['msg']);
                        $('#fail').removeClass('hide');
                    }
                } else{
                    $('#fail p').html('There was some problem. Please try again later.');
                    $('#fail').removeClass('hide');
                }
            }
        });
    });

    $('.addRole').click(function(){
        $('#defModalHead').html('Add New Role');
        $('#hidRoleID').val('0');
        $('#role').val('');
        $('#statusEnable').prop('checked',true)
        $('#description').val('');
        $('#success').addClass('hide');
        $('#fail').addClass('hide');
        $('#level').val(1);
    });
    
    $('#roleTable').on('click', '.checkall',function(){
        $this = $(this);
        $checkStatus = true;
        if($this.prop('checked') == true){
            $checkStatus = true; 
        } else {
            $checkStatus = false;
        }
        $(roleTableAjax.rows().nodes()).find(':checkbox').each(function () {
            $this = $(this);
            $this.prop('checked',$checkStatus);
        });
    });
    
    $('#roleTable').on('click', '.checkboxDel',function(){
        $this = $(this);
        if($this.prop('checked') == false){
            $('.checkall').prop('checked',false); 
        }
    });
    
    $('#roleTable').on('click','.delete',function(){
        var box = $("#mb-remove-row");
        box.addClass("open");
        
        var roleId = $(this).attr('data-roleID');
        
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");

            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/role/delete",
                dataType: 'json',
                data: {roleID: roleId},
                success: function(res){
                    if(res){
                        if(res['status'] == 1){
                            roleTableAjax.ajax.reload();
                        } else{
                            alert(res['msg']);
                        }
                    } else{
                        alert('There was some problem. Please try again later.');
                    }
                }
            });
        });
    });

    $('#roleTable').on('click','.edit',function(){
    //$('.edit').click(function(){
        $('#success').addClass('hide');
        $('#fail').addClass('hide');
        $('#defModalHead').html('Edit Role');
        var roleID = $(this).attr('data-roleID');
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/role/single",
            dataType: 'json',
            data: {roleID: roleID},
            success: function(res){
                if(res){
                    var data = res[0];
                    $('#hidRoleID').val(data['RoleID']);
                    $('#role').val(data['name']);
                    if(data['RoleStatus'] == "1"){
                        $('#statusEnable').prop('checked',true);
                    }else{
                        $('#statusDisable').prop('checked',true);
                    }
                    $('#level').val(data['level']);
                    $('#description').val(data['description']);
                } else{

                }
            }
        });
    });
    
    $('#roleTable').on('click','.permission',function(){
    //$('.permission').click(function(){
        $('#successP').addClass('hide');
        $('#failP').addClass('hide');
        var roleID = $(this).attr('data-roleID');
        $('#hidRoleIDP').val(roleID);
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/permission/all",
            dataType: 'json',
            data: {roleID: roleID},
            success: function(res){
                if(res){
                    var count = 1;
                    var PermissionGroupID = 0;
                    var html = '';
                    var data = res.data;
                    var edit = res['edit'];
                    for(var i=0;i<data.length;i++)
                    {
                        var table = data[i];
                        if(PermissionGroupID != table['PermissionGroupID']){
                            if(PermissionGroupID != 0)
                                html += '</tr>';
                            html += '<tr>';
                            html += '<td>' + count + '</td>';
                            html += '<td>' + table['GroupName'] + '</td>';
                            count++;
                        }
                        if(table['isAssign'] == 1){
                            html += '<td>' + '<input ' + edit + ' class="icheckbox" type="checkbox" name="action" value="' + table['PermissionID'] + '" checked/>' + '</td>';
                        } else {
                            html += '<td>' + '<input ' + edit + ' class="icheckbox" type="checkbox" name="action" value="' + table['PermissionID'] + '" />' + '</td>';
                        }
                        PermissionGroupID = table['PermissionGroupID'];
                    }
                    html += '</tr>';
                    $('#permissionTable').html(html);
                }
            }
        });
    });
    
    
    
    $('#permissionSubmit').click(function(event){
        event.preventDefault();
        var roleId = $('#hidRoleIDP').val();
        var formData = $('#permissionForm').serializeObject();
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/permission/addedit",
            dataType: 'json',
            data: {roleID: roleId, formData: formData},
            success: function(res){
                if(res){
                    if(res['status'] == 1){
                        $('#successP p').html(res['msg']);
                        $('#successP').removeClass('hide');
                    } else{
                        $('#failP p').html(res['msg']);
                        $('#failP').removeClass('hide');
                    }
                } else{
                    $('#failP p').html('There was some problem. Please try again later.');
                    $('#failP').removeClass('hide');
                }
            }
        });
    });
    
});

function delete_row(row, roleId){
    var box = $("#mb-remove-row");
    box.addClass("open");

    box.find(".mb-control-yes").on("click",function(){
        box.removeClass("open");

        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/role/delete",
            dataType: 'json',
            data: {roleID: roleId},
            success: function(res){
                if(res){
                    if(res['status'] == 1){
                        $("#"+row).hide("slow",function(){
                            $(this).remove();
                        });                   
                    } else{
                        alert(res['msg']);
                    }
                } else{
                    alert('There was some problem. Please try again later.');
                }
            }
        });
    });
}

function reload(){
    roleTableAjax.ajax.reload();
}