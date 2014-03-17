<?php


class LoginForm extends CFormModel
{
	public $email;
	public $password;
	public $remember_me;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('email, password', 'required'),
			array('remember_me', 'boolean'),
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return [
			'remember_me' => _('Remember me next time'),
		];
	}

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate( $attribute, $params )
    {
        if( !$this->hasErrors() )
        {
            $this->_identity = new UserIdentity();
            if( !$this->_identity->authByEmailPassDb( $this->email, $this->password ) )
            {
                $this->addError('password','Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if( $this->_identity === NULL )
        {
            $this->_identity = new UserIdentity();
            $this->_identity->authByEmailPassDb( $this->email, $this->password );
        }

        if( $this->_identity->errorCode === UserIdentity::ERROR_NONE )
        {
            $duration = $this->remember_me ? 3600*24*30 : 0; // 30 days
            Yii::app()->user->login( $this->_identity, $duration );
            Yii::app()->user->set_model( $this->_identity->get_user() );
            return TRUE;
        }
        else
        {
            return false;
        }
    }
}
