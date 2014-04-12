<?= $content; ?>
<div class="clearfix"></div>
<br/><br/>

<? foreach($products as $product): ?>
  <article class="author-art">
    <div class="author-inner">
      <img alt="" class="team-img" src="<?= $product->get_image_url('s'); ?>">
        <strong class="title2">
          <a href="<?= $product->get_url(); ?>"><?= $product->title; ?></a>
        </strong> 
      <p><?= Text::truncate($product->content, 300, true); ?></p>
      <br class="clear">
      <div class="blog-bottom">
        <ul class="b-top-links">
          <li><?= date('j M, Y', strtotime($product->created_at)); ?></li>
        </ul>
      </div>
    </div>
  </article>
<? endforeach; ?>

<section class="row-fluid">
  <? $this->widget('CLinkPager', [
      'pages'                => $pagination,
      'previousPageCssClass' => 'btn',
      'nextPageCssClass'     => 'btn',
      'internalPageCssClass' => 'btn',
      'lastPageLabel'        => '',
      'firstPageLabel'       => '',
      'firstPageCssClass'    => 'hidden',
      'lastPageCssClass'     => 'hidden',
      'selectedPageCssClass' => 'active',
      'header'               => '',
      'htmlOptions' => [
        'class' => 'span9'
      ]
  ]); ?>
</section>