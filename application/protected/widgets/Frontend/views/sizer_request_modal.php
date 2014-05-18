<div class="modal fade" id="sizer">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Виклик замірника</h4>
      </div>

      <div class="modal-body">
        <div class="comment-form">
              <? 
                $form = $this->beginWidget('CActiveForm', [
                  'action'      => url('sizerRequest/create'),
                  'htmlOptions' => [ 'class' => 'ajax-form sizer-widget-modal-form clearfix', 'name' => get_class($model) ]
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
                          'captchaAction'     => 'captcha/sizerModal' ,
                          'showRefreshButton' => false,
                          'buttonLabel'       => _('Обновить'),
                          'imageOptions' => [
                            'class' => 'modal-sizer-captha author-img',
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
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
  $(function(){
    $('.sizer-widget-modal-form').on('ajax:success', function(event) {
      if (event.response.success == true)
      {
        $('#sizer').modal('hide');
        this.reset();
        alert('Ми отримали ваше повідомлення і дамо відповідь якомога швидше!');
      }
      
      $('img.modal-sizer-captha').click();
      return false;
    });
  });
</script>