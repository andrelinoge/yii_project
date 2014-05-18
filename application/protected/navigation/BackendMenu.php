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
            'title'          => _( 'Головна' ) ,
            'url'            => url( 'site/index' ),
            'activityMarker' => 'site'
        ];

        $menuItems[] = [
            'title' => _( 'Слайдер' ),
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
            'title' => _( 'Статичні сторінки' ),
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
            'title' => _( 'Статті' ),
            'activityMarker' => 'articles',
            'items' => [
                [
                    'title'          => _( 'Все' ),
                    'url'            => url( 'articles/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'Додати' ),
                    'url'            => url( 'articles/new' ),
                    'activityMarker' => 'new'
                ]
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Категорії статей' ),
            'activityMarker' => 'articleCategories',
            'items' => [
                [
                    'title'          => _( 'Все' ),
                    'url'            => url( 'articleCategories/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'Додати' ),
                    'url'            => url( 'articleCategories/new' ),
                    'activityMarker' => 'new'
                ]
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Контактні повідомлення' ),
            'activityMarker' => 'messages',
            'items' => [
                [
                    'title'          => _( 'Все' ),
                    'url'            => url( 'messages/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'Прочитані' ),
                    'url'            => url( 'messages/read' ),
                    'activityMarker' => 'read'
                ],
                [
                    'title'          => _( 'Непрочитані' ),
                    'url'            => url( 'messages/unread' ),
                    'activityMarker' => 'unread'
                ]
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Виклик замірника' ),
            'activityMarker' => 'sizerRequest',
            'items' => [
                [
                    'title'          => _( 'Все' ),
                    'url'            => url( 'sizerRequest/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'Прочитані' ),
                    'url'            => url( 'sizerRequest/read' ),
                    'activityMarker' => 'read'
                ],
                [
                    'title'          => _( 'Непрочитані' ),
                    'url'            => url( 'sizerRequest/unread' ),
                    'activityMarker' => 'unread'
                ]
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Категорії галереї' ),
            'activityMarker' => 'galleryCategories',
            'items' => [
                [
                    'title'          => _( 'Все' ),
                    'url'            => url( 'galleryCategories/index' ),
                    'activityMarker' => 'index'
                ],
                [
                    'title'          => _( 'Додати' ),
                    'url'            => url( 'galleryCategories/new' ),
                    'activityMarker' => 'new'
                ]
            ]
        ];

        $menuItems[] = [
            'title' => _( 'Галерея' ),
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
            'title'          => _( 'Налаштування' ),
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