<div class="pagination text-center">
    <ul>
        <li>
            <a href="<?= $prevPageButton[ 'url' ]; ?>"><?= $prevPageButton[ 'label' ]; ?></a>
        </li>
        <? foreach( $buttons as $button ): ?>
            <?
                $class = '';
                $onClick = '';

                if ( $button[ 'isHidden' ] )
                {
                    $class = 'class="disabled"';
                    $onClick = 'onclick="return false;"';
                }

                if ( $button[ 'isSelected' ] )
                {
                    $class = 'class="active"';
                }
            ?>
            <li <?= $class; ?>>
                <a <?= $onClick; ?>
                    href="<?= $button[ 'url' ]; ?>"><?= $button[ 'label' ]; ?></a>
            </li>
        <? endforeach; ?>
        <li>
            <a href="<?= $nextPageButton[ 'url' ]; ?>"><?= $nextPageButton[ 'label' ]; ?></a>
        </li>
    </ul>
</div>