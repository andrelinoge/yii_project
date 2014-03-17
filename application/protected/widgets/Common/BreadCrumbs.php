<?php
/**
 * @author: Andriy Tolstokorov
 */

class BreadCrumbs extends CWidget
{
    /** @var array with bread crumbs items ( 'title' => Url [optional] ) */
    public $items;
    /** @var string menu template */
    public $view = 'default';
    /** @var string folder with menu templates */
    public $view_folder = 'bread-crumbs';

    public function init()
    {
        if ( !is_array( $this->items ) )
        {
            throw new CException( 'Wrong options format. Look widget php-doc for help.');
        }

        $this->items = array_merge([[ 'name' => 'Dashboard', 'url' => url('site/index') ]], $this->items);   
    }

    public function run()
    {
        $this->render(
            $this->getView(),
            array(
                'items' => $this->items
            )
        );
    }

    protected function getView()
    {
        return $this->view_folder . '/' . $this->view;
    }
}