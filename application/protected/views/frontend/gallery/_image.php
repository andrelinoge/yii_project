<figure class="span6 first"> 
<a data-toggle="lightbox" href="#gallery_<?= $data->id; ?>" > 
		<img class="team-img f-width-img" src="<?= $data->get_image_url('m'); ?>" alt=""/> 
	</a>
	<p><?= $data->description; ?></p>
</figure>

<div id="gallery_<?= $data->id; ?>" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
	<div class='lightbox-header'>
		<button type="button" class="close" data-dismiss="lightbox" aria-hidden="true">&times;</button>
	</div>
	<div class='lightbox-content'> <img src="<?= $data->get_image_url(); ?>">
		<div class="lightbox-caption">
			<p><?= $data->title; ?></p>
		</div>
	</div>
</div>