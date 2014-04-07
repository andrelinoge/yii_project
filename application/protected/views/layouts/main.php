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
              <h1 id="logo"><a href="index.html">Green Peas</a></h1>
              <nav id="nav">
                <div class="navbar navbar-inverse">
                  <div class="navbar-inner">
                    <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
                    <div class="nav-collapse collapse">
                      <ul class="nav">
                        <li> <a href="index.html">Home</a> </li>
                        <li class="dropdown"> <a class="dropdown-toggle" href="#" data-toggle="dropdown">Company <b class="caret"></b> </a>
                          <ul class="dropdown-menu">
                            <li><a href="about-us.html">About Us</a></li>
                            <li><a href="career.html">Career</a></li>
                            <li><a href="team.html">Our Team</a></li>
                            <li><a href="author.html">author</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"> <a class="dropdown-toggle" href="#" data-toggle="dropdown">Gallery <b class="caret"></b> </a>
                      <ul class="dropdown-menu">
                        <li><a href="gallery-2col.html">Gallery 2 column</a></li>
                        <li><a href="gallery-3col.html">Gallery 3 column</a></li>
                        <li><a href="gallery-4col.html">Gallery 4 column</a></li>
                        <li><a href="right-bar-gallery.html">Right Bar Gallery</a></li>
                    </ul>
                </li>
                <li class="dropdown"> <a class="dropdown-toggle" href="#" data-toggle="dropdown">Blog <b class="caret"></b> </a>
                  <ul class="dropdown-menu">
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="blog-detail.html">Blog Detail</a></li>
                    <li><a href="blog-double-sidebar.html">Blog Double Sidebar</a></li>
                </ul>
            </li>
            <li class="dropdown active"> <a class="dropdown-toggle" href="#" data-toggle="dropdown">Features <b class="caret"></b> </a>
              <ul class="dropdown-menu">
                <li><a href="password_protected.html">Password Protected</a></li>
                <li><a href="password_protected2.html">password protected 2</a></li>
                <li><a href="search-result.html">Search Result</a></li>
                <li><a href="shotcodes.html">ShortCodes</a></li>
                <li><a href="404.html">404 Page</a></li>
                <li><a href="faq.html">faq</a></li>
                <li class="active"><a href="left-nav.html">Left Nav</a></li>
                <li><a href="testimonials.html">Testimonials</a></li>
            </ul>
        </li>
        <li> <a href="contact.html">Contact</a> </li>
    </ul>
</div>
<!--/.nav-collapse -->
</div>
<!-- /.navbar-inner -->
</div>
<!-- /.navbar -->
</nav>
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
                <figure class="span4">
                    <? $this->widget('application.widgets.Frontend.FromGallery'); ?>
                </figure>
                  
                <figure class="span4 b-post">
                    <? $this->widget('application.widgets.Frontend.LastNews'); ?>
                </figure>

                <figure class="span4">
                    <? $this->widget('application.widgets.Frontend.ContactUs'); ?>   
                </figure>
            </section>
        </section>
    </section>
</section>


<footer id="footer">
    <section class="container">
        <figure class="copy-right">
            <p>Copyright © 2012. All rights reserved.</p>
        </figure>
    </section>
</footer>

</div>

<script type="text/javascript" src="<?= $assets_path; ?>/js/jquery00.js"></script>
<script src="<?= $assets_path; ?>/js/modernizr.custom.17475.js"></script>
<script type="text/javascript" src="<?= $assets_path; ?>/js/focus.js"></script>
<script type="text/javascript" src="<?= $assets_path; ?>/js/bootstrap.js"></script>
<script type="text/javascript" src="<?= $assets_path; ?>/js/jquery.elastislide.js"></script>

<script type="text/javascript" src="<?= $assets_path; ?>/js/slider.js"></script>
<script src="<?= $assets_path; ?>/js/cockies.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        new ApplicationController();
    });  
</script>

</body>
</html>
