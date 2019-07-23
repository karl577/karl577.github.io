�ʐZ<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:2138;s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-01-20 01:52:43";s:13:"post_date_gmt";s:19:"2016-01-19 17:52:43";s:12:"post_content";s:6330:"<img title="iOS界面设计切图小结" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/195101L57-0.png" alt="iOS界面设计切图小结" />

实际设计时按：
<ul class=" list-paddingleft-2">
 	<li>iPhone4、4s：640px*960px</li>
 	<li>iPhone5: 640px*1136px</li>
 	<li>iPad：1536px*2048px</li>
</ul>
<h3></h3>
<h3>(2) 图标：</h3>
<ul class=" list-paddingleft-2">
 	<li>1024px*1024px 圆角180px</li>
 	<li>提交1024px*1024px 方角 png格式图片</li>
 	<li></li>
</ul>
<h2>2.图形部件及字体</h2>
<h3></h3>
<h3>（1） 为显示清晰</h3>
<ul class=" list-paddingleft-2">
 	<li>所有图形部件尺寸必须为偶数</li>
 	<li>样式中阴影、发光、描边的数值也必须为偶数</li>
</ul>
<h3></h3>
<h3>（2） 为方便用户点击</h3>
<ul class=" list-paddingleft-2">
 	<li>所有可点击的部件需大于88px*88px</li>
 	<li>若图片本身不够，可在切图时补足空白像素 例如：</li>
 	<li><img title="iOS界面设计切图小结" src="http://danielxu.github.io/images/uidesign/iOS_ui_design_2.png" alt="iOS界面设计切图小结" /></li>
</ul>
<h3></h3>
<h3>（3）为减小程序体积</h3>
建议尽量使用可平铺图案设计界面
<h3></h3>
<h3>（4）苹果默认字体</h3>
在pc上没有完全一样的字体，Hiragino Sans GB苹果丽黑最相近 一般做效果图时，用Hiragino Sans GB（包括中英文）代替即可，也可以用方正黑体代替
<ul class=" list-paddingleft-2">
 	<li>所有字体使用偶数字号进行设计</li>
 	<li>苹果丽黑有W3、W6两种粗细的字体</li>
</ul>
<img title="iOS界面设计切图小结" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/1951014225-2.png" alt="iOS界面设计切图小结" />

附下载地址：<a href="http://www.iplaysoft.com/hiragino-sans.html" target="_blank">苹果丽黑</a>
<h3></h3>
<h3>（5）系统可以做到如下字体效果</h3>
<img title="iOS界面设计切图小结" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/1951011112-3.png" alt="iOS界面设计切图小结" />

即，向特定方向1px（做效果图时做2px的效果）投影，需给出字体颜色、阴影颜色。 一般不建议按钮上的文字做特殊效果。如果必要， 需将字体和按钮一起切图。
<h3></h3>
<h3>（6）导航栏中的文字一般为40点W6</h3>
<img title="iOS界面设计切图小结" src="http://danielxu.github.io/images/uidesign/iOS_ui_design_5.png" alt="iOS界面设计切图小结" />
<h2></h2>
<h2>3.切图提示</h2>
<h3></h3>
<h3>(1）所有切图必须为偶数</h3>
先根据Retina屏幕切图（即640960/6401136/1536*2048），后将切图缩为普通屏幕尺寸。 （有特殊图片需要单独制作）
<h3></h3>
<h3>（2）可平铺部件切图时可如下图：</h3>
&nbsp;

<img title="iOS界面设计切图小结" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/19510145S-5.png" alt="iOS界面设计切图小结" />

带圆角按钮切图时可如下图

<img title="iOS界面设计切图小结" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/195101AJ-6.png" alt="iOS界面设计切图小结" />

同理

<img title="iOS界面设计切图小结" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/195101NA-7.png" alt="iOS界面设计切图小结" />

并在效果图中标出具体大小

标注软件推荐：<a href="http://77g2n3.com2.z0.glb.qiniucdn.com/v/25260.html" target="_blank">dorado</a>
<h3></h3>
<h3>（3）导航栏和标签栏下的阴影程序可以自动生成，可不切，如图：</h3>
<img title="iOS界面设计切图小结" src="http://danielxu.github.io/images/uidesign/iOS_ui_design_9.png" alt="iOS界面设计切图小结" />

<img title="iOS界面设计切图小结" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/195101E54-9.png" alt="iOS界面设计切图小结" />

若不满意默认阴影效果，可以单独切2px宽的阴影，如图：

<img title="iOS界面设计切图小结" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/195101C23-10.png" alt="iOS界面设计切图小结" />

如有异形阴影如：

<img title="iOS界面设计切图小结" src="http://danielxu.github.io/images/uidesign/iOS_ui_design_12.png" alt="iOS界面设计切图小结" />

需切整条阴影，并与攻城师说明。
<h3></h3>
<h3>（4）所有按钮需有两种状态——正常状态和按下状态</h3>
<h3></h3>
<h3>（5）一般情况下切图格式为png24</h3>
<ul class=" list-paddingleft-2">
 	<li>若个别图片jpg比png小很多，可用jpg</li>
 	<li>但欢迎页、icon必须为png，在不影响显示效果的前提下，可以考虑用png8</li>
 	<li></li>
</ul>
<h2>4.命名</h2>
<h3>（1）图片命名后缀</h3>
<ul class=" list-paddingleft-2">
 	<li>根据Retina屏幕的切图文件名后加@2x，普通屏幕尺寸不用加。</li>
 	<li>欢迎页、背景等需要对iPhone5另外切图的文件名后加-568h@2x</li>
 	<li></li>
</ul>
<h3>（2）命名建议</h3>
建议采用如下方法命名，如：
<table>
<tbody>
<tr class="firstRow">
<td class="gutter">
<pre>1</pre>
</td>
<td class="code" width="757">
<pre>切图性质_功能相关描述_图片描述（可无）_状态说明（可无）@2x.png</pre>
</td>
</tr>
</tbody>
</table>
用例:
<ul class=" list-paddingleft-2">
 	<li>Retina屏幕切图</li>
</ul>
<table>
<tbody>
<tr class="firstRow">
<td class="gutter">
<pre>12345</pre>
</td>
<td class="code" width="757">
<pre>bg_booksnum_pressed@2x.pngico_arrow_blue@2x.pngbtn_blue_pressed@2x.pngpic_books_blue@2x.pngbg_main-568h@2x.png</pre>
</td>
</tr>
</tbody>
</table>
<ul class=" list-paddingleft-2">
 	<li>普通屏幕切图</li>
</ul>
<table>
<tbody>
<tr class="firstRow">
<td class="gutter">
<pre>12345</pre>
</td>
<td class="code" width="757">
<pre>bg_booksnum_pressed.png 
ico_arrow_blue.pngbtn_blue_pressed.pngpic_books_blue.png按下状态切图命名后加_pressed</pre>
</td>
</tr>
</tbody>
</table>
<ul class=" list-paddingleft-2">
 	<li>另外贴个建议命名备忘</li>
</ul>
<img title="iOS界面设计切图小结" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/1951013V7-12.png" alt="iOS界面设计切图小结" />

&nbsp;";s:10:"post_title";s:27:"iOS界面设计切图小结";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:75:"ios%e7%95%8c%e9%9d%a2%e8%ae%be%e8%ae%a1%e5%88%87%e5%9b%be%e5%b0%8f%e7%bb%93";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-08-20 01:56:18";s:17:"post_modified_gmt";s:19:"2016-08-19 17:56:18";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:25:"http://qisumu.com/?p=2138";s:10:"menu_order";i:0;s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}