<?php
/**
 * @author Andriy Tolstokorov
 */

class AdminUserForm extends CFormModel
{
    const FORM_ID = 'admin-user-form';

    public $name;
    public $email;
    public $password;

    /** @var User */
    protected $_userModel = NULL;


    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {

        return array(
            array('email, name', 'required'),
            array('email, password, name', 'length', 'max'=>255),
            array( 'email', 'email' ),
            array( 'email', 'isUnique' ),
            array( 'password', 'safe', 'on' => 'edit' ),
            array( 'password', 'required', 'on' => 'new' ),

            array('id, email, name, password', 'safe', 'on'=>'search'),
        );
    }

    public function isUnique($attribute,$params)
    {
        $model = User::model()->findByAttributes( array( 'email' => $this->$attribute ) );

        if ( $model )
        {
            if ( $this->_userModel )
            {
                if ( $this->_userModel->id != $model->id )
                {
                    $this->addError($attribute, 'Такий email вже використовується' );
                }
            }
            else
            {
                $this->addError($attribute, 'Такий email вже використовується' );
            }
        }
    }

    public function save()
    {
        if ( $this->_userModel )
        {
            $attributes = $this->attributes;

            if ( empty( $this->password ) )
            {
                unset( $attributes[ 'password' ] );
            }

            $this->_userModel->setAttributes( $attributes );
            $this->_userModel->save();
        }
        else
        {
            $user = new User('admin');

            $user->attributes = $this->attributes;
            $user->role = WebUser::ROLE_ADMIN;

            $user->save();

            return TRUE;
        }
    }

    public static function getInstance( $id = NULL )
    {
        if ( $id )
        {
            $form = new AdminUserForm( 'edit' );
            $user = User::model()->findByPk( $id );

            if ( $user )
            {
                $form->attributes = $user->attributes;
                $form->unsetAttributes( array( 'password' ) );
                $form->_userModel = $user;
            }
        }
        else
        {
            $form = new AdminUserForm( 'new' );
        }

        return $form;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
            'password' => _( 'Пароль' ),
            'name' => _( 'Ім\'я' ),

        );
    }
}