<?
/** @var $order Order */
?>

<?=  $order->user_name; // замовник ?>
<?= $order->id; // id замовлення ?>

<a href="<?= createUrl('orders/view', array('id' => $order->id));?>">Просмтор страници заказа</a>