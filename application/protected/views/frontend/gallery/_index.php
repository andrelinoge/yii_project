<? foreach($gallery as $image): ?>
    <div class="col-md-3 mix students">
        <div class="gallery-item">
            <a class="fancybox" rel="gallery1" href="<?= $image->get_image_url(); ?>">
                <div class="gallery-thumb">
                    <img src="<?= $image->get_image_url('m'); ?>" alt="" />
                </div>
                
                <? if (!empty($image->title) || !empty($image->description) ): ?>
                    <div class="gallery-content">
                        <h4 class="gallery-title">2014 Faculty Biennial</h4>
                        <p class="small-text">Featuring painting, sculpture, ceramics</p>
                    </div>
                <? endif; ?>
            </a>
        </div>
    </div>
<? endforeach; ?>