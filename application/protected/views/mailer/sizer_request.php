
Від: <h6><?= $request->name; ?></h6>
Телефон: <i><?= $request->phone; ?></i>
Адрес: <span><?= empty($request->address) ? 'не вказано' : $request->address; ?></span>
Повідомлення:
<p>
    <?= $request->content; ?>
</p>