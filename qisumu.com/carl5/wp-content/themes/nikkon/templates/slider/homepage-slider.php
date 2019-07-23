<?php if ( get_theme_mod( 'nikkon-slider-type', false ) == 'nikkon-no-slider' ) : ?>
    
    <!-- No Slider -->
    
<?php elseif ( get_theme_mod( 'nikkon-slider-type', false ) == 'nikkon-meta-slider' ) : ?>
    
    <?php
    $slider_code = '';
    if ( get_theme_mod( 'nikkon-meta-slider-shortcode' ) ) {
        $slider_code = get_theme_mod( 'nikkon-meta-slider-shortcode' );
    } ?>
    
    <?php echo ( $slider_code ) ? do_shortcode( esc_html( $slider_code ) ) : ''; ?>
    
<?php else : ?>
    
    <?php
    $slider_cats = '';
    if ( get_theme_mod( 'nikkon-slider-cats', false ) ) {
        $slider_cats = get_theme_mod( 'nikkon-slider-cats' );
    } ?>
    
    <?php if ( $slider_cats ) : ?>
        
        <?php $slider_query = new WP_Query( 'cat=' . esc_html( $slider_cats ) . '&posts_per_page=-1&orderby=date&order=DESC' ); ?>
        
        <?php if ( $slider_query->have_posts() ) : ?>
            
                <div class="home-slider-wrap home-slider-remove">
                    
                    <div class="site-container">
                        <div class="home-slider-prev"><i class="fa fa-angle-left"></i></div>
                        <div class="home-slider-next"><i class="fa fa-angle-right"></i></div>
                        
                        <div class="home-slider">
                            
                            <?php while ( $slider_query->have_posts() ) : $slider_query->the_post();
                                $slider_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
                                
                                <?php if ( get_theme_mod( 'nikkon-slider-linkto-post', false ) ) : ?>
                                <a class="home-slider-block" href="<?php the_permalink(); ?>" <?php echo ( has_post_thumbnail() ) ? 'style="background-image: url(' . esc_url( $slider_thumbnail['0'] ) . ');"' : ''; ?>>
                                <?php else : ?>
                                <div class="home-slider-block"<?php echo ( has_post_thumbnail() ) ? ' style="background-image: url(' . esc_url( $slider_thumbnail['0'] ) . ');"' : ''; ?>>
                                <?php endif; ?>
                                
                                    <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_medium.gif" />
                                    
                                    <?php if ( !get_theme_mod( 'nikkon-slider-remove-title', false ) ) : ?>
                                    
                                        <div class="home-slider-block-inner">
                                            <div class="home-slider-block-bg">
                                                <h3>
                                                    <?php the_title(); ?>
                                                </h3>
                                                <?php if ( has_excerpt() ) : ?>
                                                    <p><?php the_excerpt(); ?></p>
                                                <?php else : ?>
                                                    <p><?php the_content(); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                    <?php endif; ?>
                                    
                                <?php if ( get_theme_mod( 'nikkon-slider-linkto-post', false ) ) : ?>
                                </a>
                                <?php else : ?>
                                </div>
                                <?php endif; ?>
                            
                            <?php endwhile; ?>
                            
                        </div>
                        
                    </div>
                    
                    <div class="home-slider-pager"></div>
                </div>
                <?php do_action ( 'nikkon_after_default_slider' ); ?>
            
        <?php endif; wp_reset_query(); ?>
        
    <?php else : ?>
        
        <div class="home-slider-wrap home-slider-remove">
            
            <div class="site-container">
                <div class="home-slider-prev"><i class="fa fa-angle-left"></i></div>
                <div class="home-slider-next"><i class="fa fa-angle-right"></i></div>
                
                <div class="home-slider">
                    
                    <div class="home-slider-block" style="background-image: url(<?php echo get_template_directory_uri() ?>/images/demo/slider_default_01.jpg);">
                        
                        <img src="<?php echo get_template_directory_uri() ?>/images/slider_blank_img_medium.gif" />
                        
                        <?php if ( !get_theme_mod( 'nikkon-slider-remove-title', false ) ) : ?>
                            
                            <div class="home-slider-block-inner">
                                <div class="home-slider-block-bg">
                                    <h3>
                                        <?php _e( 'Highly Customizable', 'nikkon' ); ?>
                                    </h3>
                                    <p><?php _e( 'Build a professional website without any coding knowledge', 'nikkon' ); ?></p>
                                </div>
                            </div>
                            
                        <?php endif; ?>
                        
                    </div>
                    
                </div>
                
            </div>
            
            <div class="home-slider-pager"></div>
            
        </div>
            
    <?php endif; ?>
    
<?php endif; ?>