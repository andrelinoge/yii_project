<?

class WindowSystemsController extends BackendController
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
                'view'                  => 'add',
                'breadcrumbs'           => $this->breadcrumbs('new')
            ],
            'create' => [
                'class'                 => 'application.actions.crud.CreateAction',
                'view'                  => 'add',
                'breadcrumbs'           => $this->breadcrumbs('new')
            ],
            'edit' => [
                'class'                 => 'application.actions.crud.EditAction',
                'view'                  => 'edit',
                'breadcrumbs'           => $this->breadcrumbs('edit')
            ],
            'update' => [
                'class'                 => 'application.actions.crud.UpdateAction',
                'view'                  => 'edit',
                'breadcrumbs'           => $this->breadcrumbs('edit')
            ],
            'delete' => [
                'class'                 => 'application.actions.crud.DeleteAction',
            ]
        ];
    }

    private function breadcrumbs($action = 'new')
    {
        $breadcrumbs = [
            'index' => [['title' => 'Віконні системи']],
            'new'   => [
                ['title' => 'Віконні системи', 'url' => url("{$this->uniqueid}/index")],
                ['title' => 'Нова']
            ],
            'edit'  => [
                ['title' => 'Віконні системи', 'url' => url("{$this->uniqueid}/index")],
                ['title' => 'Редагування']
            ]
        ];
        return $breadcrumbs[$action];
    }

    public function create_model()
    {
        $model = new WindowSystem();
        return $model;
    }

    public function load_model($id)
    {
        return WindowSystem::model()->findByPk($id);
    }

    public function before_index($data_provider)
    {
        $model = new WindowSystem();

        $this->breadcrumbs = $this->breadcrumbs('index');
    }

    public function get_collection_provider()
    {
        $model = new WindowSystem();
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