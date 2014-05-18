<?

class AnotherArticles extends CWidget
{
    public $article;

    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "id != :id";
        $criteria->params = [':id' => $this->article->id];

        $articles = Article::model()->by_category($this->article->category_id)->findAll($criteria);

        if (!empty($articles))
        {
            $this->render('another_articles', [
                'articles' => $articles
            ]);
        }
    }
}