<?

class WorkGalleryController extends ImagesController
{
    public function before_index($data_provider)
    {
        $this->breadcrumbs = [
            ['title' => 'WorkGallery']
        ];
    }

    public function before_upload($model)
    {
        $model->setScenario('ajax_create');
    }

    public function create_model()
    {
        return new WorkGallery();
    }

    public function load_model($id)
    {
        return WorkGallery::model()->findByPk($id);
    }

    public function before_update($model)
    {
        $model->setScenario('update');
    }

    public function get_collection_provider()
    {
        $model = new WorkGallery();

        return $model->search();
    }
}