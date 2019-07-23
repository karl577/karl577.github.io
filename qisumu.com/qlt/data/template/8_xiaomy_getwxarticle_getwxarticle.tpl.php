<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?><?php
$__FORMHASH = FORMHASH;$return = <<<EOF

<script type="text/javascript">
var xiaomytitle ="请输入微信公众号文章URL";
var btntitle =  "立即获取";
//正在获取数据，请耐心等候...
var loadtitle = "正在下载数据，请耐心等候...";
var laodfail = "获取数据失败";
var laodsucess = "获取数据成功";
var formhash = "{$__FORMHASH}";
</script>
<link rel="stylesheet" href="source/plugin/xiaomy_getwxarticle/css/xiaomy.css" type="text/css" />
<script src="source/plugin/xiaomy_getwxarticle/js/xiaomy.js" type="text/javascript" type="text/javascript"></script>
<a id="xiaomywechat" title="采集微信公众号文章" onClick="openxiaomyDialog('xiaomywechat')" href='javascript:void(0);' >
微信
</a>

EOF;
?>