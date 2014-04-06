<?php

/**
 * This is the model class for table "faqs".
 *
 * The followings are the available columns in table 'faqs':
 * @property integer $id
 * @property string $title
 * @property string $content
 */
class Faq extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'faqs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('title, content', 'required'),
			array('title', 'length', 'max'=>255),
			array('id, title, content', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return [];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'      => 'ID',
			'title'   => 'Title',
			'content' => 'Text',
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);

        $pagination = new CPagination();
        $pagination->pageSize = 25;

        $sort = new CSort();
        $sort->defaultOrder = 'id';
        $sort->attributes = ['id', 'title'];

        return new CActiveDataProvider($this, array(
			'criteria'   => $criteria,
			'pagination' => $pagination,
			'sort'       => $sort
        ));
	}

	/**
	 * @param string $className active record class name.
	 * @return Faq the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
