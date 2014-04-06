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
 */
class Article extends BaseArticle
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'articles';
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'               => 'ID',
			'created_at'       => 'Created At',
			'updated_at'       => 'Updated At',
			'cover'            => 'Cover',
			'title'            => 'Title',
			'text'             => 'Text',
			'meta_keywords'    => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'alias'            => 'Transliterated Title'
		);
	}

	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);

        $pagination = new CPagination();
        $pagination->pageSize = 15;

        $sort = new CSort();
		$sort->defaultOrder = 'id';
		$sort->attributes   = ['id', 'title', 'created_at'];

		return new CActiveDataProvider($this, array(
			'criteria'   => $criteria,
			'pagination' => $pagination,
			'sort'       => $sort
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	private $_url;

	public function get_url()
    {
        if ($this->_url === null)
        {
            $this->_url = url($this->_route, ['category' => $this->category->alias, 'id' => $this->id]);
        }
        return $this->_url;
    }   
}
