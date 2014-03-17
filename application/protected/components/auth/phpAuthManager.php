<?php
/**
 * @author Andre Linoge
 */

class phpAuthManager extends CPhpAuthManager
{

    public function init()
    {
        // Roles description will put in file auth.php in config folder of application
        if($this->authFile === NULL)
        {
            $this->authFile = Yii::getPathOfAlias( 'application.config.auth' ).'.php';
        }

        parent::init();

        // assign user role id with role description from auth.php
        if( !Yii::app()->user->is_guest() )
        {
            $this->assign(
                self::get_role_name( Yii::app()->user->get_role() ),
                Yii::app()->user->id
            );
        }
    }

    /**
     * return description for user role using User model
     * @param $roleId
     * @return mixed
     */
    static function get_role_name( $role_id )
    {
        $result = WebUser::ROLE_NAME_GUEST;

        switch( $role_id ) {
            case WebUser::ROLE_USER:
                return WebUser::ROLE_NAME_USER;
                break;

            case WebUser::ROLE_ADMIN:
                return WebUser::ROLE_NAME_ADMIN;
                break;
        }

        return $result;
    }
}