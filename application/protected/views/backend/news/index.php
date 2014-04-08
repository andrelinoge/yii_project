<?
/** @var $this BackendController */
$this->breadcrumbs = [
    ['title' => 'News']
];
?>

<div class="row">

<div class="col-md-12">

<div class="block">
    <div class="block-head">
        <h2>Articles</h2>
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

<div class="pull-right">
    <a href="<?= $this->createUrl('new'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
</div>


</div>

</div>