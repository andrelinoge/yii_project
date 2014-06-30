<? /** @var $message ContactMessage */ ?>

Від: <a href="mailto:<?= $message->email; ?>"><?= $message->name; ?></a>
<br/>
Повідомлення:
<p>
    <?= $message->content; ?>
</p>