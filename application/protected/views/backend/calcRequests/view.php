<?
/** @var $this BackendController */
$this->breadcrumbs = [
    ['title' => 'Замовлення з калькулятора', 'url' => url('calcRequests/index')],
    ['title' => 'Перегляд']
];
?>

<div class="col-md-12">
    <div class="block">
        <div class="block-head">                                    
            <div class="block-title">
                Замовлення з калькулятора
            </div>                 
            <div class="block-title-date">
                <span class="group group-blue"></span> <?= date('d/m/Y h:i', strtotime($model->created_at)); ?>
            </div>                                    
        </div>
        <div class="block-content">
            <div class="pull-left">
                <?= $model->name; ?> (тел. <?= $model->phone; ?>)
            </div>
            <div class="btn-group pull-right">
                <a class="btn btn-default" href="<?= $this->createUrl('delete', ['id' => $model->id]); ?>" onclick="return confirm('Delete message?');"><i class="fa fa-trash-o"></i> Видалити</a>
            </div>
        </div>
        <div class="block-content">
            <dl class="dl-horizontal">
                <dt>Ціна</dt> <dd><?= $model->price; ?></dd>
                <dt>Віконна система</dt> <dd><?= $model->window_system->name; ?></dd>
                <dt>Склопакет</dt> <dd><?= $model->glass->name; ?></dd>
                <dt>Тип конструкції</dt> <dd><?= $model->construction_type; ?></dd>
                <dt>Ширина</dt> <dd><?= $model->width; ?></dd>
                <dt>Висота</dt> <dd><?= $model->height; ?></dd>
            </dl>
        </div>
        
        
    </div>
                            
</div>