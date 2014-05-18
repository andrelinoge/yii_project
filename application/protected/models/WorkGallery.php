<?php

/**
 * This is the model class for table "slides".
 *
 * The followings are the available columns in table 'slides':
 * @property integer $id
 * @property integer $item_id
 * @property integer $category_id
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
        return array(
            'condition' => "t.type='" . $this->type. "'",
        );
    }

    public function tableName()
    {
        return 'work_gallery';
    }

    public function rules()
    {
        return [
            [ 'type, category_id', 'required' ],
            [ 'image', 'file', 'allowEmpty' => false, 'types' => 'jpg, jpeg, png' ],
            [ 'image, description, title,', 'length', 'max' => 255 ],
            [ 'type', 'length', 'max' => 20 ],
            [ 'id, image, text, type, owner_id', 'safe', 'on' => 'search' ]
        ];
    }

    public function relations()
    {
        return [
            'category' => [static::BELONGS_TO, 'GalleryCategory', 'category_id'],
        ];
    }

    public function behaviors()
    {
        return [
            'file' => [
                'class'                 => 'ImageBehavior',
                'image_attribute'       => 'image',
                'is_ajax_upload'        => false,
                'image_folder'          => 'public/uploads/images/gallery',
                'temp_folder'           => 'public/uploads/temp',
                'thumbnails'            => [
                    'm' => [260, 180],
                    's' => [70, 70]
                ]
            ]
        ];
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

    public function search()
    {
        $criteria = new CDbCriteria(['with' => 'category']);

        $criteria->compare('id',$this->id);

        $pagination = new CPagination();
        $pagination->pageSize = 2000;


        return new CActiveDataProvider($this, array(
            'criteria'   => $criteria,
            'pagination' => $pagination,
        ));
    }

    public function last($limit = null)
    {
        if ($limit)
        {
            $this->getDbCriteria()->mergeWith([
                'order' => 'id DESC',
                'limit' => $limit
            ]);
        }
        else
        {
            $this->getDbCriteria()->mergeWith([
                'order' => 'id DESC'
            ]);
        }

        return $this;
    }
}