var ApplicationController;

ApplicationController = (function() {
    var $document = $(document);

    function ApplicationController()
    {
        this.initialize_active_classes();
        this.initialize_ajax_pagination();
        this.initialize_ajax_forms();
        this.initialize_plugins();
    }

    ApplicationController.prototype.initialize_active_classes = function()
    {

    };

    ApplicationController.prototype.initialize_ajax_pagination = function()
    {
        $document.on('click', '.ajax-pagination', function(event){
            event.preventDefault();
            event.stopPropagation();

            $(this).parents('.pagination-content').load(this.href, { 'request_for': 'pagination' }, function(response, status, xhr){
                $(this).trigger({
                    type: 'ajax:success',
                    xhr: xhr,
                    response: response
                });
            });
        });
    };

    ApplicationController.prototype.initialize_ajax_forms = function(selector, call_back)
    {
        var _this = this;

        $document.on('submit', 'form.ajax-form', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var $form = $(this);
            var method = $form.attr('method');
            method = ( method != undefined && method != '' ) ? method : 'POST';

            $form.ajaxSubmit({
                url         : $form.attr('action'),
                dataType    : 'json',
                cache       : false,
                type        : method,

                beforeSubmit: function(arr, $form, options) {
                    _this.remove_form_errors($form);
                    _this.show_loader($form);
                },

                error: function(xhr, status, error) {
                    _this.hide_loader($form);
                    $form.trigger({
                        type: 'ajax:error',
                        xhr: xhr,
                        error: error,
                        status: status
                    });
                },

                success: function(response, status, xhr) {
                    _this.hide_loader($form);

                    // show Error Message if it is setted
                    if( (typeof(response.error_message) != 'undefined') && (response.error_message != null && response.error_message != '') )
                    {
                        _this.show_error_message( response.error_message );
                    }

                    // show Success Message if it is setted
                    if( (typeof(response.success_message) != 'undefined') && (response.success_message != null &&  response.success_message != '') )
                    {
                        _this.show_success_message( response.success_message );
                    }

                    // show Errors from form validation action if it is setted
                    if( (typeof(response.errors) != 'undefined') && (response.errors != '') )
                    {
                        _this.show_form_errors( response.errors, $form );
                    }

                    // redirect if url is setted
                    if( (typeof(response.redirect) != 'undefined') && (response.redirect != '') )
                    {
                        window.location.href = response.redirect;
                    }

                    // reload if necessary
                    if( (typeof(response['reload']) != 'undefined') && (response['reload'] != '') )
                    {
                        window.location.reload();
                    }

                    $form.trigger({
                        type: 'ajax:success',
                        xhr: xhr,
                        response: response
                    });
                }
            });
        });
    };

    ApplicationController.prototype.show_loader = function(selector)
    {
        if (!jQuery( selector ).length)
        {
            return false;
        }

        var $selector = jQuery( selector );

        $selector.addClass( 'loader-transparent' );

        var loader = $selector.find('.loader-wrapper');
        var loaderHtml = '<div class="loader-wrapper" style="display: none;"><div class="loader"></div></div>';

        if( !jQuery(loader).size() )
        {
            loader = $selector.prepend( loaderHtml ).find( '.loader-wrapper' );
        }

        var height = $selector.height() + $selector.css('padding-top').replace('px','')*1 + $selector.css('padding-bottom').replace('px','')*1;
        var width = $selector.width() + $selector.css('padding-left').replace('px','')*1 + $selector.css('padding-right').replace('px','')*1;

        loader.height( height );
        loader.width( width );
        loader.css( 'margin-top', '-' + $selector.css('padding-top') );
        loader.css( 'margin-left', '-' + $selector.css('padding-left') );
        loader.find('.loader').css('margin-top', (height-11)/2);
        loader.show();

        return loader;
    };

    ApplicationController.prototype.hide_loader = function(selector)
    {
        var $selector = $( selector );
        $selector.removeClass('loader-transparent');
        var $loader = $selector.find('.loader-wrapper');
        $loader.remove();
    };

    ApplicationController.prototype.show_error_message = function(message)
    {
        alert(message);
    };

    ApplicationController.prototype.show_success_message = function(message)
    {
        alert(message);
    };

    ApplicationController.prototype.show_form_errors = function(errors, $form)
    {
        var form_name = $form.attr('name');

        $.each( errors, function( field_name, error_message ) {

            var $input = $form.find( '#' + form_name + '_' + field_name );
            var $errorContainer = $form.find('#'+form_name + '_' + field_name + '_error' );

            if (!$form.hasClass('highlight-only'))
            {
                if( !$errorContainer[0])
                { 
                    $('<div class="error-message" id="' + form_name + '_' + field_name + '_error">' + error_message + '</div>')
                        .insertAfter( $input )
                        .show( 0 );
                } 
                else 
                {
                    $errorContainer.html( error_message.toString() ).show( 0 );
                }
            }
            
            $input.addClass( 'error' );
        });
    };

    ApplicationController.prototype.remove_form_errors = function($form)
    {
        $form.find( '.error-message' ).html('').hide();
        $form.find( '.error' ).removeClass( 'error' );
    };

    ApplicationController.prototype.initialize_plugins = function()
    {
    };

    return ApplicationController;

})();

window.ApplicationController = ApplicationController;
