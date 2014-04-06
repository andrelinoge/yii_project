<?php

/**
 * This is the model class for table "contact_messages".
 *
 * The followings are the available columns in table 'contact_messages':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_read
 */
class ContactMessage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contact_messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name, email, content, created_at, updated_at, is_read', 'required'),
			array('is_read', 'numerical', 'integerOnly'=>true),
			array('name, email', 'length', 'max'=>255),
			array('id, name, email, content, created_at, updated_at, is_read', 'safe', 'on'=>'search'),
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
			'name'       => 'Name',
			'email'      => 'Email',
			'content'    => 'Text',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'is_read'    => 'Is Read'
		);
	}

	/**
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('is_read',$this->is_read);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

    public function search_read()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('is_read', true);

        $pagination = new CPagination();
        $pagination->pageSize = 5;

        $sort = new CSort();
        $sort->defaultOrder = 'id';
        $sort->attributes = ['id', 'name', 'email', 'created_at'];

        return new CActiveDataProvider($this, array(
			'criteria'   => $criteria,
			'pagination' => $pagination,
			'sort'       => $sort
        ));
    }

    public function search_unread()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('is_read', 0);

        $sort = new CSort();
        $sort->defaultOrder = 'id';
        $sort->attributes = ['id', 'name', 'email', 'created_at'];

        $pagination = new CPagination();
        $pagination->pageSize = 5;

        return new CActiveDataProvider($this, array(
			'criteria'   => $criteria,
			'pagination' => $pagination,
			'sort'       => $sort
        ));
    }

	/**
	 * @param string $className active record class name.
	 * @return ContactMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
