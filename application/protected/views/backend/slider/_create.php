<?
/**
 * @var $model BaseImageGalleryML
 */
?>

<div class="thumbnail slider" id="item_<?= $model->item_id; ?>">
    <a class="fancybox"
       id = "fancy_item_<?= $model->getItemId(); ?>"
       rel="group"
       href="<?= $model->getOriginalImage(); ?>">
        <img src="<?= $model->getMediumThumbnail(); ?>"
             id = "fancy_thumb_<?= $model->getItemId(); ?>"
             class="img-polaroid slider" />
    </a>

    <div class="clearfix"></div>
    <br/>

    <div class="caption">
        <p>
        <div class="btn btn-warning uploader_target"
             data-item_id = "<?= $model->getItemId(); ?>"
             id="upload_<?= $model->getItemId(); ?>">
            <?= _( 'Загрузить новый' ); ?>
        </div>

        <a class="btn btn-danger delete-btn"
           data-item_id = "<?= $model->item_id; ?>"
           href="<?= $this->createUrl( $actionDelete, array( 'itemId' => $model->item_id ) ); ?>">
            <?= _( 'удалить' ); ?>
        </a>
        </p>
        <div class="block-fluid tabs">
            <ul>
                <? foreach( $model->getLanguages( TRUE ) as $language => $description ): ?>
                    <li>
                        <a href="#tabs-<?= $language . '-' . $model->item_id; ?>"><?= $description; ?></a>
                    </li>
                <? endforeach; ?>
            </ul>
            <?php foreach( $model->getLanguages() as $language ): ?>
                <div id="tabs-<?= $language . '-' . $model->item_id; ?>" style="height: 150px">
                    <p>
                    <div class = "editable_alt text-info"
                         data-item_id = "<?= $model->item_id; ?>"
                         data-lang = "<?= $language; ?>"><?= $model->getAltByLang( $language ); ?></div>
                    </p>

                    <p>
                    <div class = "editable_title text-info"
                         data-item_id = "<?= $model->item_id; ?>"
                         data-lang = "<?= $language; ?>"><?= $model->getTitleByLang( $language ); ?></div>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
    $( '#item_<?= $model->item_id; ?> .uploader_target').each(
        function()
        {
            var $this = $( this );
            uploadController.initGalleryUpdateUploader(
                '<?= $updateItemUrl; ?>',
                $this.attr( 'id' ),
                {
                    'allowedExtensions':[ 'jpg', 'png' ],
                    'sizeLimit':20000000
                },
                {
                    item_id : $this.data( 'item_id' )
                }
            );
        }
    );

    $( '#item_<?= $model->item_id; ?> .editable_alt' ).each(
        function()
        {
            var $this = $( this );

            $this.editable(
                '<?= $updateAltUrl; ?>',
                {
                    cancel    : '<?= _( 'отмена' ) ;?>',
                    submit    : '<?= _( 'сохранить' ) ;?>',
                    indicator : '<img src="/application/public/backend/js/plugins/jeditable/img/indicator.gif">',
                    tooltip   : '<?= _( 'Click to edit alt text...' ); ?>',
                    name      : 'alt',
                    onblur    : 'ignore',
                    cssclass     : 'jEditableForm',
                    submitdata: { lang : $this.data( 'lang' ), itemId : $this.data( 'item_id' ) }

                }
            );
        }
    );

    $( '#item_<?= $model->item_id; ?> .editable_title' ).each(function(){
        var $this = $( this );

        $this.editable(
            '<?= $updateTitleUrl; ?>',
            {
                cancel    : '<?= _( 'отмена' ) ;?>',
                submit    : '<?= _( 'сохранить' ) ;?>',
                indicator : '<img src="/application/public/backend/js/plugins/jeditable/img/indicator.gif">',
                tooltip   : '<?= _( 'Click to edit title...' ); ?>',
                name      : 'title',
                onblur    : 'ignore',
                cssclass     : 'jEditableForm',
                submitdata: { lang : $this.data( 'lang' ), itemId : $this.data( 'item_id' ) }

            }
        );
    });

    $( "#item_<?= $model->item_id; ?> .tabs" ).tabs();

    thumbs();
    });
</script>