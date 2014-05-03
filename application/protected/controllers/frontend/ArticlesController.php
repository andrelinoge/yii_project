<?

class ArticlesController extends FrontendController
{
    public function actionIndex($category_alias)
    {
        if (!$category = ArticleCategory::model()->find_by_alias($category_alias))
        {
            throw new CHttpException(404);
        }

        $this->render('index',[
            'articles' => Article::model()->by_category($category)->findAll()
        ]);
    }

    public function actionShow($category_alias, $article_alias)
    {
        if (!$article = Article::model()->find_by_alias($article_alias))
        {
            throw new CHttpException(404);
        }

        $this->render('show',[
            'article' => $article
        ]);
    }
}