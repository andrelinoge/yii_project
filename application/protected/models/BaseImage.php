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
abstract class BaseImage extends CActiveRecord
{
	public function tableName()
	{
		return 'images';
	}

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

	public function search()
	{
		$criteria = new CDbCriteria;
		$criteria->compare('type', $this->type);
		$criteria->compare('owner_id', $this->owner_id);

		$pagination = new CPagination();
        $pagination->pageSize = 4;

		return new CActiveDataProvider($this, array(
			'criteria'   => $criteria,
			'pagination' => $pagination
		));
	}

	public function defaultScope()
    {
        return [ 'condition' => "t.type = '{$this->type}'" ];
    }

    public function recently($limit)
    {
    	$this->getDbCriteria()->mergeWith([
	        'order' => 'id DESC',
	        'limit' => $limit
	    ]);
	    return $this;
    }
}