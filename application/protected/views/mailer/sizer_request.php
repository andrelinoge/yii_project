
Від: <h6><?= $request->name; ?></h6>
<br/>
Телефон: <i><?= $request->phone; ?></i>
<br/>
Адрес: <span><?= empty($request->address) ? 'не вказано' : $request->address; ?></span>
<br/>
Повідомлення:
<p>
    <?= $request->content; ?>
</p>