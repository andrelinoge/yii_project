/**
 * @author Andriy Tolstokorov
 */

var UploaderController;

UploaderController = (function() {
    function UploaderController()
    {}

    UploaderController.prototype.initialize = function( handler_url, element_id, uploader_settings, data_to_send )
    {
        uploader_settings.action = handler_url;
        uploader_settings.button = document.getElementById( element_id );
        uploader_settings.debug = false;
        uploader_settings.showMessage = function(message){ console.log(message) }
        uploader_settings.maxConnections = 2;
        uploader_settings.multiple = true;
        uploader_settings.params = data_to_send;

        new qq.FileUploaderBasic(uploader_settings);
    }

    return UploaderController;
})();

window.UploaderController = UploaderController;