
От: <h6><?= $$request->name; ?></h6>
Phone: <i><?= $request->phone; ?></i>
Address: <span><?= empty($request->address) ? 'не вказано' : $request->address; ?></span>
Сообщение:
<p>
    <?= $request->content; ?>
</p>