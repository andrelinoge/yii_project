<?= $site_settings->google_map; ?>
<section class="row-fluid">
  <figure class="span7">
    <h2>Напишіть нам</h2>

    <? $form = $this->beginWidget('CActiveForm', [
      'action'      => url('contactUs/create'),
      'htmlOptions' => [ 'class' => 'ajax-form contact-us-form' ]
    ]); ?>
      <ul class="comm-list">
        <li>
          <label><?= $model->getAttributeLabel('name'); ?></label>
          <?= $form->textField($model, 'name', ['class' => 'comm-field']); ?>
        <li>

        <li>
          <label><?= $model->getAttributeLabel('email'); ?></label>
          <?= $form->emailField($model, 'email', ['class' => 'comm-field']); ?>
        <li>

        <li>
          <label><?= $model->getAttributeLabel('phone'); ?></label>
          <?= $form->telField($model, 'phone', ['class' => 'comm-field']); ?>
        <li>

        <li>
          <label><?= $model->getAttributeLabel('content'); ?></label>
          <?= $form->textArea($model, 'content', ['class' => 'comm-area']); ?>
        <li>

          <? if(CCaptcha::checkRequirements()): ?>
          <li>
            <figure class="span4">
              <?
                $this->widget(
                  'CCaptcha',
                  [
                    'captchaAction'     => 'captcha/new' ,
                    'showRefreshButton' => false,
                    'buttonLabel'       => _('Обновить'),
                    'imageOptions' => [
                    'class' => 'form-captha author-img',
                    'title' => 'Клацніть, щоб обновити картинку'
                  ],
                    'clickableImage' => true
                  ]
                );
              ?>
              </figure>
              <figure class="span2" style="margin-top: 20px">
                <?= $form->textField(
                    $model,
                    'verify_code',
                    [
                      'class'       => 'comm-field',
                      'placeholder' => 'Код з картинки',
                      'style' => 'width: 150px'
                    ]
                  ); 
                ?>
              </figure>
            </li>
        <? endif; ?>

        <li>
          <input name="" type="submit" class="send-btn" value="Надіслати">
        </li>
      </ul>
    <? $this->endWidget(); ?>

  </figure>

  <figure class="span4">
    <h2>Наша адреса</h2>
    <ul class="contact-list">
      <li class="phone"><?= $site_settings->phone_1 . ($site_settings->phone_2 ? ', ' . $site_settings->phone_2 : ''); ?></li>
      <li class="mail"><a href="#"><?= $site_settings->email ?></a></li>
      <li class="address"><?= $site_settings->address; ?></li>
    </ul>
  </figure>
</section>

<script>
  $(function(){
    $('.contact-us-form').on('ajax:success', function(){
      this.reset();
      $('img.form-captha').click();
      alert('Ми отримали ваше повідомлення і дамо відповідь якомога швидше!');
      return false;
    });
  });
</script>