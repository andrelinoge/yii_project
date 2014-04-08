<?
class LastNews extends CWidget
{
    public function run()
    {
    	$article = News::model()->recently()->find();
        $this->render( 'last_news', [ 'article' => $article ] );
    }
}