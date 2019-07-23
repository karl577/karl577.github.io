<div id="searchbar">
	<form method="get" id="searchform" action="<?php echo get_permalink( zm_get_option('baidu_url') ); ?>" target="_blank">
		<input type="hidden" value="1" name="entry">
		<input class="swap_value" placeholder="输入百度站内搜索关键词" name="q">
		<button type="submit" id="searchsubmit">百度</button>
	</form>
</div>