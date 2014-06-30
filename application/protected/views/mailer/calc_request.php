<? $request->refresh(); ?>
Від: <b><?= $request->name; ?></b>
<br/>
Телефон: <i><?= $request->phone; ?></i>
<br/>
Розміри: <i><?= $request->width; ?></i> на <i><?= $request->height; ?></i>
<br/>
Віконна система: <i><?= $request->window_system->name; ?></i>
<br/>
Склопакет: <i><?= $request->glass->name; ?></i>
<br/>
Тип вікна: <i><?= $request->construction_type; ?></i>
<br/>
Ціна: <b><?= $request->price; ?></b>
<br/>
Відправлено: <b><?= $request->created_at; ?></b>