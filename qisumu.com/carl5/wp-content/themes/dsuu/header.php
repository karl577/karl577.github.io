<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link href="/wp-content/themes/twentytwelve/images/style.css" rel="stylesheet" type="text/css"/>
<?php wp_enqueue_script("jquery"); ?>
<?php wp_head();?>
<script type="text/javascript" src="/wp-content/themes/twentytwelve/js/a.js"></script>
<!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!-- qisumu.com Baidu tongji analytics -->
<script>
var _hmt = _hmt || [];
(function() {
var hm = document.createElement("script");
hm.src = "https://hm.baidu.com/hm.js?cd8191d648355b940efdb3f1ba7fb3a0";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body>
<div id="header">
<div class="nbar" id="nbar">
<div class="forbg">
<div class="nav">
<?php if (is_home()): ?>
<h1><a href="http://www.dsuu.cc" title="趣味集">趣味集</a></h1>
<?php else: ?>
<h3><a href="http://www.dsuu.cc" title="趣味集">趣味集</a></h3>
<?php endif; ?>
<div class="menu" id="menu">
<ul id="menus" class="menus">
	<a href="/" class="m">首页</a>
	<a href="/category/article/" class="m">文字</a>
	<a href="/category/pic/" class="m">图片</a>
	<a href="/category/video/" class="m">视频</a>
	<i>|</i>
	<a href="/top/" class="m">排行榜</a>
	<a href="/guestbook/" class="m">留言</a>
</ul>
</div>
<div class="search">
<form role="search" method="get" id="searchform" action="/">
<div class="srch" id="searchbox">
<input name="s" id="searchtxt" type="text" class="ssnr searchtip" value="" x-webkit-speech>
<button id="searchbtn" type="submit" title="搜索">搜索</button>
<div class="srchsel srchsel-0"></div></div>
</form>
<script type="text/javascript">
//<![CDATA[
	var searchbox = document.getElementById("searchbox");
	var searchtxt = document.getElementById("searchtxt");
	var tiptext = "请输入搜索内容...";
	if(searchtxt.value == "" || searchtxt.value == tiptext) {
		searchtxt.className += " searchtip";
		searchtxt.value = tiptext;
	}
	searchtxt.onfocus = function(e) {
		if(searchtxt.value == tiptext) {
			searchtxt.value = "";
			searchtxt.className = searchtxt.className.replace(" searchtip", "");
		}
	}
	searchtxt.onblur = function(e) {
		if(searchtxt.value == "") {
			searchtxt.className += " searchtip";
			searchtxt.value = tiptext;
		}
	}
var searchbtn = document.getElementById("searchbtn");
searchbtn.onclick = function(e) {
	if(searchtxt.value == "" || searchtxt.value == tiptext) {
		return false;
	}
}
//]]>
</script>
</div>
</div>
</div>
</div>
</div>
<!--[if lt IE 8]><div id="ie6">
<div class="ie7"><p>您目前使用的浏览器版本过于陈旧，本站已不再支持IE8以下版本，为了获得更好的浏览体验，请升级您的浏览器! 推荐: <a href="http://www.google.com/chrome/eula.html" rel="nofollow" target="_blank">【Chrome】</a> <a href="http://windows.microsoft.com/zh-cn/internet-explorer/downloads/ie-10/worldwide-languages/" rel="nofollow" target="_blank">【IE 10】</a></p></div>
</div><![endif]-->