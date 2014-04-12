<?
    Yii::app()->clientScript->registerPackage( 'jqueryForm' );
?>


<? $form = $this->beginWidget('CActiveForm', [
    'action' => $form_action
]); ?>

    <? foreach(['old', 'new', 'confirm'] as $attribute): ?>
        <div class="form-group <? if ($model->hasErrors($attribute)): ?> has-error <? endif; ?>">
            <label class="control-label"><?= $model->getAttributeLabel($attribute); ?></label>
            <?= $form->passwordField($model, $attribute, ['class' => 'form-control', 'value' => '']); ?>

            <? if ($model->hasErrors($attribute)): ?>
                <span class="error"><?= $model->getError($attribute)?></span>
            <? endif; ?>
        </div>
    <? endforeach; ?>

    <hr>
    <div class="form-group">
        <button class="btn btn-success" type="submit">Save</button>
    </div>
<? $this->endWidget(); ?>