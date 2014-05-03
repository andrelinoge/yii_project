<div class="widget-main">
    <div class="widget-main-title">
        <h4 class="widget-title">Our Gallery</h4>
    </div>
    <div class="widget-inner">
        <div class="gallery-small-thumbs clearfix">
            <? foreach($gallery as $image): ?>
                <div class="thumb-small-gallery">
                    <a class="fancybox" rel="gallery" href="<?= $image->get_image_url('m'); ?>" title="<?= $image->title; ?>">
                        <img src="<?= $image->get_image_url('s'); ?>" alt="<?= $image->title; ?>" />
                    </a>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>