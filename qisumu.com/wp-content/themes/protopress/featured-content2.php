<?php if ( get_theme_mod('protopress_box_enable') && is_front_page() ) : ?>
<div class="featured-2">
<div class="container">
	<div class="popular-articles col-md-6">
		<div class="section-title">
			<?php echo get_theme_mod('protopress_box_title','Popular Articles'); ?>
		</div>	
		
		<?php /* Start the Loop */ $count=0; ?>
				<?php
		    		$args = array( 'posts_per_page' => 4, 'category' => get_theme_mod('protopress_box_cat') );
					$lastposts = get_posts( $args );
					foreach ( $lastposts as $post ) :
					  setup_postdata( $post ); ?>
				
				    <div class="col-md-6 col-sm-6 imgcontainer">
				    	<div class="popimage">
				        <?php if (has_post_thumbnail()) : ?>	
								<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail('pop-thumb'); ?></a>
						<?php else : ?>
								<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder2.jpg"; ?>"></a>
						<?php endif; ?>
							<div class="titledesc">
				            <h2><?php echo the_title(); ?></h2>
				            <a class="hvr-float-shadow readmorelink" href="<?php the_permalink() ?>"><?php _e('Read More','protopress'); ?></a>
				        </div>
				    	</div>	
				        
				    </div>
				    
				<?php $count++;
				if ($count == 4) break;
				 endforeach; ?>
		
	</div>
<div class="latest-hap col-md-6">
<div class="section-title">
		<?php echo get_theme_mod('protopress_slider_title','Latest Happenings'); ?>
	</div>		
	<ul id="sb-slider" class="bxslider">
		
	 
	 	<?php /* Start the Loop */ ?>
				<?php
		    		$args = array( 'posts_per_page' => get_theme_mod('protopress_slider_count', 4 ), 'category' => get_theme_mod('protopress_slider_cat') );
					$lastposts = get_posts( $args );
					foreach ( $lastposts as $post ) :
					  setup_postdata( $post ); ?>
					<?php if (has_post_thumbnail()) : //Don't Display Anything if no image. ?>	  
				    <li>
				        
						<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_post_thumbnail('slider-thumb'); ?></a>
				        <div class="sb-description">
				            <h3><?php echo the_title(); ?></h3>
				        </div>
				    </li>
				    <?php endif; ?>
				    
				<?php endforeach; ?>    
	</ul>
	<div id="nav-arrows" class="nav-arrows">
		<a id="slider-next"></a>
		<a id="slider-prev"></a>
	</div>
</div>
</div><!--.container-->
</div>
<?php endif; ?>