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
class ProductCategory extends BaseCategory
{
	protected $_route = 'product/category';
	public $type = 'Product';

	public function defaultScope()
    {
        return [ 'condition' => "type = '{$this->type}'" ];
    }

	
	public function tableName()
	{
		return 'article_categories';
	}

	public function behaviors()
    {
        return array(
            'Category' => [
				'class'                  => 'CategoryBehavior',
				'title_attribute'        => 'title',
				'alias_attribute'        => 'alias',
				'default_criteria'       => ['order' => 't.title ASC'],
				'category_item_relation' => 'products'
            ],
            'AliasBehavior' => [
                'class'            => 'AliasBehavior',
                'source_attribute' => 'title',
                'alias_attribute'  => 'alias',
            ]
        );
    }

	public function rules()
    {
        return array(
            array('title', 'required'),
            array('title, alias, meta_keywords, meta_description', 'length', 'max'=>255),
            
            array('id, title, content, alias, meta_keywords, meta_description, type, parent_id', 'safe', 'on'=>'search'),
        );
    }

	public function relations()
	{
		return [
			'products' => [self::HAS_MANY, 'Product', 'category_id']
		];
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
