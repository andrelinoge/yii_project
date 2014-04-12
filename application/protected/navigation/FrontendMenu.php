<?
class FrontendMenu
{
    public static function get()
    {
        $menu = array();

        $menu[] = [
            'title'          => 'Головна',
            'activityMarker' => 'site',
            'url'            => url( 'site/index' ),
            'items'          => null
        ];

        $menu[] = [
            'title'          => 'Наші роботи',
            'activityMarker' => 'ourWorks',
            'url'            => url('gallery/index'),
            'items'          => null
        ];

        $menu[] = [
            'title'          => 'Новини',
            'activityMarker' => 'news',
            'url'            => url('news/index'),
            'items'          => null
        ];

        $menu[] = [
            'title'          => 'Часті питання',
            'activityMarker' => 'faq',
            'url'            => url('faq/index'),
            'items'          => null
        ];

        $menu[] = [
            'title'          => 'Контакти',
            'activityMarker' => 'contactUs',
            'url'            => url('contactUs/new'),
            'items'          => null
        ];

        $menu[] = [
            'title'          => 'Каталог для друку',
            'activityMarker' => 'print',
            'url'            => url('print/index'),
            'items'          => null
        ];

        return $menu;
    }

    private function __construct() {}
}