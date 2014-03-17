<?php

class SiteController extends FrontendController
{

	public function actionIndex()
	{
        /** @var $page StaticPages */
        #$page = StaticPages::model()->byPageId( StaticPagesMl::HOME )->byLanguage()->find();
        #$this->appendTitle( $page->getTitle() );
        #$this->setMainMetaTags( $page->getMetaKeyWords(), $page->getMetaDescription() );

		$this->render(
            'index',
            [
                'content' => '###',
            ]
        );
	}

    public function actionLogin()
    {
        $this->set_layout('login-frontend');

        $this->render( 'login', ['form' => new LoginForm()] );
    }

    public function actionError()
    {
        $error = Yii::app()->errorHandler->error;
        if ($error)
        {
            if(is_ajax())
            {
                echo $error['message'];
            }
            else
            {
                $this->render('error', [ 'error' => $error ]);
            }
        }
    }

    public function filters()
    {
        return ['accessControl'];
    }

    public function accessRules()
    {
        return array(

            array(
                'allow',
                'actions' => ['index', 'error'],
                'users' => [ '*' ]
            ),

            array(
                'allow',
                'actions' => [ 'login' ],
                'users' => [ '?' ],
                'deniedCallback' => function() { $this->redirect(url('site/index')); }
            ),

            array(
                'deny',
                'users' => [ '*' ]
            ),
        );
    }
}