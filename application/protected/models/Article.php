<?

/**
 * This is the model class for table "articles".
 *
 * The followings are the available columns in table 'articles':
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $cover_image
 * @property string $title
 * @property string $text
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $alias
 */
class Article extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'articles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			['title, text', 'required'],
			['title, alias', 'length', 'max' => 255],
            ['cover', 'file', 'allowEmpty' => true, 'types' => 'jpg,jpeg,gif,png'],
			['id, created_at, updated_at, cover, title, text, meta_keywords, meta_description, alias', 'safe', 'on'=>'search']
		];
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array();
	}

    public function behaviors()
    {
        return [
            'timestampable' => [
                'class' => 'zii.behaviors.CTimestampBehavior',
                'setUpdateOnCreate' => false,
                'createAttribute' => 'created_at',
                'updateAttribute' => 'updated_at',
            ],

            'cover' => [
                'class' => 'ImageBehavior',
                'image_field' => 'cover_image',
                'image_folder' => 'public/uploads/images/articles',
                'temp_folder' => 'public/uploads/temp',
                'thumbnails' => [
                    'm' => [300, 300],
                    's' => [100, 100]
                ]
            ]
        ];
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'cover' => 'Cover',
			'title' => 'Title',
			'text' => 'Text',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
			'alias' => 'Transliterated Title',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);

        $pagination = new CPagination();
        $pagination->pageSize = 5;

        $sort = new CSort();
        $sort->defaultOrder = 'id';
        $sort->attributes = ['id', 'title', 'created_at'];

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
            'pagination' => $pagination,
            'sort' => $sort
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
