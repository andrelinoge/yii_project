<div class="widget-main comment-form">
    <div class="request-information">
      <div class="widget-main-title">
        <h4 class="widget-title">Виклик замірника</h4>
      </div>
        
      <div class="widget-inner">
        <? 
          $form = $this->beginWidget('CActiveForm', [
            'action'      => url('sizerRequest/create'),
            'htmlOptions' => [ 'class' => 'ajax-form sizer-widget-form clearfix', 'name' => get_class($model) ]
          ]); 
        ?>
        <div class="row">
          <div class="col-md-6">
            <label for="yourname">Name:</label>
            <?= $form->textField($model, 'name'); ?>
          </div>

          <div class="col-md-6">
            <label for="email-id">Phone:</label>
            <?= $form->textField($model, 'phone'); ?>
          </div>
        </div>

        <div class="full-row">
            <label for="email-id">Address:</label>
            <?= $form->textField($model, 'address'); ?>
        </div>

        <? if(CCaptcha::checkRequirements()): ?>
          <div class="row">
            <div class="col-md-6">
              <label>Код з картинки:</label>
              <?= $form->textField( $model, 'verify_code', ['class' => 'captcha_code'] ); ?>
            </div>

            <div class="col-md-6">
              <?
                $this->widget(
                  'CCaptcha',
                  [
                    'captchaAction'     => 'captcha/sizerWidget' ,
                    'showRefreshButton' => false,
                    'buttonLabel'       => _('Обновить'),
                    'imageOptions' => [
                      'class' => 'form-captha author-img',
                      'title' => 'Клацніть, щоб обновити картинку',
                      'style' => 'margin-top: 25px'
                    ],
                    'clickableImage' => true
                  ]
                );
              ?>
            </div>
          </div>
        <? endif; ?>

        <div class="row">
          <div class="col-md-12">
              <label for="message">Message:</label>
              <?= $form->textArea($model, 'content', ['rows' => '2']); ?>
          </div>
        </div>
        
        <div class="full-row">
            <div class="submit_field">
                <input type="submit" value="Надіслати" name="" class="mainBtn pull-right">
            </div>
        </div>
      <? $this->endWidget(); ?>
      </div>
  </div>
</div>

<script>
  $(function(){
    $('.sizer-widget-form').on('ajax:success', function(event) {
      if (event.response.success == true)
      {
        this.reset();
        alert('Ми отримали ваше повідомлення і дамо відповідь якомога швидше!');
      }
      
      $('img.form-captha').click();
      return false;
    });
  });
</script>