<?php
/*
Template Name: Tag Tabs
*/

?>

<?php get_header(); ?>
<div id="content" class="narrowcolumn">
<!-- ************************* BEGIN CONTENT ******************************* -->

<h3>Tag Tabs</h3>


<?php if (class_exists('SimpleTagging')) : ?> 
	<div id ="tagtabs">
		<?php STP_TagTabs(); ?>
	</div>
<?php endif; ?>




<!-- ************************* END CONTENT ********************************* -->
</div> <!-- [content] -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

