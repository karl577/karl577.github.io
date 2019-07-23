<?php
/**
Template Name: 标签云
uri : /tags/
*/
get_header();the_post();
?>
<div id="content">
<div class="atop">
<div class="inavt clr"><div class="l"><?php get_inavt(); ?></div><div class="r"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div></div>
<div class="ibdfx">广告位</div>
			<div class="com-box">
				<div class="for-cont keywords">
				<?php wp_tag_cloud('exclude=148&smallest=12&largest=24&unit=pt&number=5000');//smallest是最小字号,largest是最大字号,unit是单位,number是显示关键词个数,默认是45个 ?>
				</div>
			</div>

</div>
</div>
<?php get_footer(); ?>