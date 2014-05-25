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
            [ 'window_system_id, glass_id, construction_type, width, height', 'required', 'message' => _('Обов\'язкове поле') ],
            [ 'width, height', 'numerical' ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'window_system_id'  => _('Віконна система'),
            'glass_id'          => _('Склопакет'),
            'construction_type' => _('Тип конструкції'),
            'width'             => _('Ширина'),
            'height'            => _('Висота'),
        ];
    }

    public static function construction_types()
    {
        return [
            static::DEADLIGHT => _('Глухе')
        ];
    }

    public function price()
    {
        $price         = 0;
        $glass         = Glass::model()->findByPk($this->glass_id);
        $window_system = WindowSystem::model()->findByPk($this->window_system_id);
        $perimetry     = 2*($this->width + $this->height)/1000;

        if (!$glass || !$window_system)
        {
            throw new CHttpException("Wrong params");
        }

        switch($this->construction_type)
        {
            case self::DEADLIGHT:

            default:
                # ціна за м^2
                $glass_price               = $glass->price * ($this->width - 2 * $window_system->width_profile_frame) * ($this->height - 2 * $window_system->width_profile_frame)/1000;
                # ціна за м
                $profile_price             = $perimetry * ($window_system->profile_frame + $window_system->reinforcement + $window_system->seal + $window_system->glazing);
                $profile_window_sill_price = $this->width * $window_system->profile_window_sill / 1000;

                $price = $glass_price + $profile_price + $profile_window_sill_price;
            break;
        }

        return round($price);
    }
}