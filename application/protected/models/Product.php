<?

/**
 * The followings are the available columns in table 'articles':
 * @property integer $id
 * @property integer $category_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $cover_image
 * @property string $title
 * @property string $content
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $alias
 * @property string $type
 *
 * @property BaseCategory $category
 */
class Product extends BaseArticle
{
	public $type = 'Product';
	protected $_route = 'products/show';

	public function defaultScope()
    {
        return [ 'condition' => "t.type = '{$this->type}'" ];
    }

	public function tableName()
	{
		return 'articles';
	}

	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

	public function relations()
	{
		return [
			'category' => [static::BELONGS_TO, 'ProductCategory', 'category_id'],
            'gallery'   => [static::HAS_MANY, 'ProductImage', 'owner_id']
		];
	}

	public function behaviors()
    {
        return [
            'timestampable' => [
                'class'             => 'zii.behaviors.CTimestampBehavior',
                'setUpdateOnCreate' => false,
                'createAttribute'   => 'created_at',
                'updateAttribute'   => 'updated_at',
            ],

            'cover' => [
                'class'           => 'ImageBehavior',
                'image_attribute' => 'cover_image',
                'image_folder'    => 'public/uploads/images/articles',
                'temp_folder'     => 'public/uploads/temp',
                'thumbnails'      => [
                    'm' => [355, 115],
                    's' => [110, 110]
                ]
            ],

            'alias' => [
                'class'            => 'AliasBehavior',
                'source_attribute' => 'title',
                'alias_attribute'  => 'alias',
            ]
        ];
    }

	private $_url;

	public function get_url()
    {
        if ($this->_url === null)
        {
            $this->_url = url($this->_route, ['category_alias' => $this->category->alias, 'product_alias' => $this->alias]);
        }
        return $this->_url;
    }   
}