<?

class CalcForm extends CFormModel
{
    public $window_system_id;
    public $glass_id;
    public $construction_type;
    public $width;
    public $height;
    public $action;

    public $name;
    public $phone;

    const DEADLIGHT    = 1;
    const ONE_SASH     = 2;
    const TWO_SASHES   = 3;
    const THREE_SASHES = 4;

    const GET_PRICE = 'price';
    const SAVE      = 'save';

    public function rules()
    {
        return [
            [ 'window_system_id, glass_id, construction_type, width, height', 'required', 'message' => _('Обов\'язкове поле') ],
            [ 'width, height', 'numerical' ],
            [ 'action', 'safe'],
            [ 'name, phone', 'safe'],
            [ 'name, phone', 'required', 'on' => 'save_calculations', 'message' => _('Обов\'язкове поле')]
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
            'name'              => _('Ім\'я'),
            'phone'             => _('Телефон')
        ];
    }

    public function beforeValidate()
    {
        if ($this->action == static::SAVE)
        {
            $this->scenario = 'save_calculations';
        }

        return parent::beforeValidate();
    }

    public function afterValidate()
    {
        $this->width  = $this->width/1000;
        $this->height = $this->height/1000;
    }

    public static function construction_types()
    {
        return [
            static::DEADLIGHT    => _('Глухе'),
            static::ONE_SASH     => _('Одна створка'),
            static::TWO_SASHES   => _('Дві створка'),
            static::THREE_SASHES => _('Три створка')
        ];
    }

    public function price()
    {
        $glass         = Glass::model()->findByPk($this->glass_id);
        $window_system = WindowSystem::model()->findByPk($this->window_system_id);
        $perimetry     = 2*($this->width + $this->height);
        $furniture     = Furniture::model()->findAllByAttributes([
            'construction_type' => $this->construction_type
        ]);

        $furniture_price = 0;
        foreach($furniture as $furniture_item)
        {
            $furniture_price += $furniture_item->price * $furniture_item->count;
        }

        if (!$glass || !$window_system)
        {
            throw new CHttpException("Wrong params");
        }

        $window_system->normailze_measures();
        $price = 0;

        switch($this->construction_type)
        {
            case self::ONE_SASH:
                $price = $this->one_sash_price($glass, $window_system, $perimetry, $furniture_price);
            break;

            case self::TWO_SASHES:
                $price = $this->two_sashes_price($glass, $window_system, $perimetry, $furniture_price);
            break;

            case self::THREE_SASHES:
                $price = $this->three_sashes_price($glass, $window_system, $perimetry, $furniture_price);
            break;

            case self::DEADLIGHT:
            default:
                $price = $this->deadlight_price($glass, $window_system, $perimetry, $furniture_price);
            break;
        }

        $site_settings = SiteSettings::get();
        return $price * $site_settings->rate_exchange;
    }

    protected function deadlight_price($glass, $window_system, $perimetry, $furniture_price)
    {
        $glass_price               = $glass->price * ($this->width - 2 * $window_system->width_profile_frame) * ($this->height - 2 * $window_system->width_profile_frame);
        $profile_price             = $perimetry * ($window_system->profile_frame + $window_system->reinforcement + $window_system->seal + $window_system->glazing);
        $profile_window_sill_price = $this->width * $window_system->profile_window_sill;

        return round(($glass_price + $profile_price + $profile_window_sill_price + $furniture_price) * $window_system->profit_coefficient);
    }

    protected function one_sash_price($glass, $window_system, $perimetry, $furniture_price)
    {
        $glass_price               = $glass->price * ($this->width - 2 * $window_system->width_profile_frame - 2 * $window_system->width_profile_leaf) * ($this->height - 2 * $window_system->width_profile_frame - 2 * $window_system->width_profile_leaf);
        $profile_price             = $perimetry * ($window_system->profile_frame + $window_system->reinforcement + $window_system->seal + $window_system->glazing);
        $profile_window_sill_price = $this->width * $window_system->profile_window_sill;
        $leaf_price                = ($perimetry - 4 * $window_system->width_profile_frame) * $window_system->profile_leaf;

        return round(($leaf_price + $glass_price + $profile_price + $profile_window_sill_price + $furniture_price) * $window_system->profit_coefficient);
    }

    protected function two_sashes_price($glass, $window_system, $perimetry, $furniture_price)
    {
        $width = ($this->width - 2 * $window_system->width_profile_frame) / 2;

        $deadlight_glass_price     = $glass->price * ($width - $window_system->width_profile_impost) * ($this->height - 2 * $window_system->width_profile_frame);
        $sash_glass_price          = $glass->price * ($width - 2 * $window_system->width_profile_leaf) * ($this->height - 2 * $window_system->width_profile_frame - 2 * $window_system->width_profile_leaf);
        $profile_price             = $perimetry * ($window_system->profile_frame + $window_system->reinforcement + $window_system->seal + $window_system->glazing);
        $profile_window_sill_price = $this->width * $window_system->profile_window_sill;
        $leaf_price                = (2 * $width + 2 * ($this->height - 2 * $window_system->width_profile_frame)) * $window_system->profile_leaf;
        $impost_price              = $window_system->profile_impost * ($this->height - 2 * $window_system->width_profile_frame);
        
        return round(($leaf_price + $deadlight_glass_price + $sash_glass_price + $profile_price + $profile_window_sill_price + $furniture_price + $impost_price) * $window_system->profit_coefficient);
    }

    protected function three_sashes_price($glass, $window_system, $perimetry)
    {
        $width = ($this->width - 2 * $window_system->width_profile_frame) / 3;

        $deadlight_glass_price     = $glass->price * ($width - $window_system->width_profile_impost) * ($this->height - 2 * $window_system->width_profile_frame) *2;
        $sash_glass_price          = $glass->price * ($width - 2 * $window_system->width_profile_leaf) * ($this->height - 2 * $window_system->width_profile_frame - 2 * $window_system->width_profile_leaf);
        $profile_price             = $perimetry * ($window_system->profile_frame + $window_system->reinforcement + $window_system->seal + $window_system->glazing);
        $profile_window_sill_price = $this->width * $window_system->profile_window_sill;
        $leaf_price                = (2 * $width + 2 * ($this->height - 2 * $window_system->width_profile_frame)) * $window_system->profile_leaf;
        $impost_price              = $window_system->profile_impost * ($this->height - 2 * $window_system->width_profile_frame);
        
        return round(($leaf_price + $deadlight_glass_price + $sash_glass_price + $profile_price + $profile_window_sill_price + $furniture_price + $impost_price) * $window_system->profit_coefficient);
    }

    public function save()
    {
        $message = new CalcRequest();

        $message->setAttributes($this->getAttributes());

        $message->price = $this->price();
        $message->width *= 1000;
        $message->height *= 1000;

        $message->save();
    }
}