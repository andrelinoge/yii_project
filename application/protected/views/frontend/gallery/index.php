<figure class="span9">
  <?= $content; ?>
  <div class="clearfix"></div>
  <br/><br/>

<section class="row-fluid content-gallery">
  <? $first = true; ?>
  <? foreach($images as $image ): ?>
    <figure class="span6 <?= $first ? 'first' : ''; ?>"> 
      <a data-toggle="lightbox" href="#gallery_<?= $image->id; ?>" > 
          <img class="team-img f-width-img" src="<?= $image->get_image_url('m'); ?>" alt=""/> 
        </a>
        <p><?= $image->description; ?></p>
      </figure>

      <div id="gallery_<?= $image->id; ?>" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
        <div class='lightbox-header'>
          <button type="button" class="close" data-dismiss="lightbox" aria-hidden="true">&times;</button>
        </div>
        <div class='lightbox-content'> <img src="<?= $image->get_image_url(); ?>">
          <div class="lightbox-caption">
            <p><?= $image->title; ?></p>
          </div>
        </div>
      </div>
    <? $first = !$first; ?>
  <? endforeach; ?>
  
</section>

<section class="row-fluid">
  <? $this->widget('ext.bootstrap.widgets.TbPager', [
      'pages' => $pagination,
      'htmlOptions' => [
        'class' => 'art-bottom'
      ]
      
  ]); ?>
</section>