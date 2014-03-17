<?
    /* @var $this ApplicationController */
    $assets_path = $this->get_behavioral_url();
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title><?= CHtml::encode($this->pageTitle); ?></title>
</head>
<body>

<!-- Main page container -->
<div class="container-fluid">

<!-- Left (navigation) side -->
<section class="navigation-block">

    <!-- Main page header -->
    <header>

    </header>
    <!-- /Main page header -->

    <?
    $this->widget('application.widgets.Common.Menu',
        array(
            'active' => strtolower( $this->id ),
            'items'  => FrontendMenu::get($this->id),
            'view' => 'frontend'
        )
    );
    ?>

</section>
<!-- /Left (navigation) side -->

<!-- Right (content) side -->
<section class="content-block" role="main">

    <?= $content; ?>

    <? if (Yii::app()->user->hasFlash('notification')): ?>
        <div class="alert alert-info" id="flash-error">
            <button class="close" type="button" data-dismiss="alert">×</button>
            <p class="content notice">
                <?= Yii::app()->user->getFlash('notification'); ?>
            </p>
        </div>
    <? endif; ?>

    <? if (Yii::app()->user->hasFlash('success')): ?>
        <div class="alert alert-success" id="flash-error">
            <button class="close" type="button" data-dismiss="alert">×</button>
            <p class="content notice">
                <?= Yii::app()->user->getFlash('success'); ?>
            </p>
        </div>
    <? endif; ?>

    <? if (Yii::app()->user->hasFlash('error')): ?>
        <div class="alert alert-danger" id="flash-error">
            <button class="close" type="button" data-dismiss="alert">×</button>
            <p class="content notice">
                <?= Yii::app()->user->getFlash('error'); ?>
            </p>
        </div>
    <? endif; ?>
</section>
<!-- /Right (content) side -->

</div>

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
