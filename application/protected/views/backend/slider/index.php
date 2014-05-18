<?

$assets = $this->get_behavioral_url();

Yii::app()->clientScript
    ->registerPackage('uploader')
    ->registerScriptFile($assets . '/js/controllers/imageController.js');
?>

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
            <a href="#" class="btn btn-primary" id="uploader"><i class="fa fa-plus-circle"></i> Завантажити</a>
        </div>
    </div>  

</div>

<script type="text/javascript">
  $(function(){
    var uploader = new UploaderController();
    var image_controller = new ImageController();

    image_controller.initialize_index_page();

    uploader.initialize(
        '<?= url("slider/upload", ["type" => "Slider"]); ?>',
        'uploader',
        {
            onComplete: function(id, fileName, response)
            {
                var $container = $('div.images:first');

                if ($container.find('ul.thumbnails').length == 0)
                {
                    $container.html('<ul class="thumbnails"></ul>');
                    $container = $container.find('ul.thumbnails');
                }

                $container.append(response.html);
                $('.scroll').mCustomScrollbar("update");
            }
        }
    );
  });
</script>