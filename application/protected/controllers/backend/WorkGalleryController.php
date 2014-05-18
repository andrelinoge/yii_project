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
            'new' => [
                'class'                 => 'application.actions.crud.NewAction',
                'view'                  => 'new'
            ],
            'create' => [
                'class'                 => 'application.actions.crud.CreateAction',
                'view'                  => 'new'
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

    public function create_model()
    {
        $model = new WorkGallery();

        return $model;
    }

    public function load_model($id)
    {
        return WorkGallery::model()->findByPk($id);
    }

    public function get_collection_provider()
    {
        $model = new WorkGallery();
        return $model->search();
    }
}