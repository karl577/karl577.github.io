���Z<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:909;s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-07-25 21:27:45";s:13:"post_date_gmt";s:19:"2016-07-25 13:27:45";s:12:"post_content";s:5324:"浏览网页时，尤其是互联网产品介绍方面的网站，经常可以看到，当你的鼠标停留在某些页面时，只要轻轻滚动鼠标，页面就会自动切换，相较于传统页面的手动切换可以给用户更好的体验。今天就利用Axure8.0向下滚动的交互动作实现滑动鼠标页面自动切换效果跟大家分享一下。注意Axure7.0没有向下滚动的交互动作，请大家使用8.0进行同步操作。另外，我将使用几张图片来代替页面进行示范，当然你也可以直接使用页面。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/GIF2.gif"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/GIF2.gif" alt="GIF2" width="710" height="339" data-original="http://image.woshipm.com/wp-files/2016/07/GIF2.gif" /></a>
<h2>原材料：</h2>
春夏秋冬四张动态面板以及向对应的tu1、tu2、tu3、tu4四张小图作为图示，注意四张小图合并在一起的高度要比单张动态面板的高度小。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/tu1-2-1024x551.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/tu1-2-1024x551.png" alt="tu1" width="706" height="380" data-original="http://image.woshipm.com/wp-files/2016/07/tu1-2-1024x551.png" /></a>
<h2>方法/步骤</h2>
<h3>第一步：设置图示组和选中状态</h3>
同时选中图片tu1、tu2、tu3、tu4—属性—设置选项组名称输入“示意图”—选中—勾选线段颜色“黄色”—勾选线宽（选择较大宽度）—点击确定

选中tu1—属性—勾选选中（表示tu1在页面载入时默认状态为选中）

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/tu2-1.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/tu2-1.png" alt="tu2" width="603" height="490" data-original="http://image.woshipm.com/wp-files/2016/07/tu2-1.png" /></a>
<h3>第二步：设置动态面板交互动作</h3>
依次选中动态面板chun、xia、qiu、dong，设置其向下滚动时（不同汉化版本翻译可能存在差异）的交互动作如下图。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/tu3-1.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/tu3-1.png" alt="tu3" width="615" height="262" data-original="http://image.woshipm.com/wp-files/2016/07/tu3-1.png" /></a>
<h3>第三步：设置图示的交互动作</h3>
依次选中图示tu1、tu2、tu3、tu4，设置其鼠标单击时的交互动作如下。也可以直接复制动态面板的向下滚动时的交互动作到图示的鼠标单击时，应用关系依次是chun—tu2；xia—tu3；qiu—tu4；dong—tu1.

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/tu4-1.png"><img class="attachment-large  aligncenter" src="http://image.woshipm.com/wp-files/2016/07/tu4-1.png" alt="tu4" width="603" height="270" data-original="http://image.woshipm.com/wp-files/2016/07/tu4-1.png" /></a>
<h3>第四步：调整元件大小和位置</h3>
依次选中动态面板chun、xia、qiu、dong，缩小其动态面板的高度，使其高度与四张小图合并在一起的高度一致。

依次选中动态面板chun、xia、qiu、dong，单击鼠标右键—滚动条—自动显示垂直滚动条；完成后你就可以看到动态面板右边有一条滚动条出现。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/tu5-2.png"><img class="attachment-large  aligncenter" src="http://image.woshipm.com/wp-files/2016/07/tu5-2.png" alt="tu5" width="622" height="272" data-original="http://image.woshipm.com/wp-files/2016/07/tu5-2.png" /></a>

同时选中图示tu1、tu2、tu3、tu4，单击鼠标右键—顺序—置于顶层。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/tu6-1.png"><img class="attachment-large size-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/tu6-1.png" alt="tu6" width="543" height="372" data-original="http://image.woshipm.com/wp-files/2016/07/tu6-1.png" /></a>

将动态面板xia、qiu、dong置于chun的下面，使四张动态面板完全重合地叠加在一起。同时，移动图示tu1、tu2、tu3、tu4到动态面板chun的右侧将其滚动条完全遮盖。至此，已经全部完成，如下图。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/tu7-1.png"><img class="attachment-large  aligncenter" src="http://image.woshipm.com/wp-files/2016/07/tu7-1.png" alt="tu7" width="618" height="301" data-original="http://image.woshipm.com/wp-files/2016/07/tu7-1.png" /></a>

本文有一个很遗憾的地方，就是只能实现向下滚动页面自动切换，无法实现向上滚动页面自动切换。笔者尝试过使用同样的方法设置向上滚动时的交互动作，但结果是失败的，因为动态面板滚动条性质决定了在没有进行向下滚动时是无法进行向上滚动的。

笔者希望本文能对大家学习Axure起到绵薄之力，另外，若有哪位大神知道如何同时实现上下滚动页面自动切换的希望能告知一下，谢谢！
<h3></h3>";s:10:"post_title";s:53:"Axure教程：滑动鼠标页面自动切换（一）";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:149:"axure%e6%95%99%e7%a8%8b%ef%bc%9a%e6%bb%91%e5%8a%a8%e9%bc%a0%e6%a0%87%e9%a1%b5%e9%9d%a2%e8%87%aa%e5%8a%a8%e5%88%87%e6%8d%a2%ef%bc%88%e4%b8%80%ef%bc%89";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-07-25 21:27:45";s:17:"post_modified_gmt";s:19:"2016-07-25 13:27:45";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:24:"http://qisumu.com/?p=909";s:10:"menu_order";i:0;s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}