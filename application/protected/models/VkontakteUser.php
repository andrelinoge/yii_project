<?php

/**
 * This is the model class for table "vkontakte_users".
 *
 * The followings are the available columns in table 'vkontakte_users':
 * @property integer $id
 * @property integer $user_id
 * @property integer $social_id
 *
 * The followings are the available model relations:
 * @property User $user
 */
class VkontakteUser extends CActiveRecord
{

    /**
     * @param string $className
     * @return CActiveRecord
     */
    public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'vkontakte_users';
	}


	public function rules()
	{
		return array(
			array('user_id, social_id', 'required'),
			array('user_id, social_id', 'numerical', 'integerOnly'=>true),
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
			'user_id' => 'User',
			'social_id' => 'Vk id',
		);
	}
}