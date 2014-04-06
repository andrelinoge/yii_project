<?php 
abstract class BaseArticle extends CActiveRecord
{    
    protected $_route = '';

    public function behaviors()
    {
        return [
            'timestampable' => [
                'class' => 'zii.behaviors.CTimestampBehavior',
                'setUpdateOnCreate' => false,
                'createAttribute' => 'created_at',
                'updateAttribute' => 'updated_at',
            ],

            'cover' => [
                'class' => 'ImageBehavior',
                'image_field' => 'cover_image',
                'image_folder' => 'public/uploads/images/articles',
                'temp_folder' => 'public/uploads/temp',
                'thumbnails' => [
                    'm' => [300, 300],
                    's' => [100, 100]
                ]
            ]
        ];
    } 

    public function rules()
    {
        return [
            ['title, text', 'required'],
            ['title, alias', 'length', 'max' => 255],
            ['cover', 'file', 'allowEmpty' => true, 'types' => 'jpg,jpeg,png'],
            ['id, created_at, updated_at, cover, title, text, meta_keywords, meta_description, alias', 'safe', 'on'=>'search']
        ];
    }

    abstract public function get_url();

}