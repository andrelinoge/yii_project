<?php

class SiteController extends FrontendController
{

	public function actionIndex()
	{
        $page = Page::model()->find_by_alias('home');
        $this->page_name = $page->title;
        $this->appendTitle( $page->title );
        $this->setMainMetaTags( $page->meta_keywords, $page->meta_description );

		$this->render(
            '/shared/index',
            [
                'content' => $page->content,
            ]
        );
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
}