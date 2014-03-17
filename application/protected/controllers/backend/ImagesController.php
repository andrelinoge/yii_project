<?

class ImagesController extends BackendController
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
            ],
            'gallery' => [
                'class'                 => 'application.actions.crud.IndexAction',
                'view'                  => 'gallery',
                'ajax_view'             => '_gallery',
                'getter_collection_provider_method' => 'get_gallery'
            ]
        ];
    }

    public function create_model()
    {
        return new Image();
    }

    public function load_model($id)
    {
        return Image::model()->findByPk($id);
    }

    public function get_collection_provider()
    {
        $image = new Image();
        $image->type = get_param('type');
        $image->owner_id = get_param('id');

        return $image->search();
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
                    'index', 'new', 'create', 'update', 'delete'
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