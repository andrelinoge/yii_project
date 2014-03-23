<div class="col-md-3 thumbnail-block">
    <div class="block">
        <div class="block-content">
            <a rel="group" class="fancybox" href="<?= $data->get_image_url(); ?>">
                <img class="img-rounded img-responsive" src="<?= $data->get_image_url('s'); ?>">
            </a>
        </div>
        <div class="block-content npt text-muted">
            <div class="pull-left">
                <a href="<?= url('images/edit', ['id' => $data->id]); ?>"><i class="fa fa-pencil"></i></a>
                <a href="<?= url('images/delete', ['id' => $data->id]); ?>" class="delete-image"><i class="fa fa-times"></i></a>
            </div>
            <div class="pull-right">
                <?
                    if (!empty($data->title))
                    {   
                        echo Text::truncate($data->title, 20, true); 
                    }
                    else
                    {
                        echo 'No title';
                    }
                ?>
            </div>
        </div>
    </div>                            
</div>