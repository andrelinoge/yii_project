<?php
/**
 * User: andrelinoge
 * Date: 12/4/12
 */

class PositionListGrid extends CWidget
{
    public $widgetWrapperId = 'widget_id';
    public $widgetFormId = 'widget_form_id';

    /** @var $model ActiveRecord */
    public $model;

    /** @var string */
    public $dataProviderGetterMethod;

    /** @var string name of model method, that retrieves array with */
    public $rowCellsGetterMethod;

    /** @var string field name with primary key. Default "id" */
    public $primary = 'id';

    /** @var string route for list action*/
    public $ajaxUpdateAction = 'index';

    /** @var string route for moveUp action*/
    public $actionMoveUp = 'moveUp';

    /** @var string route for moveUp action*/
    public $actionMoveDown = 'moveDown';

    /** @var string route for moveUp action*/
    public $actionMoveTop = 'moveTop';

    /** @var string route for moveUp action*/
    public $actionMoveBottom = 'moveBottom';

    /** @var string route for moveUp action*/
    public $actionResetPosition = 'resetPosition';

    /** @var string name of view file. Default "default" */
    public $viewFile = 'default';

    /** @var string name of view file. Default "list-grid" */
    public $viewFolder = 'position-list-grid';

    /** @var array with fields for table header(the same fields as in model) */
    public $listHeaders;

    /** @var array with filter options. array( 'field' => array( for dropDown list ) ) */
    public $listFilters = NULL;

    /** @var bool If TRUE - don't render additional scripts.
     * If you are using AJAX set this flag to reduce traffic */
    public $skipScripts = FALSE;

    /** @var bool if TRUE show selector for items limit per page */
    public $enableItemsLimitSelector = TRUE;

    protected $_sortableFields;
    protected $_countOfItems;
    /** @var $_dataProvider CDataProvider */
    public $_dataProvider;

    public function init()
    {
        $dataProviderGetterMethod = $this->dataProviderGetterMethod;

        $this->_dataProvider = $this->model->{$dataProviderGetterMethod}();
        $this->_countOfItems = $this->_dataProvider->getTotalItemCount();
    }

    public function run()
    {
        $itemsLimitSelect = CHtml::dropDownList(
            'items_limit',
            get_param( 'items_limit', Yii::app()->params[ 'backend' ][ 'itemsPerPage' ] ),
            Yii::app()->params[ 'backend' ][ 'itemsPerPageOptions' ],
            array(
                'onchange' => 'changeItemsPerPageLimit( this )',
                'data-action_url' => $this->getActionUrlWithoutParam( 'items_limit' )
            )
        );

        $this->render(
            $this->getView(),
            array(
                'widgetWrapperId' => $this->widgetWrapperId,
                'widgetFormId' => $this->widgetFormId,
                'models'        => $this->_dataProvider->data,
                'model'         => $this->model,
                'isData'        => $this->_countOfItems > 0,
                'countOfItems'  => $this->_countOfItems,
                'listHeaders'   => $this->listHeaders,
                'listFilters'   => $this->listFilters,
                'action'        => $this->ajaxUpdateAction,
                'pagination'    => $this->_dataProvider->getPagination(),
                'primary'       => $this->primary,
                'actionMoveUp'    => $this->actionMoveUp,
                'actionMoveDown'    => $this->actionMoveDown,
                'actionMoveTop'  => $this->actionMoveTop,
                'actionMoveBottom'  => $this->actionMoveBottom,
                'actionResetPosition'  => $this->actionResetPosition,
                'skipScripts'   => $this->skipScripts,
                'rowCellsGetterMethod'  => $this->rowCellsGetterMethod,
                'itemsLimitSelect'      => $itemsLimitSelect,
                'enableItemsLimitSelector' => $this->enableItemsLimitSelector,
            )
        );
    }

    /**
     * Returns URL for current action without target param
     * @param $paramKey
     * @return string
     */
    public function getActionUrlWithoutParam( $paramKey )
    {
        $params = $_GET;
        if ( is_array( $paramKey ))
        {
            foreach( $paramKey as $key => $subKey)
            {
                if ( isset( $params[ $key ] ) && isset( $params[ $key ][ $subKey ] ) )
                {
                    unset( $params[ $key ][ $subKey ] );
                }
            }
        }
        else
        {
            if ( isset( $params[ $paramKey ] ) )
            {
                unset( $params[ $paramKey ] );
            }
        }

        return $this->getController()->createUrl( $this->ajaxUpdateAction, $params );
    }

    /**
     * @return string relative path for template file
     */
    protected function getView()
    {
        return $this->viewFolder . '/' . $this->viewFile;
    }

    public function createFilter( $field, $options )
    {
        if ( is_array( $options ) )
        {
            return CHtml::activeDropDownList(
                $this->model,
                $field,
                $options,
                array(
                    'onchange' => 'return onChangeFilter( this, \''. $this->widgetFormId .'\', \''.
                        $this->getActionUrlWithoutParam(
                            array( get_class($this->model) => $field )
                        ).'\' )',
                    'style' => 'width: auto;'
                )
            );
        }
        else
        {
            return CHtml::activeTextField(
                $this->model,
                $field,
                array(
                    'onchange' => 'return onChangeFilter( this, \''. $this->widgetFormId .'\', \''.
                        $this->getActionUrlWithoutParam(
                            array( get_class($this->model) => $field )
                        ).'\' )',
                    'style' => 'width: 100px;'
                )
            );
        }
    }
}