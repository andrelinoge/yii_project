<figure class="span9">
    <article class="author-art">
        <div class="author-inner">
            <img alt="" class="team-img" src="<?= $article->get_image_url('s'); ?>">
            <strong class="title2"><?= $article->title; ?>
            </strong>
            <?= $article->content; ?>
        </div>
    </article>
</figure>