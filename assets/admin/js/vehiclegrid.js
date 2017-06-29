var baseURL = $("#hdnBase").val();
var vehicleTableAjax;
var userID = $('#hdnUserId').val();

$(document).ready(function(){
    $('#deleteSel').click(function(){
        var rows = null;
        var box = $("#mb-remove-row");
        box.addClass("open");
            
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");
            
            var selected = new Array();
            
            $(vehicleTableAjax.rows().nodes()).find(':checkbox').each(function () {
                $this = $(this);
                if($this.prop('checked') == true){
                    selected.push($this.val());
                }
            });
            // convert to a string
            var vehicleIDs = selected.join();
            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/vehicle/deleteselected",
                dataType: 'json',
                data: {vehicleIDs: vehicleIDs},
                success: function(res){
                    if(res){
                        if(res['status'] == 1){
                            vehicleTableAjax.ajax.reload();
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
    
    
    
   $('#vehicleData').on('click', '.checkall',function(){
        $this = $(this);
        $checkStatus = true;
        if($this.prop('checked') == true){
            $checkStatus = true; 
        } else {
            $checkStatus = false;
        }
        $(vehicleTableAjax.rows().nodes()).find(':checkbox').each(function () {
            $this = $(this);
            $this.prop('checked',$checkStatus);
        });
    });
    $('.datepickerclassonly').datepicker({format: 'yyyy-mm-dd'});
    
    vehicleTableAjax = $("#vehicleData").DataTable({
        "ajax": baseURL + "index.php/administrator/vehicle/all/" + userID,
        "dom": 'RC<"clear">lfrtip',
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
        ],
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) 
        {
            if ( aData[0] == "1" )
            {
                $('td', nRow).addClass('alert-warning');
                //$('td', nRow).css('background-color','red');
            }
            else if ( aData[0] == "2" )
            {
                $('td', nRow).addClass('alert-danger');
                //$('td', nRow).css('background-color','yellow');
            }
        }
    });
    
    $('.addVehicle').click(function(){
         if($("input[name = 'isRegOwner']:checked").val()==0)
     {
       
       
       $("#regOwnerName").removeAttr("disabled");
     }
     else {
          $("#regOwnerName").attr("disabled",'disabled');   
       $('#regOwnerName').val('');
       
     }
 
 if($("input[name = 'isCitySticker']:checked").length > 0)
     {
          
        $("#cityExpiryDate").removeAttr("disabled"); 
        //$("#cityExpiryDate").addClass("datepickerclassonly");
                      
     }
     else {
        $('#cityExpiryDate').val('');
         $("#cityExpiryDate").attr("disabled",'disabled');
         
        
         //$("#cityExpiryDate").removeClass("datepickerclassonly");
                      
     }

        $('#defModalHead').html('Add New Vehicle');
        /*$('#hidUserID').val('0');
        $('#firstName').val('');
        $('#lastName').val('');
        $('#userName').val('');
        $('#email').val('');
        $('#password').val('');
        $('#success').addClass('hide');
        $('#fail').addClass('hide');
        $('select[name="roleID"]').find('option[value="0"]').attr("selected",true);
        $('.select').selectpicker('refresh');
        $('#statusEnable').attr('checked', true);*/
    });
    
    $('#vehicleSubmit').click(function(event){
        event.preventDefault();
        var userId = $('#hidCUserID').val();
        var vehicleID = $('#hidVehicleID').val();
        var isRegOwner = 0;
        var nickname = $('#nickname').val();
        if($('#regOwnerYes').is(':checked'))
            isRegOwner = 1;
        var regOwnerName = $('#regOwnerName').val();
        var state = $('#state').val();
        var make = $('#make').val();
        var plateno = $('#plateNo').val();
        var platetype = $('#platetype').val();
        var expiryDate = $('#expiryDate').val();
        var isCitySticker = 0;
        if($('#isCitySticker').prop('checked'))
            isCitySticker = 1;
        else 
            isCitySticker = 0;
            
        var cityStickerExpiry = $('#cityExpiryDate').val();
        var vin = $('#vin').val();
        
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/vehicle/addedit",
            dataType: 'json',
            data: {userID: userId, vehicleID: vehicleID, nickname: nickname, isRegOwner: isRegOwner, registeredOwner: regOwnerName, stateid: state, makeid: make, plateno:plateno, platetype: platetype, plateexpiry: expiryDate, isCitySticker: isCitySticker, stickerExpiry: cityStickerExpiry,vin: vin},
            success: function(res){
                // $('#hidVehicleID').val('0');
                if(res){
                    if(res['status'] == 1){
                        $('#hidVehicleID').val('0');
                        $('#nickname').val('');
                        $('#regOwnerNo').prop('checked',true);
                        $('#regOwnerName').val('');
                        $('#state').val(0);
                        $('#make').val(0);
                        $('#plateNo').val('');
                        $('#platetype').val(0);
                        $('#expiryDate').val('');
                        $('#isCitySticker').prop('checked',false);
                        $('#cityExpiryDate').val('');
                        $('#vin').val('');
                        vehicleTableAjax.ajax.reload();
                        $('#successV p').html(res['msg']);
                        $('#successV').removeClass('hide');
                    } else{
                        $('#failV p').html(res['msg']);
                        $('#failV').removeClass('hide');
                    }
                } else{
                    $('#failV p').html('There was some problem. Please try again later.');
                    $('#fail').removeClass('hide');
                }
                setTimeout(function(){ $('#failV').addClass('hide');$('#successV').addClass('hide'); }, 5000);
            }
        });
    });
     $("input[name = 'isRegOwner']").click(function() {
     if($("input[name = 'isRegOwner']:checked").val()==0)
     {
       
        $("#regOwnerName").removeAttr("disabled"); 
     }
     else {
       $("#regOwnerName").attr("disabled",'disabled');   
       $('#regOwnerName').val('');
     }

});
 
$("#isCitySticker").click(function() {
     if($("input[name = 'isCitySticker']:checked").length > 0)
     {
          
        $("#cityExpiryDate").removeAttr("disabled"); 
        //$("#cityExpiryDate").addClass("datepickerclassonly");
                      
     }
     else {
        $('#cityExpiryDate').val('');
         $("#cityExpiryDate").attr("disabled",'disabled');
         
        
         //$("#cityExpiryDate").removeClass("datepickerclassonly");
                      
     }

});

$('#vehicleData').on('click','.delete',function(){
        var box = $("#mb-remove-row");
        box.addClass("open");

        var vehicleId = $(this).attr('data-vehicleid');
        
        box.find(".mb-control-yes").on("click",function(){
            box.removeClass("open");

            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/vehicle/delete",
                dataType: 'json',
                data: {vehicleId: vehicleId},
                success: function(res){
                    if(res){
                        if(res['status'] == 1){
                            vehicleTableAjax.ajax.reload();                   
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
    
    $('#vehicleData').on('click', '.edit',function(){
    //$('.edit').click(function(){
       
        $('#failV').addClass('hide');$('#successV').addClass('hide');
        $('#defModalHead').html('Edit Vehicle');
        var vechileID = $(this).attr('data-vehicleid');
        
        $('#hidVehicleID').val(vechileID);
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/vehicle/single",
            dataType: 'json',
            data: {vechileID: vechileID},
            success: function(res){
                 console.log(res);
                if(res){
                    
                    var data = res[0];
                    $('select[name="state"]').find('option[value="'+data["state_StateID"]+'"]').attr("selected",true);
                     // $('.select').selectpicker('refresh');
                    $('select[name="make"]').find('option[value="'+data["vehicleMake_vehicleMake"]+'"]').attr("selected",true);
                  //$('.select').selectpicker('refresh');
                    $('select[name="platetype"]').find('option[value="'+data["plateTypes_plateTypesID"]+'"]').attr("selected",true);
                
                    
                    
                    $('.select').selectpicker('refresh');
                
                    $('#nickname').val(data['nickName']);
                    if(data['registeredname'])
                    {
                     
                      $('#regOwnerName').val(data['registeredname']);
                       $('input[name="isRegOwner"][value="0"]').prop('checked', true);
                       $("#regOwnerName").removeAttr("disabled");
                    }
                    else 
                    {
                     $('input[name="isRegOwner"][value="1"]').prop('checked', true);  
                     $("#regOwnerName").attr("disabled",'disabled');
                    }
                         
                    $('#plateNo').val(data['platenumber']);
                    $('#expiryDate').val(data['plateexperation'].split(' ')[0]);
                    if(data['hasSticker']==1){
                      $('#isCitySticker').prop('checked', true); 
                       $('#cityExpiryDate').val(data['stickerExperation'].split(" ")[0]);
                        $("#cityExpiryDate").removeAttr('disabled'); 
                         //$("#cityExpiryDate").addClass("datepickerclassonly");
                      
                    }
                    else {
                       $("#cityExpiryDate").attr("disabled",'disabled'); 
                       
                       // $("#cityExpiryDate").removeClass("datepickerclassonly");
                    }
                   
                    $('#vin').val(data['VIN']);
                  
                } else{

                }
            }
        });
    });
});