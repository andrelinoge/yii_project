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
      <div class="col-md-7">
        <div class="blog-post-container">
            <div class="blog-post-inner">
                <?= $content; ?>
                <div class="row">
                  <div class="col-centered" style="text-align: center">
                    <img src="/application/public/windows/1.gif" id="window_system_preview" class="col-centered">  
                  </div>
                  
                </div>
            </div>
        </div> 
    </div>

    <div class="col-md-5">
        <div class="widget-main comment-form">
            <div class="request-information">
              <div class="widget-main-title">
                <h4 class="widget-title">Віконний калькулятор</h4>
            </div>

            <div class="widget-inner">
                <? 
                  $form = $this->beginWidget('CActiveForm', [
                    'action'      => url('calculator/process'),
                    'htmlOptions' => [ 'class' => 'ajax-form calculator clearfix', 'name' => get_class($model), 'id' => 'calc' ]
                  ]); 
                ?>
                <div class="row">
                  <div class="col-md-6">
                    <label for="type">Віконна система</label>
                    <div class="input-select">
                        <?= $form->dropDownList($model, 'window_system_id', WindowSystem::model()->get_titles_list()); ?>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label for="email-id">Тип конструкції</label>
                    <div class="input-select">
                        <?= $form->dropDownList($model, 'construction_type', CalcForm::construction_types()); ?>
                    </div>
                  </div>
                </div>

                <div class="full-row" style="margin-top: 10px">
                    <label for="email-id">Склопакет</label>
                    <div class="input-select">
                        <?= $form->dropDownList($model, 'glass_id', Glass::model()->get_titles_list()); ?>
                    </div>
                </div>

                <div class="full-row">
                    <label for="email-id">Ширина</label>
                    <div class="col-md-9">
                      <?= $form->textField($model, 'width', ['class' => 'slider-width']); ?>
                    </div>
                    <div class="col-md-3">
                      <p style="margin-top: -10px"><span id="width_value">2000</span> мм</p>
                    </div>
                </div>

                <div class="full-row">
                    <label for="email-id">Висота</label>
                    <div class="col-md-9">
                      <?= $form->textField($model, 'height', ['class' => 'slider-height']); ?>
                    </div>
                    <div class="col-md-3">
                      <p style="margin-top: -10px"><span id="height_value">1200</span> мм</p>
                    </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                      <label>Ваше ім'я</label>
                      <?= $form->textField($model, 'name'); ?>
                    </div>

                    <div class="col-md-6">
                      <label>Телефон</label>
                      <?= $form->textField($model, 'phone'); ?>
                    </div>
                  </div>
                
                <div class="full-row">
                    <h4 class="pull-left" id="price"></h4>
                    <div class="submit_field">
                        <input type="submit" value="Розрахувати" id="process" class="mainBtn pull-right">
                        <input type="submit" value="Замовити" id="save" class="mainBtn pull-right">
                    </div>
                </div>
                <?= $form->hiddenField($model, 'action', ['id' => 'action']); ?>
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
        $('#price').html('Ціна: ' + event.response.price + ' грн').show();
      }

      if (typeof event.response.message != 'undefind' && event.response.message != '' && event.response.success == true)
      {
        alert(event.response.message);
      }
      return false;
    });

    $('#save').on('click', function(event) {
      event.preventDefault();
      $('#action').val('save');
      $('#calc').submit();
    });

    $('#process').on('click', function(event) {
      event.preventDefault();
      $('#action').val('price');
      $('#calc').submit();
    });

    $('#CalcForm_construction_type').on('change', function(){
      $('#window_system_preview').attr('src', '/application/public/windows/' + this.value + '.gif'); 
    });

    var slider_width_elem = document.querySelector('.slider-width'),
        slider_width = new Powerange(slider_width_elem, { callback: display_width, min: 1200, max: 3000, start: 2000, hideRange: true, step: 1, decimal: true }),
        slider_height_elem = document.querySelector('.slider-height'),
        slider_height = new Powerange(slider_height_elem, { callback: display_height, min: 400, max: 2500, start: 1200, hideRange: true, step: 1, decimal: true });

    function display_width() 
    {
      document.getElementById('width_value').innerHTML = slider_width_elem.value;
    }

    function display_height() 
    {
      document.getElementById('height_value').innerHTML = slider_height_elem.value;
    }
  });
</script>