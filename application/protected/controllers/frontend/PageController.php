<? 
class PageController extends FrontendController
{
    public function actionAbout()
    {
        $page = Page::model()->find_by_alias('about');
        $this->page_name = $page->title;
        $this->appendTitle( $page->title );
        $this->setMainMetaTags( $page->meta_keywords, $page->meta_description );

        $this->render(
            'about',
            [
                'content' => $page->content,
            ]
        );
    }

    public function actionFaq()
    {
        $page = Page::model()->find_by_alias('faq');
        $this->page_name = $page->title;
        $this->appendTitle( $page->title );
        $this->setMainMetaTags( $page->meta_keywords, $page->meta_description );

        $faqs = Faq::model()->findAll();

        $this->render(
            'faq',
            [
                'content' => $page->content,
                'faqs'    => $faqs
            ]
        );
    }
}