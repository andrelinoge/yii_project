<?
Yii::import('application.actions.crud.BaseCrudAction');

class UploadImageAction extends BaseCrudAction
{
    /** @var BaseRecord */
    public $model = null;
    public $upload_and_save = false;
    public $ajax_view = null;

    public function run()
    {
        if ( is_ajax() )
        {
            $model = $this->controller->create_model();
            try
            {
                if ($this->upload_and_save)
                {
                    $response = $model->upload_to_temp_folder();
                    $model->save();

                    $response['id'] = $model->id;

                    if (!empty($this->ajax_view))
                    {
                        $partial = $this->getController()->renderPartial($this->ajax_view, ['data' => $model], true);
                        success('', ['html' => $partial]);
                    }
                    else
                    {
                        success('', $response);
                    }
                }
                else
                {
                    $reponse = $model->upload_to_temp_folder();
                    if ($this->ajax_view)
                    {
                        $this->renderPartial($this->ajax_view, ['response' => $reponse]);
                    }
                    else
                    {
                        success('', $reponse);
                    }
                }
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