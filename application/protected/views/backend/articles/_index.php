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
            'title',
            [
                'name' => 'created_at',
                'type' => 'datetime',
                'htmlOptions' => ['style' => 'width: 175px;']
            ],
            [
                'header' => _('Actions'),
                'class' => 'bootstrap.widgets.TbJsonButtonColumn',
                'htmlOptions' => ['style' => 'width: 125px; text-align: center' ],
                'template' => '{gallery} {view} {update} {delete}',
                'buttons' => [
                    'gallery' => [
                        'options' => [
                            'class' => 'btn btn-xs btn-default'
                        ],
                        'icon' => 'fa fa-picture-o',
                        'url' => 'url("images/index", ["owner_id" => $data->id, "type" => "Article"])'
                    ],
                    'view' => [
                        'options' => [
                            'class' => 'btn btn-xs btn-default'
                        ],
                        'icon' => 'fa fa-eye',
                        'url' => 'url("articles/view", ["id" => $data->id])'
                    ],
                    'update' => [
                        'options' => [
                            'class' => 'btn btn-xs btn-warning'
                        ],
                        'icon' => 'fa fa-pencil',
                        'url' => 'url("articles/edit", ["id" => $data->id])'
                    ],
                    'delete' => [
                        'options' => [
                            'class' => 'btn btn-xs btn-danger'
                        ],
                        'icon' => 'fa fa-times',
                        'url' => 'url("articles/delete", ["id" => $data->id])'
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