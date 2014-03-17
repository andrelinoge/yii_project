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

    <div class="form-group" <? if ($model->hasErrors('category')): ?> has-error <? endif; ?>>
        <label class="control-label">Category</label>
        <select class="form-control">
            <option>1</option>
        </select>

        <? if ($model->hasErrors('category')): ?>
            <span class="error"><?= $model->getError('category')?></span>
        <? endif; ?>
    </div>

    <div class="form-group <? if ($model->hasErrors('cover_image')): ?> has-error <? endif; ?>">
        <? if ($model->cover_image): ?>
            <div class="pull-left col-md-2">
                <div class="block">
                    <div class="block-content">
                        <img class="fancybox" src="<?= $model->cover->get_image_url('s'); ?>">
                    </div>
                </div>
            </div>
        <? endif; ?>

        <div class="pull-left">
            <label class="control-label">Cover</label>
            <?= $form->fileField($model, 'cover_image'); ?>

            <? if ($model->hasErrors('cover_image')): ?>
                <span class="error"><?= $model->getError('cover_image')?></span>
            <? endif; ?>
        </div>
    </div>

    <div class="clearfix"></div>


    <div class="form-group <? if ($model->hasErrors('text')): ?> has-error <? endif; ?>">
        <label class="control-label">Text</label>
        <?= $form->textArea($model, 'text', ['class' => 'ckeditor']); ?>

        <? if ($model->hasErrors('text')): ?>
            <span class="error"><?= $model->getError('text')?></span>
        <? endif; ?>
    </div>

    <div class="form-group <? if ($model->hasErrors('meta_keywords')): ?> has-error <? endif; ?>">
        <label class="control-label">Meta keywords</label>
        <?= $form->textArea($model, 'meta_keywords'); ?>

        <? if ($model->hasErrors('meta_keywords')): ?>
            <span class="error"><?= $model->getError('meta_keywords')?></span>
        <? endif; ?>
    </div>

    <div class="form-group <? if ($model->hasErrors('meta_description')): ?> has-error <? endif; ?>">
        <label class="control-label">Meta description</label>
        <?= $form->textArea($model, 'meta_description'); ?>

        <? if ($model->hasErrors('meta_description')): ?>
            <span class="error"><?= $model->getError('meta_description')?></span>
        <? endif; ?>
    </div>

    <hr>
    <div class="form-group">
        <button class="btn btn-success" type="submit">Save</button>
    </div>
<? $this->endWidget(); ?>