<!DOCTYPE html>

<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->

<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->

<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->

<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->

<head>

    <!-- Meta Tags -->

    <meta http-equiv="Content-Type" content="text/html" charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <title><?php wp_title(); ?></title>

    

  

    <!-- HTML5 SHIV -->

    <!--[if IE]>

        <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>

    <![endif]-->

    <!-- END HTML5 SHIV -->



    <!-- Pingback and Profile -->

    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    

    <?php if(get_theme_mod("favicon-image") !== "") { ?>

		<?php $faviconimage = get_theme_mod("favicon-image"); ?>

        <link rel="shortcut icon" href="<?php echo esc_url($faviconimage); ?>">

    <?php } ?>

<?php wp_head(); ?>




<!-- qisumu.com Baidu tongji analytics -->
<script>
var _hmt = _hmt || [];
(function() {
var hm = document.createElement("script");
hm.src = "https://hm.baidu.com/hm.js?cd8191d648355b940efdb3f1ba7fb3a0";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hm, s);
})();
</script>



</head>

<body <?php body_class(); ?>>

<header id="main-header">

    <section id="top-bar" class="clearfix">

        <div class="container">

            <nav id="top-bar-menu">

                    <?php wp_nav_menu( array( 'theme_location'   => 'secondary') ); ?>

            </nav><!-- end #top-bar-menu -->



            <?php get_search_form(); ?>

        </div><!-- end .container -->

    </section><!-- end #top-bar -->



    <section id="inner-header" class="clearfix">

        <div class="container">

            <a href="<?php echo home_url(); ?>" class="logo"><h1><?php bloginfo("title"); echo " - "; bloginfo("description"); ?></h1></a>



            <section id="ad-banner">

                <?php

                    if(get_theme_mod("head_display_ad",false)) {

                        $ad_banner_img = get_theme_mod('header-ad-img');

                        $ad_banner_url = get_theme_mod('header-ad-url');

                        $ad_banner_alt = get_theme_mod("header-ad-alt");



                        if( !empty($ad_banner_img))

                        {

                            echo "<a href='" . esc_url($ad_banner_url) . "'><img title='" . esc_attr($ad_banner_alt) . "' alt='" . esc_attr($ad_banner_alt) . "' src='" . esc_url($ad_banner_img) . "' /></a>";

                        } 

                    }

                ?>

            </section><!-- end #ad-banner -->

        </div><!-- end .container -->

    </section><!-- end #inner-header -->



    <section id="main-menu" class="clearfix">

        <div class="container">

            <nav>

                <ul>

                    <?php wp_nav_menu( array( 'theme_location'   => 'primary') ); ?>

                </ul>

            </nav><!-- end #main-menu -->



            <section id="menu-social-icons">

                <ul>

                    <?php 

                        $social_links = array(

                            array('gplus_href', 'fa-google-plus'),

                            array('twitter_href', 'fa-twitter'),

                            array('facebook_href', 'fa-facebook'),

                            array('linkedin_href', 'fa-linkedin'),

                            array('instagram_href', 'fa-instagram'),

                            array('pinterest_href', 'fa-pinterest'),

                            array('youtube_href', 'fa-youtube'),

                            array('vimeo_href', 'fa-vimeo-square'),

                            array('tumblr_href', 'fa-tumblr'),

                            array('flickr_href', 'fa-flickr'),

                        );



                        foreach ($social_links as $social_link) {

                            $sl_href = get_theme_mod($social_link[0]);

                            if($sl_href != "") {

                                echo "<li><a href=". $sl_href ."><i class='fa " . $social_link[1] . "'></i></a></li>";

                            }                            

                        }

                    ?>

                </ul>

            </section><!-- end #menu-social-icons -->

        </div><!-- end .container -->

    </section><!-- end #main-menu -->

</header><!-- end #main-header -->

