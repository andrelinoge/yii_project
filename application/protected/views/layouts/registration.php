<?
    /* @var $this ApplicationController */
    $assets_path = $this->get_behavioral_url();
?>

<!DOCTYPE html>
<!--[if IE 8]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?= CHtml::encode($this->pageTitle); ?></title>
    <meta name="description" content="">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- jQuery Visualize Styles -->
    <link rel='stylesheet' type='text/css' href='<?= $assets_path; ?>/css/plugins/jquery.visualize.css'>

    <!-- jQuery FullCalendar Styles -->
    <link rel='stylesheet' type='text/css' href='<?= $assets_path; ?>/css/plugins/jquery.fullcalendar.css'>

    <!-- jQuery jGrowl Styles -->
    <link rel='stylesheet' type='text/css' href='<?= $assets_path; ?>/css/plugins/jquery.jgrowl.css'>

    <!-- Styles -->
    <link rel='stylesheet' type='text/css' href='<?= $assets_path; ?>/css/chromatron-red.css'>

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $assets_path; ?>/img/icons/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $assets_path; ?>/img/icons/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= $assets_path; ?>/img/icons/apple-touch-icon-57-precomposed.png">

    <!-- JS Libs -->
    <script src="<?= $assets_path; ?>/js/libs/jquery-ui.min.js"></script>

    <script src="<?= $assets_path; ?>/js/libs/modernizr.js"></script>
    <script src="<?= $assets_path; ?>/js/libs/selectivizr.js"></script>

</head>
<body>

<!-- Main page container -->
<div class="container-fluid">

<!-- Left (navigation) side -->
<section class="navigation-block">

    <!-- Main page header -->
    <header>

        <!-- Main page logo -->
        <h1><a class="brand" href="login.html">Chromatron Responsive Admin Backend built with Twitter Bootstrap</a></h1>

        <!-- Main page headline -->
        <p>A cathode ray tube awesomeness</p>

    </header>
    <!-- /Main page header -->

</section>
<!-- /Left (navigation) side -->

<!-- Right (content) side -->
<section class="content-block" role="main">

    <?= $content; ?>

    <? if (app()->user->hasFlash('notification')): ?>
        <div class="alert alert-info" id="flash-error">
            <button class="close" type="button" data-dismiss="alert">×</button>
            <p class="content notice">
                <?= app()->user->getFlash('notification'); ?>
            </p>
        </div>
    <? endif; ?>

    <? if (app()->user->hasFlash('success')): ?>
        <div class="alert alert-success" id="flash-error">
            <button class="close" type="button" data-dismiss="alert">×</button>
            <p class="content notice">
                <?= app()->user->getFlash('success'); ?>
            </p>
        </div>
    <? endif; ?>

    <? if (app()->user->hasFlash('error')): ?>
        <div class="alert alert-danger" id="flash-error">
            <button class="close" type="button" data-dismiss="alert">×</button>
            <p class="content notice">
                <?= app()->user->getFlash('error'); ?>
            </p>
        </div>
    <? endif; ?>
</section>
<!-- /Right (content) side -->

</div>

<script src="<?= $assets_path; ?>/js/navigation.js"></script>
<script src="<?= $assets_path; ?>/js/bootstrap/bootstrap.min.js"></script>

<!-- jQuery Flot Charts -->
<!--[if lte IE 8]>
<script language="javascript" type="text/javascript" src="<?= $assets_path; ?>/js/plugins/flot/excanvas.min.js"></script>
<![endif]-->
<script src="<?= $assets_path; ?>/js/plugins/flot/jquery.flot.js"></script>
<script src="<?= $assets_path; ?>/js/plugins/flot/jquery.flot.resize.min.js"></script>

<!-- Slim scroll -->
<script type="text/javascript" src="<?= $assets_path; ?>/js/plugins/slimScroll/jquery.slimscroll.js"></script>

<!-- jQuery sparklines -->
<script src="<?= $assets_path; ?>/js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- jQuery jGrowl -->
<script type="text/javascript" src="<?= $assets_path; ?>/js/plugins/jGrowl/jquery.jgrowl.js"></script>

<!-- jQuery Visualize -->
<!--[if lte IE 8]>
<script language="javascript" type="text/javascript" src="<?= $assets_path; ?>/js/plugins/visualize/excanvas.js"></script>
<![endif]-->
<script src="<?= $assets_path; ?>/js/plugins/visualize/jquery.visualize.min.js"></script>

<script type="text/javascript" src="<?= $assets_path; ?>/js/libs/jquery.oauthpopup.js"></script>
<script type="text/javascript" src="<?= $assets_path; ?>/js/layout.js"></script>

<script>
    $(document).ready(
        function()
        {
            new ApplicationController();
        }
    );
</script>

<? $this->renderPartial('../i18n/js-messages'); ?>
</body>
</html>
