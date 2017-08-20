/**
 * 上传文件
 */
$(function() {
    $("#file_upload").uploadify({
        'swf'             : SCOPE.upload_swf,
        'uploader'        : SCOPE.upload_image,
        'buttonText'       :"上传图片",
        'fileTypeDesc' : 'Image file',
        'fileObjName' :'file',
        'fileTypeExts':'.gif; *.jpg; *.png',
        'multi' : false,
        'onUploadSuccess' : function(file, data, response) {
            if (response){
                var obj = JSON.parse(data);
                if (obj.status == 1 ){
                    $("#upload_image_show").attr('src',obj.data);
                    $("input[name=licence_logo]").val(obj.data);
                }
            }
        },
        'onUploadError' : function(file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
        }
    });
    $("#file_upload_other").uploadify({
        'swf'             : SCOPE.upload_swf,
        'uploader'        : SCOPE.upload_image,
        'buttonText'       :"上传图片",
        'fileTypeDesc' : 'Image file',
        'fileObjName' :'file',
        'fileTypeExts':'.gif; *.jpg; *.png',
        'multi' : false,
        'onUploadSuccess' : function(file, data, response) {
            if (response){
                var obj = JSON.parse(data);
                if (obj.status == 1 ){
                    $("#upload_image_show_other").attr('src',obj.data);
                    $("input[name=licence_logo]").val(obj.data);
                }
            }
        },
        'onUploadError' : function(file, errorCode, errorMsg, errorString) {
            alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
        }
    });
});