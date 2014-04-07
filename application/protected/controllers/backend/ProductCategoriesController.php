<?

class ProductCategoriesController extends BackendController
{
    public function actions()
    {
        return [
            'index' => [
                'class'                 => 'application.actions.crud.IndexAction',
                'view'                  => 'index',
                'ajax_view'             => '_index'
            ],
            'new' => [
                'class'                 => 'application.actions.crud.NewAction',
                'view'                  => 'add'
            ],
            'create' => [
                'class'                 => 'application.actions.crud.CreateAction',
                'view'                  => 'add'
            ],
            'edit' => [
                'class'                 => 'application.actions.crud.EditAction',
                'view'                  => 'edit'
            ],
            'update' => [
                'class'                 => 'application.actions.crud.UpdateAction',
                'view'                  => 'edit'
            ],
            'delete' => [
                'class'                 => 'application.actions.crud.DeleteAction',
            ]
        ];
    }

    public function create_model()
    {
        $model = new ProductCategory();
        $model->parent_id = get_param('parent_id', 0);
        return $model;
    }

    public function load_model($id)
    {
        return ProductCategory::model()->findByPk($id);
    }

    public function before_index($data_provider)
    {
        $model = new ProductCategory();
        $model->parent_id = get_param('parent_id', null);

        $this->breadcrumbs = [];
    }

    public function get_collection_provider()
    {
        $model = new ProductCategory();
        $model->parent_id = get_param('parent_id', null);
        return $model->search();
    }

    /**                                     FILTERS                                **/

    public function filters()
    {
        return ['accessControl' ];
    }

    public function accessRules()
    {
        return [
            [
                'allow',
                'actions' => [
                    'index', 'new', 'create', 'edit', 'update', 'delete', 'view'
                ],
                'roles' => ['admin']
            ],

            [
                'deny',
                'users' => [ '*' ]
            ]
        ];
    }
}