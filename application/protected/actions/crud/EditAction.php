<?
Yii::import('application.actions.crud.BaseCrudAction');

class EditAction extends BaseCrudAction
{
    public $view        = 'edit';
    public $ajax_view   = 'edit.js';
    public $breadcrumbs = [];

    public function run()
    {
        $model = $this->load_model();
        $this->client_callback('before_edit', $model);

        if (is_ajax())
        {
            $this->controller->renderPartial($this->ajax_view, ['model' => $model]);
        }
        else
        {
            $this->controller->breadcrumbs = $this->breadcrumbs;
            $this->controller->render($this->view, ['model' => $model]);
        }
    }
}