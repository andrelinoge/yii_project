<div class="col-md-3">                            
    <div class="block">
        <div class="block-content">
            <a rel="group" class="fancybox" href="<?= $data->get_image_url(); ?>">
                <img class="img-rounded img-responsive" src="<?= $data->get_image_url('s'); ?>">
            </a>
        </div>
        <div class="block-content npt text-muted">
            <div class="pull-left"><?= $data->text?></div>
        </div>
    </div>                            
</div>