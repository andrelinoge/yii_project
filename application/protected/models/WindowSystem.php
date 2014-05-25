<?php

/**
 * This is the model class for table "window_systems".
 *
 * The followings are the available columns in table 'window_systems':
 * @property integer $id
 * @property string $name
 * @property double $profit_coefficient
 * @property double $profile_frame
 * @property double $profile_leaf
 * @property double $profile_impost
 * @property double $reinforcement
 * @property double $seal
 * @property double $glazing
 * @property double $profile_window_sill
 * @property integer $width_profile_frame
 * @property integer $width_profile_impost
 * @property integer $width_profile_leaf
 */
class WindowSystem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'window_systems';
	}

	public function rules()
	{
		return array(
			array('name, profit_coefficient, profile_frame, profile_leaf, profile_impost, reinforcement, seal, glazing, profile_window_sill, width_profile_frame, width_profile_impost, width_profile_leaf', 'required'),
			array('width_profile_frame, width_profile_impost, width_profile_leaf', 'numerical', 'integerOnly'=>true),
			array('profit_coefficient, profile_frame, profile_leaf, profile_impost, reinforcement, seal, glazing, profile_window_sill', 'numerical'),
			array('name', 'length', 'max'=>255),
			
			array('id, name, profit_coefficient, profile_frame, profile_leaf, profile_impost, reinforcement, seal, glazing, profile_window_sill, width_profile_frame, width_profile_impost, width_profile_leaf', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array();
	}

	public function attributeLabels()
	{
		return array(
			'id'                   => 'ID',
			'name'                 => 'назва',
			'profit_coefficient'   => 'коефіціент заробітку',
			'profile_frame'        => 'профіль рами',
			'profile_leaf'         => 'профіль створки',
			'profile_impost'       => 'профіль імпоста',
			'reinforcement'        => 'армування',
			'seal'                 => 'ущільнювач',
			'glazing'              => 'штапік',
			'profile_window_sill'  => 'підставочний профіль',
			'width_profile_frame'  => 'ширина профіля рами, мм',
			'width_profile_impost' => 'ширина профілю імпоста, мм',
			'width_profile_leaf'   => 'ширина профілю створки, мм'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('profit_coefficient',$this->profit_coefficient);
		$criteria->compare('profile_frame',$this->profile_frame);
		$criteria->compare('profile_leaf',$this->profile_leaf);
		$criteria->compare('profile_impost',$this->profile_impost);
		$criteria->compare('reinforcement',$this->reinforcement);
		$criteria->compare('seal',$this->seal);
		$criteria->compare('glazing',$this->glazing);
		$criteria->compare('profile_window_sill',$this->profile_window_sill);
		$criteria->compare('width_profile_frame',$this->width_profile_frame);
		$criteria->compare('width_profile_impost',$this->width_profile_impost);
		$criteria->compare('width_profile_leaf',$this->width_profile_leaf);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
