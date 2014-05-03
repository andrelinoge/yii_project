<?php

class ContactUsController extends FrontendController
{

	public function actions()
    {
        return [
            'create' => [
                'class' => 'application.actions.crud.CreateAction',
                'redirect_after_save' => false
            ]
        ];
    }

    public function actionNew()
    {
        $page = Page::model()->find_by_alias('contact');
        $this->page_name = $page->title;
        $this->appendTitle( $page->title );
        $this->setMainMetaTags( $page->meta_keywords, $page->meta_description );

        $model = new ContactMessageForm();

        $this->render(
            'new',
            [
                'content'       => $page->content,
                'model'         => $model,
                'site_settings' => SiteSettings::get()
            ]
        );
    }

    public function create_model()
    {
        $model = new ContactMessageForm();
        return $model;
    }

    public function filters()
    {
        return ['ajaxOnly + create'];
    }

}