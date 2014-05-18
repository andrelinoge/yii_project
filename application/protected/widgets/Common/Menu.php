<?

class Menu extends CWidget
{
    /** @var array with menu */
    public $items;
    /** @var string active menu item */
    public $active;
    /** @var string menu template */
    public $view = 'default';
    /** @var string folder with menu templates */
    public $view_folder = 'menu';

    public function init()
    {
        if ( !is_array( $this->items ) )
        {
            throw new CException( 'Wrong options format. Look widget php-doc for help.');
        }
    }

    public function run()
    {
        $this->render(
            $this->getView(),
            [
                'items' => $this->items,
                'active' => strtolower($this->active)
            ]
        );
    }

    protected function getView()
    {
        return $this->view_folder . '/' . $this->view;
    }
}