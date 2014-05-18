<?
$this->widget(
	'ext.bootstrap.widgets.TbThumbnails',
	[
		'dataProvider' => $data_provider,
		'template'     => "{items}\n{pager}",
		'itemView'     => '_thumbnail',
		'pagerCssClass' => 'widget-foot',
		'itemsCssClass' => 'images',
		'pager' => [
            'class' => 'bootstrap.widgets.TbJsonPager',
            'header' => '<div class="clearfix"></div><div class="col-md-4">',
            'footer' => '</div><div class="clearfix"></div>',
            'htmlOptions' => [
                'class' => 'pagination'
            ]
        ]
	]
);
?>