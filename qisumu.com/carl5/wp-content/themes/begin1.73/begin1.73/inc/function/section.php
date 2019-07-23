<?php
function show_more($atts, $content = null) {
return '<span class="showmore" title="显示隐藏"><span>▼显示</span></span>';
}
add_shortcode("s", "show_more");

function section_content($atts, $content = null) {
return '<div class="section-content">'.$content.'</div>';
}
add_shortcode("p", "section_content");
?>