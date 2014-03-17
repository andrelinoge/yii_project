<?
/** @var $this BackendController */
$this->breadcrumbs = [
    ['name' => 'Images']
];

?>



<div class="row">
    <?
        $this->renderPartial('_index', [
            'data_provider' => $data_provider
        ]);
    ?>

    <div class="clearfix"></div>

    <div class="sp"></div>

    <div class="col-md-12">
        <div class="pull-right">
            <a href="#" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Upload</a>
        </div>
    </div>  

</div>