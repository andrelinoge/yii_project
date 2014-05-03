<?
    $this->breadcrumbs = [
        ['title' => 'Static pages']
    ];
?>

<div class="row">

<div class="col-md-12">

<div class="block">
    <div class="block-head">
        <h2>Static pages</h2>
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

<div class="clearfix"></div>

<div class="sp"></div>

</div>

</div>