<?php
/* The Template to Render the Slider
*
*/

//Define all Variables.
if ( get_theme_mod('protopress_main_slider_enable' ) && is_home() ) : 

	$count_x = $count = esc_html(get_theme_mod('protopress_main_slider_count'));

		
		?>
		<div class="container">
			<div class="slider-wrapper theme-default">
		            <div id="nivoSlider" class="nivoSlider">
		            <?php
		            for ( $i = 1; $i <= $count; $i++ ) :

						$url = esc_url ( get_theme_mod('protopress_slide_url'.$i) );
						$img = esc_url ( get_theme_mod('protopress_slide_img'.$i) );
						
						?>
						
			            <a href="<?php echo $url; ?>"><img src="<?php echo $img ?>" title="#caption_<?php echo $i ?>" /></a>
			            
		             <?php endfor; ?>
		               
		            </div>
		            
		            <?php
		            for ( $i = 1; $i <= $count_x; $i++ ) :

						$title = esc_html(get_theme_mod('protopress_slide_title'.$i));
						$desc = esc_html(get_theme_mod('protopress_slide_desc'.$i));
						$button = esc_html(get_theme_mod('protopress_slide_CTA_button'.$i));
						$url = esc_url ( get_theme_mod('protopress_slide_url'.$i) );
						
						
						?>
			            <div id="caption_<?php echo $i ?>" class="nivo-html-caption">
			                <a href="<?php echo $url ?>">
				                <div class="slide-title"><?php echo $title ?></div>
				                <div class="slide-desc"><span><?php echo $desc ?></span></div>
				                <?php if ($button != "") { ?><div class="slide-cta"><span><?php echo $button ?></span></div><?php } ?>
			                </a>
			            </div>
		            <?php endfor; ?>
		            
		        </div>
		</div> 
	
	<?php	
	
endif;	?>	   