<div class="pagination text-center">
    <ul>
        <li>
            <a href="<?= $prevPageButton[ 'url' ]; ?>" class="ajax-pagination"><?= $prevPageButton[ 'label' ]; ?></a>
        </li>
        <? foreach( $buttons as $button ): ?>
            <?
                $class = '';
                $onClick = '';
                $link_class='ajax-pagination';

                if ( $button[ 'isHidden' ] )
                {
                    $class = 'class="disabled"';
                    $onClick = 'onclick="return false;"';
                    $link_class = '';
                }

                if ( $button[ 'isSelected' ] )
                {
                    $class = 'class="active"';
                    $link_class = '';
                }
            ?>
            <li <?= $class; ?>>
                <a <?= $onClick; ?> class="<?= $link_class; ?>"
                    href="<?= $button[ 'url' ]; ?>"><?= $button[ 'label' ]; ?></a>
            </li>
        <? endforeach; ?>
        <li>
            <a href="<?= $nextPageButton[ 'url' ]; ?>" class="ajax-pagination"><?= $nextPageButton[ 'label' ]; ?></a>
        </li>
    </ul>
</div>