<?php
add_action('admin_menu', 't_guide');
function t_guide() {
	add_theme_page('Begin主题使用指南', '主题指南', 8, 'user_guide', 't_guide_options');
}
function t_guide_options() {
?>
<div class="wrap">
	<div class="opwrap" style="line-height: 90%; margin:10px auto; width:95%; padding:5px 20px;" >
		<div id="wrapr">
			<div class="headsection">
				<h3 style="clear:both; padding:2px 10px; color:#444; font-size:20px;text-align: center;">Begin主题使用指南</h3>
			</div>
			<div class="gblock">
				<p><iframe src="http://zmingcx.com/begin" width="100%" height="800" frameborder="0"></iframe></p>
			</div>
		</div>
	</div>
</div>
<?php }; ?>