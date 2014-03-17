<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property integer $role
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property string $first_name
 * @property string $last_name
 * @property string $photo
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends CActiveRecord
{
    const CACHE_KEY_USER_MODEL = 'user_';
    const CACHE_TTL_USER_MODEL = 600; // 10 min
    const MIN_PASSWORD_LENGTH = 6;
    const SALT = 'qweasdzxc123'; // salt for protection id when it sends with post data


    public $confirm_password;

    /** @var string */
    protected $_initial_password;

    public function __construct($scenario='insert')
    {
        parent::__construct($scenario);
    }

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
            array( 'email, password', 'safe' ),
            array( 'email, password', 'required', 'on' => 'registration' ),
			array( 'first_name, last_name', 'required' ),
			array( 'email, password, first_name, last_name, photo', 'length', 'max'=>255 ),
            array( 'email', 'email' ),
            array( 'email', 'unique', 'on' => 'registration' ),
            array( 'photo', 'safe'),


            array('confirm_password', 'required', 'on' => 'registration'),
            array('confirm_password', 'compare', 'compareAttribute' => 'password', 'on'=>'registration'),

		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'role' => _( 'Роль' ),
			'email' => 'Email',
			'password' => _( 'Пароль' ),
            'confirm_password' => _( 'Повтор пароля' ),
			'salt' => _( 'Salt' ),
			'first_name' => _( 'Имя' ),
            'last_name' => _( 'Фамиля' ),
            'created_at' => _('Registered at'),
		);
	}

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */

    public function beforeSave()
    {
        // if new record - generate salt for user password and generate hash for password
        if ( $this->isNewRecord )
        {
            $this->salt = substr( sha1(rand()),0,10 );
            if (!empty($this->password))
            {
                $this->password = self::password_hash( $this->password, $this->salt );
            }
            $this->created_at = time();
        }
        else
        {
            // if update existing record - check if there is new password
            if ( !empty($this->password) )
            {
                // generate has for new password
                if ( $this->password != $this->_initial_password )
                {
                    $this->password = self::password_hash( $this->password, $this->salt );
                }
            }
            else
            {
                // use old hash for old password
                $this->password = $this->_initial_password;
            }
        }

        return parent::beforeSave();
    }

    public function afterSave()
    {
        parent::afterSave();
        if ( $this->getIsNewRecord() )
        {
            // create empty profile record and other stuff
        }
        else
        {
            // delete cached model
            self::purge_cache( $this->id );
        }
        return TRUE;
    }

    /**
     * Save initial password for case, when user will change any data except password
     */
    public function afterFind()
    {
        $this->_initial_password = $this->password;
    }

    /**
     * generate new password
     * @param $newPassword string
     */
    public function change_password( $newPassword )
    {
        $this->salt = substr( sha1(rand()),0,10 );
        $this->password = $newPassword;
        //$this->save( FALSE );
    }

    function is_admin()
    {
        return $this->role == (int)WebUser::ROLE_ADMIN;
    }


    public function is_user()
    {
        return $this->role == (int)WebUser::ROLE_USER;
    }


    /**
     * get user model from cache by user id
     * @static
     * @param $id int user id
     * @return mixed
     */
    public static function get_from_cache( $id )
    {
        $user = Yii::app()->cache->get( self::CACHE_KEY_USER_MODEL . $id);
        if ( !$user )
        {
            $user = static::refresh_cache( $id );
        }

        return $user;
    }

    /**
     * @static Refreshes user model in cache
     * @param int $id - user id
     * @return User
     */
    public static function refresh_cache( $id )
    {
        $model = User::model()->findByPk( $id );
        Yii::app()->cache->set( self::CACHE_KEY_USER_MODEL . $id, $model, self::CACHE_TTL_USER_MODEL );
        return $model;
    }

    /**
     * clean cache
     * @param $id integer user id
     */
    public static function purge_cache( $id )
    {
        Yii::app()->cache->delete( self::CACHE_KEY_USER_MODEL . $id );
    }

    /**
     * @static
     * @param $password string
     * @param $salt string
     * @return string
     */
    public static function password_hash( $password, $salt )
    {
        return sha1( sha1( $password ) . $salt );
    }

    /**
     * @static
     * @param $password string initial password value
     * @param $passwordHash string encrypted password value with salt
     * @param $salt string
     * @return bool
     */
    public static function is_password_valid( $password, $passwordHash, $salt)
    {
        return $passwordHash === self::password_hash( $password, $salt );
    }

    
    public static function getAdmins()
    {
        return self::model()->findAllByAttributes( array( 'role' => WebUser::ROLE_ADMIN ) );
    }


    /**
     * @return string
     */
    public function full_name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    /**
     * check if email already in use
     * @param $email
     * @return bool
     */
    public static function isEmailUnique( $email )
    {
        $sql = 'SELECT email FROM user WHERE email = :email';
        $command = Yii::app()->db->createCommand($sql);
        $command->bindParam( ':email', $email, PDO::PARAM_STR );

        $result = $command->queryRow();

        return $result === FALSE;
    }

    public static function getEmailsByRole($role)
    {
        $sql = "SELECT email FROM user WHERE role = {$role}";
        /** @var CDbCommand $command */
        $command = Yii::app()->db->createCommand($sql);

        return $command->queryColumn();
    }

}
