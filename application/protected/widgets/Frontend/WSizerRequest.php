<?
class WSizerRequest extends CWidget
{
    public function run()
    {
        $this->render('sizer_request', [
            'model' => new SizerRequestForm()
        ]);
    }
}