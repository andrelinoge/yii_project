<?php

/**
 * This is the model class for table "calc_requests".
 *
 * The followings are the available columns in table 'calc_requests':
 * @property integer $id
 * @property integer $window_system_id
 * @property integer $glass_id
 * @property integer $construction_type
 * @property integer $width
 * @property integer $height
 * @property string $name
 * @property string $phone
 * @property integer $is_read
 * @property string $created_at
 * @property string $updated_at
 * @property double $price
 */
class CalcRequest extends CActiveRecord
{
	
	public function tableName()
	{
		return 'calc_requests';
	}

	public function rules()
	{
		return array(
			array('window_system_id, glass_id, construction_type, width, height, name, phone, price', 'required'),
			array('window_system_id, glass_id, construction_type, width, height, is_read', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('name, phone', 'length', 'max'=>255),
			
			array('id, window_system_id, glass_id, construction_type, width, height, name, phone, is_read, created_at, updated_at, price', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return [
			'window_system' => [self::BELONGS_TO, 'WindowSystem', 'window_system_id'],
			'glass' => [self::BELONGS_TO, 'Glass', 'glass_id'],
		];
	}

	public function attributeLabels()
	{
		return array(
			'id'                => 'ID',
			'window_system_id'  => 'Window System',
			'glass_id'          => 'Glass',
			'construction_type' => 'Construction Type',
			'width'             => 'Width',
			'height'            => 'Height',
			'name'              => 'Name',
			'phone'             => 'Phone',
			'is_read'           => 'Is Read',
			'created_at'        => 'Created At',
			'updated_at'        => 'Updated At',
			'price'             => 'Price'
		);
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

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('window_system_id',$this->window_system_id);
		$criteria->compare('glass_id',$this->glass_id);
		$criteria->compare('construction_type',$this->construction_type);
		$criteria->compare('width',$this->width);
		$criteria->compare('height',$this->height);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('is_read',$this->is_read);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('price',$this->price);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
        $sort->attributes = ['id', 'name', 'phone', 'created_at'];

        $pagination = new CPagination();
        $pagination->pageSize = 5;

        return new CActiveDataProvider($this, array(
			'criteria'   => $criteria,
			'pagination' => $pagination,
			'sort'       => $sort
        ));
    }

    public function afterSave()
    {
    	if ($this->isNewRecord)
    	{
    		$mailer = new ApplicationMailer();
        	$mailer->new_calc_request_notification($this);
    	}

    	parent::afterSave();
    }

    public function afterFind()
    {
    	$types = CalcForm::construction_types();

    	if (isset($types[$this->construction_type]))
    	{
    		$this->construction_type = $types[$this->construction_type];
    	}
    	else
    	{
    		$this->construction_type = 'Не визначено';
    	}
    }
}
