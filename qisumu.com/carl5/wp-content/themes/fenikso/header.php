<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title( '&hearts;', true, 'right' ); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <script src="<?php echo get_template_directory_uri(); ?>/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/fenikso.js"></script>
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
  <body>
    <header>
      <div class="container">
        <div class="row">
          <div class="span6">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Jump to the front page', 'fenikso' ); ?>">
              <img id="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
            </a>
          </div>
          <div class="span6">
            <?php get_search_form(); ?> 
          </div>
        </div>
        
      </div>
    </header>
    <nav id="navigation">
      <div class="container">
        <div class="navbar">
          <?php wp_nav_menu( array(
            'theme_location'  =>  'primary',
            'menu_class'      =>  'nav',
            'container'       =>  false,
            'walker'          =>  new fenikso_Nav_Walker,
          ) ); ?> 	
        </div>
    </div>
    </nav><!-- end #navigation -->
    
    
