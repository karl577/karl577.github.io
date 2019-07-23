<?php
add_action( 'admin_menu', 'quemalabs_getting_started_menu' );
function quemalabs_getting_started_menu() {
	add_theme_page( esc_attr__( 'Theme Info', 'caos' ), esc_attr__( 'Theme Info', 'caos' ), 'manage_options', 'caos_theme-info', 'quemalabs_getting_started_page' );
}

/**
 * Theme Info Page
 */
function quemalabs_getting_started_page() {
	if ( ! current_user_can( 'manage_options' ) )  {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'caos' ) );
	}
	echo '<div class="getting-started">';
	?>
	<div class="getting-started-header">
		<div class="header-wrap">
			<div class="theme-image">
				<span class="top-browser"><i></i><i></i><i></i></span>
				<img src="<?php echo get_template_directory_uri() . '/screenshot.png'; ?>" alt="">
			</div>
			<div class="theme-content">
				<div class="theme-content-wrap">
				<h4><?php esc_html_e( 'Getting Started', 'caos' ); ?></h4>
				<h2 class="theme-name"><?php echo esc_html( QL_THEME_NAME ); ?> <span class="ver"><?php echo 'v' . esc_html( QL_THEME_VERSION ); ?></span></h2>
				<p><?php echo sprintf( esc_html__( 'Thanks for using %s, we appriciate that you create with our products.', 'caos' ), esc_html( QL_THEME_NAME ) ); ?></p>
				<p><?php esc_html_e( 'Check the content below to get started with our theme.', 'caos' ); ?></p>
				</div>

				<ul class="getting-started-menu">
					<?php
					if ( isset ( $_GET['tab'] ) ){
						$tab = $_GET['tab'];
					}else{
						$tab = 'docs';
					}
					?>
					<li><a href="?page=caos_theme-info&amp;tab=docs" class="<?php echo ( $tab == 'docs' ) ? ' active' : ''; ?>"><i class="fa fa-file-text-o"></i> <?php esc_html_e( 'Documentation', 'caos' ); ?></a></li>
					<li><a href="https://www.quemalabs.com/theme/caos-pro/" target="_blank"><i class="fa fa-star-o"></i> <?php esc_html_e( 'PRO Version', 'caos' ); ?></a></li>
					<li><a href="?page=caos_theme-info&amp;tab=more-themes" class="<?php echo ( $tab == 'more-themes' ) ? ' active' : ''; ?>"><i class="fa fa-wordpress"></i> <?php esc_html_e( 'More Themes', 'caos' ); ?></a></li>
					 
				</ul>

			</div><!-- .theme-content -->
		</div>
		<a href="https://www.quemalabs.com/" class="ql_logo" target="_blank"><img  src="<?php echo get_template_directory_uri() . '/images/quemalabs.png'; ?>" alt="Quema Labs" /></a>
	</div><!-- .getting-started-header -->

	<div class="getting-started-content">

	<?php
	global $pagenow;
	global $updater;
	
	if ( $pagenow == 'themes.php' && $_GET['page'] == 'caos_theme-info' ){
		if ( isset ( $_GET['tab'] ) ){
			$tab = $_GET['tab'];
		}else{
			$tab = 'docs';
		}

		switch ( $tab ){
			case 'docs' :
	?>

			<div class="theme-docuementation">
				<div class="help-msg-wrap">
					<div class="help-msg"><?php echo sprintf( esc_html__( 'You can find this documentation and more at our %sHelp Center%s.', 'caos' ), '<a href="https://www.quemalabs.com/help-center/" target="_blank">', '</a>' ); ?></div>
				</div>
				<?php
				$url = wp_nonce_url( 'themes.php?page=caos_theme-info', 'more-themes' );
				if ( false === ( $creds = request_filesystem_credentials( $url, '', false, false, null ) ) ) {
					return; // stop processing here
				}
				if ( ! WP_Filesystem( $creds ) ) {
					request_filesystem_credentials( $url, '', true, false, null );
					return;
				}
				global $wp_filesystem;
				$content = $wp_filesystem->get_contents( 'https://www.quemalabs.com/article/' . QL_THEME_SLUG . '-documentation/' );
				$first_step = explode( '<div class="post_content">' , $content );
				$second_step = explode("</div><!-- /post_content -->" , $first_step[1] );

				echo $second_step[0];
				?>
			</div><!-- .theme-docuementation -->
			<?php
	      	break;
	      	case 'license' :

	      	
			$updater->license_page();
	      	
	        ?>

        <?php
        	break;
        	case 'more-themes' :

        	$url = wp_nonce_url( 'themes.php?page=caos_theme-info', 'more-themes' );
			if ( false === ( $creds = request_filesystem_credentials( $url, '', false, false, null ) ) ) {
				return; // stop processing here
			}
			if ( ! WP_Filesystem( $creds ) ) {
				request_filesystem_credentials( $url, '', true, false, null );
				return;
			}
			global $wp_filesystem;
			$json = $wp_filesystem->get_contents( 'https://www.quemalabs.com/wp-json/quemalabs/v1/themes/' );
			$themes = json_decode( $json );

        	echo '<div class="more-themes">';

				foreach ( $themes as $theme ) {
					if ( QL_THEME_SLUG == $theme->slug ) continue;
						
					?>
					<div class="ql-theme">
						<a href="<?php echo esc_url( $theme->url ); ?>" class="ql-theme-image" target="_blank"><img src="<?php echo $theme->image; ?>" alt="<?php echo esc_attr( $theme->slug ); ?>" /></a>
						<div class="ql-theme-info">
							<h4><a href="<?php echo esc_url( $theme->url ); ?>" target="_blank"><?php echo esc_html( $theme->name ); ?></a></h4>
							<p><?php echo esc_html( $theme->sub_title ); ?></p>
							<?php
							if( 'premium' == $theme->type ){
								$type = esc_html__( 'Premium', 'caos' );
							}else{
								$type = esc_html__( 'Free', 'caos' );
							}
							?>
							<a href="<?php echo esc_url( $theme->url ); ?>" class="ql-theme-button <?php echo esc_attr( $theme->type ); ?>" target="_blank"><?php echo $type; ?></a>
						</div>
					</div>
					<?php
				}

        ?>

				
        	</div><!-- .more-themes -->

        <?php
        	break;
     	}//switch
         ?>


	<?php }//if theme.php ?>

	</div><!-- .getting-started-content -->


	<?php
	echo '</div><!-- .getting-started -->';
}
?>