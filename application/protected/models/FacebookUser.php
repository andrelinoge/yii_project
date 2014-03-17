<?php

/**
 * This is the model class for table "facebook_users".
 *
 * The followings are the available columns in table 'facebook_users':
 * @property integer $user_id
 * @property string $social_id
 */
class FacebookUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FacebookUser the static model class
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
		return 'facebook_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('user_id, social_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('social_id', 'length', 'max'=>20),
			array('user_id, social_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'social_id' => 'Fb id',
		);
	}
}