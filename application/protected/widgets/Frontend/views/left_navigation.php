<h3>Продукти</h3>
<ul class="left-col-list">
	<? foreach($menu as $url => $title): ?>
    	<li><a href="<?= $url; ?>"><?= $title; ?></a> </li>
	<? endforeach; ?>
</ul>