<?php
/**
 * @author Andriy Tolstokorov
 * @version 1.0
 */

class TwitterUserIdentity extends CUserIdentity
{
    const ERROR_ID_NOT_FOUND = 3;

    protected  $_id;
    protected  $_social_id;

    public function __construct( $social_id )
    {
        $this->_social_id = $social_id;
    }

    /**
     * Authenticate with password
     * @return bool
     */
    public function auth()
    {
        /** @var $relation TwitterUser */
        $reflection = TwitterUser::model()->findByAttributes(
            array(
                'social_id' => $this->_social_id
            )
        );

        if ( !$reflection )
        {
            $this->errorCode = self::ERROR_ID_NOT_FOUND;
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
    public function save_state( User $user ){
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