<?
class FrontendMenu
{
    public static function get($controller, $action = '')
    {
        $menu = array();

        $menu[] = [
            'title' => _( 'Главная' ),
            'activityMarker' => 'site',
            'active' => $controller,
            'url' => url( 'site/index' ),
            'items' => null
        ];

        $menu[] = [
            'title' => _( 'Аккаунт' ),
            'activityMarker' => 'user',
            'active' => $controller,
            'url' => '#',
            'items' => [[
                'title' => _( 'Профайл' ),
                'activityMarker' => 'edit',
                'active' => $controller,
                'url' => url( 'user/edit' ),
            ]]
        ];

        return $menu;
    }

    private function __construct() {}
}