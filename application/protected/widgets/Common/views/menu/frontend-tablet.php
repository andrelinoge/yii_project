<ul class="main_menu">
    <? foreach( $items as $item ): ?>
        <?
            $has_sub_items = isset( $item[ 'items' ] ) && (is_array($item[ 'items' ]));
            $class = ($active == strtolower($item[ 'activityMarker' ])) ? 'current' : '';
        ?>

        <li class="<?= $class; ?>">
            <a href="<?= isset( $item[ 'url' ] ) ? $item[ 'url' ] : '#'; ?>" <? if (!$has_sub_items): ?>class="no-submenu"<? endif; ?>>
                <?= $item['title']; ?>
            </a>
            <? if( $has_sub_items ): ?>
                <ul>
                    <? foreach($item[ 'items' ] as $sub_item): ?>
                        <li>
                            <a href="<?= isset( $sub_item[ 'url' ] ) ? $sub_item[ 'url' ] : '#'; ?>"><?= $sub_item['title']; ?></a>
                        </li>
                    <? endforeach; ?>
                </ul>
            <? endif; ?>
        </li>
    <? endforeach; ?>
</ul>