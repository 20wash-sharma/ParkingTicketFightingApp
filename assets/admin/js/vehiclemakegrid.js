var baseURL = $("#hdnBase").val();
var vehicleMakeTableAjax;

$(document).ready(function(){
    vehicleMakeTableAjax = $("#vehicleMakeTable").DataTable({
        "ajax": baseURL + "index.php/administrator/vehiclemake/all"
    });
    
    $('#makeSubmit').click(function(event){
        event.preventDefault();
        var makeId = $('#hidMakeID').val();
        var make = $('#vechicleMake').val();
        var description = $('#description').val();
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/vehiclemake/addedit",
            dataType: 'json',
            data: {makeID: makeId, make: make, description: description},
            success: function(res){
                if(res){
                    if(res['status'] == 1){
                        $('#success p').html(res['msg']);
                        $('#success').removeClass('hide');
                        $('#hidMakeID').val('0');
                        $('#vechicleMake').val('');
                        $('#description').val('');
                        vehicleMakeTableAjax.ajax.reload();
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

    $('.addVechicleMake').click(function(){
        $('#defModalHead').html('Add New Make');
        $('#hidMakeID').val('0');
        $('#vechicleMake').val('');
        $('#description').val('');
        $('#success').addClass('hide');
        $('#fail').addClass('hide');
    });

    $('#vehicleMakeTable').on('click', '.edit',function(){
    //$('.edit').click(function(){
        $('#success').addClass('hide');
        $('#fail').addClass('hide');
        $('#defModalHead').html('Edit Vehicle Make');
        var makeID = $(this).attr('data-makeID');
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/vehiclemake/single",
            dataType: 'json',
            data: {makeID: makeID},
            success: function(res){
                if(res){
                    var data = res[0];
                    $('#hidMakeID   ').val(data['VehiclemakeID']);
                    $('#vechicleMake').val(data['vehiclemake']);
                    $('#description').val(data['description']);
                } else{

                }
            }
        });
    });
    
    $('#vehicleMakeTable').on('click','.delete',function(){
    //function delete_row(row, makeId){
        var box = $("#mb-remove-row");
        box.addClass("open");

        var makeId = $(this).attr('data-makeID');
        
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");

            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/vehiclemake/delete",
                dataType: 'json',
                data: {makeID: makeId},
                success: function(res){
                    if(res){
                        if(res['status'] == 1){
                            vehicleMakeTableAjax.ajax.reload();                   
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
    
    $('#vehicleMakeTable').on('click', '.checkall',function(){
        $this = $(this);
        $checkStatus = true;
        if($this.prop('checked') == true){
            $checkStatus = true; 
        } else {
            $checkStatus = false;
        }
        $(vehicleMakeTableAjax.rows().nodes()).find(':checkbox').each(function () {
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
            
            $(vehicleMakeTableAjax.rows().nodes()).find(':checkbox').each(function () {
                $this = $(this);
                if($this.prop('checked') == true){
                    selected.push($this.val());
                }
            });
            // convert to a string
            var makeIDs = selected.join();
            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/vehiclemake/deleteselected",
                dataType: 'json',
                data: {makeIDs: makeIDs},
                success: function(res){
                    if(res){
                        if(res['status'] == 1){
                            vehicleMakeTableAjax.ajax.reload();
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
    
    $('#vehicleMakeTable').on('click', '.checkboxDel',function(){
        $this = $(this);
        if($this.prop('checked') == false){
            $('.checkall').prop('checked',false); 
        }
    });
    
    $('#vehicleMakeTable tbody tr').hover(function(){
        $(this).css('cursor', 'pointer');
    }, function() {
        $(this).css('cursor', 'auto');
    });
});

function reload(){
    vehicleMakeTableAjax.ajax.reload();
}