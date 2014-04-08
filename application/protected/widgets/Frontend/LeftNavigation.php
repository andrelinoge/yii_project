<?

class LeftNavigation extends CWidget
{
    public function run()
    {
        $this->render( 'left_navigation', [ 'menu' => ProductCategory::model()->get_urls_list() ] );
    }
}