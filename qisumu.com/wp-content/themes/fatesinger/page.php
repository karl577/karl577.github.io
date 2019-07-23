<?php get_header(); ?>
<article>
	
		
	   <div id="page-header"></div>							
					
				 <div id="page-content">
			<div class="page-sidebar">
        <ul class="page-navbar">
            <?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'pagenav', 'echo' => false)) )); ?>
        </ul>
    </div>
			<div class="breadcrumbsclear"><div class="breadcrumbs"><li><a href="<?php bloginfo('url'); ?>">Home&nbsp;</a> &gt; <?php the_title(); ?></li></div></div>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1>
						<?php the_title(); ?>
					</h1>
			<div class="page-entry">
			<?php the_content(); ?>
			</div>
		<div class="clear"></div>
								
						
						
				<?php comments_template( '/comments.php', true ); ?>	
			
			<?php endwhile; endif;?>
		</div>
	
	<div class="clear"></div> </article> 
	<?php get_footer(); ?>

<div class="clear"></div> 