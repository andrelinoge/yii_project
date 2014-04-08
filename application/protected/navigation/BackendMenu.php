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
            'title'          => _( 'Static pages' ),
            'activityMarker' => 'staticPage',
            'items' => [
                [
                    'title'          => _( 'All' ),
                    'url'            => url( 'staticPage/index' ),
                    'activityMarker' => 'index'
                ]
            ]
        ];

        $menuItems[] = [
            'title'          => _( 'Slider' ),
            'activityMarker' => 'Slider',
            'items' => [
                [
                    'title'          => _( 'Все' ),
                    'url'            => url( 'slider/index' ),
                    'activityMarker' => 'index'
                ],
            ]
        ];

        $menuItems[] = [
            'title'          => _( 'Our works' ),
            'activityMarker' => 'WorkGallery',
            'items' => [
                [
                    'title'          => _( 'Все' ),
                    'url'            => url( 'workGallery/index' ),
                    'activityMarker' => 'index'
                ],
            ]
        ];

        $menuItems[] = [
            'title'          => _( 'News' ),
            'activityMarker' => 'news',
            'items' => [
                [
                    'title'          => _( 'All' ),
                    'url'            => url( 'news/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'New' ),
                    'url'            => url( 'news/new' ),
                    'activityMarker' => 'new'
                ]
            ]
        ];

        $menuItems[] = [
            'title'          => _( 'Product categories' ),
            'activityMarker' => 'productCategories',
            'items' => [
                [
                    'title'          => _( 'All' ),
                    'url'            => url( 'productCategories/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'New' ),
                    'url'            => url( 'productCategories/new' ),
                    'activityMarker' => 'new'
                ]
            ]
        ];

        $menuItems[] = [
            'title'          => _( 'Products' ),
            'activityMarker' => 'products',
            'items' => [
                [
                    'title'          => _( 'All' ),
                    'url'            => url( 'products/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'New' ),
                    'url'            => url( 'products/new' ),
                    'activityMarker' => 'new'
                ]
            ]
        ];

        $menuItems[] = [
            'title'          => _( 'Faq' ),
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
            'title'          => _( 'Contact messages' ),
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

        return $menuItems;
    }

    private function __construct() {}
}