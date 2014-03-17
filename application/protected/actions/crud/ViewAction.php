<?
Yii::import('application.actions.crud.BaseCrudAction');

class ViewAction extends BaseCrudAction
{
    public $view = 'view';
    public $ajax_view = '_view';

    public function run()
    {
        $model = $this->load_model();
        $this->client_callback('before_view', $model);

        if (is_ajax())
        {
            $this->controller->renderPartial($this->ajax_view, ['model' => $model]);
        }
        else
        {
            $this->controller->render($this->view, ['model' => $model]);
        }
    }

}