<?

class SizerRequestForm extends CFormModel
{
    public $name;
    public $phone;
    public $address;
    //public $verify_code;

    public function rules()
    {
        return array(
            array(
                'name, phone',
                'required',
                'message' => _('обязательное поле')
            ),

            array(
                'address', 'safe'
            ),

            // array(
            //     'verify_code',
            //     'captcha',
            //     'allowEmpty'=>!CCaptcha::checkRequirements(),
            //     'captchaAction' => Yii::app()->createUrl( 'captcha/new' ),
            //     'message' => _('неправильный код')
            // ),
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

        $model->name = $this->name;
        $model->phone = $this->email;
        $model->address = $this->address;

        if ($model->save())
        {
            $mailer = new ApplicationMailer();
            $mailer->new_sizer_request($model);
        }
    }
}