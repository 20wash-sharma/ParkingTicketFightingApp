var baseURL = $("#hdnBase").val();
var userTableAjax1;

$(document).ready(function(){
    /*userTableAjax1 = $("#userTable").dataTable({
        "ajax": baseURL + "index.php/administrator/user/alluserjson",
        "aoColumnDefs": [{ 
            "bSortable": false, "aTargets":[0,1,9]}
        ],
        'fnRowCallback' : function(){
             $('#userTable tbody tr td:not(:last-child,:eq(7))').click(function() {
                 var userName = $(this).attr("data-username");
                 //document.location.href = baseURL + "index.php/administrator/user/profile/" + userName;
             })
         },
         'dom': 'RC<"clear">lfrtip',
         'columnDefs': [
            { visible: false, targets: 1 }
        ]
    });*/
    
    userTableAjax1 = $("#userTable").DataTable({
        "ajax": baseURL + "index.php/administrator/user/alluserjson",
//        "aoColumnDefs": [{ 
//            "bSortable": false, "aTargets":[0,1,9]}
//        ]
    });
    
    $('#userTable tbody tr').hover(function(){
        $(this).css('cursor', 'pointer');
    }, function() {
        $(this).css('cursor', 'auto');
    });
    
    $('#deleteSel').click(function(){
        var rows = null;
        var box = $("#mb-remove-row");
        box.addClass("open");
        
        //var roleId = $(this).attr('data-roleID');
        
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");
            
            var selected = new Array();
            
            $(userTableAjax1.rows().nodes()).find(':checkbox').each(function () {
                $this = $(this);
                if($this.prop('checked') == true){
                    selected.push($this.val());
                }
            });
            // convert to a string
            var userIDs = selected.join();
            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/user/deleteselected",
                dataType: 'json',
                data: {userIDs: userIDs},
                success: function(res){
                    if(res){
                        if(res['status'] == 1){
                            userTableAjax1.ajax.reload();
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
    
    $('#userTable').on('click', '.checkall',function(){
        $this = $(this);
        $checkStatus = true;
        if($this.prop('checked') == true){
            $checkStatus = true; 
        } else {
            $checkStatus = false;
        }
        $(userTableAjax1.rows().nodes()).find(':checkbox').each(function () {
            $this = $(this);
            $this.prop('checked',$checkStatus);
        });
    });
    
    $('#userTable').on('click', '.userStatus',function(){
    //$('.userStatus').click(function(event){
        event.preventDefault();
        var statusObj = $(this);
        var userID = $(this).attr('data-userID');
        var userStatus = $(this).attr('data-userStatus');
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/user/changestatus",
            dataType: 'json',
            data: {userID: userID, userStatus: userStatus},
            success: function(res){
                if(res){
                    if(res['status'] == 1){
                        if(userStatus == 0){
                            $(statusObj).removeClass("label-warning");
                            $(statusObj).addClass("label-success");
                            $(statusObj).attr("data-userStatus",1);
                            $(statusObj).html("Active");
                        } else {
                            $(statusObj).addClass("label-warning");
                            $(statusObj).removeClass("label-success");
                            $(statusObj).attr("data-userStatus",0);
                            $(statusObj).html("Not Active");
                        }
                    } else{
                        
                    }
                } else{
                    
                }
            }
        });
    });
    
    $('#userSubmit').click(function(event){
        event.preventDefault();
        var userId = $('#hidUserID').val();
        var firstName = $('#firstName').val();
        var lastName = $('#lastName').val();
        var userName = $('#userName').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var role = $('#role').val();
        var status = 1;
        var statusEnable = $('#statusEnable').is(':checked');
        var statusDisable = $('#statusDisable').is(':checked');
        if(statusEnable)
            status = 1;
        else
            status = 0;
        
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/user/addedit",
            dataType: 'json',
            data: {userID: userId, firstname: firstName, lastname: lastName, username: userName, email: email, password: password, roleID: role, status: status},
            success: function(res){
                if(res){
                    if(res['status'] == 1){
                        $('#success p').html(res['msg']);
                        $('#success').removeClass('hide');
                        $('#hidUserID').val('0');
                        $('#firstName').val('');
                        $('#lastName').val('');
                        $('#userName').val('');
                        $('#email').val('');
                        $('#password').val('');
                        $('#statusEnable').attr('checked', true);
                        $('select[name="roleID"]').find('option[value="0"]').attr("selected",true);
                        $('.select').selectpicker('refresh');
                        userTableAjax1.ajax.reload();
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

    $('.addUser').click(function(){
        $('#defModalHead').html('Add New User');
        $('#hidUserID').val('0');
        $('#firstName').val('');
        $('#lastName').val('');
        $('#userName').val('');
        $('#email').val('');
        $('#password').val('');
        $('#success').addClass('hide');
        $('#fail').addClass('hide');
        $('select[name="roleID"]').find('option[value="0"]').attr("selected",true);
        $('.select').selectpicker('refresh');
        $('#statusEnable').attr('checked', true);
    });

    $('#userTable').on('click', '.edit',function(){
    //$('.edit').click(function(){
        $('#success').addClass('hide');
        $('#fail').addClass('hide');
        $('#defModalHead').html('Edit User');
        var userID = $(this).attr('data-userID');
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/user/single",
            dataType: 'json',
            data: {userID: userID},
            success: function(res){
                if(res){
                    var data = res[0];
                    $('#hidUserID').val(data['UserID']);
                    $('#firstName').val(data['firstname']);
                    $('#lastName').val(data['lastname']);
                    $('#userName').val(data['username']);
                    $('#email').val(data['email']);
                    $('select[name="roleID"]').find('option[value="'+data["Role_roleID"]+'"]').attr("selected",true);
                    $('.select').selectpicker('refresh');
                    if(data['status'] == "1"){
                        $('#statusEnable').prop('checked',true);
                    }else{
                        $('#statusDisable').prop('checked',true);
                    }
                } else{

                }
            }
        });
    });
    
    $('#userTable').on('click', '.checkboxDel',function(){
        $this = $(this);
        if($this.prop('checked') == false){
            $('.checkall').prop('checked',false); 
        }
    });
    
    $('#userTable').on('click','.delete',function(){
        var box = $("#mb-remove-row");
        box.addClass("open");

        var userId = $(this).attr('data-userId');
        
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");

            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/user/delete",
                dataType: 'json',
                data: {userID: userId},
                success: function(res){
                    if(res){
                        if(res['status'] == 1){
                            userTableAjax1.ajax.reload();                   
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
    
});

function delete_row(row, userId){
    var box = $("#mb-remove-row");
    box.addClass("open");

    box.find(".mb-control-yes").on("click",function(){
        box.removeClass("open");

        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/user/delete",
            dataType: 'json',
            data: {userID: userId},
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
    userTableAjax1.ajax.reload();
}