<?php
/**
 * @author: Andriy Tolstokorov
 */

/** @var galleryItems Slider[] */

Yii::app()
    ->clientScript
    ->registerPackage( 'jqueryForm' )
    ->registerPackage( 'fileUploader' )
    ->registerPackage( 'uploader' )
    ->registerPackage( 'jeditable' );
?>


<script type="text/javascript">
    jQuery( document ).ready( function(){
        backendController = new backendControllerClass();
        uploadController = new uploadControllerClass();

        uploadController.initGalleryImageUploader(
            '<?= $createNewUrl; ?>',
            'uploadButton',
            {
                'allowedExtensions':[ 'jpg', 'png' ],
                'sizeLimit':20000000
            }
        );

        $( '.uploader_target').each(
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

        $( '.editable_alt' ).each(
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

        $( '.editable_title' ).each(function(){
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

        $( '#gallery' ).on(
            'click',
            'a.delete-btn',
            function( event )
            {
                if ( confirm( '<?= _( 'Delete slide?' ); ?>') )
                {
                    var $caller = $( event.target );
                    backendController.ajaxPost(
                        $caller.attr( 'href' ),
                        {},
                        function()
                        {
                            $( '#item_' + $caller.data( 'item_id' )).remove();
                            gallery();
                            thumbs();
                        }
                    );
                }

                return false;
            }
        );

    });
</script>


<div class="row-fluid">

    <div class="span12">
        <div class="head clearfix">
            <div class="isw-picture"></div>
            <h1><?= _( 'Слайдер' ); ?></h1>
        </div>
        <div class="block-fluid thumbs clearfix">
            <div id="gallery">
                <? foreach( $galleryItems as $item ): ?>
                    <div class="thumbnail slider" id="item_<?= $item->item_id; ?>" >
                        <a class="fancybox"
                           id = "fancy_item_<?= $item->getItemId(); ?>"
                           rel="group"
                           href="<?= $item->getOriginalImage(); ?>">
                            <img src="<?= $item->getMediumThumbnail(); ?>"
                                 id = "fancy_thumb_<?= $item->getItemId(); ?>"
                                 class="img-polaroid slider" />
                        </a>

                        <div class="clearfix"></div>
                        <br/>

                        <div class="caption">
                            <p>
                                <div class="btn btn-warning uploader_target"
                                     data-item_id = "<?= $item->getItemId(); ?>"
                                   id="upload_<?= $item->getItemId(); ?>">
                                    <?= _( 'Загрузить новый' ); ?>
                                </div>

                                <a class="btn btn-danger delete-btn"
                                   data-item_id = "<?= $item->item_id; ?>"
                                   href="<?= $this->createUrl( $actionDelete, array( 'itemId' => $item->item_id ) ); ?>">
                                    <?= _( 'удалить' ); ?>
                                </a>
                            </p>
                            <div class="block-fluid tabs">
                                <ul>
                                    <? foreach( $model->getLanguages( TRUE ) as $language => $description ): ?>
                                        <li>
                                            <a href="#tabs-<?= $language . '-' . $item->item_id; ?>"><?= $description; ?></a>
                                        </li>
                                    <? endforeach; ?>
                                </ul>
                                <?php foreach( $model->getLanguages() as $language ): ?>
                                    <div id="tabs-<?= $language . '-' . $item->item_id; ?>" style="height: 150px">
                                        <p>
                                            <div class = "editable_alt text-info"
                                                 data-item_id = "<?= $item->item_id; ?>"
                                                 data-lang = "<?= $language; ?>"><?= $item->getAltByLang( $language ); ?></div>
                                        </p>

                                        <p>
                                            <div class = "editable_title text-info"
                                                 data-item_id = "<?= $item->item_id; ?>"
                                                 data-lang = "<?= $language; ?>"><?= $item->getTitleByLang( $language ); ?></div>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                <? endforeach;?>
            </div>

            <div class="clearfix"></div>
            <div class="upload_btn_wrapper">
                <div class="btn" id="uploadButton"><?= _( 'Upload' ); ?></div>
            </div>
        </div>
    </div>

</div>

<div class="dr"><span></span></div>