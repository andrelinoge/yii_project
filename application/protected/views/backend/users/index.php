<?php
/**
 * @author: Andriy Tolstokorov
 * Date: 12/4/12
 */

Yii::app()
    ->clientScript
    ->registerPackage( 'jqueryForm' );
/** @var $this BackendController */
?>

<?php if( Yii::app()->user->hasFlash( 'warning-message' ) ):?>
    <div class="alert alert-block">
        <h4><?= _( 'Warning!' ); ?></h4>
        <?= Yii::app()->user->getFlash( 'warning-message' ); ?>
    </div>
<?php endif; ?>

<?php if( Yii::app()->user->hasFlash( 'success-message' ) ):?>
    <div class="alert alert-block">
        <h4><?= _( 'success!' ); ?></h4>
        <?= Yii::app()->user->getFlash( 'success-message' ); ?>
    </div>
<?php endif; ?>

<div class="page-header">
    <h1><?= $pageTitle; ?></h1>
</div>

<?= $this->renderPartial( '_search-form', array( 'model' => $model, 'action' => $ajaxUpdateAction ) ); ?>

<div class="row-fluid">

    <div class="span12">
        <div class="head clearfix">
            <div class="isw-grid"></div>
            <h1><?= $listTitle; ?></h1>
            <ul class="buttons">
                <li>
                    <a href="#" class="isw-settings"></a>
                    <ul class="dd-list">
                        <li>
                            <a href="<?= $actionCreateUrl; ?>">
                                <span class="isw-plus"></span><?= _( 'новий' ); ?>
                            </a>
                        </li>
                        <!--
                        <li>
                            <a href="#"
                               onclick="return onGroupEdit( '<?//= $actionGroupEditUrl; ?>' );">
                                <span class="isw-edit"></span> <?//= _( 'редактировать' ); ?>
                            </a>
                        </li>
                        -->
                        <li>
                            <a href="<?= $actionGroupDeleteUrl; ?>"
                               onclick="return onGroupDelete( this );">
                                <span class="isw-delete"></span> <?= _( 'видалити' ); ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="block-fluid table-sorting clearfix">
            <?php
            $this->renderPartial(
                $partialView,
                array(
                    'model'         => $model,
                    'listHeaders'       => $listHeaders,
                    'listFilters'       => $listFilters,
                    'primaryField'      => $primaryField,
                    'groupingCheckboxName'  => $groupingCheckboxName,
                    'widgetWrapperId' => $widgetWrapperId, // this will be id of block and part of form id
                    'widgetFormId'  => $widgetFormId, // to access checkboxes via form id
                    'skipScripts'   => $skipScripts,
                    'actionCreateUrl' => $actionCreateUrl,
                    'isSortEnabled' => $isSortEnabled,
                    'messageDeleteConfirmation' => $messageDeleteConfirmation,
                    'dataProviderGetterMethod' => $dataProviderGetterMethod,
                    'rowCellsGetterMethod' => $rowCellsGetterMethod,
                    'listGirdView' => $listGirdView,
                    'ajaxUpdateAction' => $ajaxUpdateAction,
                    'actionDelete'      => $actionDelete,
                    'actionEdit'      => $actionEdit,
                    'actionView'      => $actionView,
                    'enableViewing' => $enableViewing
                )
            );
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    // as param send only action url, set it as action for widget form (form that wraps table)
    function onGroupEdit( actionUrl ) {
        jQuery( '#<?= $widgetFormId; ?>' ).attr( 'action', actionUrl ).submit();
        return false;
    }

    // as param send only action url, set it as action for widget form (form that wraps table)
    function onGroupDelete( actionUrl ) {
        jQuery( '#<?= $widgetFormId; ?>' ).attr( 'action', actionUrl ).submit();
        return false;
    }

    function search( form )
    {
        backendController.ajaxSubmitForm(
            $( form ),
            function( data )
            {
                jQuery( '#<?= $widgetWrapperId; ?>' ).replaceWith( data );
            }
        );

        return false;
    }

</script>