<figure class="span9">
  <?= $content; ?>
  <div class="clearfix"></div>
  <br/><br/>

  <? foreach($articles as $article): ?>
    <article class="author-art">
      <div class="author-inner">
        <img alt="" class="team-img" src="<?= $article->get_image_url('s'); ?>">
          <strong class="title2">
            <a href="<?= $article->get_url(); ?>"><?= $article->title; ?></a>
          </strong> 
        <p><?= Text::truncate($article->content, 300, true); ?></p>
        <br class="clear">
        <div class="blog-bottom">
          <ul class="b-top-links">
            <li><?= date('j M, Y', strtotime($article->created_at)); ?></li>
          </ul>
        </div>
      </div>
    </article>
  <? endforeach; ?>
</figure>