var baseURL = $("#hdnBase").val();
var plateTypeTableAjax;

$(document).ready(function(){
    plateTypeTableAjax = $("#plateTypeTable").DataTable({
        "ajax": baseURL + "index.php/administrator/platetype/all"
    });
    
    $('#plateTypeSubmit').click(function(event){
        event.preventDefault();
        var plateTypeId = $('#hidPlateTypeID').val();
        var plateType = $('#plateType').val();
        var description = $('#description').val();
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/platetype/addedit",
            dataType: 'json',
            data: {plateTypeID: plateTypeId, platetype: plateType, description: description},
            success: function(res){
                if(res){
                    if(res['status'] == 1){
                        $('#success p').html(res['msg']);
                        $('#success').removeClass('hide');
                        $('#hidPlateTypID').val('0');
                        $('#plateType').val('');
                        $('#description').val('');
                        plateTypeTableAjax.ajax.reload();
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

    $('.addPlateType').click(function(){
        $('#defModalHead').html('Add New Plate Type');
        $('#hidPlateTypeID').val('0');
        $('#plateType').val('');
        $('#description').val('');
        $('#success').addClass('hide');
        $('#fail').addClass('hide');
    });

    $('#plateTypeTable').on('click', '.edit',function(){
    //$('.edit').click(function(){
        $('#success').addClass('hide');
        $('#fail').addClass('hide');
        $('#defModalHead').html('Edit Plate Type');
        var plateTypeID = $(this).attr('data-plateTypeID');
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/platetype/single",
            dataType: 'json',
            data: {plateTypeID: plateTypeID},
            success: function(res){
                if(res){
                    var data = res[0];
                    $('#hidPlateTypeID').val(data['PlatetypeID']);
                    $('#plateType').val(data['platetype']);
                    $('#description').val(data['platetypesdesc']);
                } else{

                }
            }
        });
    });
    
    $('#plateTypeTable').on('click','.delete',function(){
    //function delete_row(row, makeId){
        var box = $("#mb-remove-row");
        box.addClass("open");

        var plateTypeId = $(this).attr('data-plateTypeID');
        
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");

            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/platetype/delete",
                dataType: 'json',
                data: {plateTypeID: plateTypeId},
                success: function(res){
                    if(res){
                        if(res['status'] == 1){
                            plateTypeTableAjax.ajax.reload();                   
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
    
    $('#plateTypeTable').on('click', '.checkall',function(){
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
            
            $(plateTypeTableAjax.rows().nodes()).find(':checkbox').each(function () {
                $this = $(this);
                if($this.prop('checked') == true){
                    selected.push($this.val());
                }
            });
            // convert to a string
            var plateTypeIDs = selected.join();
            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/platetype/deleteselected",
                dataType: 'json',
                data: {plateTypeIDs: plateTypeIDs},
                success: function(res){
                    if(res){
                        if(res['status'] == 1){
                            plateTypeTableAjax.ajax.reload();
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
    
    $('#plateTypeTable').on('click', '.checkboxDel',function(){
        $this = $(this);
        if($this.prop('checked') == false){
            $('.checkall').prop('checked',false); 
        }
    });
    
    $('#plateTypeTable tbody tr').hover(function(){
        $(this).css('cursor', 'pointer');
    }, function() {
        $(this).css('cursor', 'auto');
    });
});

function reload(){
    plateTypeTableAjax.ajax.reload();
}