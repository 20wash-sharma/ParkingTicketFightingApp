var baseURL = $("#hdnBase").val();
var stateTableAjax;

$(document).ready(function(){
    stateTableAjax = $("#stateTable").DataTable({
        "ajax": baseURL + "index.php/administrator/state/all"
    });
    
    $('#stateSubmit').click(function(event){
        event.preventDefault();
        var stateId = $('#hidStateID').val();
        var statename = $('#statename').val();
        var stateshortname = $('#stateshortname').val();
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/state/addedit",
            dataType: 'json',
            data: {stateID: stateId, statename: statename, stateshortname: stateshortname},
            success: function(res){
                if(res){
                    if(res['status'] == 1){
                        $('#success p').html(res['msg']);
                        $('#success').removeClass('hide');
                        $('#hidStateID').val('0');
                        $('#statename').val('');
                        $('#stateshortname').val('');
                        stateTableAjax.ajax.reload();
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

    $('.addState').click(function(){
        $('#defModalHead').html('Add New State');
        $('#hidStateID').val('0');
        $('#statename').val('');
        $('#stateshortname').val('');
        $('#success').addClass('hide');
        $('#fail').addClass('hide');
    });

    $('#stateTable').on('click', '.edit',function(){
    //$('.edit').click(function(){
        $('#success').addClass('hide');
        $('#fail').addClass('hide');
        $('#defModalHead').html('Edit State');
        var stateID = $(this).attr('data-stateID');
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/state/single",
            dataType: 'json',
            data: {stateID: stateID},
            success: function(res){
                if(res){
                    var data = res[0];
                    $('#hidStateID').val(data['StateID']);
                    $('#statename').val(data['StateName']);
                    $('#stateshortname').val(data['StateShortName']);
                } else{

                }
            }
        });
    });
    
    $('#stateTable').on('click','.delete',function(){
    //function delete_row(row, makeId){
        var box = $("#mb-remove-row");
        box.addClass("open");

        var stateId = $(this).attr('data-stateID');
        
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");

            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/state/delete",
                dataType: 'json',
                data: {stateID: stateId},
                success: function(res){
                    if(res){
                        if(res['status'] == 1){
                            stateTableAjax.ajax.reload();                   
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
    
    $('#stateTable').on('click', '.checkall',function(){
        $this = $(this);
        $checkStatus = true;
        if($this.prop('checked') == true){
            $checkStatus = true; 
        } else {
            $checkStatus = false;
        }
        $(stateTableAjax.rows().nodes()).find(':checkbox').each(function () {
            $this = $(this);
            $this.prop('checked',$checkStatus);
        });
    });
    
    $('#deleteSel').click(function(){
        var rows = null;
        var box = $("#mb-remove-row");
        box.addClass("open");
        
        //var roleId = $(this).attr('data-roleID');
        
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");
            
            var selected = new Array();
            
            $(stateTableAjax.rows().nodes()).find(':checkbox').each(function () {
                $this = $(this);
                if($this.prop('checked') == true){
                    selected.push($this.val());
                }
            });
            // convert to a string
            var stateIDs = selected.join();
            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/state/deleteselected",
                dataType: 'json',
                data: {stateIDs: stateIDs},
                success: function(res){
                    if(res){
                        if(res['status'] == 1){
                            stateTableAjax.ajax.reload();
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
    
    $('#stateTable').on('click', '.checkboxDel',function(){
        $this = $(this);
        if($this.prop('checked') == false){
            $('.checkall').prop('checked',false); 
        }
    });
    
    $('#stateTable tbody tr').hover(function(){
        $(this).css('cursor', 'pointer');
    }, function() {
        $(this).css('cursor', 'auto');
    });
});

function reload(){
    stateTableAjax.ajax.reload();
}