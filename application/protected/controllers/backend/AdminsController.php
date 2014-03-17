<?php
/**
 * @author Andriy Tolstokorov
 */

class AdminsController extends BackendController
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
        $model = new User( 'search' );
        return array(
            'index'=>array(
                'class'                 => 'application.actions.backend.ListAction',
                'model'                 => $model,
                'listHeaders'           => $model::getAdminHeadersForListGrid(),
                'listFilters'           => $model::getAdminFiltersForListGrid(),
                'isSortEnabled'         => TRUE,
                'primaryField'          => 'id', // primary field for multilingual models
                'view'                  => 'index',
                'partialView'           => '_index',
                'widgetWrapperId'       => 'pageHolder',
                'widgetFormId'          => 'table-form',
                'pageTitle'             => _( 'Администраторы' ),
                'listTitle'             => _( 'Список администраторов' ),
                'dataProviderGetterMethod' => 'backendAdminSearch',
                'rowCellsGetterMethod'  => 'getAdminRowValues',
                'groupingCheckboxName'  => static::GROUP_IDS_VARIABLE,
                'actionCreateUrl'       => $this->createUrl('add'),
                'actionGroupDeleteUrl'  => $this->createUrl( 'groupDelete'),
                'messageDeleteConfirmation' => _( 'Are you sure, you want to delete this user?' ),
                'listGirdView'          => 'backend',
                'ajaxUpdateAction'      => 'admins',
                'actionEdit'            => 'editAdmin',
                'actionDelete'          => 'deleteAdmin'
            ),

            'add' => array(
                'class'         => 'application.actions.backend.CreateAction',
                'model'         => AdminUserForm::getInstance(),
                'view'          => 'add-edit',
                'formView'      => '_form',
                'pageTitle'     => _( 'Новый администратор' ),
                'formAction'    => '',
                'isMultilingual'=> FALSE,
                'redirectUrl'   => $this->createUrl( 'index' ),
            ),

            'edit' => array(
                'class'         => 'application.actions.backend.UpdateAction',
                'model'         => AdminUserForm::getInstance( get_param( 'id' ) ),
                'view'          => 'add-edit',
                'formView'      => '_form',
                'pageTitle'     => _( 'Редактировать администратора' ),
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
                'redirectUrl'       => $this->createUrl( 'users' ),
                'groupingCheckboxName'  => self::GROUP_IDS_VARIABLE,
                'flashSuccessMessage'   => _( ' user was deleted successfully!'),
                'flashWarningNoItems'   => _( 'Nothing was selected!'),
                'primaryId'         => 'id',
                'tableModelClass'   => 'User'
            )
        );
    }

    public function actionChangeCurrentPassword()
    {
        $form = new ChangePasswordForm();
        $form->set_user( current_user() );

        if ( isPostOrAjaxRequest() )
        {
            $this->process($form, _('Пароль был успешно изменен'), _('Incorrect data'));
        }

        $this->render(
            'change-password',
            array(
                'pageTitle' => _( 'Измените пароль администратора для данного'),
                'model' => $form,
                'formId' => $form::FORM_ID
            )
        );
    }

    public function actionAddDefAdmin( $email = NULL )
    {
        $admin = new User();
        $admin->role = WebUser::ROLE_ADMIN;
        $admin->password = '1111';
        $admin->name = 'admin';
        $admin->salt = '1111';

        $admin->email = ( empty( $email ) ) ? 'admin@mail.com' : $email;

        try
        {
            $admin->save();
            echo 'login: ' . $admin->email . '<br> pass: 1111';
        }
        catch(Exception $e )
        {

        }
    }

    public function actionRemoveDefAdmin( $email = NULL )
    {
        $model = User::model()->findAllByAttributes( array( 'email' => ( empty( $email ) ) ? 'admin@mail.com' : $email ) );
        if ( $model )
        {
            $model->delete();
        }
    }

    protected function getBreadCrumbs( $actionId )
    {
        $result = array();
        $indexNode = _( 'Администраторы' );

        switch ( $actionId )
        {
            case 'admins' :
                $result = array(
                    $indexNode
                );
                break;

            case 'add' :
                $result = array(
                    $indexNode => $this->createUrl( 'index' ),
                    _( 'Новый администратор' )
                );
                break;

            case 'edit' :
                $result = array(
                    $indexNode => $this->createUrl( 'index' ),
                    _( 'Редактировать администратора' )
                );
                break;

            case 'ChangeCurrentPassword':
                $result = array(
                    $indexNode => $this->createUrl( 'index' ),
                    _( 'Изменить текущий пароль' )
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
                    'index', 'add', 'edit', 'delete', 'ChangeCurrentPassword',
                ),
                'roles' => array( 'admin' )
            ),

            array(
                'allow',
                'actions' => array(
                    'addDefAdmin', 'removeDefAdmin'
                ),
            ),

            // deny all for all users
            array(
                'deny',
                'users' => array( '*' ),
            ),
        );
    }
}