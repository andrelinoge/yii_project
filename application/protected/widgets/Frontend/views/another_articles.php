<div class="widget-main">
    <div class="widget-main-title">
        <h4 class="widget-title">Інші товари</h4>
    </div>
    <div class="widget-inner">
        <div class="blog-categories">
            <div class="row">
                <ul class="col-md-12">
                    <? foreach($articles as $article): ?>
                        <li><a href="<?= $article->get_url(); ?>"><?= $article->title; ?></a></li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>