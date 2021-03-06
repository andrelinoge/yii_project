<?
$this->breadcrumbs = [
    ['title' => 'Faqs', 'url' => url('faqs/index')],
    ['title' => 'New article']
];
?>

<div class="row">
    <div class="col-md-12">
        <div class="block">
            <div class="block-head">
                <h2>New faq</h2>
            </div>

            <div class="block-content">
                <? $this->renderPartial(
                    '_form',
                    [
                        'model'       => $model,
                        'form_action' => $this->createUrl('create')
                    ]
                ); ?>
            </div>
        </div>
    </div>
</div>