<?
class BackendMenu
{
    /**
     * Returns array for generation menu items
     * @return array
     */
    public static function get()
    {
        $menuItems = [];
        $menuItems[] = [
            'title'          => _( 'Home' ) ,
            'url'            => url( 'site/index' ),
            'activityMarker' => 'site'
        ];

        $menuItems[] = [
            'title' => _( 'Slider' ),
            'activityMarker' => 'Slider',
            'items' => [
                [
                    'title'          => _( 'Все' ),
                    'url'            => url( 'slider/index', ['type' => 'Slide'] ),
                    'activityMarker' => 'index'
                ],
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Articles' ),
            'activityMarker' => 'articles',
            'items' => [
                [
                    'title'          => _( 'All' ),
                    'url'            => url( 'articles/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'New' ),
                    'url'            => url( 'articles/new' ),
                    'activityMarker' => 'new'
                ]
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Article categories' ),
            'activityMarker' => 'articleCategories',
            'items' => [
                [
                    'title'          => _( 'All' ),
                    'url'            => url( 'articleCategories/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'New' ),
                    'url'            => url( 'articleCategories/new' ),
                    'activityMarker' => 'new'
                ]
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Faq' ),
            'activityMarker' => 'faqs',
            'items' => [
                [
                    'title'          => _( 'All' ),
                    'url'            => url( 'faqs/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'New' ),
                    'url'            => url( 'faqs/new' ),
                    'activityMarker' => 'new'
                ]
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Contact messages' ),
            'activityMarker' => 'messages',
            'items' => [
                [
                    'title'          => _( 'All' ),
                    'url'            => url( 'messages/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'Read' ),
                    'url'            => url( 'messages/read' ),
                    'activityMarker' => 'read'
                ],
                [
                    'title'          => _( 'Unread' ),
                    'url'            => url( 'messages/unread' ),
                    'activityMarker' => 'unread'
                ]
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Our works' ),
            'activityMarker' => 'WorkGallery',
            'items' => [
                [
                    'title'          => _( 'Все' ),
                    'url'            => url( 'workGallery/index', ['type' => 'WorkGallery'] ),
                    'activityMarker' => 'index'
                ],
            ]
        ];

        return $menuItems;
    }

    private function __construct() {}
}