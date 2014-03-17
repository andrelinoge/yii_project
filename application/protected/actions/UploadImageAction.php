<?

class UploadImageAction extends BaseCrudAction
{
    /** @var BaseRecord */
    public $model = NULL;

    public function run()
    {
        if ( is_ajax() )
        {
            $model = $this->controller->create_model();
            try
            {
                return $model->upload();
            }
            catch(CException $e)
            {
                failure($e->getMessage());
            }
        }
        else
        {
            throw new CHttpException( 404 );
        }
    }

}