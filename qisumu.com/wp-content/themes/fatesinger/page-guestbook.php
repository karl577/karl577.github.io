<?php 
/*
Template Name: 留言簿模板
*/ 
?>
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
				<!-- start wall -->	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<h1>
						<?php the_title(); ?>
					</h1>
					<div class="wall">
						<ul>
							<?php 
								$query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 1 MONTH ) AND user_id='0' AND comment_author_email != 'lonelyxue@gmail.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 30";
								$wall = $wpdb->get_results($query); 
								foreach ($wall as $comment) 
								{ 
									if( $comment->comment_author_url ) 
									$url = $comment->comment_author_url; 
									else $url="#"; 
									$tmp = "<li><a href='".$url."' target='_blank' title='".$comment->comment_author." (".$comment->cnt." Comments)'>".get_avatar($comment->comment_author_email, 80)."</a></li>"; 
									$output .= $tmp; 
								 } 
								echo $output ;
							?>
						</ul>
					</div>
					<!-- end wall -->
					
					<div class="clear"></div>
					
					
					
					<?php comments_template( '/comments.php', true ); ?>
				
					<?php endwhile; endif;?>       
					<div class="clear"></div>					
								
			</div> 			
			
		 </article> 
		<?php get_footer(); ?>
	