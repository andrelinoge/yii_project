<?
class CaptchaController extends CController
{
    public function beforeAction()
    {
        $session = Yii::app()->session;
        $prefixLen = strlen(CCaptchaAction::SESSION_VAR_PREFIX);
        foreach($session->keys as $key)
        {
            if(strncmp(CCaptchaAction::SESSION_VAR_PREFIX, $key, $prefixLen) == 0)
                $session->remove($key);
        }
        return true;
    }

    public function actions()
    {
        return array(
            'new'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
                'minLength' => 3,
                'maxLength' => 4,
                'testLimit' => 2
            ),
        );
    }
}