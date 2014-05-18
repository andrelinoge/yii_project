<?
/** @var $this SiteController */
/** @var $user User */
/** @var $login_form CFormModel*/
/** @var $form CActiveForm  */

Yii::app()->clientScript->registerScriptFile('/application/public/frontend/js/plugins/jquery.autocomplete.min.js');
?>

<ul class="nav nav-tabs" id="p-tabs">
    <li class="active">
        <a data-toggle="tab" href="#sign_in"><?= _('Вход'); ?></a>
    </li>
    <li class="">
        <a data-toggle="tab" href="#sign_up"><?= _('Зарегистрироваться'); ?></a>
    </li>
</ul>

<div class="tab-content box" id="p-tabs-content">
    <div id="sign_in" class="tab-pane fade active in">
        <div class="tab-clm-left">
            <h3 class="clearfix">
                <?= _('Вход в магазин');?>
            </h3>

            <div>
                <?= Form::begin($login_form, createUrl('session/create'), array('class' => 'ajax-form sign-in')); ?>

                    <?= Form::label($login_form,'email'); ?>
                    <?= Form::email($login_form,'email'); ?>

                    <label><?= _('Пароль'); ?></label>
                    <?= Form::password($login_form,'password'); ?>

                    <label class="checkbox">
                        <?= Form::checkbox($login_form, 'remember_me'); ?>
                        <?= _('Запомнить меня'); ?></label>

                    <?= Form::submit(_('Войти'), array('class' => 'btn')); ?>

                <?= Form::end_form(); ?>
            </div>
        </div>

    </div>

    <div id="sign_up" class="tab-pane fade">
        <div class="tab-clm-left">
            <h3 class="clearfix">
                <?= _('Регистрация');?>
            </h3>

            <div>
                <?= Form::begin($user, createUrl('users/create'), array('class' => 'ajax-form sign-up')); ?>

                    <?= Form::label($user,'name'); ?>
                    <?= Form::input($user,'name'); ?>

                    <?= Form::label($user,'email'); ?>
                    <?= Form::email($user,'email'); ?>

                    <label><?= _('Пароль'); ?></label>
                    <?= Form::password($user,'password'); ?>

                    <label><?= _('Повторить пароль'); ?></label>
                    <?= Form::password($user,'password_repeat'); ?>

                    <?= Form::label($user,'city'); ?>
                    <?= Form::input($user,'city', array('class' => 'auto-complete-city')); ?>

                    <?= Form::label($user,'phone_1'); ?>
                    <?= Form::input($user,'phone_1'); ?>

                    <?= Form::label($user,'phone_2'); ?>
                    <?= Form::input($user,'phone_2'); ?>

                    <?= Form::label($user,'sex'); ?>
                    <?= Form::radio_buttons($user, 'sex', array(User::SEX_BOY => _('М'), User::SEX_GIRL => _('Ж'))); ?>

                    <?= Form::submit(_('Зарегистрироваться'), array('class' => 'btn')); ?>

                <?= Form::end_form(); ?>
            </div>
        </div>
    </div>
</div>

