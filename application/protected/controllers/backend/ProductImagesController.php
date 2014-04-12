<?

class ProductImagesController extends BackendController
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
                'title' => 'Products',
                'url' => url('products/index')
            ],
            ['title' => 'Product images']
        ];
    }

    public function before_upload($model)
    {
        $model->setScenario('ajax_create');
    }

    public function create_model()
    {
        $model = new ProductImage();
        $model->owner_id = get_param('owner_id');

        return $model;
    }

    public function load_model($id)
    {
        return ProductImage::model()->findByPk($id);
    }

    public function before_update($model)
    {
        $model->setScenario('update');
        $model->file->is_ajax_upload = false;
    }

    public function get_collection_provider()
    {
        $owner_id = get_param('owner_id');
        if (!$owner_id)
        {
            throw new CHttpException("404");
        }

        $model = new ProductImage();
        $model->owner_id = get_param('owner_id');

        return $model->search();
    }
}