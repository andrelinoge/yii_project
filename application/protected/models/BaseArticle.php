<?php 
abstract class BaseArticle extends CActiveRecord
{    
    protected $_route = '';

    public function rules()
    {
        return [
            ['title, content, category_id', 'required'],
            ['title, alias', 'length', 'max' => 255],
            ['cover', 'file', 'allowEmpty' => true, 'types' => 'jpg,jpeg,png'],
            ['id, created_at, updated_at, cover, title, content, meta_keywords, meta_description, alias', 'safe', 'on'=>'search']
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'               => 'ID',
            'created_at'       => 'Created At',
            'updated_at'       => 'Updated At',
            'cover'            => 'Cover',
            'title'            => 'Title',
            'content'          => 'Text',
            'meta_keywords'    => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'alias'            => 'Transliterated Title',
            'category_id'      => 'Category'
        );
    }

    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('category_id',$this->category_id);
        $criteria->compare('created_at',$this->created_at,true);
        $criteria->compare('updated_at',$this->updated_at,true);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('alias',$this->alias,true);

        $pagination = new CPagination();
        $pagination->pageSize = 15;

        $sort = new CSort();
        $sort->attributes   = [
            'id' => [
                'asc' => 'id asc',
                'desk' => 'id desk'
            ], 
            'title', 'alias', 'category_id', 'created_at'
        ];  

        return new CActiveDataProvider($this, array(
            'criteria'   => $criteria,
            'pagination' => $pagination,
            'sort'       => $sort
        ));
    }

    abstract public function get_url();
}