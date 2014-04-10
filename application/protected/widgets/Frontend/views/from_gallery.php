<h2>Із галереї наших робіт</h2>
<ul class="gallery-list">
  <? foreach($images as $image): ?>
    <li>
      <a href="<?= url('gallery/index'); ?>">
        <img src="<?= $image->get_image_url('s'); ?>" alt="<?= $image->title; ?>"/>
      </a>
    </li>
  <? endforeach; ?>
</ul>
<a href="<?= url('gallery/index'); ?>" class="more-btn2">+ Більше</a> 