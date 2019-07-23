<header id="masthead" class="site-header">

	<nav id="top-header">
		<div class="top-nav">
			<?php if (zm_get_option('profile')) { ?>
				<?php get_template_part( 'inc/user-profile' ); ?>
			<?php } ?>

			<?php
				wp_nav_menu( array(
					'theme_location'	=> 'header',
					'menu_class'		=> 'top-menu',
					'fallback_cb'		=> 'default_menu'
				) );
			?>
		</div>
	</nav><!-- #top-header -->

	<div id="menu-box">
		<div id="top-menu">
			<span class="nav-search">搜索</span>
			<?php if (zm_get_option("logo_css")) { ?>
			<hgroup class="logo-site">
			<?php } else { ?>
			<hgroup class="logo-sites">
			<?php } ?>
				<?php
					if ( is_front_page() && is_home() ) : ?>
						<?php if (zm_get_option('logos')) { ?>
				    	<h1 class="site-title">
						    <?php if ( zm_get_option('logo') ) { ?>
						        <a href="<?php echo esc_url( home_url('/') ); ?>"><img src="<?php echo zm_get_option('logo'); ?>" width="220" height="50" alt="<?php bloginfo('name'); ?>" /></a>
							<?php } ?>
						</h1>
				       <?php } else { ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php } ?>
					<?php else : ?>
					<?php if (zm_get_option('logos')) { ?>
				    	<p class="site-title">
						    <?php if ( zm_get_option('logo') ) { ?>
						        <a href="<?php echo esc_url( home_url('/') ); ?>"><img src="<?php echo zm_get_option('logo'); ?>" width="220" height="50" alt="<?php bloginfo('name'); ?>" /></a>
							<?php } ?>
						</p>
				       <?php } else { ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php } ?>
					<?php endif;
				?>
			</hgroup><!-- .logo-site -->

			<div id="site-nav-wrap">
				<div id="sidr-close"><a href="#sidr-close" class="toggle-sidr-close">关闭</a></div>
				<nav id="site-nav" class="main-nav">
					<?php if (zm_get_option('m_nav')) { ?>
						<?php if ( wp_is_mobile() ) { ?>
							<span class="nav-mobile">导航</span>
						<?php } else { ?>
							<a href="#sidr-main" id="navigation-toggle" class="bars">导航</a>
						<?php } ?>
					<?php } else { ?>
					<a href="#sidr-main" id="navigation-toggle" class="bars">导航</a>
					<?php } ?>
					<?php
						wp_nav_menu( array(
							'theme_location'	=> 'primary',
							'menu_class'		=> 'down-menu nav-menu',
							'fallback_cb'		=> 'default_menu'
						) ); 
					?>
				</nav><!-- #site-nav -->
				
			</div><!-- #site-nav-wrap -->

		</div><!-- #top-menu -->
	</div><!-- #menu-box -->
</header><!-- #masthead -->

<div id="main-search">
	<?php if (zm_get_option('wp_s')) { ?><?php get_search_form(); ?><?php } ?>
	<?php if (zm_get_option('baidu_s')) { ?><?php get_template_part( 'inc/search-baidu' ); ?><?php } ?>
	<div class="clear"></div>
</div>