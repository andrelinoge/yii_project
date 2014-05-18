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
class GalleryCategory extends BaseCategory
{
    protected $_route = '';

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'gallery_categories';
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
            'parent' => [static::BELONGS_TO, 'GalleryCategory', 'parent_id']
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
            $this->_url = url($this->_route, ['category_alias' => $this->alias]);
        }
        return $this->_url;
    }
}
