<?

class ContactUs extends CWidget
{
    public function run()
    {
    	$model = [];
        $this->render( 'contact_us', [ 'model' => $model ] );
    }
}