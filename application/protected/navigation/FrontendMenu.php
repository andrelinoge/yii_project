<?
class FrontendMenu
{
    public static function get($controller, $action = '')
    {
        $menu = array();

        $menu[] = [
            'title'          => _( 'Головна' ),
            'activityMarker' => '#',
            'active'         => $controller,
            'url'            => url( 'site/index' ),
            'items'          => null
        ];

        foreach (ArticleCategory::model()->findAll() as $category) 
        {
            $subitems = [];

            foreach (Article::model()->by_category($category)->findAll() as $article) 
            {
                $subitems[] = [
                    'title'          => $article->title,
                    'activityMarker' => '#',
                    'active'         => '#',
                    'url'            => $article->get_url()
                ];
            }

            $menu[] = [
                'title'          => $category->title,
                'activityMarker' => '#',
                'active'         => $controller,
                'url'            => $category->get_url(),
                'items'          => $subitems
            ];
        }

        $menu[] = [
            'title'          => _( 'Галерея' ),
            'activityMarker' => '#',
            'active'         => $controller,
            'url'            => url('gallery/index')
        ];

        $menu[] = [
            'title'          => _( 'Напишіть нам' ),
            'activityMarker' => '#',
            'active'         => $controller,
            'url'            => url('contactUs/new')
        ];

        return $menu;
    }

    private function __construct() {}
}