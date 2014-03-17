<? /** @var $message ContactMessage */ ?>

От: <a href="mailto:<?= $message->email; ?>"><?= $message->name; ?></a>
Сообщение:
<p>
    <?= $message->content; ?>
</p>