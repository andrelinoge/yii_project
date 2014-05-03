<?
class FrontendMenu
{
    public static function get($controller, $action = '')
    {
        $menu = array();

        $menu[] = [
            'title'          => _( 'Home' ),
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
                'url'            => url( 'category/index' ),
                'items'          => $subitems
            ];
        }

        $menu[] = [
            'title'          => _( 'Our works' ),
            'activityMarker' => '#',
            'active'         => $controller,
            'url'            => url('gallery/index')
        ];

        $menu[] = [
            'title'          => _( 'Contact us' ),
            'activityMarker' => '#',
            'active'         => $controller,
            'url'            => url('contacts/new')
        ];

        return $menu;
    }

    private function __construct() {}
}