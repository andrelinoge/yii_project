<?
/** @var $this BackendController */
$this->breadcrumbs = [
    ['name' => 'Images']
];

Yii::app()->clientScript->registerPackage('uploader');


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
            <a href="#" class="btn btn-primary" id="uploader"><i class="fa fa-plus-circle"></i> Upload</a>
        </div>
    </div>  

</div>

<script type="text/javascript">
  $(function(){
    var uploader = new UploaderController();

    uploader.initialize(
        '<?= url("images/upload", ["owner_id" => get_param("owner_id"), "type" => get_param("type")]); ?>',
        'uploader',
        {
            onComplete: function(id, fileName, response)
            {
                $('div.images:first > ul.thumbnails').append(response.html);
                $('.scroll').mCustomScrollbar("update");
            }
        }
    );
  });
</script>