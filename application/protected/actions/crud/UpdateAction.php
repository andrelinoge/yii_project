<?
Yii::import('application.actions.crud.BaseCrudAction');

class UpdateAction extends BaseCrudAction
{
    public $view = 'edit';
    public $ajax_view = null;
    public $success_message = 'Edited successfully';
    public $error_message = 'Invalid data';
    public $redirect_to_view = false;
    public $redirect_to = 'index';

    public function run()
    {
        $model = $this->load_model();
        $class_name = get_class( $model );
        $attributes = get_param($class_name);

        if ( $attributes && is_array($attributes) )
        {
            $model->setAttributes($attributes);
            $this->client_callback('before_update', $model);

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
                success($this->success_message);
                if ($this->redirect_to_view)
                {
                    $response['redirect'] = url('view', ['id' => $model->getPrimaryKey() ]);
                }
            }
        }
    }

    protected function non_ajax_process(CModel $model)
    {
        if ($model->hasErrors())
        {
            failure($this->error_message);
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
                $this->controller->redirect([ $this->redirect_to ]);
            }
        }
    }
}