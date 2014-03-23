<?
Yii::import('application.actions.crud.UpdateAction');

class UpdateImageAction extends UpdateAction
{
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
                $this->controller->redirect(['index', 'owner_id' => $model->owner_id, 'type' => $model->type ]);
            }
        }
    }
}