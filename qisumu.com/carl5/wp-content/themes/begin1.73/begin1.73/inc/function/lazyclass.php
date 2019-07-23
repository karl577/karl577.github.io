<?php
if (zm_get_option('lazy_s')) {
	add_filter ('the_content', 'lazyload');
	function lazyload($content) {
		$loadimg_url=get_template_directory_uri().'/img/blank.gif';
		if(!is_feed()||!is_robots) {
			$content=preg_replace('/<img(.+)src=[\'"]([^\'"]+)[\'"](.*)>/i',"<img\$1data-echo=\"\$2\" src=\"$loadimg_url\"\$3>\n<noscript>\$0</noscript>",$content);
		}
		return $content;
	}
}
?>