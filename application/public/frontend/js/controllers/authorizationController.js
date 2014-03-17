var AuthorizationController;

AuthorizationController = (function() {

    function AuthorizationController()
    {}

    AuthorizationController.prototype.initialize_vk = function(selector, callback_url, app_id, redirect_url)
    {
        var _this = this;
        $(selector).click(function(event){
            event.preventDefault();
            event.stopPropagation();

            var uri_regex = new RegExp(callback_url);
            var authorization_frame = _this.vk_popup({
                width: 620,
                height: 370,
                url: 'http://oauth.vkontakte.ru/authorize?client_id=' + app_id + '&display=popup&redirect_uri=' + callback_url
            });

            var authorization_process_observer = setInterval(function () {
                try {
                    if (uri_regex.test(authorization_frame.location)) {
                        clearInterval(authorization_process_observer);

                        setTimeout(function () {
                            authorization_frame.close();
                            document.location = redirect_url;
                        }, 500);
                    }
                } catch (e) {
                    // do something
                }
            }, 100);

            return false;
        });
    };

    AuthorizationController.prototype.vk_popup = function(popup_options)
    {
        var
            screenX = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
            screenY = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
            outerWidth = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.body.clientWidth,
            outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
            width = popup_options.width,
            height = popup_options.height,
            left = parseInt(screenX + ((outerWidth - width) / 2), 10),
            top = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
            options = 'width=' + width +
                ',height=' + height +
                ',left=' + left +
                ',top=' + top;

        return window.open(popup_options.url, 'vk_oauth', options);
    };

    AuthorizationController.prototype.initialize_fb = function(selector, callback_url, app_id)
    {
        var e = document.createElement('script');
        e.async = true;
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);

        var _this = this;

        window.fbAsyncInit = function() {
            FB.init(
                {
                    appId:  app_id,
                    cookie: false,
                    xfbml: true,
                    oauth: true,
                    display:'popup'
                }
            );
        };

        $(selector).click(function(event) {
            event.preventDefault();
            event.stopPropagation();

            FB.login(
                function(response) {
                    if (response.status === "connected")
                    {
                        $.ajax({
                            url: callback_url,
                            dataType    : 'json',
                            data: {
                                user_id: response.authResponse.userID,
                                access_token: response.authResponse.accessToken
                            },
                            success: function(response, status, xhr) {

                                if( (typeof(response.error_message) != 'undefined') && (response.error_message != '') )
                                {
                                    _this.show_error_message( response.error_message );
                                }

                                if( (typeof(response.success_message) != 'undefined') && (response.success_message != '') )
                                {
                                    _this.show_success_message( response.success_message );
                                }

                                if( (typeof(response.errors) != 'undefined') && (response.errors != '') )
                                {
                                    _this.show_form_errors( response.errors, $form );
                                }

                                if( (typeof(response.redirect) != 'undefined') && (response.redirect != '') )
                                {
                                    window.location.href = response.redirect;
                                }

                                if( (typeof(response['reload']) != 'undefined') && (response['reload'] != '') )
                                {
                                    window.location.reload();
                                }
                            }
                        });
                    }
                },
                {
                    scope: 'email, user_photos'
                }
            );
        });
    };

    AuthorizationController.prototype.initialize_twitter = function(callback_url, redirect_ur)
    {
        $('#twitter_login').click(function(){
            $.oauthpopup({
                path: callback_url,
                callback: function() {
                    window.location = redirect_ur;
                }
            });
        });
    }

    return AuthorizationController;

})();

window.AuthorizationController = AuthorizationController;
