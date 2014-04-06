<?php

/**
 * This is the model class for table "article_categories".
 *
 * The followings are the available columns in table 'categories':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $alias
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $type
 * @property integer $parent_id
 */
class ArticleCategory extends BaseCategory
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'article_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('title, content', 'required'),
			array('type, parent_id', 'numerical', 'integerOnly'=>true),
			array('title, alias, meta_keywords, meta_description', 'length', 'max'=>255),
			
			array('id, title, content, alias, meta_keywords, meta_description, type, parent_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return [
			'parent' => [static::BELONGS_TO, 'ArticleCategory', 'parent_id']
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
			'alias'            => 'Alias',
			'meta_keywords'    => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'type'             => 'Type',
			'parent_id'        => 'Parent',
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);

        $pagination = new CPagination();
        $pagination->pageSize = 15;

        $sort = new CSort();
		$sort->defaultOrder = 'id';
		$sort->attributes   = ['id', 'title', 'created_at'];

		return new CActiveDataProvider($this, array(
			'criteria'   => $criteria,
			'pagination' => $pagination,
			'sort'       => $sort
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	private $_url;
	
	public function get_url()
    {
        if ($this->_url === null)
        {
            $this->_url = url($this->_route, ['category' => $this->alias]);
        }
        return $this->_url;
    }
}
