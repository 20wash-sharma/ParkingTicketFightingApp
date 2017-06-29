var baseURL = $("#hdnBase").val();

$(function(){
    
    function onSuccess(){
        $("#cp_photo").parent("a").find("span").html("Choose another photo");
        
        var img = $("#cp_target").find("#crop_image")
        
        if(img.length === 1){            
            $("#cp_img_path").val(img.attr("src"));
            
            img.cropper({aspectRatio: 1,
                        done: function(data) {
                            $("#ic_x").val(data.x);
                            $("#ic_y").val(data.y);
                            $("#ic_h").val(data.height);
                            $("#ic_w").val(data.width);
                        }
            });
            
            $("#cp_accept").prop("disabled",false).removeClass("disabled");
            
            $("#cp_accept").on("click",function(){                
                $("#user_image").html('<img src="' + baseURL + '/img/loaders/default.gif"/>');
                $("#modal_change_photo").modal("hide");
                
                $("#cp_crop").ajaxForm({target: '#user_image',success: setImage}).submit();
                $("#cp_target").html("Use form below to upload file. Only .jpg files.");
                $("#cp_photo").val("").parent("a").find("span").html("Select file");
                $("#cp_accept").prop("disabled",true).addClass("disabled");
                $("#cp_img_path").val("");
            });           
        }
    }
    
    function setImage(){
        var userID = $('#hdnUserId').val();
        var img = $('#user_image>img').attr('src');
        //$('#userProfImage').attr('src',img);
        jQuery.ajax({
            type: "POST",
            url: baseURL + "index.php/administrator/user/updateprofileimage",
            dataType: 'json',
            data: {userID: userID, profileImg:img},
            success: function(res){
                if(res['status'] == 1){
                    //$('#successP p').html(res['msg']);
                    //$('#successP').removeClass('hide');
                }
                else{
                    //$('#failP p').html(res['msg']);
                    //$('#failP').removeClass('hide');
                }
            }
        });
    }
    
    $('#img-thumbnail').on('change', function () {
        alert($('#userProfImage').attr('src'));
    });
    
    $("#cp_photo").on("change",function(){
        
        if($("#cp_photo").val() == '') return false;
        
        $("#cp_target").html('<img src="' + baseURL + '/img/loaders/default.gif"/>');        
        $("#cp_upload").ajaxForm({target: '#cp_target',success: onSuccess}).submit();        
    });
    
});      