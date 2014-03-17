<?
/** @var $this BackendController */
$this->breadcrumbs = [
    ['name' => 'Faqs', 'url' => url('faqs/index')],
    ['name' => 'Preview']
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
            <p><?= $model->text; ?></p>
        </div>
    </div>
</div>