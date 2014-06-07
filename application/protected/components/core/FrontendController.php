<?php
/**
 * @author Andre Linoge
 */

class FrontendController extends ApplicationController
{
    public $site_settings;
    public $page_name = 'Головна';
    public $breadcumbs = [];

    public function init()
    {
        $this->pageTitle = Yii::app()->name;
        $this->set_layout( 'main' );

        $assets = $this->get_behavioral_url();
        Yii::app()->clientScript->registerPackage('form');

        $this->site_settings = SiteSettings::get();

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