<?

class Slider extends CWidget
{
    protected  $slides;

    public function init()
    {
        $this->slides = Slide::model()->findAll();
    }

    public function run()
    {
        $this->render(
            'slider_default',
            array(
                'slides' => $this->slides
            )
        );
    }
}