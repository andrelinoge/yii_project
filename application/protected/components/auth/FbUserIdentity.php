<?php
/**
 * @author Andriy Tolstokorov
 * @version 1.0
 */

class FbUserIdentity extends CUserIdentity
{
    const ERROR_FB_ID_NOT_FOUND = 3;

    protected  $_id;
    protected  $_social_id;

    public function __construct( $social_id = NULL )
    {
        if ( $social_id )
        {
            $this->_social_id = $social_id;
        }
    }

    /**
     * Authenticate with password
     * @return bool
     */
    public function auth()
    {
        /** @var $relation FacebookUser */
        $reflection = FacebookUser::model()->findByAttributes(
            array(
                'social_id' => $this->_social_id
            )
        );


        if ( !$reflection )
        {
            $this->errorCode = self::ERROR_FB_ID_NOT_FOUND;
            return !$this->errorCode;
        }

        /** @var $userModel User */
        $user = User::model()->findByPk( $reflection->user_id );

        $this->save_state( $user );
        $this->errorCode = self::ERROR_NONE;

        return !$this->errorCode;
    }

    /**
     * Saves user state
     * @param User $record user record
     */
    public function save_state( User $user )
    {
        $this->_id = $user->id;
        $this->setState( 'name', phpAuthManager::getRoleName( $user->role ) );
        $this->setState( 'role', $user->role );
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->_id;
    }
}