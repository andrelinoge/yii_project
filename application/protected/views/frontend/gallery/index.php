<? Yii::app()->getClientScript()->registerScriptFile( $this->get_behavioral_url() . '/js/controllers/paginationController.js'); ?>

<div class="container">
    <div class="row">   
        <div class="col-md-12">
            <div class="row" id="gallery">
                <? if (is_array($gallery) && !empty($gallery)): ?>
                    <? $this->renderPartial('_index', ['gallery' => $gallery]); ?>
                <? else: ?>
                    <p>Галерея наших робіт знаходиться на етапі наповнення...</p>
                <? endif; ?>
            </div>

            <? if ($pager->getPageCount() > 1): ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="load-more-btn">
                            <a class="show-more-pager" href="<?= url('gallery/index'); ?>" data-container="#gallery" data-page="2">Load more images</a>
                        </div>
                    </div>
                </div>
            <? endif; ?>
        </div>  
    </div>
</div>

<script type="text/javascript">
    $(function(){
        var pagination_controller = new PaginationController();
        pagination_controller.initialize_gallery_pager();
    });
</script>