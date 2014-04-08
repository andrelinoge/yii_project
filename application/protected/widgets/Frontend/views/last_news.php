<? $assets_path = $this->controller->get_behavioral_url(); ?>

<h2>Останні новинки</h2>
<div class="f-img-holder">
	<a href="<?= $article->get_url(); ?>"> 
		<img src="<?= $article->get_image_url('m'); ?>" class="f-blog-img" alt=""/> 
	</a> 
</div>
<p><?= Text::truncate($article->content, 150, true); ?></p>
<a href="<?= $article->get_url(); ?>" class="more-btn2">+ Читати далі</a> 