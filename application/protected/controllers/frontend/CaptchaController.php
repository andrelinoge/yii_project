<?
class CaptchaController extends CController
{
    public function actions()
    {
        return [
            'contactNew' => [
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
                'minLength' => 3,
                'maxLength' => 4,
                'testLimit' => 2
            ],

            'sizerModal' => [
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
                'minLength' => 3,
                'maxLength' => 4,
                'testLimit' => 2
            ],

            'sizerWidget' => [
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
                'minLength' => 3,
                'maxLength' => 4,
                'testLimit' => 2
            ]
        ];
    }
}