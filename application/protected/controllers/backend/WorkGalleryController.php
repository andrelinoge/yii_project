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
        $model->detachBehavior('file');
        $model->attachBehavior('file', [
            'class'                 => 'ImageBehavior',
            'image_attribute'       => 'image',
            'is_ajax_upload'        => false,
            'image_folder'          => 'public/uploads/images/gallery',
            'temp_folder'           => 'public/uploads/temp',
            'thumbnails'            => [
                'm' => [375, 160],
                's' => [60, 40] 
            ]
        ]);
    }

    public function get_collection_provider()
    {
        $model = new WorkGallery();

        return $model->search();
    }
}