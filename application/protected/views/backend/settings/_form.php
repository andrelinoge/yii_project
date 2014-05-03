<? Yii::app()->clientScript->registerPackage( 'jqueryForm' ); ?>


<? $form = $this->beginWidget('CActiveForm', [
    'action' => $form_action,
    'focus'  => [$model, 'phone_1']
]); ?>

    <? foreach(['phone_1', 'phone_2', 'address', 'google_map'] as $attribute): ?>
        <div class="form-group <? if ($model->hasErrors($attribute)): ?> has-error <? endif; ?>">
            <label class="control-label"><?= $model->getAttributeLabel($attribute); ?></label>
            <?= $form->textField($model, $attribute, ['class' => 'form-control']); ?>

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