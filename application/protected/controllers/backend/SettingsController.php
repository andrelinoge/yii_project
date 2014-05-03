<?

class SettingsController extends BackendController
{
    public function actions()
    {
        return [
            'edit' => [
                'class'   => 'application.actions.crud.EditAction',
                'view'    => 'edit',
                'pk_name' => null
            ],
            'update' => [
                'class' => 'application.actions.crud.UpdateAction',
                'view'  => 'edit',
                'pk_name' => null,
                'redirect_to_index' => false
            ],
        ];
    }

    public function load_model()
    {
        return SiteSettings::get();
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
                    'edit', 'update'
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