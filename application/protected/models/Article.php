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
class Article extends BaseArticle
{
	protected $_route = 'articles/show';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'articles';
	}

	public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return [
			'category' => [static::BELONGS_TO, 'ArticleCategory', 'category_id']
		];
	}


	private $_url;

	public function get_url()
    {
        if ($this->_url === null)
        {
            $this->_url = url($this->_route, ['category' => $this->category->alias, 'alias' => $this->alias]);
        }
        return $this->_url;
    }   
}
