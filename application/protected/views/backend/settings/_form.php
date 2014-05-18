<? Yii::app()->clientScript->registerPackage( 'jqueryForm' ); ?>


<? $form = $this->beginWidget('CActiveForm', [
    'action' => $form_action,
    'focus'  => [$model, 'phone_1']
]); ?>

    <? foreach(['phone_1', 'phone_2', 'phone_3', 'skype', 'address'] as $attribute): ?>
        <div class="form-group <? if ($model->hasErrors($attribute)): ?> has-error <? endif; ?>">
            <label class="control-label"><?= $model->getAttributeLabel($attribute); ?></label>
            <?= $form->textField($model, $attribute, ['class' => 'form-control']); ?>

            <? if ($model->hasErrors($attribute)): ?>
                <span class="error"><?= $model->getError($attribute)?></span>
            <? endif; ?>
        </div>
    <? endforeach; ?>

    <div class="form-group">
        <label class="control-label"><?= $model->getAttributeLabel('google_map'); ?></label>
        <?= $form->textArea($model, 'google_map', ['class' => 'form-control']); ?>
    </div>

    <hr>
    <div class="form-group">
        <button class="btn btn-success" type="submit">Save</button>
    </div>
<? $this->endWidget(); ?>