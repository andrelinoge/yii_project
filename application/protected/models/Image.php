<?

/**
 * This is the model class for table "images".
 *
 * The followings are the available columns in table 'images':
 * @property integer $id
 * @property string $image
 * @property string $title
 * @property string $description
 * @property string $type
 * @property integer $owner_id
 */
class Image extends CActiveRecord
{
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
                    'm' => [300, 300],
                    's' => [100, 100]
                ]
            ]
        ];
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return [
			[ 'type', 'required' ],
			[ 'image', 'file', 'allowEmpty' => false, 'types' => 'jpg, jpeg, png', 'on' => 'create' ],
			[ 'image', 'file', 'allowEmpty' => true, 'types' => 'jpg, jpeg, png', 'on' => 'ajax_create' ],
			[ 'image', 'file', 'allowEmpty' => true, 'types' => 'jpg, jpeg, png', 'on' => 'update' ],
			[ 'image, description, title,', 'length', 'max' => 255 ],
			[ 'type', 'length', 'max' => 20 ],
			[ 'id, image, text, type, owner_id', 'safe', 'on' => 'search' ]
		];
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return [];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'          => 'ID',
			'image'       => 'Image',
			'title'       => 'Title',
			'description' => 'Text',
			'type'        => 'Type',
			'owner_id'    => 'Owner of image'
		);
	}

	/**
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = new CDbCriteria;
		$criteria->compare('type', $this->type);
		$criteria->compare('owner_id', $this->owner_id);

		$pagination = new CPagination();
        $pagination->pageSize = 30;

		return new CActiveDataProvider($this, array(
			'criteria'   => $criteria,
			'pagination' => $pagination
		));
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