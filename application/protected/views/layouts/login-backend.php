<?php
/**
 * @author Andre Linoge
 */

/** @var $this Controller */

$assets = $this->get_behavioral_url();

Yii::app()
    ->clientScript
    ->registerPackage('form');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log in</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="<?= $assets; ?>/css/styles.css" rel="stylesheet" type="text/css" />

    <!--[if lt IE 10]><link rel="stylesheet" type="text/css" href="<?= $assets; ?>/css/ie.css"/><![endif]-->

    <script type="text/javascript" src="<?= $assets; ?>/js/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>/js/plugins/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= $assets; ?>/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

    <script type="text/javascript" src="<?= $assets; ?>/js/plugins/jquery-validation/jquery.validate.min.js"></script>

    <script type="text/javascript" src="<?= $assets; ?>/js/plugins.js"></script>

</head>
<body>

<div class="page-container">

    <div class="page-content page-content-default">

        <div class="block-login">
            <?= $content; ?>
        </div>

    </div>
</div>

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


