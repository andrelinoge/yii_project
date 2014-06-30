<?
/** @var $this BackendController */
$this->breadcrumbs = [
    ['title' => 'Замовлення з розрахунками']
];
?>

<div class="row">

<div class="col-md-12">

<div class="block">
    <div class="block-head">
        <h2>Замовлення з розрахунками</h2>
    </div>

    <div class="block-content np">
        <?
            $this->renderPartial('_index', [
                'data_provider' => $data_provider,
                'model'         => $model
            ]);
        ?>
    </div>

</div>


</div>

</div>