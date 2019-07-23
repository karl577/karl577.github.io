<?php


    //////////////////////////////////////////////////////////////////
    //  Posts navigation link. <- Older post  |   Newer Post ->
    //////////////////////////////////////////////////////////////////

    if (!function_exists('shaped_blog_posts_navigation')) {

        function shaped_blog_posts_navigation()
        {
            ?>
            <div class="row next-previous-posts clearfix">

                <?php if (get_previous_posts_link()) { ?>
                    <div class="col-xs-6 pull-right">
                        <div class="next-post">
                            <div class="post-headingn text-right">
                                <?php previous_posts_link(__('Newer posts <i class="fa fa-angle-right"></i>', 'shaped-blog')); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if (get_next_posts_link()) { ?>
                    <div class="col-xs-6 pull-left">
                        <div class="previous-post">
                            <div class="post-heading text-left">
                                <?php next_posts_link(__('<i class="fa fa-angle-left"></i> Older posts', 'shaped-blog')); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        <?php
        }
    }


    //////////////////////////////////////////////////////////////////
    //  Blog Pagination
    //////////////////////////////////////////////////////////////////

    if (!function_exists('shaped_blog_posts_pagination')) {
        function shaped_blog_posts_pagination()
        {
            global $wp_query;
            if ($wp_query->max_num_pages > 1) {
                $big   = 999999999; // need an unlikely integer
                $items = paginate_links(array(
                    'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format'    => '?paged=%#%',
                    'prev_next' => TRUE,
                    'current'   => max(1, get_query_var('paged')),
                    'total'     => $wp_query->max_num_pages,
                    'type'      => 'array',
                    'prev_text' => '<i class="fa fa-angle-left"></i>',
                    'next_text' => '<i class="fa fa-angle-right"></i>'
                ));

                $pagination = "<ul class=\"pagination\">\n\t<li>";
                $pagination .= join("</li>\n\t<li>", $items);
                $pagination . "</li>\n</ul>\n";

                echo $pagination;
            }
            return;
        }
    }



    //////////////////////////////////////////////////////////////////
    //  Posted on
    //////////////////////////////////////////////////////////////////

    if (!function_exists('shaped_blog_posted_on')) {
        function shaped_blog_posted_on() { ?>

            <ul class="list-inline">
                <li>
                    <span class="author vcard">
                        <?php _e('By ', 'shaped-blog');
                            printf('<a class="url fn n" href="%1$s">%2$s</a>',
                                esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                                esc_html(get_the_author())
                            ) ?>
                    </span>
                </li>
                <li>
                    on <span class="posted-on"><?php the_time('M d, Y') ?></span>
                </li>
                <?php if (get_the_category_list()) : ?>
                    <li>
                        in <span class="posted-in">
                            <?php echo get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'shaped-blog'));
                            ?>
                        </span>
                    </li>
                <?php endif; ?>
            </ul>
        <?php
        }
    }




    //////////////////////////////////////////////////////////////////
    //  Single Post navigation link. <- Previous post  |   Next Post ->
    //////////////////////////////////////////////////////////////////

    if (!function_exists('shaped_blog_post_navigation')) {

        function shaped_blog_post_navigation()
        {
            // Don't print empty markup if there's nowhere to navigate.
            $previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(FALSE, '', TRUE);
            $next     = get_adjacent_post(FALSE, '', FALSE);

            if (!$next && !$previous) {
                return;
            }
            ?>
            
            <nav class="next-previous-post clearfix media" role="navigation">
                <div class="row">
                    <!-- Previous Post -->
                    <div class="previous-post col-sm-6 pull-left">
                        <?php previous_post_link('<div class="nav-previous"><i class="fa fa-angle-left"></i> %link</div>', '%title'); ?>
                    </div>

                    <!-- Next Post -->
                    <div class="next-post col-sm-6 pull-right text-right">
                        <?php next_post_link('<div class="nav-next">%link <i class="fa fa-angle-right"></i></div>','%title'); ?>
                    </div>
                </div>
            </nav><!-- .navigation -->
            
        <?php
        }
    }



    //////////////////////////////////////////////////////////////////
    // Archive title
    //////////////////////////////////////////////////////////////////

    if ( ! function_exists( 'shaped_blog_archive_title' ) ) :

    function shaped_blog_archive_title( $before = '', $after = '' ) {
        if ( is_category() ) {
            $title = sprintf( __( 'Browse Category: %s', 'shaped-blog' ), single_cat_title( '', false ) );
        } elseif ( is_tag() ) {
            $title = sprintf( __( 'Browse Tag: %s', 'shaped-blog' ), single_tag_title( '', false ) );
        } elseif ( is_author() ) {
            $title = sprintf( __( 'Browse Author: %s', 'shaped-blog' ), '<span class="vcard">' . get_the_author() . '</span>' );
        } elseif ( is_year() ) {
            $title = sprintf( __( 'Browse Year: %s', 'shaped-blog' ), get_the_date( _x( 'Y', 'yearly archives date format', 'shaped-blog' ) ) );
        } elseif ( is_month() ) {
            $title = sprintf( __( 'Browse Month: %s', 'shaped-blog' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'shaped-blog' ) ) );
        } elseif ( is_day() ) {
            $title = sprintf( __( 'Browse Day: %s', 'shaped-blog' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'shaped-blog' ) ) );
        } elseif ( is_tax( 'post_format' ) ) {
            if ( is_tax( 'post_format', 'post-format-aside' ) ) {
                $title = _x( 'Asides', 'post format archive title', 'shaped-blog' );
            } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
                $title = _x( 'Galleries', 'post format archive title', 'shaped-blog' );
            } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
                $title = _x( 'Images', 'post format archive title', 'shaped-blog' );
            } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
                $title = _x( 'Videos', 'post format archive title', 'shaped-blog' );
            } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
                $title = _x( 'Quotes', 'post format archive title', 'shaped-blog' );
            } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
                $title = _x( 'Links', 'post format archive title', 'shaped-blog' );
            } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
                $title = _x( 'Statuses', 'post format archive title', 'shaped-blog' );
            } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
                $title = _x( 'Audio', 'post format archive title', 'shaped-blog' );
            } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
                $title = _x( 'Chats', 'post format archive title', 'shaped-blog' );
            }
        } elseif ( is_post_type_archive() ) {
            $title = sprintf( __( 'Browse Archives: %s', 'shaped-blog' ), post_type_archive_title( '', false ) );
        } elseif ( is_tax() ) {
            $tax = get_taxonomy( get_queried_object()->taxonomy );
            /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
            $title = sprintf( __( '%1$s: %2$s', 'shaped-blog' ), $tax->labels->singular_name, single_term_title( '', false ) );
        } else {
            $title = __( 'Archives', 'shaped-blog' );
        }

        /**
         * Filter the archive title.
         *
         * @param string $title Archive title to be displayed.
         */
        $title = apply_filters( 'get_the_archive_title', $title );

        if ( ! empty( $title ) ) {
            echo $before . $title . $after;
        }
    }
    endif;





if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
    $description = apply_filters( 'get_the_archive_description', term_description() );

    if ( ! empty( $description ) ) {
        /**
         * Filter the archive description.
         *
         * @see term_description()
         *
         * @param string $description Archive description to be displayed.
         */
        echo $before . $description . $after;
    }
}
endif;





/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function shaped_blog_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'shaped_blog_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'shaped_blog_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so shaped_blog_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so shaped_blog_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in shaped_blog_categorized_blog.
 */
function shaped_blog_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'shaped_blog_categories' );
}
add_action( 'edit_category', 'shaped_blog_category_transient_flusher' );
add_action( 'save_post',     'shaped_blog_category_transient_flusher' );
