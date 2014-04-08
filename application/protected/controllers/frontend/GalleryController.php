<?php

class GalleryController extends FrontendController
{

	public function actionIndex()
	{
        $page = Page::model()->find_by_alias('gallery');
        $this->page_name = $page->title;
        $this->appendTitle( $page->title );
        $this->setMainMetaTags( $page->meta_keywords, $page->meta_description );

        $this->render(
            'index',
            [
                'content'       => $page->content,
                'data_provider' => WorkGallery::model()->search()
            ]
        );
	}
    
}