<? Yii::app()->getClientScript()->registerScriptFile( $this->get_behavioral_url() . '/js/controllers/paginationController.js'); ?>

<? $this->widget('application.widgets.Common.BreadCrumbs', [
    'default_title' => 'Головна', 
    'view'          => 'frontend',
    'items'         => $this->breadcrumbs
]); ?>

<div class="container">
    <div class="row">   
        <div class="col-md-12">
            <div class="row" id="gallery">
                <? if (is_array($gallery) && !empty($gallery)): ?>
                    <div class="col-md-3">
                        <div class="widget-main">
                            <div class="widget-main-title">
                                <h4 class="widget-title">Filter Controls</h4>
                            </div>
                            <div class="widget-inner">
                                <ul class="mixitup-controls">
                                    <li class="filter" data-filter="all">Show All</li>
                                    <? foreach($categories as $category): ?>
                                        <li class="filter" data-filter="<?= $category->alias; ?>"><?= $category->title; ?></li>
                                    <? endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="row">
                            <div id="Grid">
                                <? $this->renderPartial('_index', ['gallery' => $gallery]); ?>
                            </div>
                        </div>
                    </div>
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