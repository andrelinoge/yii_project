<?

class FromGallery extends CWidget
{
    public function run()
    {
    	$images = WorkGallery::model()->recently(12)->findAll();
        $this->render( 'from_gallery', [ 'images' => $images ] );
    }
}