<?php

class GalleryController extends FrontendController
{

	public function actionIndex()
	{
        $page = Page::model()->find_by_alias('gallery');
        $this->page_name = $page->title;
        $this->appendTitle( $page->title );
        $this->setMainMetaTags( $page->meta_keywords, $page->meta_description );

        $dp = WorkGallery::model()->search();

        $this->render(
            'index',
            [
                'content'    => $page->content,
                'images'     => $dp->getData(),
                'pagination' => $dp->getPagination()
            ]
        );
	}
    
}