<? $form = $this->beginWidget('CActiveForm', ['action' => $form_action]); ?>
    <? foreach(['name', 'price', 'count'] as $attribute): ?>
        <div class="form-group <? if ($model->hasErrors($attribute)): ?> has-error <? endif; ?>">
            <label class="control-label"><?= $model->getAttributeLabel($attribute)?></label>
            <?= $form->textField($model, $attribute, ['class' => 'form-control']); ?>

            <? if ($model->hasErrors($attribute)): ?>
                <span class="error"><?= $model->getError($attribute)?></span>
            <? endif; ?>
        </div>
    <? endforeach; ?>

    <div class="form-group" <? if ($model->hasErrors('construction_type')): ?> has-error <? endif; ?>>
        <label class="control-label">Тип конструкції</label>

        <?= $form->dropDownList(
            $model, 
            'construction_type', 
            [null => '[Вибір системи]'] + CalcForm::construction_types()
            , ['class' => 'form-control']
        ); ?>

        <? if ($model->hasErrors('construction_type')): ?>
            <span class="error"><?= $model->getError('construction_type')?></span>
        <? endif; ?>
    </div>

    <hr>
    <div class="form-group">
        <button class="btn btn-success" type="submit">Зберегти</button>
    </div>
<? $this->endWidget(); ?>