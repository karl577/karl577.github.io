<?php get_header(); ?>

<section id="main-content" class="clearfix">

    <section id="main-content-inner" class="container">
<?php // Display the sidebar on the left side if set.
        if(get_theme_mod("mp_layout_type") == "sidebarleft") get_sidebar(); ?>

    <?php if(have_posts()): ?>
        <?php if(is_search()) : ?>
            <div class="search-results-header">
                <h3><?php printf(__("Search results for: %s", "book-rev-lite"), "<span>" . get_search_query() . "</span>"); ?></h3>
            </div><!-- end .search-results-header -->
        <?php endif; ?>

    <div class="article-container">
        <?php while(have_posts()) : the_post(); ?>
            <?php get_template_part("templates/bookrev_loop_article_template"); ?>
        <?php endwhile; book_rev_lite_numeric_pagination(); ?>
    </div><!-- end .article-list -->

<?php else: ?>
    <?php if(is_search()) : ?>
        <div class="search-results-header">
            <h3> <?php printf(__("There are no search results for: %s", "book-rev-lite"), "<span>" . get_search_query() . "</span>"); ?></h3>
        </div><!-- end .search-results-header -->
    <?php endif; ?>
<?php endif; ?>

    <?php
        // Display the sidebar on the right side if set.
        if(get_theme_mod("mp_layout_type","sidebarright") == "sidebarright") get_sidebar();
    ?>

    </section><!-- end .main-content-inner -->
</section><!-- end #main-content -->
<?php get_footer(); ?>