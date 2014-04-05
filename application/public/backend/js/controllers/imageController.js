/**
 * @author Andriy Tolstokorov
 */

var ImageController;

ImageController = (function() {
    function ImageController()
    {
    }

    ImageController.prototype.initialize_index_page = function()
    {
        $('div.images').on('click', 'a.delete-image', function(event) {
            event.preventDefault();
            var $this = $(this);

            if (confirm('Delete image?'))
            {
                $.ajax({
                    url: this.href,
                    type: 'get',
                    dataType: 'json',

                    success: function(respose) {

                        if ((typeof(respose.success) != 'undefined') && respose.success)
                        {
                            var $images = $this.parents('div.images');

                            $this.parents('div.thumbnail-block').remove();
                            if ($images.find('div.thumbnail-block').length == 0)
                            {
                                $.fn.yiiListView.update($images.parents('.list-view').attr('id'));
                            }
                        }
                    }
                });
            }
        });
    }

    return ImageController;
})();

window.ImageController = ImageController;