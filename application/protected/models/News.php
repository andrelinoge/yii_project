<?

/**
 * This is the model class for table "articles".
 *
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
class News extends BaseArticle
{
	public $type = 'News';
	protected $_route = 'news/show';

	public function defaultScope()
    {
        return [ 'condition' => "type = '{$this->type}'" ];
    }

	public function tableName()
	{
		return 'articles';
	}

	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function rules()
    {
        return [
            ['title, content', 'required'],
            ['title, alias', 'length', 'max' => 255],
            ['cover', 'file', 'allowEmpty' => true, 'types' => 'jpg,jpeg,png'],
            ['id, created_at, updated_at, cover, title, content, meta_keywords, meta_description, alias', 'safe', 'on'=>'search']
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

	public function relations()
	{
		return [];
	}

	private $_url;

	public function get_url()
    {
        if ($this->_url === null)
        {
            $this->_url = url($this->_route, ['alias' => $this->alias]);
        }
        return $this->_url;
    }   
}
