<?

/*
 * @property integer $id
 * @property integer $item_id
 * @property string $image
 * @property string $alt
 * @property string $title
 * @property string $lang
 */
class ArticleImage extends Image
{
    public $type = 'Article';

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
                    's' => [70, 70]
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

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}