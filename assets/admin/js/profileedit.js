var baseURL = $("#hdnBase").val();

$(document).ready(function(){
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
    
    
    
    /*$('input[type="checkbox"][name="alertStatus"]').iCheck('check', function(){
        alert('Well done, Sir');
    });*/
    
    $('input[type="checkbox"][name="alertStatus"]').on('ifUnchecked', function(event){
        //$('select[name="alertType"]').find('option[value="0"]').attr("selected",true);
        $(this).parent().parent().parent().next('div').children('select[name="alertType"]').find('option[value="0"]').attr("selected",true);
        $('.select').selectpicker('refresh');
    });
    
    $('select[name="alertType"]').on('change', function(){
        var selected = $(this).find("option:selected").val();
        if(selected == 0){
            //$(this).parent().prev('label').children('label').children('div').children('input[type="checkbox"][name="alertStatus"]').attr('checked', false);
            $(this).parent().prev('label').children('label').children('div').children('input[type="checkbox"][name="alertStatus"]').iCheck('uncheck');
        } else {
            //$(this).parent().prev('label').children('label').children('div').children('input[type="checkbox"][name="alertStatus"]').attr('checked', true);
            $(this).parent().prev('label').children('label').children('div').children('input[type="checkbox"][name="alertStatus"]').iCheck('check');
            var alertType = $(this).val();
            
            if(alertType == 'twitter'){
                if($('#twitter').val() == ''){
                    $(this).parent().parent().addClass('alert-warning');
                } else{
                    $(this).parent().parent().removeClass('alert-warning');
                }
            } else if(alertType == 'facebook'){
                if($('#facebook').val() == ''){
                    $(this).parent().parent().addClass('alert-warning');
                } else{
                    $(this).parent().parent().removeClass('alert-warning');
                }
            } else if(alertType == 'text'){
                if($('#phone').val() == ''){
                    $(this).parent().parent().addClass('alert-warning');
                } else{
                    $(this).parent().parent().removeClass('alert-warning');
                }
            }
        }
    });
    
    $('#btnSaveAlert').click(function(event){
        event.preventDefault();
        var userID = $('#hdnUserId').val();
        var total = $('.alertRows').length;
        var formElementStatus = new Array();
        var formElementStatusChk = new Array();
        $('.alertChk').each(function(index,value){
            formElementStatus[index] = $(this).val();
            if($(this).prop('checked') == true){
                formElementStatusChk[index] = 1;
            } else {
                formElementStatusChk[index] = 0;
            }
        });
        var formElementSel = new Array();
        $('select.alertSel').each(function(index,value){
            var alertType = $(this).val();
            
            if(alertType == 'twitter'){
                if($('#twitter').val() == ''){
                    $(this).parent().parent().addClass('alert-warning');
                } else{
                    $(this).parent().parent().removeClass('alert-warning');
                }
            } else if(alertType == 'facebook'){
                if($('#facebook').val() == ''){
                    $(this).parent().parent().addClass('alert-warning');
                } else{
                    $(this).parent().parent().removeClass('alert-warning');
                }
            } else if(alertType == 'text'){
                if($('#phone').val() == ''){
                    $(this).parent().parent().addClass('alert-warning');
                } else{
                    $(this).parent().parent().removeClass('alert-warning');
                }
            }
            formElementSel[index] = alertType;
        });
        
        var formData = $('#changeAlert').serializeObject();
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/alerts/updatepreference",
            dataType: 'json',
            data: {userID: userID, formElementStatus: formElementStatus,formElementStatusChk: formElementStatusChk, formElementSel: formElementSel},
            success: function(res){
                if(res['status'] == 1){
                    $('#successA p').html(res['msg']);
                    $('#successA').removeClass('hide');
                }
                else{
                    $('#failA p').html(res['msg']);
                    $('#failA').removeClass('hide');
                }
            }
        });
    });
    
    $('#btnSaveProfile').click(function(event){
        event.preventDefault();
        var firstName = $('#firstName').val();
        var lastName = $('#lastName').val();
        var email = $('#email').val();
        var userID = $('#hdnUserID').val();
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/user/updateprofile",
            dataType: 'json',
            data: {userID: userID, firstName: firstName, lastName: lastName, email:email},
            success: function(res){
                if(res['status'] == 1){
                    $('#successP p').html(res['msg']);
                    $('#successP').removeClass('hide');
                }
                else{
                    $('#failP p').html(res['msg']);
                    $('#failP').removeClass('hide');
                }
            }
        });
    });
    
    $('#btnSaveContact').click(function(event){
        event.preventDefault();
        var phone = $('#phone').val();
        var twitter = $('#twitter').val();
        var facebook = $('#facebook').val();
        var userID = $('#hdnUserIdCont').val();
        
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/user/updatecontact",
            dataType: 'json',
            data: {userID: userID, phone: phone, facebook: facebook, twitter:twitter},
            success: function(res){
                if(res['status'] == 1){
                    $('#successContact p').html(res['msg']);
                    $('#successContact').removeClass('hide');
                }
                else{
                    $('#failContact p').html(res['msg']);
                    $('#failContact').removeClass('hide');
                }
            }
        });
    });
    
    $('.successAC').click(function(){
        event.preventDefault();
        $('#successA p').html('');
        $('#successA').addClass('hide');
        $('#failA p').html('');
        $('#failA').addClass('hide');
    });
    
   $('#btnChangePassword').click(function(event){
       $('#success').addClass('hide');
       $('#fail').addClass('hide');
        event.preventDefault();
        var oldPassword = $('#oldPassword').val();
        var newPassword = $('#newPassword').val();
        var reNewPassword = $('#reNewPassword').val();
        var userID = $('#hdnUserId').val();
        
        var isError = 0;
        var errorMsg = '';
        if(oldPassword == null || oldPassword == ''){
            isError = 1;
            errorMsg += 'Please enter old password.<br/>';
        }
        if(newPassword == null || newPassword == ''){
            isError = 1;
            errorMsg += 'Please enter new password.<br/>';
        }
        if(reNewPassword == null || reNewPassword == ''){
            isError = 1;
            errorMsg += 'Please re enter new password.<br/>';
        }
        if(newPassword != null && reNewPassword != null){
            if(newPassword != reNewPassword){
                isError = 1;
                errorMsg += 'New password and re-entered password do not match.';
            }
        }
        if(isError == 0){
            jQuery.ajax({
                type: "POST",
                url: baseURL + "index.php/administrator/user/changepassword",
                dataType: 'json',
                data: {userID: userID, oldpassword: oldPassword, newpassword: newPassword},
                success: function(res){
                    if(res['status'] == 1){
                        $('#success p').html(res['msg']);
                        $('#success').removeClass('hide');
                        $('#oldPassword').val();
                        $('#newPassword').val();
                        $('#reNewPassword').val();
                    }
                }
            });
        } else {
            $('#fail p').html(errorMsg);
            $('#fail').removeClass('hide');
        }
    }); 
});