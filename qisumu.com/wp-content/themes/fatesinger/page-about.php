<?php 
/*
Template Name: 关于模板
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
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<div class="page-entry">
			
			<?php the_content(); ?>
			
			</div>
		<div class="clear"></div>
								
						
						
				
			
			<?php endwhile; endif;?>
		</div>
		<script>
	
		$('.myskills li').each(function(){
			$(this).animate(
				{marginLeft:0},function ee(n){
					return(n=Math.random()*3333|0)>1500?n:ee()
				}()

				
			);
		});
	
	</script>

	</article><?php get_footer(); ?>