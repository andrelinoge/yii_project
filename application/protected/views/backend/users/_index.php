<?php
/**
 * User: andrelinoge
 * Date: 12/4/12
 */

Yii::import('application.widgets.Templated.ListGrid');

$this->widget(
    'ListGrid',
    array(
        'primary'       => $primaryField,
        'viewFile'      => $listGirdView,
        'enableSort'    => $isSortEnabled,
        'enableViewing' => $enableViewing,
        'dataProviderGetterMethod' => $dataProviderGetterMethod,
        'model'         => $model,
        'listHeaders'       => $listHeaders,
        'listFilters'       => $listFilters,
        'rowCellsGetterMethod'=> $rowCellsGetterMethod,
        'messageDeleteConfirmation' => $messageDeleteConfirmation,
        'groupingCheckboxName'  => $groupingCheckboxName,
        'widgetWrapperId' => $widgetWrapperId,
        'widgetFormId'  => $widgetFormId, // to access checkboxes via form id
        'skipScripts'   => $skipScripts,
        'actionEdit'    => $actionEdit,
        'actionDelete'    => $actionDelete,
        'actionCreateUrl' => $actionCreateUrl,
        'actionView'      => $actionView,
        'ajaxUpdateAction' => $ajaxUpdateAction
    )
);

?>
