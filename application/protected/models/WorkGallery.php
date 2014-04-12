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
class WorkGallery extends BaseImage
{
    public $type = 'WorkGallery';

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
                    'm' => [375, 160],
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