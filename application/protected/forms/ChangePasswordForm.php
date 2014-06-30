<?php

class ChangePasswordForm extends CFormModel
{
    public $old;
    public $new;
    public $confirm;

    /** @var null User */
    protected $_user = NULL;

    public function rules()
    {
        return [
            [
                'old, new, confirm',
                'required',
            ],
            [
                'old',
                'validate_old_password',
            ],
            [
                'confirm',
                'compare',
                'compareAttribute' => 'new',
                'operator'         => '=='
            ]
        ];
    }

    public function validate_old_password($attribute,$params)
    {
        $model = $this->get_user();

        if( !$model::is_password_valid( $this->old, $model->password, $model->salt ) )
        {
            $this->addError($attribute, 'Wrong old password');
        }
    }

    public function attributeLabels()
    {
        return [
            'old'     => 'Old password',
            'new'     => 'New password',
            'confirm' => 'Confirm password'
        ];
    }

    public function save()
    {
        $model = $this->get_user();
        $model->change_password( $this->new );
        $model->save( FALSE );
    }

    public function set_user( User $model )
    {
        $this->_user = $model;
    }

    public function get_user()
    {
        if ( empty( $this->_user ) )
        {
            throw new CException( 'User model is not set' );
        }
        else
        {
            return $this->_user;
        }
    }

}