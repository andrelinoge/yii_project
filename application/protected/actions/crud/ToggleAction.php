<?php

class ToggleAction extends BaseCrudAction
{
    public $ajax_toggle_on_view = '';
    public $ajax_toggle_off_view = '';
    public $attributes = [];

    public function run()
    {
        $model = $this->load_model();
        $attribute = $this->get_attribute();

        $this->client_callback('before_toggle', $model);
        $model->{$attribute} = $model->{$attribute} ? false : true;

        is_ajax() ? $this->ajax_process($model) : $this->non_ajax_process($model);
    }

    protected function ajax_process(CModel $model)
    {
        $attribute = $this->get_attribute();

        if ($model->save())
        {
            if ( $model->{$attribute} )
            {
                if ($this->ajax_toggle_on_view)
                {
                    $this->controller->renderPartial($this->ajax_toggle_on_view);
                }
            }
            else
            {
                if ($this->ajax_toggle_off_view)
                {
                    $this->controller->renderPartial($this->ajax_toggle_off_view);
                }
            }
        }
        else
        {
            failure($this->error_message);
        }
    }

    protected function non_ajax_process(CModel $model)
    {
        $model->save() ? success($this->success_message) : failure($this->error_message);
        $this->redirect_to_view($model);
    }

    protected function get_attribute()
    {
        if (empty($this->attributes))
        {
            throw new CHttpException(400, 'ToggleAction::attributes is empty');
        }

        $attribute = get_param('attribute');

        if (!in_array($attribute, $this->attributes))
        {
            throw new CHttpException(400, "Missing attribute {$attribute}");
        }

        return $attribute;
    }
}