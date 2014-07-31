<? if(!empty($this->_params['iframe'])): ?>
<html id="fileuploadajax">
    <head>
        <script type="text/javascript">
            domain      = '<?=DOM_NAME?>';
            path        = '<?=PATH?>';
            currentPath = '<?=CURRENT_PATH?>';
        </script>
        <script src="<?=MOTOR_PATH?>lib/js/jquery-2.0.3.min.js" type="text/javascript"></script>
        <script src="<?=MOTOR_PATH?>lib/js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
        <link href="<?=FILEUPLOADAJAX_PATH?>view/css/basic.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
<? endif; ?>
    
<script src="<?=FILEUPLOADAJAX_PATH?>js/load-image.min.js" type="text/javascript" ></script>
<script src="<?=FILEUPLOADAJAX_PATH?>js/canvas-to-blob.min.js" type="text/javascript" ></script>
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.iframe-transport.js" type="text/javascript" ></script>
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload.js" type="text/javascript" ></script>
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload-process.js" type="text/javascript" ></script>
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload-image.js" type="text/javascript" ></script>
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload-audio.js" type="text/javascript" ></script>
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload-video.js" type="text/javascript" ></script>
<script src="<?=FILEUPLOADAJAX_PATH?>js/jquery.fileupload-validate.js" type="text/javascript" ></script>

<script>
    
function deleteFile(file){
    var fileName = $(file).val();
    var url = '<?=PATH?>fileUploadAjax/<?=$this->_params['action']?>/?mode=ajax&<?=Controller::setHtmlParams($this->_params)?>file='+fileName+'&delete=1';
    $.ajax({
            url: url,
            type: "DELETE",
            dataType: 'json',
            success: function(data) {
                if(data.success)
                {
                    $(file).parent().remove();
                }
            }
    });
}

/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '<?=PATH?>fileUploadAjax/<?=$this->_params['action']?>/?mode=ajax&<?=Controller::setHtmlParams($this->_params)?>&upload=1';
    /*
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true,
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('#files').append(
                    '<div>'+
                        '<div class="name">'+file.name+'</div>'+
                        '<div class="preview" data-ng-switch-when="true">'+
                            '<a data-ng-href="'+file.url+'" title="'+file.name+'" data-gallery="gallery" download="'+file.name+'"><img data-ng-src="'+file.thumbnail_url+'"></a>'+
                        '</div>'+
                        '<div class="preview" data-ng-switch-default data-preview="file"></div>'+
                        '<button class="delete_file" onclick="deleteFile(this)" value="'+file.name+'">'+
                            '<span>Delete</span>'+
                        '</button>'+
                    '</div>'
                )
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .bar').css(
                'width',
                progress + '%'
            );
        }
    });
    */
   
            
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        loadImageMaxFileSize: 15000000, // 15MB
        disableImageResize: false,
        previewMaxWidth: 400,
        previewMaxHeight: 150,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        $('#files').empty();
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<div/>');
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append(file.error);
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        if(typeof callbackDoneFileUploadAjax == 'function') {
            callbackDoneFileUploadAjax(data);
        }
        else {
            console.log('callbackDoneFileUploadAjax() can be called');
        }
        $.each(data.result.files, function (index, file) {
            var link = $('<a>')
                .attr('target', '_blank')
                .prop('href', file.url);
            $(data.context.children()[index])
                .wrap(link);
        });
    }).on('fileuploadfail', function (e, data) {
        if(typeof callbackFailFileUploadAjax == 'function') {
            callbackFailFileUploadAjax(data);
        }
        else {
            console.log('callbackFailFileUploadAjax() can be called');
        }
        $.each(data.result.files, function (index, file) {
            var error = $('<span/>').text(file.error);
            $(data.context.children()[index])
                .append(error);
        });
    });
});
</script>

<span class="btn btn-success fileinput-button">
    <i class="icon-plus icon-white"></i>
    <span>Select file</span>
    <!-- The file input field used as target for the file upload widget -->
    <input id="fileupload" type="file" name="files[]" multiple>
</span>
<br>
<br>
<!-- The global progress bar -->
<div id="progress" class="progress progress-success progress-striped">
    <div class="bar"></div>
</div>
<!-- The container for the uploaded files -->
<div id="files"></div>

<? if(!empty($this->_params['iframe'])): ?>
    </body>
</html>
<? endif; ?>