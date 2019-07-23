<?php while( have_posts() ) : the_post(); ?>
    <article class="clearfix" id="post-<?php echo $post->ID; ?>">
        <div class="feat-img">
            <a href="<?php echo get_permalink($post->ID); ?>">				<?php 				if ( has_post_thumbnail($post->ID) ) { // check if the post has a Post Thumbnail assigned to it.					the_post_thumbnail($post->ID,'single-post-thumbnail');				} 				else {					$def = get_theme_mod('default-article-image-upload');					if( !empty($def) ) {						echo '<img src="'.$def.'">';					}				}				?>
            </a>
            <div class="comment-count">
                <i class="fa fa-comments"></i>
                <a href="<?php echo get_comments_link(get_the_ID()); ?>"><?php comments_number("0", "1", "%"); ?></a>
            </div><!-- end .comment-count -->
            <?php $grade = book_rev_lite_get_review_grade($post->ID); ?>
            <span class="grade <?php echo book_rev_lite_display_review_class($grade); ?>"> <?php if(!empty($grade)) book_rev_lite_display_review_grade($grade); ?> </span>
        </div><!-- end .feat-img -->
        <div class="content">
            <header>
                <a href="<?php echo get_permalink($post->ID); ?>" class="title"><?php echo the_title(); ?></a>
                <div class="meta">
                    <span class="categ"><?php the_category(' , '); ?></span>
                    <span class="date">/ <?php echo get_the_date(); ?></span>
                </div><!-- end .meta -->
            </header>
            <p> <?php book_rev_lite_get_limited_content($post->ID, 440, '...'); ?> </p>
        </div><!-- end .content -->
    </article>

<?php  endwhile; book_rev_lite_numeric_pagination(); ?>