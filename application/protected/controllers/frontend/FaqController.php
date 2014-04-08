<?php

class FaqController extends FrontendController
{

	public function actionIndex()
	{
        $page = Page::model()->find_by_alias('faq');
        $this->page_name = $page->title;
        $this->appendTitle( $page->title );
        $this->setMainMetaTags( $page->meta_keywords, $page->meta_description );

        $faqs = Faq::model()->findAll();

        $this->render(
            'index',
            [
                'content' => $page->content,
                'faqs'    => $faqs
            ]
        );
	}

    public function actionShow($alias)
    {
        $article = News::model()->find_by_alias($alias);

        if (!$article)
        {
            throw new CHttpException(404);
        }

        $page = Page::model()->find_by_alias('news');
        $this->page_name = $page->title;

        $this->appendTitle( $article->title );
        $this->setMainMetaTags( $article->meta_keywords, $article->meta_description );

        $this->render(
            'show',
            [
                'article'   => $article
            ]
        );
    }

}