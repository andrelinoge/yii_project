<?
/** @var $this BackendController */
$this->breadcrumbs = [
    [
        'title' => 'Зображення', 
        'url'   => url('image/index', ['owner_id' => $model->owner_id, 'type' => $model->type])
    ],
    [ 'title' => 'Нове' ]
];

?>

<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-head">
                <h2>Нове зображення</h2>
            </div>

            <div class="block-content">
                <? $this->renderPartial(
                    '_form',
                    [
                        'model'       => $model,
                        'form_action' => $this->createUrl('create')
                    ]
                ); ?>
            </div>
        </div>
    </div>
</div>