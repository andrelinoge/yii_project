<?
$last_item = array_pop( $items );
?>

<div class="container">
    <div class="page-title clearfix">
        <div class="row">
            <div class="col-md-12">
                <? foreach($items as $item): ?>
                    <h6><a href="<?= $item['url']; ?>"><?= $item['title']; ?></a></h6>
                <? endforeach ?>
                <h6><span class="page-active"><?= $last_item['title']; ?></span></h6>
            </div>
        </div>
    </div>
</div>