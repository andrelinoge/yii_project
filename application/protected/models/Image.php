<?

/**
 * This is the model class for table "images".
 *
 * The followings are the available columns in table 'images':
 * @property integer $id
 * @property string $image
 * @property string $text
 * @property string $type
 * @property integer $owner_id
 */
class Image extends CActiveRecord
{
	public function behaviors()
    {
        return [
            'imagable' => [
                'class' => 'ImageBehavior',
                'image_field' => 'image',
                'image_folder' => 'public/uploads/images/gallery',
                'temp_folder' => 'public/uploads/temp',
                'thumbnails' => [
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
		return array(
			array('image, text, type', 'required'),
			array('image, text', 'length', 'max'=>255),
			array('type', 'length', 'max'=>20),
			array('id, image, text, type, owner_id', 'safe', 'on'=>'search'),
		);
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
			'id' => 'ID',
			'image' => 'Image',
			'text' => 'Text',
			'type' => 'Type',
			'owner_id' => 'Owner',
		);
	}

	/**
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('owner_id',$this->owner_id);

		$pagination = new CPagination();
        $pagination->pageSize = 20;

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