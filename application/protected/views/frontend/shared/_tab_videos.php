<?
/** @var $videos BaseVideoGalleryML[] */
?>
<ul class="thumbnails item-thumbs">
	<? foreach($videos as $video): ?>
  <li class="span4 thumb">
  	<a href="<?= $video->getVideo(); ?>" class="fancy-media">
  	    <img src="http://img.youtube.com/vi/<?= $video->getYoutubeVideoId();?>/0.jpg">
  	</a>
  </li>
	<? endforeach; ?>
</ul>