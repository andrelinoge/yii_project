<?
/** @var $images BaseImageGalleryML[] */
?>
<ul class="thumbnails item-thumbs">
	<? foreach($images as $image): ?>
	    <li class="span4 thumb">
	    	<a href="<?= $image->getOriginalImage()?>" class="fancy-thumb" rel="fancybox-thumb" title="<?= $image->getTitle(); ?>">
	    	    <img src="<?= $image->getSmallThumbnail(); ?>"
                     alt="<?= $image->getAlt(); ?>"
                     title="<?= $image->getTitle(); ?>">
	    	</a>
	    </li>
	<? endforeach; ?>
</ul>