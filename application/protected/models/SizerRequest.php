<?php

/**
 * This is the model class for table "sizer_requests".
 *
 * The followings are the available columns in table 'sizer_requests':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_read
 */
class SizerRequest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sizer_requests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name, phone', 'required'),
			array('name, phone', 'length', 'max'=>255),
            array('address, content', 'safe'),
			array('id, name, phone, is_read', 'safe', 'on'=>'search'),
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
			'phone'      => 'phone',
            'address'    => 'address',
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
		$criteria->compare('phone',$this->phone,true);
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
        $sort->attributes = ['id', 'name', 'phone', 'created_at'];

        return new CActiveDataProvider($this, [
			'criteria'   => $criteria,
			'pagination' => $pagination,
			'sort'       => $sort
        ]);
    }

    public function search_unread()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('is_read', 0);

        $sort = new CSort();
        $sort->defaultOrder = 'id';
        $sort->attributes = ['id', 'name', 'phone', 'created_at'];

        $pagination = new CPagination();
        $pagination->pageSize = 5;

        return new CActiveDataProvider($this, [
    			'criteria'   => $criteria,
    			'pagination' => $pagination,
    			'sort'       => $sort
        ]);
    }

	/**
	 * @param string $className active record class name.
	 * @return ContactMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function behaviors()
    {
        return [
            'timestampable' => [
                'class'             => 'zii.behaviors.CTimestampBehavior',
                'setUpdateOnCreate' => false,
                'createAttribute'   => 'created_at',
                'updateAttribute'   => 'updated_at',
            ]
        ];
    }
}
