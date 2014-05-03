<div class="main-slideshow">
    <div class="flexslider">
        <ul class="slides">
            <? foreach($slides as $slide): ?>
                <li>
                    <img src="<?= $slide->get_image_url('m'); ?>" />
                    <? if (!empty($slide->title) || !empty($slide->description)): ?>
                        <div class="slider-caption">
                            <h2><?= $slide->title; ?></h2>
                            <p><?= $slide->description; ?></p>
                        </div>
                    <? endif?>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</div>