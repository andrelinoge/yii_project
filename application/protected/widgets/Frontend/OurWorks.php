<?
class OurWorks extends CWidget
{
	public function run()
	{
		$this->render('our_works', [
			'gallery' => WorkGallery::model()->last(12)->findAll()
		]);
	}
}