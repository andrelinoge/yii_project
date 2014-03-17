<?php
/**
 * @author Andre Linoge
 */

class WebUser extends CWebUser
{
    /* ROLES AND THEIR DESCRIPTION */
    const ROLE_ADMIN        = 1;
    const ROLE_USER         = 2;
    const ROLE_NAME_GUEST   = 'guest';
    const ROLE_NAME_USER    = 'user';
    const ROLE_NAME_ADMIN   = 'admin';

    /**
     * @var null|User $_model
     */
    private $_model = NULL;

    /**
     * @return int user role
     */
    function get_role()
    {
        /** @var $user User */
        $user = $this->get_model();
        if( $user )
        {
            return $user->role;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * @return null|User
     */
    public function get_model()
    {
        if ( !$this->is_guest() && $this->_model === NULL )
        {
            if ( $this->id === 0 )
            {
                $this->_model = new StaticAdminUser();
            }
            else
            {
                $this->_model = User::get_from_cache( $this->id );
            }
        }
        return $this->_model;
    }

    /**
     * @param CModel $model
     * @throws CException
     */
    public function set_model( $model )
    {
        if ( !( $model instanceof User ) && !( $model instanceof StaticAdminUser ) )
        {
            throw new CException( 'model must instance of User or StaticAdminUser class' );
        }
        $this->_model = $model;
    }

    /**
     * Refresh current user
     */
    public function refresh()
    {
        $this->_model = User::refresh_cache($this->id);
    }

    /**
     * @return bool - is user admin
     */
    function is_admin()
    {
        if( $this->isGuest )
        {
            return FALSE;
        }
        else
        {
            return (int)$this->get_role() == (int)self::ROLE_ADMIN;
        }
    }

    /**
     * @return bool - is user a simple user
     */
    public function is_user()
    {
        if( $this->isGuest )
        {
            return FALSE;
        }
        else
        {
            return (int)$this->get_role() == (int)self::ROLE_USER;
        }
    }

    public function is_guest()
    {
        return $this->isGuest;
    }

    public function can_access_dashboard()
    {
        if ( $this->isGuest )
        {
            return FALSE;
        }
        else
        {
            if ( $this->is_admin() )
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
    }
}