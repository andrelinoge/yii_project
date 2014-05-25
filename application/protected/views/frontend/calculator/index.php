<? $this->widget('application.widgets.Common.BreadCrumbs', [
    'default_title' => 'Головна', 
    'view'          => 'frontend',
    'items'         => $this->breadcrumbs
]); ?>

<div class="container">
    <div class="row">   
      <div class="col-md-8">
        <div class="blog-post-container">
            <div class="blog-post-inner">
                <?= $content; ?>
            </div>
        </div> 
    </div>

    <div class="col-md-4">
        <div class="widget-main comment-form">
            <div class="request-information">
              <div class="widget-main-title">
                <h4 class="widget-title">Віконний калькулятор</h4>
            </div>

            <div class="widget-inner">
                <? 
                  $form = $this->beginWidget('CActiveForm', [
                    'action'      => url('calculator/process'),
                    'htmlOptions' => [ 'class' => 'ajax-form calculator clearfix', 'name' => get_class($model) ]
                  ]); 
                ?>
                <div class="row">
                  <div class="col-md-6">
                    <label for="type">Віконна система</label>
                    <div class="input-select">
                        <?= $form->dropDownList($model, 'window_system_id', [null => '- Вибрати -'] + WindowSystem::model()->get_titles_list()); ?>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label for="email-id">Тип конструкції</label>
                    <div class="input-select">
                        <?= $form->dropDownList($model, 'construction_type', [null => '- Вибрати -'] + CalcForm::construction_types()); ?>
                    </div>
                  </div>
                </div>
                <div class="full-row" style="margin-top: 10px">
                    <label for="email-id">Склопакет</label>
                    <div class="input-select">
                        <?= $form->dropDownList($model, 'glass_id', [null => '- Вибрати -'] + Glass::model()->get_titles_list()); ?>
                    </div>
                </div>

                <div class="full-row">
                    <label for="email-id">Ширина</label>
                    <?= $form->textField($model, 'width'); ?>
                </div>

                <div class="full-row">
                    <label for="email-id">Висота</label>
                    <?= $form->textField($model, 'height'); ?>
                </div>

                
                <div class="full-row">
                    <h4 class="pull-left" id="price"></h4>
                    <div class="submit_field">
                        <input type="submit" value="Надіслати" name="" class="mainBtn pull-right">
                    </div>
                </div>
              <? $this->endWidget(); ?>
            </div>
        </div>
    </div>

</div>
</div>
</div>  

<script>
  $(function(){
    $('.calculator').on('ajax:success', function(event) {
      if (event.response.success == true)
      {
        $('#price').html('Ціна: ' + event.response.price + ' грн');
      }
      return false;
    });
  });
</script>