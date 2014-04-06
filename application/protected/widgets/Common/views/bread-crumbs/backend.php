<?
$last_item = array_pop( $items );
?>

<ul class="breadcrumb">
	<? if (!empty($items)): ?>
		<? foreach($items as $item): ?>
		    <li><a href="<?= $item['url']; ?>"><?= $item['title']; ?></a></li>
		<? endforeach ?>
    <? endif; ?>

    <li class="active"><?= $last_item['title']; ?></li>
</ul>