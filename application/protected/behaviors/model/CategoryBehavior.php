<?php
/**
 * @property string $title_attribute
 * @property string $alias_attribute
 *  
 */
class CategoryBehavior extends CActiveRecordBehavior
{
    public $title_attribute = 'title';
    public $alias_attribute = 'alias';
    public $default_criteria = [];
    public $category_item_relation = null;

    protected $_primary_key;
    protected $_table_schema;
    protected $_table_name;
    protected $_criteria;

    public function beforeDelete()
    {
        if (!empty($this->category_item_relation))
        {
            foreach ($$this->getOwner()->{$this->category_item_relation} as $item) 
            {
                $item->delete();
            }
        }
    }

    /**
     * Returns associated array ($id=>$title, $id=>$title, ...)
     * @return array
     */
    public function get_titles_list()
    {
        $this->_cached();

        $items = $this->_get_items_array([
            $this->_primary_key_attribute(),
            $this->title_attribute
        ]);

        $result = [];
        foreach($items as $item)
        {
            $result[$item[$this->_primary_key_attribute()]] = $item[$this->title_attribute];
        }

        return $result;
    }

    /**
     * Returns associated array ($alias=>$title, $alias=>$title, ...)
     * @return array
     */
    public function get_aliases_list()
    {
        $this->_cached();

        $items = $this->_get_items_array([
            $this->alias_attribute,
            $this->title_attribute
        ]);

        $result = [];
        foreach($items as $item)
        {
            $result[$item[$this->alias_attribute]] = $item[$this->title_attribute];
        }

        return $result;
    }

    /**
     * Returns associated array ($url=>$title, $url=>$title, ...)
     * @return array
     */
    public function get_urls_list()
    {
        $this->_cached();

        $criteria = $this->_get_owner_criteria();
        $items    = $this->_cached($this->getOwner())->findAll($criteria);
        $result   = [];

        foreach ($items as $item)
        {
            $result[$item->get_url()] = $item->{$this->title_attribute};
        }

        return $result;
    }

    public function get_url()
    {
        return '#';
    }

    protected function _get_items_array($attributes)
    {
        $criteria = $this->_get_owner_criteria();

        $attributes = $this->_alias_attributes(array_unique(array_merge($attributes, array($this->_primary_key_attribute()))));

        $criteria->select = implode(', ', $attributes);

        $command = $this->_create_find_command($criteria);
        $this->_clear_owner_criteria();

        return $command->queryAll();
    }

    protected function _create_find_command($criteria)
    {
        $builder = new CDbCommandBuilder(Yii::app()->db->getSchema());
        $command = $builder->createFindCommand($this->_get_table_name(), $criteria);

        return $command;
    }

    protected function _cached($model=null)
    {
        if ($model === null)
        {
            $model = $this->getOwner();
        }

        $connection = $model->getDbConnection();
        return $model->cache($connection->queryCachingDuration);
    }

    protected function _alias_attributes($attributes)
    {
        $aliases_attributes = [];
        foreach ($attributes as $attribute) 
        {
            $aliases_attributes[] = 't.' . $attribute;
        }

        return $aliases_attributes;
    }

    protected function _primary_key_attribute()
    {
        if ($this->_primary_key === null)
        {
            $this->_primary_key = $this->get_table_schema()->primaryKey;
        }

        return $this->_primary_key;
    }

    protected function get_table_schema()
    {
        if ($this->_table_schema === null)
        {
            $this->_table_schema = $this->getOwner()->getMetaData()->tableSchema;
        }

        return $this->_table_schema;
    }

    protected function _get_table_name()
    {
        if ($this->_table_name === null)
        {
            $this->_table_name = $this->getOwner()->tableName();
        }

        return $this->_table_name;
    }

    protected function _get_owner_criteria()
    {
        $criteria = clone $this->getOwner()->getDbCriteria();
        $criteria->mergeWith($this->default_criteria);
        $this->_criteria = clone $criteria;

        return $criteria;
    }

    protected function _clear_owner_criteria()
    {
        $this->getOwner()->setDbCriteria(new CDbCriteria());
    }

}