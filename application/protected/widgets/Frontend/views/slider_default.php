<? /** @var $slides Slider[] */?>
<? if( !empty($slides) ): ?>
    <section class="sub-head">

        <div class="container">
            <div class="carousel slide" id="slidesHome">
                <ol class="carousel-indicators">
                    <? for( $i = 0; $i < count($slides); $i++): ?>
                        <li data-slide-to="<?= $i; ?>" data-target="#slidesHome" <? if ($i == 0): ?>class="active"<? endif; ?>>
                            <?= $i + 1; ?>
                        </li>
                    <? endfor; ?>
                </ol>

                <div class="carousel-inner">
                    <? $class = "item active"; ?>
                    <? foreach($slides as $slide): ?>
                        <div class="<?= $class; ?>">
                            <a href="#">
                                <img src="<?= $slide->getOriginalImage(); ?>"
                                     class="slide"
                                     alt="<?= $slide->getAlt(); ?>"
                                     title="<?= $slide->getTitle(); ?>">
                            </a>
                        </div>
                        <? $class = "item"; ?>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<? endif; ?>

<script>
    $(document).ready(function() {
        $('.carousel').carousel({
            interval: 5000
        })
    });
</script>