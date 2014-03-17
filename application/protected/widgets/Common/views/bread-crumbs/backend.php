<?
$last_item = array_pop( $items );
?>

<ul class="breadcrumb">
    <? foreach($items as $item): ?>
        <li><a href="<?= $item['url']; ?>"><?= $item['name']; ?></a></li>
    <? endforeach ?>

    <li class="active"><?= $last_item['name']; ?></li>
</ul>