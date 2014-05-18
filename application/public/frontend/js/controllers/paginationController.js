var PaginationController;

PaginationController = (function() {

    function PaginationController()
    {
    }

    PaginationController.prototype.initialize_gallery_pager = function()
    {
        $('.show-more-pager').on('click', function(event) {
            event.preventDefault();
            var $this = $(this);

            $.ajax({
                url: $this.attr('href'),
                data: { page: $this.data('page') },
                dataType: 'json',
                method: 'get',

                success: function(response, status, xhr)
                {
                    if (response.success == true)
                    {
                        if (response.next_page != false)
                        {
                            $this.data('page', response.next_page);
                        }
                        else
                        {
                            $this.parents('div.load-more-btn').addClass('hide');
                        }

                        $($this.data('container')).append(response.content);
                    }
                }
            });
        });
    };

    return PaginationController;

})();

window.PaginationController = PaginationController;
