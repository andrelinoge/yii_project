<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <? if (!empty()): ?>
                    <? foreach($articles as $article): ?>
                        <div class="col-md-4 col-sm-4">
                            <div class="blog-grid-item">
                                <div class="blog-grid-thumb">
                                    <a href="<?= $article->get_url(); ?>">
                                        <img alt="" src="<?= $article->cover->get_image_url('m'); ?>">
                                    </a>
                                </div>
                                <div class="box-content-inner">
                                    <h4 class="blog-grid-title"><a href="<?= $article->get_url(); ?>"><?= $article->title; ?></a></h4>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                <? else: ?>
                    <p><?= _('Категорія в стані наповнення'); ?></p>
                <? endif;  ?>
            </div>
        </div>
    </div>
</div>