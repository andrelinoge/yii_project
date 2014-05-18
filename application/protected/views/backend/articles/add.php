<?
/** @var $this BackendController */
$this->breadcrumbs = [
    ['title' => 'Статті', 'url' => url('articles/index')],
    ['title' => 'Додати статтю']
];
?>

<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-head">
                <h2>Додати статтю</h2>
            </div>

            <div class="block-content">
                <? $this->renderPartial(
                    '_form',
                    [
                        'model' => $model,
                        'form_action' => $this->createUrl('create')
                    ]
                ); ?>
            </div>
        </div>
    </div>
</div>