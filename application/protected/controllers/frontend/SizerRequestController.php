<?

class SizerRequestController extends FrontendController
{

	public function actions()
    {
        return [
            'create' => [
                'class'               => 'application.actions.crud.CreateAction',
                'redirect_after_save' => false
            ]
        ];
    }

    public function create_model()
    {
        if (isset($_POST['SizerRequestModalForm']))
        {
            $model = new SizerRequestModalForm();
        }
        else
        {
            $model = new SizerRequestForm();
        }
        return $model;
    }

    public function filters()
    {
        return ['ajaxOnly + create'];
    }

}