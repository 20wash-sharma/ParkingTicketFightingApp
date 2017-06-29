/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var baseURL = $("#hdnBase").val();
$(document).ready(function(){
$('#btnChangePassword').click(function(event){
       $('#successpassword').addClass('hide');
       $('#failpassword').addClass('hide');
        event.preventDefault();
        var oldPassword = $('#oldPassword').val();
        var newPassword = $('#newPassword').val();
        var reNewPassword = $('#reNewPassword').val();
        var userID = $('#passwordUserId').val();
        
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
                        $('#successpassword p').html(res['msg']);
                        $('#successpassword').removeClass('hide');
                        $('#oldPassword').val();
                        $('#newPassword').val();
                        $('#reNewPassword').val();
                    }
                    else {
            $('#failpassword p').html(res['msg']);
            $('#failpassword').removeClass('hide');
        }
                }
            });
        } else {
            $('#failpassword p').html(errorMsg);
            $('#failpassword').removeClass('hide');
        }
    }); 
    });
