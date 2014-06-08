<?php

/**
 * This is the model class for table "site_settings".
 *
 * The followings are the available columns in table 'site_settings':
 * @property integer $id
 * @property string $phone_1
 * @property string $phone_2
 */
class SiteSettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'site_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('phone_1, phone_2, phone_3, skype, address, google_map, rate_exchange', 'safe'),
			array('phone_1, phone_2', 'length', 'max'=>255),
			array('id, phone_1, phone_2', 'safe', 'on'=>'search'),
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
			'id'         => 'ID',
			'phone_1'    => 'Phone 1',
			'phone_2'    => 'Phone 2',
			'phone_3'	 => 'Phone 3',
			'skype'		 => 'Skype',
			'address'    => 'Address',
			'google_map' => 'Google map code',
			'rate_exchange' => 'Rate exchange'
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function get()
	{
		$model = self::model()->find();

		if (!$model)
		{
			$model = new self;
			$model->phone_1       = 'none';
			$model->phone_2       = 'none';
			$model->phone_3       = 'none';
			$model->skype         = 'none';
			$model->address       = 'none';
			$model->google_map    = 'none';
			$model->rate_exchange = 10.5;
			$model->save();
		}

		return $model;
	}
}
