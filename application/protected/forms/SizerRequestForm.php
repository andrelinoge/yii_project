<?

class SizerRequestForm extends CFormModel
{
    public $name;
    public $phone;
    public $address;
    public $content;
    public $verify_code;

    public function rules()
    {
        return array(
            array(
                'name, phone',
                'required',
                'message' => _('обязательное поле')
            ),

            array(
                'address, content', 'safe'
            ),

            array(
                'verify_code',
                'captcha',
                'allowEmpty'=>!CCaptcha::checkRequirements(),
                'captchaAction' => Yii::app()->createUrl( 'captcha/sizerWidget' ),
                'message' => _('неправильный код')
            ),
        );
    }

    public function attributeLabels()
    {
        return array(
            'verify_code' => _('код')
        );
    }

    public function save()
    {
        $model = new SizerRequest();
        $model->setAttributes($this->getAttributes());

        if ($model->save())
        {
            $mailer = new ApplicationMailer();
            $mailer->new_sizer_request($model);
        }
    }
}