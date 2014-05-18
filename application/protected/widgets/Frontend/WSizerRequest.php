<?
class WSizerRequest extends CWidget
{
    public $modal = false;

    public function run()
    {
        if ($this->modal)
        {
            $this->render('sizer_request_modal', [
                'model' => new SizerRequestModalForm()
            ]);
        }
        else
        {
            $this->render('sizer_request', [
                'model' => new SizerRequestForm()
            ]);
        }
        
    }
}