<?

class FromGallery extends CWidget
{
    public function run()
    {
    	$images = [];
        $this->render( 'from_gallery', [ 'images' => $images ] );
    }
}