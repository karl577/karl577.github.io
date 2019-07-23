<?php get_header(); ?>

<div class="nav">
<?php wp_nav_menu( array( 'theme_location' => 'menu', 'container' => '', 'fallback_cb' => '' ) ); ?>
<p>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. Powered by WordPress. Designed by <a href="https://github.com/LoeiFy" target="_blank">LoeiFy</a>. Modified by <a href="https://www.mywpku.com" target="_blank">PCDotFan</a></p>
</div>

<div id="container">	

    <?php if (have_posts()) : $count = 0;  while (have_posts()) : the_post(); $count++; if( $count <= 1 ): ?>

	<?php $cover = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>
	
	<div id="screen">
        <div id="mark">
            <div class="layer" data-depth="0.4">
                <img id="cover" src="<?php echo $cover[0] ?>" width="<?php echo $cover[1] ?>" height="<?php echo $cover[2] ?>"/>
            </div>
        </div>

        <div id="vibrant">
            <svg viewBox="0 0 2880 1620" height="100%" preserveAspectRatio="xMaxYMax slice">
				<polygon opacity="0.7" points="2000,1620 0,1620 0,0 600,0 "/>
			</svg>
        </div>

        <div id="header"><div>
            <a class="header-logo" href="/"></a>
            <div class="icon-menu switchmenu"></div>
        </div></div>
        <div id="post0">
            <p><?php the_time('F j, Y'); ?></p>
            <h2><a data-id="<?php the_ID() ?>" class="posttitle" href="<?php the_permalink(); ?>" /><?php the_title(); ?></a></h2>
            <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 100,"..."); ?></p>
        </div>
	</div>

	<div style="display: none;">
	    <?php get_template_part( 'post' ); ?>
	</div>

    <div id="primary">

    <?php else : ?>

    <?php get_template_part( 'post' ); ?>

    <?php endif; endwhile; endif; ?>

    </div>
    
    <div id="pager"><?php next_posts_link(('加载更多')); ?></div>
  
</div>
<div id="preview" class="trans"></div>
</body>
</html><!--
