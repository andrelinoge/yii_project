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
class Slide extends Image
{
    public $type = 'Slider';

    public function behaviors()
    {
        return [
            'file' => [
                'class'                 => 'ImageBehavior',
                'image_attribute'       => 'image',
                'is_ajax_upload'        => true,
                'image_folder'          => 'public/uploads/images/slider',
                'temp_folder'           => 'public/uploads/temp',
                'thumbnails'            => [
                    'm' => [770, 400],
                    's' => [100, 100]
                ]
            ]
        ];
    }

    public function defaultScope()
    {
        return array(
            'condition' => "type='" . $this->type. "'",
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Image the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}