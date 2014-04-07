<?php
/**
 * @author Andre Linoge
 */

class FrontendController extends ApplicationController
{
    public $page_name = 'Home';

    public function init()
    {
        $this->pageTitle = Yii::app()->name;
        $this->set_layout( 'main' );
        Yii::app()->clientScript->registerPackage( 'frontend' );

        parent::init();
    }

    /**
     * @param string $title
     */
    public function appendTitle( $title )
    {
        $this->pageTitle .= ' - ' . $title;
    }

    /**
     * @param string $keywords
     * @param string $description
     */
    public function setMainMetaTags( $keywords = '', $description = '' )
    {
        /** @var $cs CClientScript */
        Yii::app()
            ->getClientScript()
            ->registerMetaTag( $description, 'description' )
            ->registerMetaTag( $keywords, 'keywords' );
    }


}