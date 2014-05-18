<ul class="navigation">
    <? foreach( $items as $item ): ?>
    <? $has_sub_menu = isset( $item[ 'items' ] ); ?>
    <?
        $class = '';
        if ( $active === strtolower($item[ 'activityMarker' ]) )
        {
            $class = $has_sub_menu ? 'active open' : 'active';
        }
    ?>

    <li class="<?= $class; ?>">
        <a href="<?= isset( $item[ 'url' ] ) ? $item[ 'url' ] : '#'; ?>"><?= $item[ 'title' ]; ?></a>
        <? if( $has_sub_menu ): ?>
            <? $active_sub_item = isset( $item[ 'active' ] ) ? strtolower($item[ 'active' ]) : ''; ?>
            <ul>
                <? foreach( $item[ 'items' ] as $sub_menu ): ?>
                    <li>
                        <a href="<?= isset( $sub_menu[ 'url' ] ) ? $sub_menu[ 'url' ] : '#'; ?>">
                            <span class="text"><?= $sub_menu[ 'title' ]; ?></span>
                        </a>
                    </li>
                <? endforeach; ?>
            </ul>
        <? endif;?>
    </li>

    <? endforeach; ?>
</ul>