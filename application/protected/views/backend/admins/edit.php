<?
/** @var $this BackendController */
$this->breadcrumbs = [
    ['title' => 'Admins', 'url' => '#'],
    ['title' => 'Change password']
];
?>

<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-head">
                <h2>Change password</h2>
            </div>

            <div class="block-content">
                <? $this->renderPartial(
                    '_form',
                    [
                        'model' => $model,
                        'form_action' => $this->createUrl('update')
                    ]
                ); ?>
            </div>
        </div>
    </div>
</div>