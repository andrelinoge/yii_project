<? $this->widget('application.widgets.Common.BreadCrumbs', [
    'default_title' => 'Головна', 
    'view'          => 'frontend',
    'items'         => $this->breadcrumbs
]); ?>

<div class="container">
    <div class="row">

        <div class="col-md-5">
            <div class="contact-map">
                <?= $site_settings->google_map; ?>
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
                        'htmlOptions' => [ 
                          'class' => 'ajax-form contact-us-form',
                          'name'  => get_class($model)
                        ]
                      ]); 
                    ?>
                    <p class="full-row">
                        <span class="contact-label">
                            <label for="name-id">Ім'я:</label>
                        </span>
                        <?= $form->textField($model, 'name'); ?>
                    </p>

                    <p class="full-row"> 
                        <span class="contact-label">
                            <label for="surname-id">Телефон:</label>
                        </span>
                        <?= $form->textField($model, 'phone'); ?>
                    </p>

                    <? if(CCaptcha::checkRequirements()): ?>
                      <p class="full-row">
                        <span class="contact-label">
                          <label>Код з картинки:</label>
                        </span>
                        <?
                          $this->widget(
                            'CCaptcha',
                            [
                              'captchaAction'     => 'captcha/contactNew' ,
                              'showRefreshButton' => false,
                              'buttonLabel'       => _('Обновити'),
                              'imageOptions' => [
                              'class' => 'form-captha author-img',
                              'title' => 'Клацніть, щоб обновити картинку',
                              'style' => 'float:right'
                            ],
                              'clickableImage' => true
                            ]
                          );
                        ?>
                        <?= $form->textField( $model, 'verify_code' ); ?>
                      </p>
                    <? endif; ?>

                    <p class="full-row">
                        <span class="contact-label">
                            <label for="message">Повідомлення:</label>
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
    $('.contact-us-form').on('ajax:success', function(event) {
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