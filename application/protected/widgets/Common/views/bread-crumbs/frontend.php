<? $last_bread_crumb = array_pop( $items ); ?>
<div class="container">
    <ul class="breadcrumb">
        <? if (!empty($items)): ?>
            <li>
                <a href="<?= createUrl('site/index'); ?>">
                    <?= _('Интернет-супермаркет'); ?>
                </a>
                <span class="divider">></span>
            </li>
            <? foreach( $items as $bread_crumb ): ?>
                <? $url = isset($bread_crumb['url']) ? $bread_crumb['url'] : '#'; ?>
                <li>
                    <a href="<?= $url; ?>">
                        <?= $bread_crumb['name']; ?>
                    </a>
                    <span class="divider">></span>
                </li>
            <? endforeach ?>
            <li class="active">
                <?= $last_bread_crumb['name']; ?>
            </li>
        <? else: ?>
            <? if (empty($last_bread_crumb)): ?>
            <li class="active">
                <?= _('Интернет-супермаркет'); ?>
            </li>
            <? else: ?>
                <li>
                    <a href="<?= createUrl('site/index'); ?>">
                        <?= _('Интернет-супермаркет'); ?>
                    </a>
                    <span class="divider">></span>
                </li>
                <li class="active">
                    <?= $last_bread_crumb['name']; ?>
                </li>
            <? endif; ?>
        <? endif; ?>
</div>