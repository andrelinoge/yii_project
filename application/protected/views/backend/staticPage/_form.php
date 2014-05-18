<?
    Yii::app()->clientScript->registerPackage( 'jqueryForm' )->registerPackage( 'ckEditor' );

    $form = $this->beginWidget('CActiveForm', [
        'enableAjaxValidation'   => false,
        'enableClientValidation' => false,
        'action'                 => $form_action,
        'focus'                  => [$model, 'title']
    ]); 
?>

    <div class="form-group <? if ($model->hasErrors('title')): ?> has-error <? endif; ?>">
        <label class="control-label">Title</label>
        <?= $form->textField($model, 'title', ['class' => 'form-control']); ?>

        <? if ($model->hasErrors('title')): ?>
            <span class="error"><?= $model->getError('title')?></span>
        <? endif; ?>
    </div>

    <div class="form-group <? if ($model->hasErrors('content')): ?> has-error <? endif; ?>">
        <label class="control-label">Text</label>
        <?= $form->textArea($model, 'content', ['class' => 'ckeditor']); ?>

        <? if ($model->hasErrors('content')): ?>
            <span class="error"><?= $model->getError('content')?></span>
        <? endif; ?>
    </div>

    <div class="form-group <? if ($model->hasErrors('meta_keywords')): ?> has-error <? endif; ?>">
        <label class="control-label">Meta keywords</label>
        <?= $form->textField($model, 'meta_keywords', ['class' => 'form-control']); ?>

        <? if ($model->hasErrors('meta_keywords')): ?>
            <span class="error"><?= $model->getError('meta_keywords')?></span>
        <? endif; ?>
    </div>

    <div class="form-group <? if ($model->hasErrors('meta_description')): ?> has-error <? endif; ?>">
        <label class="control-label">Meta description</label>
        <?= $form->textArea($model, 'meta_description', ['class' => 'form-control']); ?>

        <? if ($model->hasErrors('meta_description')): ?>
            <span class="error"><?= $model->getError('meta_description')?></span>
        <? endif; ?>
    </div>

    <hr>
    <div class="form-group">
        <button class="btn btn-success" type="submit">Зберегти</button>
    </div>
<? $this->endWidget(); ?>