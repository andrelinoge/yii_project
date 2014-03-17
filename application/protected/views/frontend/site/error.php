<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - ' . _('Ошибка');
?>

<div class="content">

    <!-- Start Content -->
    <div class="container main">

        <div class="sixteen columns">

            <div class="error-page">
                <div class="error-notif">
                    <h1 class="error-code">404</h1>
                    <p>
                        <?= $error['message']; ?>
                    </p>
                    <p>
                        <a class="btn btn-large" href="<?= $this->createUrl('index'); ?>">Back</a>
                    </p>
                </div>
            </div>

        </div>

    </div>

</div>