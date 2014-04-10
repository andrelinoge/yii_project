<?php

/**
 * This is the model class for table "site_settings".
 *
 * The followings are the available columns in table 'site_settings':
 * @property integer $id
 * @property string $phone_1
 * @property string $phone_2
 * @property string $email
 * @property string $address
 */
class SiteSetting extends CActiveRecord
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
			array('phone_1, phone_2, email, address', 'required'),
			array('phone_1, phone_2, email, address', 'length', 'max'=>255),
			array('id, phone_1, phone_2, email, address', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array();
	}

	public function attributeLabels()
	{
		return array(
			'phone_1' => 'Phone 1',
			'phone_2' => 'Phone 2',
			'email'   => 'Email',
			'address' => 'Address',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('phone_1',$this->phone_1,true);
		$criteria->compare('phone_2',$this->phone_2,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
