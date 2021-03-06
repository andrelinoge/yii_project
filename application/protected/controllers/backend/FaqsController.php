<?

class FaqsController extends BackendController
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
            ],
            'view' => [
                'class'                 => 'application.actions.crud.ViewAction',
                'view'                  => 'view'
            ],
        ];
    }

    public function create_model()
    {
        return new Faq();
    }

    public function load_model($id)
    {
        return Faq::model()->findByPk($id);
    }

    public function get_collection_provider()
    {
        return Faq::model()->search();
    }

    /**                                     FILTERS                                **/

    public function filters()
    {
        return [ 'accessControl' ];
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