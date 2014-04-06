<?php 
abstract class BaseCategory extends CActiveRecord
{    
    protected $_route = '';

    public function behaviors()
    {
        return array(
            'CategoryTreeBehavior' => [
                'class'            => 'CategoryTreeBehavior',
                'title_attribute'  => 'title',
                'alias_attribute'  => 'alias',
                'parent_attribute' => 'parent_id',
                'parent_relation'  => 'parent',
                'default_criteria' => ['order' => 't.title ASC']
            ]
        );
    } 

    public function rules()
    {
        return [
            array('title, alias', 'required'),
            array('title, alias', 'length', 'max' => 255)
        ];
    }

    abstract public function get_url();

}