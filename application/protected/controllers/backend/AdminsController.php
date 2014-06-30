<?php
class AdminsController extends BackendController
{
    public function actions()
    {
        return [
            'edit' => [
                'class'                => 'application.actions.crud.EditAction',
                'view'                 => 'edit',
            ],
            'update' => [
                'class'                => 'application.actions.crud.UpdateAction',
                'view'                 => 'edit',
            ],
        ];
    }

    public function actionIndex()
    {
        $this->redirect(url('site/index'));
    }

    public function load_model($id)
    {
        $form = new ChangePasswordForm();
        $form->set_user( current_user() );

        return $form;
    }

    public function actionAddDefAdmin( $email = NULL )
    {
        $admin = new User();
        $admin->role = WebUser::ROLE_ADMIN;
        $admin->password = '1111';
        $admin->first_name = 'admin';
        $admin->last_name = 'admin';
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

    /**                                     FILTERS                                **/


    public function filters()
    {
        return ['accessControl'];
    }

    public function accessRules()
    {
        return [
            [
                'allow',
                'actions' => [
                    'edit', 'update', 'index'
                ],
                'roles' => [ 'admin' ]
            ],

            [
                'allow',
                'actions' => [
                    'addDefAdmin', 'removeDefAdmin'
                ],
            ],

            [
                'deny',
                'users' => [ '*' ]
            ]
        ];
    }
}