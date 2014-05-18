<?
$this->breadcrumbs = [
    ['title' => 'Статті', 'url' => url('articles/index')],
    ['title' => 'Перегляд']
];
?>

<div class="col-md-12">
    <div class="block">
        <div class="block-head">                                    
            <div class="block-title">
                <?= $model->title; ?>
            </div>     
            <div class="block-title-date">
                <?= $model->category->title; ?>
            </div>            
        </div>
        <div class="block-content">
            <p><?= $model->content; ?></p>
        </div>
    </div>
</div>