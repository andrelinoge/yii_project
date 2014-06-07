<? 

$cs     = Yii::app()->clientScript;
$assets = $this->get_behavioral_url();

$cs->registerScriptFile($assets . '/js/slider/powerange.min.js', ClientScript::POS_END);
$cs->registerCssFile($assets . '/js/slider/powerange.min.css');

$this->widget('application.widgets.Common.BreadCrumbs', [
    'default_title' => 'Головна', 
    'view'          => 'frontend',
    'items'         => $this->breadcrumbs
]); 

?>

<div class="container">
    <div class="row">   
      <div class="col-md-8">
        <div class="blog-post-container">
            <div class="blog-post-inner">
                <?= $content; ?>
            </div>
            <div class="blog-post-inner">
              <img src="/application/public/windows/1.gif" id="window_system_preview" style="display: block;" class="col-centered">
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
                    <label>Ширина</label>
                    <br/>
                    <div class="col-md-10">
                      <?= $form->textField($model, 'width', ['class' => 'width']); ?>
                    </div>
                    <div style="margin-top: -10px">
                      <span id="width-box">2000</span>, мм
                    </div>
                </div>

                <div class="full-row">
                    <label>Висота</label>
                    <br/>
                    <div class="col-md-10">
                      <?= $form->textField($model, 'height', ['class' => 'height']); ?>
                    </div>
                    <div style="margin-top: -10px">
                      <span id="height-box">2000</span>, мм
                    </div>
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

    $('#CalcForm_construction_type').on('change', function(){
      $('#window_system_preview').attr('src', '/application/public/windows/' + this.value + '.gif'); 
    });

    var width = document.querySelector('.width');
    new Powerange(width, {
      decimal       : true,
      hideRange     : true,
      min           : 1000,
      max           : 3000,
      start         : 2000,
      step: 1,
    });

    var height = document.querySelector('.height');

    new Powerange(height, {
      decimal       : true,
      hideRange     : true,
      min           : 1000,
      max           : 3000,
      start         : 2000,
      step: 1,
    });

    $('#CalcForm_width').on('change', function(){
      $('#width-box').html(this.value);
    });

    $('#CalcForm_height').on('change', function(){
      $('#height-box').html(this.value);
    });
  });
</script>