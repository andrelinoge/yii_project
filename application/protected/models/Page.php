<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $alias
 */
class Page extends CActiveRecord
{
	public function tableName()
	{
		return 'pages';
	}

	public function rules()
	{
		return array(
			array('title, content', 'required'),
			array('title', 'length', 'max'=>255),
			array('id, title, content, meta_keywords, meta_description, alias', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

	public function behaviors()
    {
        return [
            '_alias' => [
                'class'            => 'AliasBehavior',
                'source_attribute' => 'title',
                'alias_attribute'  => 'alias',
            ]
        ];
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'               => 'ID',
			'title'            => 'Title',
			'content'          => 'Content',
			'meta_keywords'    => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'alias'            => 'Alias',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
