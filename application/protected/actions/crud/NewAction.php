<?
Yii::import('application.actions.crud.BaseCrudAction');

class NewAction extends BaseCrudAction
{
    public $view = 'new';
    public $ajax_view = '_new';

    public function run()
    {
        $model = $this->create_model();
        $this->client_callback('before_new', $model);

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