<div class="widget-item">
    <div class="request-information">
        <h4 class="widget-title">Виклик замірника</h4>
          <? 
            $form = $this->beginWidget('CActiveForm', [
              'action'      => url('sizerRequest/create'),
              'htmlOptions' => [ 'class' => 'ajax-form sizer-widget-form request-info clearfix' ]
            ]); 
          ?>
          <div class="full-row">
              <label for="yourname">Name:</label>
              <?= $form->textField($model, 'name'); ?>
          </div>

          <div class="full-row">
              <label for="email-id">Phone:</label>
              <?= $form->textField($model, 'phone'); ?>
          </div>

          <div class="full-row">
              <label for="email-id">Address:</label>
              <?= $form->textField($model, 'address'); ?>
          </div>
          
          <div class="full-row">
              <div class="submit_field">
                  <input type="submit" value="Надіслати" name="" class="mainBtn pull-right">
              </div>
          </div>
        <? $this->endWidget(); ?>
    </div>
</div>