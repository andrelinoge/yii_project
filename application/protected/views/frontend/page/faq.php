<div class="container">
    <div class="row">   
      <div class="col-md-12">
        <?= $content; ?>
      </div>
    </div>

    <div class="row">   
    <div class="col-md-12">
        <div class="panel-group" id="accordion">
          <? foreach($faqs as $faq): ?>
            <div class="panel panel-default">
              <div class="panel-heading">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?= $faq->id; ?>">
                    <?= $faq->title; ?>
                  </a>
              </div>
              <div id="collapse-<?= $faq->id; ?>" class="panel-collapse collapse">
                <div class="panel-body">
                  <?= $faq->content; ?>
                </div>
              </div>
            </div>
          <? endforeach; ?>
    </div>
  </div>
</div>  