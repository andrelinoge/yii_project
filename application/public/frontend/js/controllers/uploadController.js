var UploaderController;

UploaderController = (function() {
    function UploaderController()
    {}

    UploaderController.prototype.user_photo = function()
    {
        new qq.FileUploaderBasic({

            action: '/user/uploadPhoto',
            button: document.getElementById( 'photo_uploader' ),
            multiple: false,
            maxConnections: 2,
            allowedExtensions: [ 'jpg', 'png', 'jpeg' ],
            sizeLimit: 20000000,

            debug: false,

            onSubmit: function(id, file_name)
            {
                // show loader
            },

            onProgress:function (id, file_name, loaded, total) {
                // show indicator
            },

            onComplete: function(id, file_name, response)
            {
                $( '#thumbnail' ).attr( 'src', response.image_src).show();
                $( '#user_photo' ).val( response.file_name );
                // hide loader

            },

            onCancel: function(id, file_name){
                // do something
            },

            showMessage: function(message)
            {
                $.jGrowl(
                    message,
                    {
                        sticky: true,
                        theme: 'danger'
                    }
                );
            }
        });
    }

    return UploaderController;
})();

window.UploaderController = UploaderController;
