<?
/** @var $this BackendController */
$this->breadcrumbs = [
    [
        'title' => 'Слайдер', 
        'url'   => url('slider/index', ['owner_id' => $model->owner_id, 'type' => $model->type])
    ],
    [ 'title' => 'Редагувати зображення' ]
];

?>

<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-head">
                <h2>Edit article "<?= $model->title; ?>"</h2>
            </div>

            <div class="block-content">
                <? $this->renderPartial(
                    '_form',
                    [
                        'model'       => $model,
                        'form_action' => $this->createUrl('update', ['id' => $model->id])
                    ]
                ); ?>
            </div>
        </div>
    </div>
</div>