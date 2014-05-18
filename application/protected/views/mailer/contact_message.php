<? /** @var $message ContactMessage */ ?>

Від: <a href="mailto:<?= $message->email; ?>"><?= $message->name; ?></a>
Повідомлення:
<p>
    <?= $message->content; ?>
</p>