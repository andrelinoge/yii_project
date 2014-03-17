<?php
/**
 * @author Andriy Tolstokorov
 */

class ChangePasswordForm extends CFormModel
{
    const FORM_ID = 'change-password-form';

    public $old;
    public $new;
    public $confirm;

    /** @var null User */
    protected $_user = NULL;

    public function rules()
    {
        return array(
            array(
                'old, new, confirm',
                'required',
            ),
            array(
                'old',
                'validateOldPass',
            ),
            array(
                'confirm',
                'compare',
                'compareAttribute' => 'new',
                'operator' => '=='
            )
        );
    }

    public function validateOldPass($attribute,$params)
    {
        $model = $this->get_user();

        if( !$model::isPasswordValid( $this->old, $model->password, $model->salt ) )
        {
            $this->addError($attribute, 'Старый пароль неверный');
        }
    }

    public function attributeLabels()
    {
        return array(
            'old' => 'Старый пароль',
            'new' => 'Новый пароль',
            'confirm' => 'Подтверждение пароля'
        );
    }

    public function save()
    {
        $model = $this->get_user();
        $model->change_password( $this->new );
        $model->save( FALSE );
    }

    /**
     * @param User $model
     */
    public function set_user( User $model )
    {
        $this->_user = $model;
    }

    /**
     * @return User
     * @throws CException
     */
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