<?

class WorkGalleryController extends BackendController
{
    public function actions()
    {
        return [
            'index' => [
                'class'                 => 'application.actions.crud.IndexAction',
                'view'                  => 'index',
                'ajax_view'             => '_index',
            ],
            'edit' => [
                'class'                 => 'application.actions.crud.EditAction',
                'view'                  => 'edit'
            ],
            'update' => [
                'class'                 => 'application.actions.crud.UpdateImageAction',
                'view'                  => 'edit'
            ],
            'delete' => [
                'class'                 => 'application.actions.crud.DeleteAction',
            ],
            'view' => [
                'class'                 => 'application.actions.crud.ViewAction',
            ],
            'upload' => [
                'class'                 => 'application.actions.crud.UploadImageAction',
                'upload_and_save'       => true,
                'ajax_view'             => '_thumbnail'
            ]
        ];
    }

    public function before_index($data_provider)
    {
        $this->breadcrumbs = [
            [
                'title' => 'Work gallery'
            ]   
        ];
    }

    public function before_upload($model)
    {
        $model->setScenario('ajax_create');
    }

    public function create_model()
    {
        $model = new WorkGallery();

        return $model;
    }

    public function load_model($id)
    {
        return WorkGallery::model()->findByPk($id);
    }

    public function before_update($model)
    {
        $model->setScenario('update');
        $model->file->is_ajax_upload = false;
    }

    public function get_collection_provider()
    {
        $model = new WorkGallery();
        return $model->search();
    }
}