/**
 * @author Andriy Tolstokorov
 */

var UploaderController;

UploaderController = (function() {
    function UploaderController()
    {}

    UploaderController.prototype.init = function( handler_url, element, uploader_settings, data_to_send )
    {
        new qq.FileUploaderBasic({

            action: handler_url,
            button: document.getElementById( element ),
            multiple: false,
            params: data_to_send,
            maxConnections: 2,
            allowedExtensions: uploader_settings.allowedExtensions,
            // path to server-side upload script
            sizeLimit: uploader_settings.sizeLimit, // max size

            // set to true to output server response to console
            debug: false,

            onSubmit: uploader_settings.onSubmit,
            onProgress: uploader_settings.onProgress,
            onComplete: uploader_settings.onCompelete,

            messages: uploader_messages,
            showMessage: function(message){ alert(message) }
        });
    }

    return UploaderController();
})();

window.UploaderController = UploaderController;

/*
UploadController.prototype = {


    initCatalogImageUploader: function( handler_url, element, uploader_settings, data_to_send )
    {
        uploadController.uploader = new qq.FileUploaderBasic({

            action: handler_url,
            button: document.getElementById( element ),
            multiple: false,
            params: data_to_send,
            maxConnections: 2,
            allowedExtensions: uploader_settings.allowedExtensions,
            // path to server-side upload script
            sizeLimit: uploader_settings.sizeLimit, // max size

            // set to true to output server response to console
            debug: false,

            onSubmit: function(id, file_name){
                // show loader
            },
            onProgress:function (id, file_name, loaded, total) {
                // show indicator
            },
            onComplete: function(id, file_name, response)
            {
                $( '#upload-image-hint').hide();
                $( '#catalog_image').attr( 'src', response.image_src).show();
                $( '#catalog_image-fancy').attr( 'href', response.image_src );
                $( '#image_field').val( response.file_name );

                // hide loader

            },
            onCancel: function(id, file_name){

            },

            messages :
            {
                typeError: "{file} has invalid extension. Only {extensions} are allowed.",
                sizeError: "{file} is too large, maximum file size is {sizeLimit}.",
                minSizeError: "{file} is too small, minimum file size is {minSizeLimit}.",
                emptyError: "{file} is empty, please select files again without it.",
                onLeave: "The files are being uploaded, if you leave now the upload will be cancelled."
            },
            showMessage: function(message){ console.log(message) }
        });
    },

    initGalleryImageUploader: function( handler_url, element, uploader_settings, data_to_send )
    {
        uploadController.uploader = new qq.FileUploaderBasic({

            action: handler_url,
            button: document.getElementById( element ),
            multiple: true,
            params: data_to_send,
            maxConnections: 2,
            allowedExtensions: uploader_settings.allowedExtensions,
            // path to server-side upload script
            sizeLimit: uploader_settings.sizeLimit, // max size

            // set to true to output server response to console
            debug: false,

            onSubmit: function(id, file_name){
                // show loader
            },
            onProgress:function (id, file_name, loaded, total) {
                // show indicator
            },
            onComplete: function(id, file_name, response)
            {
                $( '#gallery' ).append( response.html );
            },
            onCancel: function(id, file_name){

            },

            messages :
            {
                typeError: "{file} has invalid extension. Only {extensions} are allowed.",
                sizeError: "{file} is too large, maximum file size is {sizeLimit}.",
                minSizeError: "{file} is too small, minimum file size is {minSizeLimit}.",
                emptyError: "{file} is empty, please select files again without it.",
                onLeave: "The files are being uploaded, if you leave now the upload will be cancelled."
            },
            showMessage: function(message){ console.log(message) }
        });
    },

    initGalleryUpdateUploader: function( handler_url, element, uploader_settings, data_to_send )
    {
        uploadController.uploader = new qq.FileUploaderBasic({

            action: handler_url,
            button: document.getElementById( element ),
            multiple: false,
            params: data_to_send,
            maxConnections: 2,
            allowedExtensions: uploader_settings.allowedExtensions,
            // path to server-side upload script
            sizeLimit: uploader_settings.sizeLimit, // max size

            // set to true to output server response to console
            debug: false,

            onSubmit: function(id, file_name){
                // show loader
            },
            onProgress:function (id, file_name, loaded, total) {
                // show indicator
            },
            onComplete: function(id, file_name, response)
            {
                $( '#fancy_thumb_' + response.itemId ).attr( 'src', response.thumbSrc ).show();
                $( '#fancy_item_' + response.itemId ).attr( 'href', response.image_src );
                // hide loader

            },
            onCancel: function(id, file_name){

            },

            messages :
            {
                typeError: "{file} has invalid extension. Only {extensions} are allowed.",
                sizeError: "{file} is too large, maximum file size is {sizeLimit}.",
                minSizeError: "{file} is too small, minimum file size is {minSizeLimit}.",
                emptyError: "{file} is empty, please select files again without it.",
                onLeave: "The files are being uploaded, if you leave now the upload will be cancelled."
            },
            showMessage: function(message){ console.log(message) }
        });
    }
};

var uploadController;

$( document ).ready(
    function()
    {
        if ( typeof( uploadController ) != 'object' )
        {
            uploadController = new uploadControllerClass();
        }
    }
);
*/