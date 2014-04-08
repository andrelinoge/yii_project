<nav id="nav">
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            
            <div class="nav-collapse collapse">
                <ul class="nav">
                <? foreach( $items as $item ): ?>
                    <?
                        $has_sub_items = isset( $item[ 'items' ] ) && (is_array($item[ 'items' ]));
                        $class = $has_sub_items ? 'dropdown' : '';

                        if ( $active === strtolower($item[ 'activityMarker' ]) )
                        {
                            $class .= ' active';
                        }
                    ?>

                    <li class="<?= $class; ?>">
                        <a href="<?= isset( $item[ 'url' ] ) ? $item[ 'url' ] : '#'; ?>" <? if ($has_sub_items): ?>class="dropdown-toggle" data-toggle="dropdown"<? endif; ?>>
                            <?= $item['title']; ?> <? if ($has_sub_items): ?><b class="caret"></b><? endif; ?>
                        </a>
                        <? if( $has_sub_items ): ?>
                            <ul class="dropdown-menu">
                                <? foreach($item[ 'items' ] as $sub_item): ?>
                                    <li>
                                        <a href="<?= isset( $sub_item[ 'url' ] ) ? $sub_item[ 'url' ] : '#'; ?>"><?= $sub_item['title']; ?></a>
                                    </li>
                                <? endforeach; ?>
                            </ul>
                        <? endif; ?>
                    </li>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</nav>