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
class Slide extends BaseImageGalleryML
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Slider the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'slides';
	}

    public function init()
    {
        $this->setTempFolder( '/public/uploads/temp/' );
        $this->setUploadFolder( '/public/uploads/slider/' );
        $this->setThumbsSettings(
            array(
                $this->thumbsPrefixMedium => array( 640, 480 ),
            )
        );
    }

    public static function createNew( $image )
    {
        $newItemId = static::getLastId() + 1;

        // create set of gallery records with the same item_id
        foreach( self::getLanguages() as $lang )
        {
            /** @var $model BaseImageGalleyTableML */
            $model = new self;

            $model->item_id = $newItemId;
            $model->image = $image;
            $model->alt = '';
            $model->title = '';
            $model->lang = $lang;
            $model->save();

        }

        return $newItemId;
    }

    public static function updateItems( $itemId, $image )
    {
        foreach( static::getLanguages() as $lang )
        {
            $model = static::model()->find(
                'item_id = :itemId AND lang = :lang',
                array(
                    ':itemId' => $itemId,
                    ':lang' => $lang
                )
            );

            if ( $model )
            {
                $model->image = $image;
                $model->save();
            }
            else
            {
                $new = static::model();
                $new->item_id = $itemId;
                $new->image = $image;
                $new->alt = '';
                $new->title = '';
                $new->lang = $lang;
                $new->save();
            }
        }
    }

    /**
     * @return Slider[]
     */
    public static function getSlides()
    {
        return self::model()->findAllByAttributes( array( 'lang' => self::getCurrentLanguage() ) );
    }

}