<?
/** @var $this BackendController */
$this->breadcrumbs = [
    ['title' => 'Sizer request', 'url' => url('sizerRequest/index')],
    ['title' => 'Preview']
];
?>

<div class="col-md-12">
    <div class="block">
        <div class="block-head">                                    
            <div class="block-title">
                Request
            </div>                 
            <div class="block-title-date">
                <span class="group group-blue"></span> <?= date('d/m/Y h:i', strtotime($model->created_at)); ?>
            </div>                                    
        </div>
        <div class="block-content">
            <div class="pull-left">
                <?= $model->name; ?> [<?= $model->phone; ?>] 
            </div>
            <div class="btn-group pull-right">
                <a class="btn btn-default" href="<?= $this->createUrl('delete', ['id' => $model->id]); ?>" onclick="return confirm('Delete message?');"><i class="fa fa-trash-o"></i> Delete</a>
            </div>
        </div>
        <div class="block-content">
            <p><?= $model->content; ?></p>
        </div>
        
        
    </div>
                            
</div>