<?

class BackendController extends ApplicationController
{
    /** @var string Url for redirect in CRUD methods */
    protected $_redirectUrl = NULL;

    public function init()
    {
        $this->pageTitle=Yii::app()->name . '-' . 'Dashboard';
        $this->set_layout( 'backend' );
        parent::init();
    }

}