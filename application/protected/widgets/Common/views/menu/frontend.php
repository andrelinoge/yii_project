<ul class="main-menu sf-menu">
    <? foreach( $items as $item ): ?>
        <?
            $has_sub_items = isset( $item[ 'items' ] ) && (is_array($item[ 'items' ]));
        ?>

        <li class="">
            <a href="<?= isset( $item[ 'url' ] ) ? $item[ 'url' ] : '#'; ?>">
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