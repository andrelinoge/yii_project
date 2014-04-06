<?
Yii::import('application.actions.crud.BaseCrudAction');

class IndexAction extends BaseCrudAction
{
    public $view = 'index';
    public $ajax_view = '_index';
    public $getter_collection_provider_method = 'get_collection_provider';
    public $view_assigns = [];

    public function run()
    {
        $data_provider = call_user_func([ $this->controller, $this->getter_collection_provider_method]);
        $this->client_callback('before_index', $data_provider);

        if (is_ajax())
        {
            $this->controller->renderPartial(
                $this->ajax_view, [
                    'data_provider' => $data_provider,
                    'model'         => $data_provider->model
                ]
            );
        }
        else
        {
            $this->controller->render(
                $this->view, array_merge($this->view_assigns, [
                    'data_provider' => $data_provider,
                    'model'         => $data_provider->model,
                    'partial_view'  => $this->ajax_view
                ])
            );
        }
    }

}