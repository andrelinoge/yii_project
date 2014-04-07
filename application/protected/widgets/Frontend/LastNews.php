<?
class LastNews extends CWidget
{
    public function run()
    {
    	$article = null;
        $this->render( 'last_news', [ 'article' => $article ] );
    }
}