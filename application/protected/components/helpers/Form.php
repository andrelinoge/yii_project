<?
class Form
{
    /**
     * @param $model
     * @param string $action
     * @param array $html_options
     * @param string $method
     * @return string
     */
    public static function begin($model, $action = '', $html_options = array(), $method = 'post')
    {
        $html_options['name'] = get_class($model);
        return CHtml::beginForm($action, $method, $html_options);
    }

    public static function end_form()
    {
        return CHtml::endForm();
    }

    /**
     * @param string $model
     * @param string $attribute
     * @param array $html_options
     * @return string
     */
    public static function label($model, $attribute, $html_options = array())
    {
        return CHtml::activeLabel($model, $attribute, $html_options);
    }

    /**
     * @param $model
     * @param $attribute
     * @param array $html_options
     * @return string
     */
    public static function input($model, $attribute, $html_options = array())
    {
        return CHtml::activeTextField($model, $attribute, $html_options);
    }

    /**
     * @param $model
     * @param $attribute
     * @param array $html_options
     * @return string
     */
    public static function password($model, $attribute, $html_options = array())
    {
        return CHtml::activePasswordField($model, $attribute, $html_options);
    }

    /**
     * @param $model
     * @param $attribute
     * @param array $html_options
     * @return string
     */
    public static function hidden($model, $attribute, $html_options = array())
    {
        return CHtml::activeHiddenField($model, $attribute, $html_options);
    }

    /**
     * @param $model
     * @param $attribute
     * @param array $html_options
     * @return string
     */
    public static function email($model, $attribute, $html_options = array())
    {
        return CHtml::activeEmailField($model, $attribute, $html_options);
    }

    /**
     * @param $model
     * @param $attribute
     * @param array $html_options
     * @return string
     */
    public static function textarea($model, $attribute, $html_options = array())
    {
        return CHtml::activeTextArea($model, $attribute, $html_options);
    }

    /**
     * @param string $model
     * @param bool $attribute
     * @param array $html_options
     * @return string
     */
    public static function checkbox($model, $attribute, $html_options = array())
    {
        return CHtml::activeCheckBox($model, $attribute, $html_options);
    }

    /**
     * @param string $label
     * @param array $html_options
     * @return string
     */
    public static function submit($label = 'submit', $html_options = array())
    {
        $html_options['type'] = 'submit';
        return CHtml::button($label, $html_options);
    }

    /**
     * @param $model
     * @param $attribute
     * @param $data
     * @param array $html_options
     * @return string
     */
    public static function radio_buttons($model, $attribute, $data, $html_options = array())
    {
        return CHtml::activeRadioButtonList($model, $attribute, $data, $html_options);
    }
}