<?php
if(! defined('IN_DISCUZ') || ! defined('IN_ADMINCP')) {
	exit('Access Denied');
}
$version_desc = lang('plugin/oculus', 'version_desc');
$desc_for_5_6_2_1 = lang('plugin/oculus', 'desc_for_5_6_2_1');
$desc_for_5_6_2_2 = lang('plugin/oculus', 'desc_for_5_6_2_2');
$desc_for_5_6_2_3 = lang('plugin/oculus', 'desc_for_5_6_2_3');
$html = <<<HTML
	<h1>5.6.2a$version_desc</h1>
	<ol>
		<li>$desc_for_5_6_2_1</li>
		<li>$desc_for_5_6_2_2</li>
		<li>$desc_for_5_6_2_3</li>
	</ol>
HTML;
echo $html;
?>
