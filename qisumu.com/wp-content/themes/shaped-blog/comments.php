<?php
/* This comments template */

if ( post_password_required() )
    return;
?>
<div id="comments" class="comments-area comments">
    <?php if ( have_comments() ) : ?>
        <h3 class="common-title comments-title">
            <?php comments_number( __('No Comment', 'shaped-blog' ), __('One Comments', 'shaped-blog' ), __('% Comments', 'shaped-blog' ) ); ?>
        </h3>

        <ul class="comment-list">

            <?php
                wp_list_comments( array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'callback' => 'shaped_blog_comment',
                    'avatar_size' => 75
                ) );
            ?>
        </ul><!-- .comment-list -->

        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'shaped-blog' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'shaped-blog' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'shaped-blog' ) ); ?></div>
        </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>

        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'shaped-blog' ); ?></p>
        <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php
        $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $fields =  array(
            'author' => '<div class="col-md-4"><input id="author" name="author" type="text" placeholder="'. __( 'Name *', 'shaped-blog' ) .'" value="" size="30"' . $aria_req . '/></div>',
            'email'  => '<div class="col-md-4"><input id="email" name="email" type="text" placeholder="'. __( 'Email *', 'shaped-blog' ) .'" value="" size="30"' . $aria_req . '/></div>',
            'url'  => '<div class="col-md-4"><input id="url" name="url" type="text" placeholder="'. __( 'Website', 'shaped-blog' ) .'" value="" size="30"/></div>',
        );

        
         
        $comments_args = array(
            'fields' =>  $fields,
            'comment_notes_before'      => '',
            'comment_notes_after'       => '',
            'comment_field'             => '<div class="clearfix"></div><div class="col-md-12"><textarea id="comment" placeholder="'. __( 'Write your comment...', 'shaped-blog' ) .'" name="comment" aria-required="true"></textarea></div>',
            'label_submit'              => 'Post Comment'
        );
        ob_start();
        comment_form($comments_args);
        $search = array('class="comment-form"','class="form-submit"');
        $replace = array('class="comment-form row"','class="form-submit col-md-12"');
        echo str_replace($search,$replace,ob_get_clean());
    ?>
</div>