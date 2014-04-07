<?php

/**
 * This is the model class for table "slides".
 *
 * The followings are the available columns in table 'slides':
 * @property integer $id
 * @property integer $item_id
 * @property string $image
 * @property string $alt
 * @property string $title
 * @property string $lang
 */
class WorkGallery extends Image
{
    public $type = 'WorkGallery';

    public function defaultScope()
    {
        return [ 'condition' => "type = '{$this->type}'" ];
    }

    public function behaviors()
    {
        return [
            'file' => [
                'class'                 => 'ImageBehavior',
                'image_attribute'       => 'image',
                'is_ajax_upload'        => true,
                'image_folder'          => 'public/uploads/images/gallery',
                'temp_folder'           => 'public/uploads/temp',
                'thumbnails'            => [
                    'm' => [700, 700],
                    's' => [60, 40]
                ]
            ]
        ];
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}