<?php
	// get options
	$pinthis_numlinks = get_option('pbpanel_footer_showlinks');
	$pinthis_soclink_facebook = get_option('pbpanel_url_facebook');
	$pinthis_soclink_pinterest = get_option('pbpanel_url_pinterest');
	$pinthis_soclink_twitter = get_option('pbpanel_url_twitter');
	$pinthis_soclink_instagram = get_option('pbpanel_url_instagram');
	$pinthis_soclink_youtube = get_option('pbpanel_url_youtube');
	$pinthis_soclink_linkedin = get_option('pbpanel_url_linkedin');
	$pinthis_soclink_gplus = get_option('pbpanel_url_gplus');
	$pinthis_soclink_behance = get_option('pbpanel_url_behance');
	$pinthis_soclink_flickr = get_option('pbpanel_url_flickr');
	$pinthis_soclink_foursquare = get_option('pbpanel_url_foursquare');
	$pinthis_soclink_vimeo = get_option('pbpanel_url_vimeo');
	$pinthis_soclink_soundcloud = get_option('pbpanel_url_soundcloud');
	$pinthis_copyright = get_option('pbpanel_footer_copyright');
?>
<input type="checkbox" id="toggle-footer" class="hide">
<footer>
	<a href="#totop" class="scrolltotop">Scroll to Top</a>
	<div class="toggler">
		<label for="toggle-footer">&nbsp;</label>
	</div>
	<div class="footerwrapper">
		<div class="footerbar">
			<div class="container">
				<div class="cell">
					<h3 class="title-2"><?php echo __('Pages', 'pinthis'); ?></h3>
					<?php if (get_pages()) { ?>
						<?php 
							$pages_limit = $pinthis_numlinks; 
							$pages_list = wp_list_pages('title_li=&sort_column=menu_order&echo=0&depth=1');
							$pages_arr = explode('</li>', $pages_list);
						 ?>
						<ul class="links">
							<?php 
								for($i=0; $i < min(count($pages_arr),$pages_limit); $i++) {
									echo $pages_arr[$i];
								}
							?>	
						</ul>
					<?php } else { ?>
						<p class="notification"><?php echo __('No pages', 'pinthis'); ?></p>
					<?php } ?>
				</div>
				<div class="cell"> 
					<h3 class="title-2"><?php echo __('Bookmarks', 'pinthis'); ?></h3>
					<?php if (get_bookmarks()) { ?>
						<ul class="links">
							<?php wp_list_bookmarks('title_li=&categorize=0&show_images=0&limit=' . $pinthis_numlinks); ?>	
						</ul>
					<?php } else { ?>
						<p class="notification"><?php echo __('No bookmarks', 'pinthis'); ?></p>
					<?php } ?>
				</div>
				<div class="cell">
					<h3 class="title-2"><?php echo __('Recent Posts', 'pinthis'); ?></h3>
					<?php query_posts('order=DESC&ignore_sticky_posts=1&showposts=' . $pinthis_numlinks); ?>
					<?php if ( have_posts() ) { ?>
						<ul class="links">
							<?php while ( have_posts() ) { the_post(); ?>
							<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
							<?php } ?>	
						</ul>
					<?php } else { ?>
						<p class="notification"><?php echo __('No recent posts', 'pinthis'); ?></p>
					<?php } wp_reset_query(); ?>
				</div>
				<div class="cell">
					<h3 class="title-2"><?php echo __('Popular Posts', 'pinthis'); ?></h3>
					<?php query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&ignore_sticky_posts=1&showposts=' . $pinthis_numlinks);  ?>
					<?php if (have_posts()) { ?>
						<ul class="links">
						<?php while (have_posts()) { the_post();  ?>
							<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
						<?php } ?>
						</ul>
					<?php }  else { ?>
						<p class="notification"><?php echo __('No popular posts', 'pinthis'); ?></p>	
					<?php } ?>
				</div>
				<div class="cell">
					<h3 class="title-2"><?php echo __('Follow Us', 'pinthis'); ?></h3>
					<ul class="soclinks clearfix">
						<?php if (strlen($pinthis_soclink_facebook) > 0) { ?>
						<li><a href="<?php echo esc_url(pinthis_addScheme($pinthis_soclink_facebook)); ?>" class="icon-footer-fb" target="_blank"><?php echo __('Facebook', 'pinthis'); ?></a></li>
						<?php } ?>
						<?php if (strlen($pinthis_soclink_pinterest) > 0) { ?>
						<li><a href="<?php echo esc_url(pinthis_addScheme($pinthis_soclink_pinterest)); ?>" class="icon-footer-pin" target="_blank"><?php echo __('Pinterest', 'pinthis'); ?></a></li>
						<?php } ?>
						<?php if (strlen($pinthis_soclink_twitter) > 0) { ?>
						<li><a href="<?php echo esc_url(pinthis_addScheme($pinthis_soclink_twitter)); ?>" class="icon-footer-tw" target="_blank"><?php echo __('Twitter', 'pinthis'); ?></a></li>
						<?php } ?>
						<?php if (strlen($pinthis_soclink_instagram) > 0) { ?>
						<li><a href="<?php echo esc_url(pinthis_addScheme($pinthis_soclink_instagram)); ?>" class="icon-footer-instagram" target="_blank"><?php echo __('Instagram', 'pinthis'); ?></a></li>
						<?php } ?>
						<?php if (strlen($pinthis_soclink_youtube) > 0) { ?>
						<li><a href="<?php echo esc_url(pinthis_addScheme($pinthis_soclink_youtube)); ?>" class="icon-footer-youtube" target="_blank"><?php echo __('Youtube', 'pinthis'); ?></a></li>
						<?php } ?>
						<?php if (strlen($pinthis_soclink_linkedin) > 0) { ?>
						<li><a href="<?php echo esc_url(pinthis_addScheme($pinthis_soclink_linkedin)); ?>" class="icon-footer-linkedin" target="_blank"><?php echo __('LinkedIn', 'pinthis'); ?></a></li>
						<?php } ?>
						<?php if (strlen($pinthis_soclink_gplus) > 0) { ?>
						<li><a href="<?php echo esc_url(pinthis_addScheme($pinthis_soclink_gplus)); ?>" class="icon-footer-gplus" target="_blank"><?php echo __('Google +', 'pinthis'); ?></a></li>
						<?php } ?>
						<?php if (strlen($pinthis_soclink_behance) > 0) { ?>
						<li><a href="<?php echo esc_url(pinthis_addScheme($pinthis_soclink_behance)); ?>" class="icon-footer-behance" target="_blank"><?php echo __('Behance', 'pinthis'); ?></a></li>
						<?php } ?>
						<?php if (strlen($pinthis_soclink_flickr) > 0) { ?>
						<li><a href="<?php echo esc_url(pinthis_addScheme($pinthis_soclink_flickr)); ?>" class="icon-footer-flickr" target="_blank"><?php echo __('Flickr', 'pinthis'); ?></a></li>
						<?php } ?>
						<?php if (strlen($pinthis_soclink_foursquare) > 0) { ?>
						<li><a href="<?php echo esc_url(pinthis_addScheme($pinthis_soclink_foursquare)); ?>" class="icon-footer-foursquare" target="_blank"><?php echo __('Foursquare', 'pinthis'); ?></a></li>
						<?php } ?>
						<?php if (strlen($pinthis_soclink_vimeo) > 0) { ?>
						<li><a href="<?php echo esc_url(pinthis_addScheme($pinthis_soclink_vimeo)); ?>" class="icon-footer-vimeo" target="_blank"><?php echo __('Vimeo', 'pinthis'); ?></a></li>
						<?php } ?>
						<?php if (strlen($pinthis_soclink_soundcloud) > 0) { ?>
						<li><a href="<?php echo esc_url(pinthis_addScheme($pinthis_soclink_soundcloud)); ?>" class="icon-footer-soundcloud" target="_blank"><?php echo __('Soundcloud', 'pinthis'); ?></a></li>	
						<?php } ?>
					</ul>
				</div>	
			</div>	
		</div>
		<div class="copyright">
			<div class="container">
				<?php if (strlen($pinthis_copyright) > 0) { ?>
				<p><?php echo html_entity_decode(stripslashes_deep($pinthis_copyright), ENT_QUOTES); ?></p>
				<?php } else { ?>
				<p><?php echo __('Copyright', 'pinthis'); ?> &copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?></p>
				<?php } ?>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
