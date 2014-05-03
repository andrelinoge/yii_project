<?

class SizerRequestController extends FrontendController
{

	public function actions()
    {
        return [
            'create' => [
                'class'               => 'application.actions.crud.CreateAction',
                'redirect_after_save' => false
            ],
            'captacha' => [
                'class'     =>'CCaptchaAction',
                'backColor' =>0xFFFFFF,
                'minLength' => 3,
                'maxLength' => 4,
                'testLimit' => 2
            ]
        ];
    }

    public function create_model()
    {
        $model = new SizerRequestForm();
        return $model;
    }

    public function filters()
    {
        return ['ajaxOnly + create'];
    }

}