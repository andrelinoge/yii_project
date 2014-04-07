<?php 
abstract class BaseCategory extends CActiveRecord
{    
    protected $_route = '';

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

    abstract public function get_url();

}