<?
/** @var $user User */
?>
<div class="row-fluid">

    <div class="span6">
        <div class="row-fluid">
            <div class="span8">

                <div class="block ucard">
                    <a class="btn"
                       href="<?= $this->createUrl( 'edit', array( 'id' => $user->id ) ); ?>">
                        <span class="isw-edit"></span>
                        <?= _('Edit'); ?>
                    </a>
                    <a class="btn"
                        href="<?= $this->createUrl( 'delete', array( 'id' => $user->id ) ); ?>"
                        onclick="return confirm( _('Delete user?'));">
                        <span class="isw-delete"></span>
                        <?= _('Delete'); ?>
                    </a>
                    <a class="btn"
                        href="#" onclick="return toggleBanStatus(); ">
                        <span class="isw-user"></span>
                        <strong id="status"><?= ( $user->is_banned ) ? _('blocked') : _('unblocked') ;?></strong>
                    </a>

                    <div class="info">
                        <ul class="rows">
                            <li class="heading"><?= _('User info'); ?></li>

                            <li>
                                <div class="title">Name:</div>
                                <div class="text"><?= $user->getFullName(); ?></div>
                            </li>

                            <li>
                                <div class="title">Email:</div>
                                <div class="text"><?= $user->getEmail() ?></div>
                            </li>

                            <li>
                                <div class="title">
                                    <?= _('Registered:'); ?>
                                </div>
                                <div class="text">
                                    <?= $user->getRegisteredAt(); ?>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function toggleBanStatus()
    {
        if( confirm( 'Змінити статус?' ) )
        {
            backendController.ajaxPost(
                '<?= $this->createUrl( 'changeBanStatusHandler' );?>',
                {
                    'id' : <?= $user->id; ?>
                },
                function( data )
                {
                    if ( data.status == true )
                    {
                        $( '#status').html( data.new_user_status );
                    }
                }
            );
        }
        return false;
    }
</script>