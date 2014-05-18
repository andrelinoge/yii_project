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
                    'url'            => url( 'slider/index'),
                    'activityMarker' => 'index'
                ],
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Static pages' ),
            'activityMarker' => 'StaticPage',
            'items' => [
                [
                    'title'          => _( 'Все' ),
                    'url'            => url( 'staticPage/index'),
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
            'title' => _( 'Sizer request' ),
            'activityMarker' => 'sizerRequest',
            'items' => [
                [
                    'title'          => _( 'All' ),
                    'url'            => url( 'sizerRequest/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'Read' ),
                    'url'            => url( 'sizerRequest/read' ),
                    'activityMarker' => 'read'
                ],
                [
                    'title'          => _( 'Unread' ),
                    'url'            => url( 'sizerRequest/unread' ),
                    'activityMarker' => 'unread'
                ]
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Gallery categories' ),
            'activityMarker' => 'galleryCategories',
            'items' => [
                [
                    'title'          => _( 'All' ),
                    'url'            => url( 'galleryCategories/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'New' ),
                    'url'            => url( 'galleryCategories/new' ),
                    'activityMarker' => 'new'
                ]
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Our works' ),
            'activityMarker' => 'WorkGallery',
            'items' => [
                [
                    'title'          => _( 'Все' ),
                    'url'            => url( 'workGallery/index'),
                    'activityMarker' => 'index'
                ],
            ]
        ];

        $menuItems[] = [
            'title'          => _( 'Settings' ),
            'url'            => url('settings/edit'),
            'activityMarker' => ''
        ];

        $menuItems[] = [
            'title'          => _( 'Перейти до сайту' ),
            'url'            => Yii::app()->getBaseUrl(true),
            'activityMarker' => ''
        ];

        return $menuItems;
    }

    private function __construct() {}
}