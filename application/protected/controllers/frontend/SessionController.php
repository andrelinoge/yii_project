<?php

class SessionController extends FrontendController
{
    public function actionCreate()
    {
        $login_form = new LoginForm();

        if ( isset( $_POST[ 'LoginForm' ] ) )
        {
            $login_form->attributes = $_POST[ 'LoginForm' ];

            if ( $login_form->validate() )
            {
                $login_form->login();
            }

            if ( $login_form->hasErrors() )
            {
                $this->unsuccessful_ajax_response( array( 'errors' => $login_form->getErrors()) );
            }
            else
            {
                $this->successful_ajax_response( array('redirect' => createUrl('site/index')) );
            }
        }
    }

    public function actionDestroy()
    {
        app()->user->logout();
        if (is_ajax())
        {
            $this->successful_ajax_response( array('reload' => true) );
        }
        else
        {
            $this->redirect(createUrl('site/index'));
        }
    }

    public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('destroy'),
                'users' => array('@')
            ),
            array(
                'allow',
                'actions' => array('new', 'create'),
                'users' => array('?')
            ),
            array(
                'deny',
                'users' => array('*'),
                'deniedCallback' => function(){ if (is_ajax()) { throw new CHttpException(401); } }
            )
        );
    }

}