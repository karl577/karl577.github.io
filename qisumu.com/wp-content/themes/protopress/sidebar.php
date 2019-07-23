<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package protopress
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

if ( protopress_load_sidebar() ) : ?>
<div id="secondary" class="widget-area <?php do_action('protopress_secondary-width') ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
<?php endif; ?>
