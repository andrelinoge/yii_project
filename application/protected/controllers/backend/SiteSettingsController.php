<?

class SiteSettingsController extends BackendController
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
                'class'                 => 'application.actions.crud.UpdateAction',
                'view'                  => 'edit'
            ]
        ];
    }

    public function load_model($id)
    {
        return SiteSetting::model()->findByPk($id);
    }

    public function get_collection_provider()
    {
        $dp = SiteSetting::model()->search();
        if ($dp->totalItemCount == 0)
        {
            $settings = new SiteSetting();
            $settings->save();
        }
        return SiteSetting::model()->search();
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
                    'index', 'edit', 'update'
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