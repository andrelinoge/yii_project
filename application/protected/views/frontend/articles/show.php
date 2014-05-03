<div class="container">
    <div class="row">

        <!-- Here begin Main Content -->
        <div class="col-md-8">

            <div class="row">
                <div class="col-md-12">
                    <div class="blog-post-container">
                        <div class="blog-post-image">
                            <img alt="" src="<?= $article->cover->get_image_url('b'); ?>">
                        </div> <!-- /.blog-post-image -->
                        <div class="blog-post-inner">
                            <?= $article->content; ?>
                        </div>
                    </div> <!-- /.blog-post-container -->
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.col-md-8 -->

        <div class="col-md-4">
            <? $this->widget('application.widgets.Frontend.AnotherArticles', ['article' => $article]); ?>
            <? $this->widget('application.widgets.Frontend.ArticleGallery', ['article' => $article]); ?>
        </div> 

    </div> 
</div>