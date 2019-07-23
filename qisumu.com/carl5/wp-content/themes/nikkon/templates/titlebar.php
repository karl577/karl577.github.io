<?php if ( !is_front_page() ) : ?>
    <?php if ( !get_theme_mod( 'nikkon-page-remove-titlebar' ) ) : ?>
    
        <header class="entry-header">
            
            <?php if ( is_home() ) : ?>
                
                <?php echo ( get_theme_mod( 'nikkon-blog-title' ) ) ? '<h1 class="entry-title">' . esc_html( get_theme_mod( 'nikkon-blog-title', false ) ) . '</h1>' : '<h1 class="entry-title">' . __( 'Blog', 'nikkon' ) . '</h1>'; ?>
                
            <?php else: ?>
                
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                
            <?php endif; ?>
            
            <?php if ( ! is_front_page() ) : ?>
        
    	        <?php if ( function_exists( 'bcn_display' ) ) : ?>
    		        <div class="breadcrumbs">
    		            <?php bcn_display(); ?>
    		        </div>
    	        <?php endif; ?>
    	        
    	    <?php endif; ?>
            
        </header><!-- .entry-header -->
    
    <?php endif; ?>
<?php endif; ?>