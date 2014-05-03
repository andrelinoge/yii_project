<?

class BaseCrudAction extends CAction
{
    public $success_message = '';
    public $error_message = '';
    public $pk_name = 'id';

    /**
     * @param $method string
     * @param $model CModel
     */
    protected function client_callback($method, $model)
    {
        if (method_exists($this->controller, $method))
        {
            $this->controller->$method($model);
        }
    }

    /**
     * @param $model CActiveRecord
     */
    protected function redirect_to_view($model)
    {
        if (!is_ajax())
        {
            $this->controller->redirect(['view', 'id' => $model->getPrimaryKey() ]);
        }
    }

    protected function redirect_to_referrer()
    {
        if (!is_ajax())
        {
            $return_url = get_param('return_url');
            $this->controller->redirect($return_url ? [$return_url] : ['index']);
        }
    }

    protected function check_method_exists($method)
    {
        if (!method_exists($this->controller, $method))
        {
            throw new CException("Method CController::{$method}() not found");
        }
    }

    /**
     * @return CModel
     */
    protected function create_model()
    {
        $this->check_method_exists('create_model');
        return $this->controller->create_model();
    }

    /**
     * @return CModel
     * @throws CHttpException
     */
    protected function load_model()
    {
        $this->check_method_exists('load_model');

        if ($this->pk_name)
        {
            $id = get_param($this->pk_name, null);
            if ($id)
            {
                $model = $this->controller->load_model($id);
            }
            else
            {
                throw new CHttpException(404);
            }
        }
        else
        {
            $model = $this->controller->load_model();
        }

        if (!$model)
        {
            throw new CHttpException(404);
        }
        
        return $model;
    }

    /**
     * @return CActiveRecord
     */
    protected function get_collection_provider()
    {
        $this->check_method_exists('get_collection_provider');
        $model = $this->controller->get_collection_provider();
        return $model;
    }

}