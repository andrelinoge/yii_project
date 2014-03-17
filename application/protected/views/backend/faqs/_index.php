<?
$this->widget(
    'ext.bootstrap.widgets.TbJsonGridView',
    [
        'dataProvider' => $data_provider,
        'type' => 'striped bordered condensed',
        'summaryText' => true,
        'cacheTTL' => 10, // cache will be stored 10 seconds (see cacheTTLType)
        'cacheTTLType' => 's', // type can be of seconds, minutes or hours
        'template' => "{items}\n{pager}",
        'htmlOptions' => ['class' => 'dataTables_wrapper'],
        'pagerCssClass' => 'widget-foot',
        'columns' => [
            [
                'name' => 'id',
                'header' => '#',
                'htmlOptions' => ['style' => 'width: 50px;']
            ],
            [
                'name' => 'title',
                'header' => 'Question'
            ],
            [
                'header' => _('Actions'),
                'class' => 'bootstrap.widgets.TbJsonButtonColumn',
                'htmlOptions' => ['style' => 'width: 100px; text-align: center' ],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => [
                        'options' => [
                            'class' => 'btn btn-xs btn-default'
                        ],
                        'icon' => 'fa fa-eye',
                        'url' => 'url("faqs/view", ["id" => $data->id])'
                    ],
                    'update' => [
                        'options' => [
                            'class' => 'btn btn-xs btn-warning'
                        ],
                        'icon' => 'fa fa-pencil',
                        'url' => 'url("faqs/edit", ["id" => $data->id])'
                    ],
                    'delete' => [
                        'options' => [
                            'class' => 'btn btn-xs btn-danger'
                        ],
                        'icon' => 'fa fa-times',
                        'url' => 'url("faqs/delete", ["id" => $data->id])'
                    ]
                ]
            ]
        ],
        'pager' => [
            'class' => 'bootstrap.widgets.TbJsonPager',
            'header' => '<div class="clearfix"></div><div class="col-md-4">',
            'footer' => '</div><div class="clearfix"></div>',
            'htmlOptions' => [
                'class' => 'pagination'
            ]
        ]
    ]
);
?>