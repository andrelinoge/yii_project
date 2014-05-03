<?
/** @var $this BackendController */
$this->breadcrumbs = [
    [
        'title' => 'Article images', 
        'url'   => url('articleImages/index', ['owner_id' => $model->owner_id])
    ],
    [ 'title' => 'Edit image' ]
];

?>

<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-head">
                <h2>Edit gallery image</h2>
            </div>

            <div class="block-content">
                <? $this->renderPartial(
                    '_form',
                    [
                        'model'       => $model,
                        'form_action' => $this->createUrl('update', ['id' => $model->id])
                    ]
                ); ?>
            </div>
        </div>
    </div>
</div>