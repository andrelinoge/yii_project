<?
$this->breadcrumbs = [
    ['title' => 'Faqs', 'url' => url('faqs/index')],
    ['title' => 'Preview']
];
?>

<div class="col-md-12">
    <div class="block">
        <div class="block-head">                                    
            <div class="block-title">
                <?= $model->title; ?>
            </div>                 
        </div>
        <div class="block-content">
            <p><?= $model->content; ?></p>
        </div>
    </div>
</div>