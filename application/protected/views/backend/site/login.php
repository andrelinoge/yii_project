<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

Yii::app()
    ->clientScript
    ->registerPackage( 'jqueryForm' );
?>


<div class="block-login-content">
    <h1>Sign in</h1>

    <?= CHtml::beginForm(
        '',
        'post',
        [
            'id' => 'login-form',
            'name' => get_class( $model ),
            'class' => 'ajax-form'
        ]
    );
    ?>

        <div class="form-group">
            <?= CHtml::activeTextField(
                $model,
                'email',
                [
                    'placeholder' => 'Email',
                    'class' => 'form-control'
                ]
            );
            ?>
        </div>

        <div class="form-group">
            <?= CHtml::activePasswordField(
                $model,
                'password',
                [
                    'placeholder' => 'Password',
                    'class' => 'form-control'
                ]
            );
            ?>
        </div>


        <button class="btn btn-primary btn-block" type="submit">Sign in</button>

    <?= CHtml::endForm(); ?>

    <div class="sp"></div>
    <div class="pull-left">
        © All Rights Reserved 2014
    </div>
</div>