<? 
  Yii::app()->getClientScript()
    ->registerScriptFile($this->get_behavioral_url() . '/js/lightbox.js')
    ->registerCssFile($this->get_behavioral_url() . '/css/lightbox.min.css');
?>

<article class="author-art">
    <div class="author-inner">
        <img alt="<?= $product->title; ?>" class="team-img" src="<?= $product->get_image_url('s'); ?>">
        <strong class="title2"><?= $product->title; ?></strong>
        <?= $product->content; ?>
    </div>
</article>

<div class="clearfix"></div>
<section class="row-fluid content-gallery">
	<? $i = 0; ?>
	<? foreach($product->gallery as $image): ?>
		<figure class="span3 <? if ($i % 4 == 0): ?> first <? endif; ?>"> 
			<a href="#image_<?= $image->id; ?>" data-toggle="lightbox">
				<img class="team-img f-width-img" alt="<?= $image->title; ?>" src="<?= $image->get_image_url('m'); ?>">
			</a> 
		</figure>

		<div id="image_<?= $image->id; ?>" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
			<div class='lightbox-header'>
				<button type="button" class="close" data-dismiss="lightbox" aria-hidden="true">&times;</button>
			</div>

			<div class='lightbox-content'>
				<img src="<?= $image->get_image_url(); ?>">
				<div class="lightbox-caption">
					<p><?= $image->title; ?></p>
				</div>
			</div>
		</div>

    	<? $i++; ?>
	<? endforeach; ?>
</section>