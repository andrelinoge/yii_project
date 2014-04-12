<?

/** @var $this ApplicationController */

$assets = $this->get_behavioral_url();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= Yii::app()->params['name']; ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="<?= $assets; ?>/css/styles.css" rel="stylesheet" type="text/css" />

    <!--[if lt IE 10]><link rel="stylesheet" type="text/css" href="<?= $assets; ?>/css/ie.css"/><![endif]-->

    <script type="text/javascript" src="<?= $assets; ?>/js/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>/js/plugins/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

    <script type="text/javascript" src="<?= $assets; ?>/js/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>

    <script type="text/javascript" src="<?= $assets; ?>/js/plugins/fancybox/jquery.fancybox.pack.js"></script>

    <script type="text/javascript" src="<?= $assets; ?>/js/plugins.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>/js/actions.js"></script>

</head>
<body>

<div class="page-container">

<div class="page-head">

    <ul class="page-head-elements">
        <li><a href="#" class="page-navigation-toggle"><span class="fa fa-bars"></span></a></li>
    </ul>


</div>

<div class="page-navigation">

    <div class="profile">
        <div class="profile-info" style="margin-left: 45px;">
            <a href="#" class="profile-title"><?= current_user()->full_name(); ?></a>
            <span class="profile-subtitle">Administrator</span>

            <div class="profile-buttons">
                <div class="btn-group">
                    <a class="but dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header" role="presentation">Profile Menu</li>
                        <li><a href="<?= url('admins/edit'); ?>">Change password</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= url('site/logout'); ?>">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <? $this->widget('application.widgets.Common.Menu', [
        'active' => strtolower( $this->id ),
        'items'  => BackendMenu::get(),
        'view' => 'backend'
    ]); ?>

</div>

<div class="page-content">

<div class="container">

<div class="page-toolbar">
    <? $this->widget('application.widgets.Common.BreadCrumbs', [
        'items'  => $this->breadcrumbs,
        'view' => 'backend'
    ]); ?>
</div>

<div class="row">
    <div class="col-md-12">
        <?
        $this->widget('ext.bootstrap.widgets.TbAlert', [
            'block' => true,
            'fade' => true,
            'closeText' => '&times;', // false equals no close link
            'events' => [],
            'htmlOptions' => [],
            'userComponentId' => 'user',
            'alerts' => [
                'success' => ['closeText' => '&times;'],
                'error' => [ 'block' => false, 'closeText' => false]
            ]
        ]);
        ?>
    </div>

    <?= $content; ?>
</div>

</div>
</div>

</div>

<script type="text/javascript">
    $(function(){
        new ApplicationController();
    });
</script>>

</body>
</html>
