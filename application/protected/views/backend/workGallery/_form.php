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

    <div class="form-group <? if ($model->hasErrors('image')): ?> has-error <? endif; ?>">
        <? if ($model->image): ?>
            <div class="pull-left col-md-2">
                <div class="block">
                    <div class="block-content">
                        <img class="fancybox" src="<?= $model->file->get_image_url('s'); ?>">
                    </div>
                </div>
            </div>
        <? endif; ?>

        <div class="pull-left">
            <label class="control-label">Image</label>
            <?= $form->fileField($model, 'image'); ?>

            <? if ($model->hasErrors('image')): ?>
                <span class="error"><?= $model->getError('image')?></span>
            <? endif; ?>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="form-group" <? if ($model->hasErrors('category_id')): ?> has-error <? endif; ?>>
        <label class="control-label">Category</label>

        <?= $form->dropDownList(
            $model, 
            'category_id', 
            ['' => '[Select category]'] + GalleryCategory::model()->get_titles_list()
            , ['class' => 'form-control']
        ); ?>

        <? if ($model->hasErrors('category_id')): ?>
            <span class="error"><?= $model->getError('category_id')?></span>
        <? endif; ?>
    </div>

    <div class="form-group <? if ($model->hasErrors('title')): ?> has-error <? endif; ?>">
        <label class="control-label">Title</label>
        <?= $form->textField($model, 'title', ['class' => 'form-control']); ?>

        <? if ($model->hasErrors('title')): ?>
            <span class="error"><?= $model->getError('title')?></span>
        <? endif; ?>
    </div>

    <div class="form-group <? if ($model->hasErrors('description')): ?> has-error <? endif; ?>">
        <label class="control-label">Description</label>
        <?= $form->textArea($model, 'description', ['class' => 'form-control']); ?>

        <? if ($model->hasErrors('description')): ?>
            <span class="error"><?= $model->getError('description')?></span>
        <? endif; ?>
    </div>

    <hr>
    <div class="form-group">
        <button class="btn btn-success" type="submit">Зберегти</button>
    </div>
<? $this->endWidget(); ?>