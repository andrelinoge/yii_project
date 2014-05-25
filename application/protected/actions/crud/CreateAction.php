<?
Yii::import('application.actions.crud.BaseCrudAction');

class CreateAction extends BaseCrudAction
{
    public $view = 'new';
    public $ajax_view = null;
    public $success_message = 'Added successfully';
    public $error_message = 'Invalid data';
    public $redirect_after_save = true;
    public $redirect_to_view = false;
    public $breadcrumbs = [];

    public function run()
    {
        $model = $this->create_model();
        $class_name = get_class( $model );
        $attributes = get_param($class_name);

        if ( $attributes && is_array($attributes) )
        {
            $model->setAttributes($attributes);
            $this->client_callback('before_create', $model);

            $model->validate();

            is_ajax() ? $this->ajax_process($model) : $this->non_ajax_process($model);
        }
    }

    protected function ajax_process(CModel $model)
    {
        if ($model->hasErrors())
        {
            failure($this->error_message, ['errors' => $model->getErrors()]);
        }
        else
        {
            $model->save(false);

            if ($this->ajax_view)
            {
                $this->controller->render($this->ajax_view, ['model' => $model]);
            }
            else
            {
                $response = [];
                if ($this->redirect_after_save)
                {
                    if ($this->redirect_to_view)
                    {
                        $response['redirect'] = url('view', ['id' => $model->getPrimaryKey() ]);
                    }
                    else
                    {
                        $response['redirect'] = url('index' );
                    }
                }
                success($this->success_message, $response);
            }
        }
    }

    protected function non_ajax_process(CModel $model)
    {
        if ($model->hasErrors())
        {
            failure($this->error_message);
            $this->controller->breadcrumbs = $this->breadcrumbs;
            $this->controller->render($this->view, ['model' => $model]);
        }
        else
        {
            $model->save(false);
            success($this->success_message);
            if ($this->redirect_to_view)
            {
                $this->controller->redirect(['view', 'id' => $model->getPrimaryKey() ]);
            }
            else
            {
                $this->controller->redirect(['index' ]);
            }
        }
    }
}