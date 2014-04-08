<?

class ContactUs extends CWidget
{
	public function init()
	{
		Yii::app()->clientScript->registerPackage('independent-form');
	}

    public function run()
    {
    	$model = new ContactMessageForm();
        $this->render( 'contact_us', [ 'model' => $model ] );
    }
}