<?
class UserController extends FrontendController
{

    public function actionShow()
    {
        $this->render( 'show' );
    }


    public function actionNew()
    {
        $this->set_layout('registration');

        $this->render( 'new', ['user' => new User('registration')] );
    }


    public function actionCreate()
    {
        $user = new User('registration');
        $attributes = get_param('User', NULL);
        $user->role = WebUser::ROLE_USER;

        if ( $attributes )
        {
            $user->attributes = $attributes;

            if ( $user->validate() )
            {
                $user->save( FALSE );
            }

            if ( is_ajax() )
            {
                if ( $user->hasErrors() )
                {
                    $this->unsuccessful_ajax_response( ['errors' => $user->getErrors()] );
                }
                else
                {
                    app()->user->setFlash('success', 'Registration completed!');
                    $this->successful_ajax_response( [ 'redirect' => createUrl('site/index')] );

                }
            }
            else
            {
                $this->render( 'new', ['user' => $user] );
            }
        }
    }

    public function actionEdit()
    {
        $this->render( 'edit', ['user' => current_user(), 'change_password_form' => new ChangePasswordForm()] );
    }

    public function actionUpdate()
    {
        $user = current_user();

        $attributes = get_param('User', NULL);

        if ( $attributes )
        {
            $user->attributes = $attributes;

            if ( $user->validate() )
            {
                $user->save( FALSE );
                app()->user->refresh();
            }

            if ( is_ajax() )
            {
                if ( $user->hasErrors() )
                {
                    $this->unsuccessful_ajax_response( ['errors' => $user->getErrors()] );
                }
                else
                {
                    $this->successful_ajax_response( ['reload' => true] );
                }
            }
            else
            {
                $this->render( 'edit', ['user' => $user] );
            }
        }
    }

    public function actionUpdatePassword()
    {
        $form = new ChangePasswordForm();
        $form->set_user(current_user());

        $this->process($form, 'Password was changed successfully!');
    }


    public function actionUploadPhoto()
    {
        $model = new User();
        try
        {
            $response = $model->upload();
            $this->successful_ajax_response( $response );
        }
        catch(CException $e)
        {
            $this->unsuccessful_ajax_response( ['error_message' => $e->getMessage()] );
        }
    }

    public function actionConfirm()
    {

    }

    public function actionRestorePassword()
    {

    }

    public function filters()
    {
        return ['accessControl'];
    }

    public function accessRules()
    {
        return [
            [
                'allow',
                'actions' => ['index', 'edit', 'update', 'updatePassword'],
                'users' => ['@']
            ],

            [
                'allow',
                'actions' => [ 'new', 'create', 'restorePassword'],
                'users' => ['?']
            ],

            [
                'allow',
                'actions' => ['confirm', 'uploadPhoto'],
                'users' => ['*']
            ],

            [
                'deny',
                'users' => ['*']
            ]
        ];
    }
}