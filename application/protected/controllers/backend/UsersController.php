<?php
/**
 * @author Andriy Tolstokorov
 */

class UsersController extends BackendController
{
    const GROUP_IDS_VARIABLE = 'ids';

    public function beforeAction()
    {
        $this->breadcrumbs = $this->getBreadCrumbs(
            $this->getAction()->getId()
        );

        return TRUE;
    }

    public function actions()
    {
        $actions = $this->getUsersActions();
        return $actions;
    }

    protected function getUsersActions()
    {
        $model = new User( 'search' );
        if ( isset( $_GET[ 'User' ] ) )
        {
            //$model->unsetAttributes();
            $model->attributes = $_GET[ 'User' ];
        }

        return array(
            'index'=>array(
                'class'                 => 'application.actions.backend.ListAction',
                'model'                 => $model,
                'listHeaders'           => $model::getUserHeadersForListGrid(),
                'listFilters'           => $model::getUserFiltersForListGrid(),
                'isSortEnabled'         => TRUE,
                'primaryField'          => 'id', // primary field for multilingual models
                'view'                  => 'index',
                'partialView'           => '_index',
                'widgetWrapperId'       => 'pageHolder',
                'widgetFormId'          => 'table-form',
                'pageTitle'             => _( 'Пользователи' ),
                'listTitle'             => _( 'Список пользователей' ),
                'dataProviderGetterMethod' => 'backendUserSearch',
                'rowCellsGetterMethod'  => 'getUserRowValues',
                'groupingCheckboxName'  => static::GROUP_IDS_VARIABLE,
                'actionCreateUrl'       => $this->createUrl('add'),
                'actionGroupDeleteUrl'  => $this->createUrl( 'groupDelete'),
                'messageDeleteConfirmation' => _( 'Are you sure, you want to delete this user?' ),
                'listGirdView'          => 'backend',
                'ajaxUpdateAction'      => 'index',
                'actionEdit'            => 'edit',
                'actionDelete'          => 'delete',
                'actionView'            => 'view'
            ),

            'add' => array(
                'class'         => 'application.actions.backend.CreateAction',
                'model'         => UserForm::getInstance(),
                'view'          => 'add-edit',
                'formView'      => '_form',
                'pageTitle'     => _( 'Новый пользователь' ),
                'formAction'    => '',
                'isMultilingual'=> FALSE,
                'redirectUrl'   => $this->createUrl( 'index' ),
            ),

            'edit' => array(
                'class'         => 'application.actions.backend.UpdateAction',
                'model'         => UserForm::getInstance( get_param( 'id' ) ),
                'view'          => 'add-edit',
                'formView'      => '_form',
                'pageTitle'     => _( 'Редактировать пользователя' ),
                'formAction'    => '',
                'isMultilingual'=> FALSE,
            ),

            'delete' => array(
                'class'             => 'application.actions.backend.DeleteAction',
                'model'             => $model,
                'deleteCriteria'    => 'id = :itemId',
                'deleteParams'      => array( ':itemId' => get_param( 'id' ) ),
                'nonAjaxRedirect'   => $this->createUrl( 'index' ),
                'isMultilingual'    => FALSE
            ),

            'groupDelete' => array(
                'class'             => 'application.actions.backend.GroupDeleteAction',
                'isMultilingual'    => FALSE,
                'redirectUrl'       => $this->createUrl( 'index' ),
                'groupingCheckboxName'  => self::GROUP_IDS_VARIABLE,
                'flashSuccessMessage'   => _( ' user was deleted successfully!'),
                'flashWarningNoItems'   => _( 'Nothing was selected!'),
                'primaryId'         => 'id',
                'tableModelClass'   => 'User'
            )
        );
    }

    public function actionEditUser()
    {
        $userId = get_param( 'id', FALSE );

        $user = User::model()->findByPk( $userId );

        if ( !$user )
        {
            throw new CHttpException( 404 );
        }

        $form = UserForm::getInstance( $userId );
        $this->set_model( $form );
        if ( isPostOrAjaxRequest() )
        {
            $this->processUpdate();
        }

        $this->render(
            'edit-user',
            array(
                'model'         => $this->get_model(),
                'pageTitle'     => _('Редактировать пользователя'),
                'formId'        => $form::FORM_ID,
                'formView'      => '_user-form',
                'formAction'    => '',
                'innerLinks'    => NULL,
                'changeUserAvatarHandlerUrl'
                => $this->createAbsoluteUrl( 'changeUserAvatarHandler', array( 'userId' => $user->id ) ),
                'user' => $user
            )
        );
    }

    public function actionView( $id )
    {
        /** @var $user User */
        if ( !( $user = User::model()->findByPk( $id ) ) )
        {
            throw new CHttpException( 404 );
        }

        $this->breadcrumbs = array(
            _( 'User' ) => $this->createUrl( 'index' ),
            $user->getFullName()
        );

        $this->render(
            'view',
            array(
                'user' => $user
            )
        );
    }

    public function actionChangeBanStatusHandler()
    {
        $new_status = '';
        /** @var $user User */
        $user = User::model()->findByPk( get_param( 'id', 0 ) );
        if ( $user )
        {
            if ( $user->is_banned )
            {
                $user->is_banned = FALSE;
                $new_status = _('активный');
                $user->save();
            }
            else
            {
                $user->is_banned = TRUE;
                $new_status = _('запрещенный');
                $user->save();
            }

            $this->successful_ajax_response(
                array(
                    'new_user_status' => $new_status
                )
            );
        }
    }


    protected function getBreadCrumbs( $actionId )
    {
        $result = array();
        $indexNode = _( 'Пользователи' );
        switch ( $actionId )
        {
            case 'index' :
                $result = array(
                    $indexNode
                );
            break;

            case 'add' :
                $result = array(
                    $indexNode => $this->createUrl( 'index' ),
                    _( 'Создать нового пользователя' )
                );
                break;

            case 'edit' :
                $result = array(
                    $indexNode => $this->createUrl( 'index' ),
                    _( 'Редактировать пользователя' )
                );
            break;

        }

        return $result;
    }

    /**                                     FILTERS                                **/


    public function filters()
    {
        return array(
            'accessControl'
        );
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array(
                    'index', 'add', 'edit', 'delete', 'groupDelete', 'view', 'ChangeBanStatusHandler'
                ),
                'roles' => array( 'admin' )
            ),

            // deny all for all users
            array(
                'deny',
                'users' => array( '*' ),
            ),
        );
    }
}