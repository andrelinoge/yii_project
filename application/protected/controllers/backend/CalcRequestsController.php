<?

class CalcRequestsController extends BackendController
{
    public function actions()
    {
        return [
            'index' => [
                'class'                 => 'application.actions.crud.IndexAction',
                'view'                  => 'index',
                'ajax_view'             => '_index'
            ],
            'delete' => [
                'class'                 => 'application.actions.crud.DeleteAction',
            ],
            'read' => [
                'class'                 => 'application.actions.crud.IndexAction',
                'view'                  => 'index',
                'ajax_view'             => '_index',
                'getter_collection_provider_method' => 'get_read_messages'
            ],
            'unread' => [
                'class'                 => 'application.actions.crud.IndexAction',
                'view'                  => 'index',
                'ajax_view'             => '_index',
                'getter_collection_provider_method' => 'get_unread_messages'
            ],
            'view' => [
                'class'                 => 'application.actions.crud.ViewAction',
                'view'                  => 'view'
            ],
        ];
    }

    public function before_view($model)
    {
        if (!$model->is_read)
        {
            $model->is_read = true;   
            $model->update(['is_read']);
        }
    }

    public function create_model()
    {
    }

    public function load_model($id)
    {
        return CalcRequest::model()->findByPk($id);
    }

    public function get_collection_provider()
    {
        return CalcRequest::model()->search();
    }

    public function get_read_messages()
    {
        return CalcRequest::model()->search_read();
    }

    public function get_unread_messages()
    {
        return CalcRequest::model()->search_unread();
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
                    'index', 'read', 'unread', 'view', 'delete'
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