<? $assets_path = $this->get_behavioral_url(); ?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> 
<![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> 
<![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <title><?= CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="College Education Responsive Template">
    <meta name="author" content="Esmet">
    <meta charset="UTF-8">

    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800' rel='stylesheet' type='text/css'>
        
    <!-- CSS Bootstrap & Custom -->
    <link href="<?= $assets_path; ?>/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?= $assets_path; ?>/css/font-awesome.min.css" rel="stylesheet" media="screen">
    <link href="<?= $assets_path; ?>/css/animate.css" rel="stylesheet" media="screen">
    
    <link href="<?= $assets_path; ?>/style.css" rel="stylesheet" media="screen">
        
    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= $assets_path; ?>/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= $assets_path; ?>/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= $assets_path; ?>/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= $assets_path; ?>/images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?= $assets_path; ?>/images/ico/favicon.ico">
    
    <!-- JavaScripts -->
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?= $assets_path; ?>/js/modernizr.js"></script>
    <!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative;'>
            <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>
        </div>
    <![endif]-->
</head>
<body>

    <!-- This one in here is responsive menu for tablet and mobiles -->
    <div class="responsive-navigation visible-sm visible-xs">
        <a href="#" class="menu-toggle-btn">
            <i class="fa fa-bars"></i>
        </a>
        <div class="responsive_menu">
            <?
                $this->widget('application.widgets.Common.Menu', [
                        'active' => strtolower( $this->id ),
                        'items'  => FrontendMenu::get($this->id),
                        'view' => 'frontend-tablet'
                ]);
            ?> 

        </div> <!-- /.responsive_menu -->
    </div> <!-- /responsive_navigation -->


    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 header-left">
                    <? if (!empty($this->site_settings->phone_1)): ?>
                        <p><i class="fa fa-phone"></i><?= $this->site_settings->phone_1; ?></p>
                    <? endif; ?>
                    
                    <? if (!empty($this->site_settings->phone_2)): ?>
                        <p><i class="fa fa-phone"></i><?= $this->site_settings->phone_2; ?></p>
                    <? endif; ?>
                </div> <!-- /.header-left -->

                <div class="col-md-4">
                    <div class="logo">
                        <a href="index.html" title="Universe" rel="home">
                            <img src="<?= $assets_path; ?>/images/logo.png" alt="Universe">
                        </a>
                    </div> <!-- /.logo -->
                </div> <!-- /.col-md-4 -->

                <div class="col-md-4 header-right">
                    <ul class="small-links">
                        <li><a href="<?= url('page/about'); ?>">About Us</a></li>
                        <li><a href="<?= url('contacts/new'); ?>">Contact</a></li>
                        <li><a href="#" class="call-sizer">Викликати замірника</a></li>
                    </ul>
                </div> <!-- /.header-right -->
            </div>
        </div> <!-- /.container -->

        <div class="nav-bar-main" role="navigation">
            <div class="container">
                <nav class="main-navigation clearfix visible-md visible-lg" role="navigation">
                        <?
                            $this->widget('application.widgets.Common.Menu', [
                                    'active' => strtolower( $this->id ),
                                    'items'  => FrontendMenu::get($this->id),
                                    'view' => 'frontend'
                            ]);
                        ?>
                </nav> <!-- /.main-navigation -->
            </div> <!-- /.container -->
        </div> <!-- /.nav-bar-main -->

    </header> <!-- /.site-header -->
    
    <?= $content; ?>

    <!-- begin The Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <p class="small-text">&copy; Всі права захищені 2014</p>
                </div> <!-- /.col-md-5 -->
                <div class="col-md-7">
                    <ul class="footer-nav">
                        <li><a href="<?= url('site/index'); ?>">Home</a></li>
                        <li><a href="<?= url('page/about'); ?>">About us</a></li>
                        <li><a href="<?= url('contacts/new'); ?>">Contact us</a></li>
                        <li><a href="#" class="call-sizer">Викликати замірника</a></li>
                    </ul>
                </div> <!-- /.col-md-7 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </footer> <!-- /.site-footer -->


    <script src="<?= $assets_path; ?>/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= $assets_path; ?>/js/plugins.js"></script>
    <script src="<?= $assets_path; ?>/js/custom.js"></script>

    <script type="text/javascript">
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