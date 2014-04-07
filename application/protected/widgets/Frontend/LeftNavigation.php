<?

class LeftNavigation extends CWidget
{
    public function run()
    {
    	$menu = [];
        $this->render( 'left_navigation', [ 'menu' => $menu ] );
    }
}