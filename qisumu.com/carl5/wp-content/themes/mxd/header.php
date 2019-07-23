<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta id="robots" content="all">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="B2C+C2C家居饰品分享网站">
<meta id="Copyright" content="Copyright 2014 Missulife.com Inc. All Rights Reserved">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>">
<link rel="shortcut icon" type="image/ico" href="http://mxd.tencent.com/favicon.ico"> 
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen">
<meta name="robots" content="noindex,nofollow">
<script src="http://jsqmt.qq.com/cdn_djl.js" type="text/javascript" async=""></script>
<script type="text/javascript">
var duoshuoQuery = {short_name:"homemissulife"};
	(function() {
		var ds = document.createElement('script');
		ds.type = 'text/javascript';ds.async = true;
		ds.src = 'http://static.duoshuo.com/embed.js';
		ds.charset = 'UTF-8';
		(document.getElementsByTagName('head')[0] 
		|| document.getElementsByTagName('body')[0]).appendChild(ds);
	})();
	</script>
<style type="text/css"></style>
<script type="text/javascript" src="http://static.duoshuo.com/embed.js" charset="UTF-8" async="async"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.easing.1.3.js" type="text/javascript"></script>
<script type="text/javascript">
	var html5Tags=['header' ,'footer','article','nav' ,'section','aside'];
	for(var i=0;i<html5Tags.length;i++){
    	document.createElement(html5Tags[i]);
	}
</script>

<script src="http://jqmt.qq.com/cdn_dianjiliu.js?a=0.4965029847808182"></script><!-- qisumu.com Baidu tongji analytics -->
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

<body id="index" onresize="whenResize();">
    <!--[if lt IE 8]>
    <div id="bodyMask2" class="browser-mask"></div>
    <div class='browser-box'>
        <h2>噢，您是否知道您正在使用的浏览器无法完全支持我们的页面？</h2>
        <h3>很抱歉，由于采用了HTML5，当前浏览器无法完美呈现该页面。</h3>
        <div>
            <span>如果你还不知道什么是HTML5标准，请看<a href="http://zh.wikipedia.org/wiki/HTML5" target='_blank'>维基百科</a>。</span>建议您使用以下浏览器的最新版本： 
        </div>
        <ul>
            <li><a class="ico icoChrome" title='谷歌Chrome浏览器' href="http://www.google.cn/chrome/intl/zh-CN/landing_chrome.html" target='_blank'></a></li>
            <li><a class="ico icoOpera" title='Opera浏览器' href="http://www.opera.com/" target='_blank'></a></li>
            <li><a class="ico icoFirefox" title='火狐浏览器' href="http://www.firefox.com.cn/download/" target='_blank'></a></li>
            <li><a class="ico icoSafar" title='Safar浏览器' href="http://www.apple.com.cn/safari/download/" target='_blank'></a></li>
        </UL>

        <p><a class="ico icoGt" href="/v2">访问旧版</a></p>
    </div>
    <![endif]-->
<div id="wrapper">
        <div id="QRcode">
        	<script type="text/javascript">
                var isOpen = false;
				function openQRcode(){
                    console.log(1);
					$("#QRcode").css("display","block");
					$("#QRcode").animate({height: '290px'},500,"easeOutExpo",function(){isOpen = true;});
				}
				function closeQRcode(){
					$("#QRcode").animate({height: '0px'},500,"easeOutExpo",function(){isOpen = false;$("#QRcode").css("display","none");});
				}
                function addFavorite(){
                    try{
                        window.external.AddFavorite('<?php bloginfo('url'); ?>','<?php bloginfo('name'); ?>');
                    }catch(e){
                        try{
                            window.sidebar.addPanel('<?php bloginfo('name'); ?>', '<?php bloginfo('url'); ?>', '');
                        }catch(err){
                            window.open('http://1.t.qq.com/coubann','_blank');
                        }
                    }
                }
                function whenResize(){
                    var w = parseInt($('body').css('width').replace('px',''));
                    if (w&&w<=900&&isOpen){
                        closeQRcode();
                    }
                }
			</script>
       		<div class="QRimage">
            	<div class="weixin"></div>
                <div class="chupin"></div>
            </div>
            <a href="javascript:void(0);" onclick="closeQRcode();"></a>
            <div class="QRjiao"></div>
        </div><!--#QRcode-->
        <header>
        	<a class="logo" href="<?php bloginfo('url'); ?>"></a>
            <div class="tools">
            	<div class="socialbar">
                    <ul>
                        <li class="qrcode">
                            <a href="javascript:if(isOpen){closeQRcode();}else{openQRcode();}">
                                <img src="<?php bloginfo('template_url'); ?>/images/common/qrcode.png">
                                <span>扫二维码</span>
                            </a>
                        </li>
                        <li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank"></a></li>
                        <li class="plus">
                            <a href="javascript:addFavorite();"></a>
                        </li>
                        <li class="qzone"><a href="javascript:;" onclick="window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+encodeURIComponent('<?php bloginfo('url'); ?>'));return false;"></a></li>
                        <!--li class="tsina"><a href="#"></a></li-->
                        <li class="tqq"><a href="http://1.t.qq.com/coubann" target="_blank" tittle=""></a></li>
                    </ul>
                 </div>
                <div class="search">
                	

<form role="search" action="<?php bloginfo('url'); ?>" id="" method="get">
        <label for="s">
            <input class="search-input" type="text" placeholder="搜索你感兴趣的咚咚" value="" size="20" id="s" name="s"> 
            <input type="submit" value="" class="icon-search">
        </label>
</form>                    
                </div>
            </div><!--#tools-->
            <div id="navigator" class="clearfix">
            	<nav class="clearfix">
                <ul>
                	            
                    <li>
                        
                        <a id="title1" href="<?php bloginfo('url'); ?>" onclick="playTick(1);" style="color: rgb(0, 0, 0);">首页</a>
                    </li>
                    <?php wp_list_pages('style=list&title_li=');?>
                </ul>
                </nav>
            </div><!--navigator-->
            
            <script type="text/javascript">
            	var p = 1;
				setCurrent(p);
            </script>
            <div id="category-container">
              
                <div id="menu-wraper">
                    <div id="menu-button">
                        <p href="">
                            <span></span>
                        </p>
                    </div>
                   
                </div>
            </div>
            <div id="menu-container">
                <div id="menu-list">
                    <ul>
                        
                    </ul>
                </div>
            </div>
        </header>