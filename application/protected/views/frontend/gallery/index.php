<figure class="span9">
  <?= $content; ?>
  <div class="clearfix"></div>
  <br/><br/>

<section class="row-fluid content-gallery">
  <?
    $this->widget(
      'ext.bootstrap.widgets.TbThumbnails',
      [
        'dataProvider' => $data_provider,
        'template'     => "{items}\n{pager}",
        'itemView'     => '_image',
        'pagerCssClass' => 'widget-foot',
        'itemsCssClass' => 'images',
        'pager' => [
                'class' => 'bootstrap.widgets.TbJsonPager',
                'header' => '<div class="clearfix"></div><div class="span6">',
                'footer' => '</div><div class="clearfix"></div>',
                'htmlOptions' => [
                    'class' => 'pagination'
                ]
            ]
      ]
    );
  ?>   
</section>