<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class ApplicationController extends CController
{
    public $baseUrl = NULL;
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = [];

    public $breadcrumbs = [];

    /** @var  CModel */
    protected $_model;

    public function __construct($id,$module)
    {
        parent::__construct($id,$module);

        // set current lang from cookie
        if(isset(Yii::app()->request->cookies['language']))
        {
            Yii::app()->setLanguage(Yii::app()->request->cookies['language']->value);
        }
    }

    /**
     * Initialize base components, register frequently used packages, etc.
     */
    public function init()
    {
        Yii::app()->clientScript->registerPackage( 'applicationEndController' );
    }

    /**
     * Set current layout
     * @param $layout
     */
    public function set_layout( $layout )
    {
        $this->layout = '/../layouts/' . $layout;
    }

    /**
     * Returns base url depending on current behavior
     * @return string
     */
    public function get_behavioral_url()
    {
        return assets_folder() . '/'. Yii::app()->getEndName();
    }

    /*          COMMON ACTIONS      */
    public function actionChangeLocale( $locale )
    {
        if ( !in_array( $locale, Yii::app()->params->availableLocalesInShortForm )) {
            $locale = Yii::app()->params->defaultLocale;
        }

        $expirePeriod = 60 * 60 * 24 * 365; // 1 year

        $cookie = new CHttpCookie('language', $locale );
        $cookie->expire = time() + $expirePeriod;

        Yii::app()->request->cookies['language'] = $cookie;

        $this->redirect( Yii::app()->getRequest()->getUrlReferrer() );
    }
}