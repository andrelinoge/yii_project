<?
    Yii::app()->clientScript->registerPackage( 'jqueryForm' )->registerPackage( 'ckEditor' );
    /**
     * @var CActiveForm $form
     * @var CModel $model
     */
?>


<? $form = $this->beginWidget('CActiveForm', [
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'action' => $form_action,
    'focus' => array($model,'title'),
    'htmlOptions' => [ 'enctype' => "multipart/form-data" ]
]); ?>

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

    <hr>
    <div class="form-group">
        <button class="btn btn-success" type="submit">Save</button>
    </div>
<? $this->endWidget(); ?>