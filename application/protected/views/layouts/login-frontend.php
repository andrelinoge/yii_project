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

    <!-- Styles -->
    <link rel='stylesheet' type='text/css' href='<?= $assets_path; ?>/css/chromatron-blue.css'>

    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="<?= $assets_path; ?>/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $assets_path; ?>/img/icons/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $assets_path; ?>/img/icons/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= $assets_path; ?>/img/icons/apple-touch-icon-57-precomposed.png">

    <!-- JS Libs -->
    <script src="<?= $assets_path; ?>/js/libs/modernizr.js"></script>
    <script src="<?= $assets_path; ?>/js/libs/selectivizr.js"></script>

</head>
<body class="login-page">

<!-- Main login container -->
<div class="login-container">
    <?= $content; ?>
</div>
<!-- /Main login container -->

<script>
    $(document).ready(
        function()
        {
            new ApplicationController();
        }
    );
</script>
</body>
</html>
