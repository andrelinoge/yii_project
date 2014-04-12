<?
    Yii::app()->clientScript->registerPackage( 'jqueryForm' )->registerPackage( 'ckEditor' );
    /**
     * @var CActiveForm $form
     * @var CModel $model
     */
?>


<? $form = $this->beginWidget('CActiveForm', [
    'enableAjaxValidation'   => false,
    'enableClientValidation' => false,
    'action'                 => $form_action,
]); ?>

    <? foreach(['phone_1', 'phone_2', 'email', 'address'] as $attribute): ?>
        <div class="form-group <? if ($model->hasErrors($attribute)): ?> has-error <? endif; ?>">
            <label class="control-label"><?= $model->getAttributeLabel($attribute); ?></label>
            <?= $form->textField($model, $attribute, ['class' => 'form-control']); ?>

            <? if ($model->hasErrors($attribute)): ?>
                <span class="error"><?= $model->getError($attribute)?></span>
            <? endif; ?>
        </div>
    <? endforeach; ?>

    <div class="form-group <? if ($model->hasErrors('google_map')): ?> has-error <? endif; ?>">
        <label class="control-label"><?= $model->getAttributeLabel('google_map'); ?></label>
        <?= $form->textArea($model, 'google_map', ['class' => 'form-control']); ?>

        <? if ($model->hasErrors('google_map')): ?>
            <span class="error"><?= $model->getError('google_map')?></span>
        <? endif; ?>
    </div>

    <hr>
    <div class="form-group">
        <button class="btn btn-success" type="submit">Save</button>
    </div>
<? $this->endWidget(); ?>