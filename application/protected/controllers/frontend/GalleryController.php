<?
class GalleryController extends FrontendController
{
	public function actionIndex()
	{
		$data_provider = WorkGallery::model()->search();
		$gallery       = $data_provider->getData();
		$pager         = $data_provider->getPagination();	

		if (is_ajax())
		{
			$content = $this->renderPartial('_index', [
				'gallery' => $gallery,
				'pager'   => $pager
			], true);

			$next_page = ($_GET['page'] + 1 <= $pager->getPageCount()) ? $_GET['page'] + 1 : false;

			success(null, [
				'content'   => $content,
				'next_page' => $next_page
			]);
		}
		else
		{
			$this->render('index', [
				'gallery' => $gallery,
				'pager'   => $pager
			]);
		}
	}
}