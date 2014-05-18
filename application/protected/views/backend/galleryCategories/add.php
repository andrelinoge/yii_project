<?
/** @var $this BackendController */
$this->breadcrumbs = [
    ['title' => 'Категорії', 'url' => url('articleCategories/index')],
    ['title' => 'Нова категорія']
];
?>

<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-head">
                <h2>Нова категорія</h2>
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