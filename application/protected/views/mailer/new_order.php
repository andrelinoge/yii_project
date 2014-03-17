<?
/** @var $order Order */
?>
<h1>Новий заказ</h1>
<h3>№ заказа: <?= $order->id; ?></h3>
<h3>от:
    <?if ($order->user_email): ?>
    <a href="mailto:<?= $order->user_email?>"><?= $order->user_name; ?></a>
    <? else: ?>
        <?= $order->user_name; ?>
    <? endif; ?>
</h3>
<h3>
    Телефони: <?= $order->phone_1; ?>, <?= $order->phone_2; ?>
</h3>