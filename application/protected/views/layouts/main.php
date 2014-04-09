<? $assets_path = $this->get_behavioral_url(); ?>

<!DOCTYPE html>
<head>
    <title><?= CHtml::encode($this->pageTitle); ?></title>
    <meta name="description" content="Place your description here">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="<?= $assets_path; ?>/css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?= $assets_path; ?>/css/flexslid.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?= $assets_path; ?>/css/bootstrap.css" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="<?= $assets_path; ?>/css/elastislide.css" />
    <link rel="stylesheet" name="skins" href="<?= $assets_path; ?>/css/default.css" type="text/css" media="all">

<!--[if lt IE 7]>
<script type="text/javascript" src="<?= $assets_path; ?>/js/ie6_script_other.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="<?= $assets_path; ?>/js/html5.js"></script>
<![endif]-->
</head>

<body>
    <div class="wrapper">
        <!-- header -->
        <header id="header">
            <section class="container">
                <h1 id="logo"><a href="index.html">Екодекор</a></h1>
                <? $this->widget('application.widgets.Common.Menu', [
                        'active' => strtolower( $this->id ),
                        'items'  => FrontendMenu::get(),
                        'view'   => 'frontend'
                    ]); 
                ?>
            </section>
        </header>
        <!-- banner -->
        <section id="banner" class="inner-b"> <img src="<?= $assets_path; ?>/images/404_01.png" alt=""/> </section>
        <!-- Content -->
        <section class="content-holder1 inner-pages">
            <section class="container">
                <section class="help-holder">
                    <article class="left">

                        <h2> <span class="txt-left"><?= $this->page_name; ?></span> <span class="bg-right"></span> </h2>

                        <section class="row-fluid">
                            <figure class="span3">
                                <? $this->widget('application.widgets.Frontend.LeftNavigation'); ?>
                            </figure>

                            <figure class="span9">
                                <?= $content; ?>
                            </figure>
                        </section>
                    </article>
                </section>
            </section>
        </section>

        <section class="inner-f-top">
            <section class="container">
                <section class="top">
                    <section class="row-fluid">
                        <figure class="span4" style="margin-bottom: 0px;">
                            <? $this->widget('application.widgets.Frontend.FromGallery'); ?>
                        </figure>

                        <figure class="span4 b-post" style="margin-bottom: 0px;">
                            <? $this->widget('application.widgets.Frontend.LastNews'); ?>
                        </figure>

                        <figure class="span4" style="margin-bottom: 0px;">
                            <? $this->widget('application.widgets.Frontend.ContactUs'); ?>   
                        </figure>
                    </section>
                </section>
            </section>
        </section>


        <footer id="footer">
            <section class="container">
                <figure class="copy-right">
                    <p>© 2014. Івано-Франківськ. ekodekor-if.com при використанні матеріалів сайту гіперпосилання на www.ekodekor-if.com є обов'язковим.</p>
                </figure>
            </section>
        </footer>

    </div>

    <script type="text/javascript" src="<?= $assets_path; ?>/js/modernizr.custom.17475.js"></script>
    <script type="text/javascript" src="<?= $assets_path; ?>/js/focus.js"></script>
    <script type="text/javascript" src="<?= $assets_path; ?>/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?= $assets_path; ?>/js/jquery.elastislide.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            new ApplicationController();
        });  
    </script>

</body>
</html>
