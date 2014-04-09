<h2>Напишіть нам</h2>
<? $form = $this->beginWidget('CActiveForm', [
	'action'      => url('contactUs/create'),
	'htmlOptions' => [ 'class' => 'ajax-form contact-us-widget' ]
]); ?>

	<?= $form->textField($model, 'name', ['class' => 'f-field', 'placeholder' => 'Ім\'я']); ?>
	<?= $form->emailField($model, 'email', ['class' => 'f-field', 'placeholder' => 'Електронна пошта']); ?>
	<?= $form->telField($model, 'phone', ['class' => 'f-field', 'placeholder' => 'Телефон']); ?>
	<?= $form->textArea($model, 'content', ['class' => 'f-area', 'placeholder' => 'Повідомлення', 'cols' => 4, 'rows' => 15, 'style' => 'height: 80px']); ?>
  	<? if(CCaptcha::checkRequirements()): ?>
	     <figure class="span4">
	         <?
		         $this->widget(
		             'CCaptcha',
		             [
						'captchaAction'     => 'captcha/new' ,
						'showRefreshButton' => FALSE,
						'buttonLabel'       => _('Обновить'),
						'imageOptions' => [
						 'class' => 'captcha-img author-img',
						 'title' => 'Клацніть, щоб обновити картинку'
						],
						'clickableImage' => TRUE
		            ]
		         );
	         ?>
	     </figure>
	     <figure class="span7" style="margin-top: 27px">
		     <?= $form->textField(
		             $model,
		             'verify_code',
		             array(
						'class'       => 'f-field',
						'placeholder' => 'Код з картинки'
		             )
		         ); ?>
		         <?= $form->error($model, 'verify_code'); ?>
		    <? endif; ?>
	    </figure>
	    <div class="clearfix"></div>
  	<input name="" type="submit" class="send-btn" value="Надіслати">
<? $this->endWidget(); ?>

<script>
	$(function(){
		$('.contact-us-widget').on('ajax:success', function(){
			$(this).reset();
			$('img.captcha-img').click();
		});
	});
</script>