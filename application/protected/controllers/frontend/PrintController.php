<?php

class PrintController extends FrontendController
{

	public function actionIndex()
	{
        $page = Page::model()->find_by_alias('print_catalog');
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

}