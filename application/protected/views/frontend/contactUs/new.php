<?= $site_settings->google_map; ?>

<div class="container">
    <div class="row">

        <div class="col-md-5">
            <div class="contact-map">
                <div class="google-map-canvas" id="map-canvas" style="height: 542px;">
                </div>
            </div>
        </div> <!-- /.col-md-5 -->
        
        <div class="col-md-7">
            <div class="contact-page-content">
                <div class="contact-heading">
                    <h3>Напишіть нам</h3>
                    <p><?= $content; ?></p>
                </div>

                <div class="contact-form clearfix">
                    <? 
                      $form = $this->beginWidget('CActiveForm', [
                        'action'      => url('contactUs/create'),
                        'htmlOptions' => [ 'class' => 'ajax-form contact-us-form' ]
                      ]); 
                    ?>
                    <p class="full-row">
                        <span class="contact-label">
                            <label for="name-id">Name:</label>
                        </span>
                        <?= $form->textField($model, 'name'); ?>
                    </p>

                    <p class="full-row"> 
                        <span class="contact-label">
                            <label for="surname-id">Phone:</label>
                        </span>
                        <?= $form->textField($model, 'phone'); ?>
                    </p>

                    <? if(CCaptcha::checkRequirements()): ?>
                      <p class="full-row">
                        <span class="contact-label">
                          <label>Код з картинки:</label>
                        </span>
                        <?= $form->textField( $model, 'verify_code' ); ?>
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
                      </p>
                    <? endif; ?>

                    <p class="full-row">
                        <span class="contact-label">
                            <label for="message">Message:</label>
                        </span>
                        <?= $form->textArea($model, 'content', ['rows' => '6']); ?>
                    </p>

                    <p class="full-row">
                        <input class="mainBtn" type="submit" name="" value="Надіслати">
                    </p>

                    <? $this->endWidget(); ?>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
  $(function(){
    $('.contact-us-form').on('ajax:success', function() {
      this.reset();
      $('img.form-captha').click();
      alert('Ми отримали ваше повідомлення і дамо відповідь якомога швидше!');
      return false;
    });
  });
</script>