<? foreach($gallery as $image): ?>
    <div class="col-md-4 mix <?= $image->category->alias; ?>">
        <div class="gallery-item">
            <a class="fancybox" rel="gallery1" href="<?= $image->get_image_url(); ?>">
                <div class="gallery-thumb_">
                    <img src="<?= $image->get_image_url('m'); ?>" alt="" />
                </div>
                
                <? if (!empty($image->title) || !empty($image->description) ): ?>
                    <div class="gallery-content">
                        <h4 class="gallery-title"><?= $image->title; ?></h4>
                        <p class="small-text"><?= $image->description; ?></p>
                    </div>
                <? endif; ?>
            </a>
        </div>
    </div>
<? endforeach; ?>