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

    public function create_model()
    {
        $model = new Image();
        $model->type = get_param('type');

        if (empty($model->type))
        {
            throw new CException("Type not specified");
        }

        $model->owner_id = get_param('owner_id');

        return $model;
    }

    public function load_model($id)
    {
        return Image::model()->findByPk($id);
    }

    public function before_update($model)
    {
        $model->detachBehavior('file');
        $model->attachBehavior('file', [
            'class'                 => 'ImageBehavior',
            'image_field'           => 'image',
            'is_ajax_upload'        => false,
            'image_folder'          => 'public/uploads/images/gallery',
            'temp_folder'           => 'public/uploads/temp',
            'thumbnails'            => [
                'm' => [300, 300],
                's' => [100, 100]
            ]
        ]);
    }

    public function before_upload($model)
    {
        $model->setScenario('ajax_create');
    }

    public function get_collection_provider()
    {
        $model = new Image();
        $model->type = get_param('type');

        if (empty($model->type))
        {
            throw new CException("Type not specified");
        }

        $model->owner_id = get_param('owner_id');

        return $model->search();
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
                    'index', 'edit', 'update', 'delete', 'upload'
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