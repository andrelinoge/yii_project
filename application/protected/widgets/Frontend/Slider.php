<?

class Slider extends CWidget
{
    /** @var Slider[] */
    protected  $slides;

    public function init()
    {
        $this->slides = Slide::getSlides();
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