<div class="row">
    <?
        $this->renderPartial($partial_view, [
            'data_provider' => $data_provider
        ]);
    ?>

    <div class="clearfix"></div>

    <div class="sp"></div>

    <div class="col-md-12">
        <div class="pull-right">
            <a href="<?= $this->createUrl('new'); ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Завантажити</a>
        </div>
    </div>  

</div>

