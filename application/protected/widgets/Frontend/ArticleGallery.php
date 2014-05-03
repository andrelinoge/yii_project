<?
class ArticleGallery extends CWidget
{
    public $article;

    public function run()
    {
        $gallery = $this->article->gallery;

        if (!empty($gallery))
        {
            $this->render('article_gallery', [
                'gallery' => $gallery
            ]);
        }
    }
}