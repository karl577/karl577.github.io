<?php get_header();?>
<div class="article-detail-wrap">
<div class="main-section">
<div class="content-wrapper focus-edition">
<?php while (have_posts()) : the_post(); ?>
    <article class="single-post">
        <section class="article">
        	<h1 id="toc_0" style="text-align:center;font-size:24px;"><?php the_title(); ?></h1>
        	<?php the_content(); ?>
        </section>
    </article>
<?php endwhile;  ?>
<?php comments_template('', true); ?>
</div></div></div>
<?php get_footer();?>
