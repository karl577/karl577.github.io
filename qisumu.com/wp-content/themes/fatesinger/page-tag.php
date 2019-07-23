<?php 
/*
Template Name: 标签模板
*/
get_header(); 
?>

	<article>        
	<div id="page-header"></div>							
					
				 <div id="page-content">
			<div class="page-sidebar">
        <ul class="page-navbar">
            <?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'pagenav', 'echo' => false)) )); ?>
        </ul>
    </div>
			<div class="breadcrumbsclear"><div class="breadcrumbs"><li><a href="<?php bloginfo('url'); ?>">Home&nbsp;</a> &gt; <?php the_title(); ?></li></div></div>
			<h1><?php echo get_the_title(); ?></h1>
			<ul class="tag-clouds">
		<?php $tags_list = get_tags('orderby=count&order=DESC');
		if ($tags_list) { 
			foreach($tags_list as $tag) {
				echo '<li><a class="tag-link" href="'.get_tag_link($tag).'">'. $tag->name .'</a><strong>x '. $tag->count .'</strong><div class="tag-posts">'; 
				$posts = get_posts( "tag_id=". $tag->term_id ."&numberposts=1" );
				if( $posts ){
					foreach( $posts as $post ) {
						setup_postdata( $post );
						echo '<a href="'.get_permalink().'">'.get_the_title().'</a></div><em>'.get_the_time('Y-m-d').'</em>';
					}
				}
				echo '</li>';
			} 
		} 
		?>
	</ul>
		</div>
		
	</article><?php get_footer(); ?>