<figure class="span9">
  <?= $content; ?>
  <div class="clearfix"></div>
  <br/><br/>

  <div class="accordion" id="accordion2">
    <? foreach($faqs as $faq): ?>
      <div class="accordion-group">
        <div class="accordion-heading"> 
          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse-<?= $faq->id; ?>"> <?= $faq->title; ?> </a> 
        </div>

        <div id="collapse-<?= $faq->id; ?>" class="accordion-body collapse">
          <div class="accordion-inner">
            <?= $faq->content; ?>
          </div>
        </div>

      </div>
    <? endforeach; ?>
  </div>
</figure>