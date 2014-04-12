<?
$this->widget(
    'ext.bootstrap.widgets.TbJsonGridView',
    [
        'dataProvider'  => $data_provider,
        'type'          => 'striped bordered condensed',
        'summaryText'   => true,
        'cacheTTL'      => 10, // cache will be stored 10 seconds (see cacheTTLType)
        'cacheTTLType'  => 's', // type can be of seconds, minutes or hours
        'template'      => "{items}\n{pager}",
        'htmlOptions'   => ['class' => 'dataTables_wrapper'],
        'pagerCssClass' => 'widget-foot',
        'columns' => [
            [
                'name'        => 'id',
                'header'      => '#',
                'htmlOptions' => ['style' => 'width: 50px;']
            ],
            'phone_1',
            'phone_1',
            'email',
            'address',
            [
                'header'      => _('Actions'),
                'class'       => 'bootstrap.widgets.TbJsonButtonColumn',
                'htmlOptions' => ['style' => 'width: 125px; text-align: center' ],
                'template'    => '{update}',
                'buttons'     => [
                    'update' => [
                        'options' => [
                            'class' => 'btn btn-xs btn-warning'
                        ],
                        'icon' => 'fa fa-pencil',
                        'url'  => 'url("siteSettings/edit", ["id" => $data->id])'
                    ]
                ]
            ]
        ],
        'pager' => [
            'class'  => 'bootstrap.widgets.TbJsonPager',
            'header' => '<div class="clearfix"></div><div class="col-md-4">',
            'footer' => '</div><div class="clearfix"></div>',
            'htmlOptions' => [
                'class' => 'pagination'
            ]
        ]
    ]
);
?>