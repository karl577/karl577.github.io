<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function easyblog_widgets_init() {

    // Register Right Sidebar
    register_sidebar( array(
        'name'          => esc_html__( 'Right Sidebar', 'easyblog' ),
        'id'            => 'dt-sidebar',
        'description'   => __( 'Add widgets to Show widgets at right panel of page', 'easyblog' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // Register front page sidebar before Content
    register_sidebar( array(
        'name'          => esc_html__( 'Front Page: Before Content', 'easyblog' ),
        'id'            => 'dt-front-page-before-content',
        'description'   => __( 'Add widgets to show at Frontpage Before Content', 'easyblog' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // Register front page sidebar after Content
    register_sidebar( array(
        'name'          => esc_html__( 'Front Page: After Content', 'easyblog' ),
        'id'            => 'dt-front-page-after-content',
        'description'   => __( 'Add widgets to show at Frontpage After Content', 'easyblog' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'easyblog_widgets_init' );

/**
 * Enqueue Admin Scripts
 */
function easyblog_media_script( $hook ) {
    if ( 'widgets.php' != $hook ) {
        return;
    }

    wp_enqueue_style('easyblog-widget-style', get_template_directory_uri() . '/inc/widgets/widgets.css');

    wp_enqueue_media();
    wp_enqueue_script( 'easyblog-media-upload', get_template_directory_uri() . '/inc/widgets/widgets.js', array( 'jquery' ), '', true );

}
add_action( 'admin_enqueue_scripts', 'easyblog_media_script' );

/**
 * Social Icons widget.
 */
class easyblog_social_icons extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'easyblog_social_icons',
            __( 'Daisy: Social Icons', 'easyblog' ),
            array(
                'description'   => __( 'Social Icons', 'easyblog' )
            )
        );

    }

    public function widget( $args, $instance ) {

        $title      = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $facebook   = isset( $instance[ 'facebook' ] ) ? $instance[ 'facebook' ] : '';
        $twitter    = isset( $instance[ 'twitter' ] ) ? $instance[ 'twitter' ] : '';
        $g_plus     = isset( $instance[ 'g-plus' ] ) ? $instance[ 'g-plus' ] : '';
        $instagram  = isset( $instance[ 'instagram' ] ) ? $instance[ 'instagram' ] : '';
        $github     = isset( $instance[ 'github' ] ) ? $instance[ 'github' ] : '';
        $flickr     = isset( $instance[ 'flickr' ] ) ? $instance[ 'flickr' ] : '';
        $pinterest  = isset( $instance[ 'pinterest' ] ) ? $instance[ 'pinterest' ] : '';
        $wordpress  = isset( $instance[ 'wordpress' ] ) ? $instance[ 'wordpress' ] : '';
        $youtube    = isset( $instance[ 'youtube' ] ) ? $instance[ 'youtube' ] : '';
        $vimeo      = isset( $instance[ 'vimeo' ] ) ? $instance[ 'vimeo' ] : '';
        $linkedin   = isset( $instance[ 'linkedin' ] ) ? $instance[ 'linkedin' ] : '';
        $behance    = isset( $instance[ 'behance' ] ) ? $instance[ 'behance' ] : '';
        $dribbble   = isset( $instance[ 'dribbble' ] ) ? $instance[ 'dribbble' ] : '';

        ?>

        <div class="dt-social-icons">
            <?php if( ! empty( $title ) ) { ?><h2 class="widget-title"><?php echo esc_attr( $title ); ?></h2><?php } ?>

            <ul>
                <?php if( ! empty( $facebook ) ) { ?>
                    <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><i class="fa fa-facebook transition35"></i></a> </li>
                <?php } ?>

                <?php if( ! empty( $twitter ) ) { ?>
                    <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><i class="fa fa-twitter transition35"></i></a> </li>
                <?php } ?>

                <?php if( ! empty( $g_plus ) ) { ?>
                    <li><a href="<?php echo esc_url( $g_plus ); ?>" target="_blank"><i class="fa fa-google-plus transition35"></i></a> </li>
                <?php } ?>

                <?php if( ! empty( $instagram ) ) { ?>
                    <li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><i class="fa fa-instagram transition35"></i></a> </li>
                <?php } ?>

                <?php if( ! empty( $github ) ) { ?>
                    <li><a href="<?php echo esc_url( $github ); ?>" target="_blank"><i class="fa fa-github transition35"></i></a> </li>
                <?php } ?>

                <?php if( ! empty( $flickr ) ) { ?>
                    <li><a href="<?php echo esc_url( $flickr ); ?>" target="_blank"><i class="fa fa-flickr transition35"></i></a> </li>
                <?php } ?>

                <?php if( ! empty( $pinterest ) ) { ?>
                    <li><a href="<?php echo esc_url( $pinterest ); ?>" target="_blank"><i class="fa fa-pinterest transition35"></i></a> </li>
                <?php } ?>

                <?php if( ! empty( $wordpress ) ) { ?>
                    <li><a href="<?php echo esc_url( $wordpress ); ?>" target="_blank"><i class="fa fa-wordpress transition35"></i></a> </li>
                <?php } ?>

                <?php if( ! empty( $youtube ) ) { ?>
                    <li><a href="<?php echo esc_url( $youtube ); ?>" target="_blank"><i class="fa fa-youtube transition35"></i></a> </li>
                <?php } ?>

                <?php if( ! empty( $vimeo ) ) { ?>
                    <li><a href="<?php echo esc_url( $vimeo ); ?>" target="_blank"><i class="fa fa-vimeo transition35"></i></a> </li>
                <?php } ?>

                <?php if( ! empty( $linkedin ) ) { ?>
                    <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"><i class="fa fa-linkedin transition35"></i></a> </li>
                <?php } ?>

                <?php if( ! empty( $behance ) ) { ?>
                    <li><a href="<?php echo esc_url( $behance ); ?>" target="_blank"><i class="fa fa-behance transition35"></i></a> </li>
                <?php } ?>

                <?php if( ! empty( $dribbble ) ) { ?>
                    <li><a href="<?php echo esc_url( $dribbble ); ?>" target="_blank"><i class="fa fa-dribbble transition35"></i></a> </li>
                <?php } ?>

                <div class="clearfix"></div>
            </ul>
        </div>

        <?php
    }

    public function form( $instance ) {

        $instance = wp_parse_args(
            (array) $instance, array(
                'title'             => '',
                'facebook'          => '',
                'twitter'           => '',
                'g-plus'            => '',
                'instagram'         => '',
                'github'            => '',
                'flickr'            => '',
                'pinterest'         => '',
                'wordpress'         => '',
                'youtube'           => '',
                'vimeo'             => '',
                'linkedin'          => '',
                'behance'           => '',
                'dribbble'          => ''
            )
        );

        ?>

        <div class="dt-social-icons">
            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php _e( 'Title', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo esc_url( $instance['facebook'] ); ?>" placeholder="<?php _e( 'https://www.facebook.com/', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo esc_url( $instance['twitter'] ); ?>" placeholder="<?php _e( 'https://twitter.com/', 'easyblog' ); ?>" >
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'g-plus' ); ?>"><?php _e( 'G plus', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'g-plus' ); ?>" name="<?php echo $this->get_field_name( 'g-plus' ); ?>" value="<?php echo esc_url( $instance['g-plus'] ); ?>" placeholder="<?php _e( 'https://plus.google.com/', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" value="<?php echo esc_url( $instance['instagram'] ); ?>" placeholder="<?php _e( 'https://instagram.com/', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'github' ); ?>"><?php _e( 'Github', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'github' ); ?>" name="<?php echo $this->get_field_name( 'github' ); ?>" value="<?php echo esc_url( $instance['github'] ); ?>" placeholder="<?php _e( 'https://github.com/', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e( 'Flickr', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" value="<?php echo esc_url( $instance['flickr'] ); ?>" placeholder="<?php _e( 'https://www.flickr.com/"', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e( 'Pinterest', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php echo esc_url( $instance['pinterest'] ); ?>" placeholder="<?php _e( 'https://www.pinterest.com/', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'wordpress' ); ?>"><?php _e( 'WordPress', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'wordpress' ); ?>" name="<?php echo $this->get_field_name( 'wordpress' ); ?>" value="<?php echo esc_url( $instance['wordpress'] ); ?>" placeholder="<?php _e( 'https://wordpress.org/', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'YouTube', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo esc_url( $instance['youtube'] ); ?>" placeholder="<?php _e( 'https://www.youtube.com/', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'vimeo' ); ?>"><?php _e( 'Vimeo', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo esc_url( $instance['vimeo'] ); ?>" placeholder="<?php _e( 'https://vimeo.com/', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'Linkedin', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo esc_url( $instance['linkedin'] ); ?>" placeholder="<?php _e( 'https://linkedin.com', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'behance' ); ?>"><?php _e( 'Behance', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'behance' ); ?>" name="<?php echo $this->get_field_name( 'behance' ); ?>" value="<?php echo esc_url( $instance['behance'] ); ?>" placeholder="<?php _e( 'https://www.behance.net/', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'dribbble' ); ?>"><?php _e( 'Dribbble', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo esc_url( $instance['dribbble'] ); ?>" placeholder="<?php _e( 'https://dribbble.com/', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->
        </div><!-- .dt-social-icons -->
        <?php
    }

    public function update( $new_instance, $old_instance ) {

        $instance                = $old_instance;
        $instance[ 'title' ]     = sanitize_text_field( $new_instance[ 'title' ] );
        $instance[ 'facebook' ]  = esc_url_raw( $new_instance[ 'facebook' ] );
        $instance[ 'twitter' ]   = esc_url_raw( $new_instance[ 'twitter' ] );
        $instance[ 'g-plus' ]    = esc_url_raw( $new_instance[ 'g-plus' ] );
        $instance[ 'instagram' ] = esc_url_raw( $new_instance[ 'instagram' ] );
        $instance[ 'github' ]    = esc_url_raw( $new_instance[ 'github' ] );
        $instance[ 'flickr' ]    = esc_url_raw( $new_instance[ 'flickr' ] );
        $instance[ 'pinterest' ] = esc_url_raw( $new_instance[ 'pinterest' ] );
        $instance[ 'wordpress' ] = esc_url_raw( $new_instance[ 'wordpress' ] );
        $instance[ 'youtube' ]   = esc_url_raw( $new_instance[ 'youtube' ] );
        $instance[ 'vimeo' ]     = esc_url_raw( $new_instance[ 'vimeo' ] );
        $instance[ 'linkedin' ]  = esc_url_raw( $new_instance[ 'linkedin' ] );
        $instance[ 'behance' ]   = esc_url_raw( $new_instance[ 'behance' ] );
        $instance[ 'dribbble' ]  = esc_url_raw( $new_instance[ 'dribbble' ] );
        return $instance;

    }

}

/**
 * Adds widget.
 */
class easyblog_ads extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'easyblog_ads',
            __( 'Daisy: Banner Advertisement ', 'easyblog' ),
            array(
                'description'   => __( 'Advertisement for sidebar', 'easyblog' )
            )
        );
    }

    public function widget( $args, $instance ) {

        $title          = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $ads_image_path = isset( $instance[ 'ads_image' ] ) ? $instance[ 'ads_image' ] : '';
        $ads_link       = isset( $instance[ 'ads_link' ] ) ? $instance[ 'ads_link' ] : '';

        if( empty( $title ) ) {
            $title = __( 'Advertisement', 'easyblog' );
        };

        if( empty( $ads_image_path ) ) {
            $ads_image_path = '';
        };

       ?>
        <div class="dt-ads">
            <?php if( ! empty( $ads_link ) ) : ?><a href="<?php echo esc_url( $ads_link ); ?>" title="<?php echo esc_attr( $title ); ?>" target="_blank"><?php endif; ?><img src="<?php echo esc_url( $ads_image_path ); ?>" alt="<?php echo esc_attr( $title ); ?>"><?php if( ! empty( $ads_link ) ) : ?></a><?php endif; ?>
        </div>
        <?php
    }

    public function form( $instance ) {

        $instance = wp_parse_args(
            (array) $instance, array(
                'title'              => '',
                'ads_link'           => '',
                'ads_image'          => ''
            )
        );

        ?>

        <div class="dt-ads">
            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" placeholder="<?php _e( 'Ads Title', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'ads_link' ); ?>"><?php _e( 'Ads Link', 'easyblog' ); ?></label>
                <input type="text" id="<?php echo $this->get_field_id( 'ads_link' ); ?>" name="<?php echo $this->get_field_name( 'ads_link' ); ?>" value="<?php echo esc_attr( $instance['ads_link'] ); ?>" placeholder="<?php _e( 'http://daisythemes.com/', 'easyblog' ); ?>">
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'ads_image' ); ?>"><?php _e( 'Ads Image', 'easyblog' ); ?></label>

                <?php $dt_ads_img = $instance['ads_image'];
                if ( ! empty( $dt_ads_img ) ) { ?>
                    <img src="<?php echo $dt_ads_img; ?>" />
                <?php } else { ?>
                    <img src="" />
                <?php } ?>

                <input type="hidden" class="dt-custom-media-image" id="<?php echo $this->get_field_id( 'ads_image' ); ?>" name="<?php echo $this->get_field_name( 'ads_image' ); ?>" value="<?php echo $instance['ads_image']; ?>" />
                <input type="button" class="dt-img-upload dt-custom-media-button" id="custom_media_button" name="<?php echo $this->get_field_name( 'ads_image' ); ?>"  value="<?php _e( 'Select Ads Image', 'easyblog' ); ?>" />
            </div><!-- .dt-admin-input-wrap -->
        </div><!-- .dt-ads -->
        <?php
    }

    public function update( $new_instance, $old_instance ) {

        $instance               = $old_instance;
        $instance['title']      = sanitize_text_field( $new_instance['title'] );
        $instance['ads_link']   = esc_url_raw ( $new_instance['ads_link'] );
        $instance['ads_image']  = esc_url_raw ( $new_instance['ads_image'] );
        return $instance;

    }

}

/**
 * Recent Posts.
 */
class easyblog_recent_posts extends WP_Widget {

    public function __construct() {

        parent::__construct(
            'easyblog_recent_posts',
            __( 'Daisy: Recent Posts', 'easyblog' ),
            array(
                'classname'     => 'dt-recent-posts',
                'description'   => __( 'Show Recent Posts with thumbnail image', 'easyblog' )
            )
        );
    }

    public function widget( $args, $instance ) {

        global $post;
        $title          = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
        $category       = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
        $no_of_posts    = isset( $instance[ 'no_of_posts' ] ) ? $instance[ 'no_of_posts' ] : '';

        $query = new WP_Query( array(
            'post_type'         => 'post',
            'category__in'      => $category,
            'posts_per_page'    => $no_of_posts
        ) );

        ?>

        <div class="dt-recent-posts">

            <?php
            if ( !empty( $title ) ) { ?>
                <h2><?php echo esc_attr( $title ); ?></h2>
            <?php } ?>

            <?php
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) : $query->the_post(); ?>

                    <div class="dt-recent-post">
                        <figure>
                            <?php
                            if ( has_post_thumbnail() ) :
                                the_post_thumbnail( 'easyblog-recent-posts-img' );
                            endif;
                            ?>
                        </figure>

                        <h3><a href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_attr( the_title() ); ?></a></h3>
                    </div>

                 <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <p><?php _e( 'Sorry, no posts found in selected category.', 'easyblog' ); ?></p>
            <?php endif; ?>

        </div>
        <?php
    }

    public function form( $instance ) {

        $instance = wp_parse_args( (array) $instance, array(
            'title'              => '',
            'category'           => '',
            'no_of_posts'        => '5'
        ) );
        ?>

        <div class="dt-recent-posts">
            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong><?php _e( 'Title', 'easyblog' ); ?></strong></label>

                <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" >
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'category' ); ?>"><strong><?php _e( 'Category', 'easyblog' ); ?></strong></label>

                <select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">

                    <?php foreach(get_terms('category','parent=0&hide_empty=0') as $term) { ?>
                        <option <?php selected( $instance['category'], $term->term_id ); ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                    <?php } ?>

                </select>
            </div><!-- .dt-admin-input-wrap -->

            <div class="dt-admin-input-wrap">
                <label for="<?php echo $this->get_field_id( 'no_of_posts' ); ?>"><strong><?php _e( 'No. of Posts', 'easyblog' ); ?></strong></label>

                <input type="number" id="<?php echo $this->get_field_id( 'no_of_posts' ); ?>" name="<?php echo $this->get_field_name( 'no_of_posts' ); ?>" value="<?php echo esc_attr( $instance['no_of_posts'] ); ?>">
            </div><!-- .dt-admin-input-wrap -->
        </div><!-- .dt-recent-posts -->

        <?php
    }

    public function update( $new_instance, $old_instance ) {

        $instance                   = $old_instance;
        $instance[ 'title' ]        = sanitize_text_field( $new_instance[ 'title' ] );
        $instance[ 'category' ]     = absint( $new_instance[ 'category' ] );
        $instance[ 'no_of_posts' ]  = absint( $new_instance[ 'no_of_posts' ] );
        return $instance;

    }

}

// Register widgets
function easyblog_register_widgets() {

    register_widget( 'easyblog_social_icons' );
    register_widget( 'easyblog_ads' );
    register_widget( 'easyblog_recent_posts' );
    
}
add_action( 'widgets_init', 'easyblog_register_widgets' );
