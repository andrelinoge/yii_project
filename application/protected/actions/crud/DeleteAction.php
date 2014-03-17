<?
Yii::import('application.actions.crud.BaseCrudAction');

class DeleteAction extends BaseCrudAction
{
    public $success_message = 'Successfully deleted';
    public $error_message = 'error';
    public $ajax_view = '';

    public function run()
    {
        $model = $this->load_model();
        $this->client_callback('before_delete', $model);

        if ($model->delete())
        {
            success($this->success_message);
        }
        else
        {
            failure($this->error_message);
        }

        if (!is_ajax())
        {
            $this->redirect_to_referrer();
        }
    }
}