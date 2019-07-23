<?php get_header();?>
<div class="article-detail-wrap">
<div class="main-section">
<div class="content-wrapper focus-edition">
<?php while (have_posts()) : the_post(); ?>
    <article class="single-post">
        <section class="article">
        	<h1 class="single-page-title"><?php the_title(); ?></h3>
        	<?php the_content(); ?>
        </section>
    </article>
<?php endwhile;  ?>
<?php comments_template('', true); ?>
</div></div></div>
<?php get_footer();?>
