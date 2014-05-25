<?

class CalcForm extends CFormModel
{
    public $window_system_id;
    public $glass_id;
    public $construction_type;
    public $width;
    public $height;

    const DEADLIGHT = 1;

    public function rules()
    {
        return [
            [ 'window_system_id, glass_id, construction_type, width, height', 'required' ],
            [ 'width, height', 'number' ]
        ];
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
            'password' => _( 'Пароль' ),
            'name' => _( 'Ім\'я' ),
        );
    }

    public function process()
    {
        // calc price
    }

    public function construction_types()
    {
        return [
            self::DEADLIGHT => _('Глухе')
        ];
    }

    public function price()
    {
        $price = 0;
        $glass         = Glass::model()->findByPk($this->glass_id);
        $window_system = WindowSystem::model()->findByPk($this->window_system_id);

        if (!$glass || !$window_system)
        {
            throw new CHttpException("Wrong params");
        }

        switch($this->construction_type)
        {
            case self::DEADLIGHT:

            default:
                $price = 0;
            break;
        }

        return $price;
    }
}