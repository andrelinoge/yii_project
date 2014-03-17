<?php
/**
 * @author: Andriy Tolstokorov
 */

/** @var $model BaseMultilingualForm */

Yii::app()
    ->clientScript
    ->registerPackage( 'jqueryForm' );
?>

<?= CHtml::beginForm( $action, 'post', array( 'onsubmit' => 'return backendController.ajaxSubmitForm(this)', 'name' => get_class( $model ) ) ); ?>

    <?= FormDecorator::textField( $model, 'name' ); ?>
    <?= FormDecorator::textField( $model, 'email' ); ?>
    <?= FormDecorator::textField( $model, 'password' ); ?>

    <div class="footer tar">
        <?= CHtml::submitButton('Save', array( 'class' => 'btn' ) ); ?>
    </div>
<?= CHtml::endForm(); ?>
