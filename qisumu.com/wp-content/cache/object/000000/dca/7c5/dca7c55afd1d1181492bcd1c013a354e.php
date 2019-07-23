�
�Z<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:4:"1040";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-07-26 18:38:10";s:13:"post_date_gmt";s:19:"2016-07-26 10:38:10";s:12:"post_content";s:10973:"作为设计师，我们经常接到这样的需求：XX app中的<span class="wp_keywordlink_affiliate"><a title="" href="http://dyartstyle.com/?tag=%e5%8a%a8%e6%95%88" target="_blank" data-original-title="View all posts in 动效">动效</a></span>好酷啊，我们也做一个吧。这时，一些习惯了把设计输出 = PSD的同学往往无从下手。那什么是<span class="wp_keywordlink_affiliate"><a title="" href="http://dyartstyle.com/?tag=%e5%8a%a8%e6%95%88" target="_blank" data-original-title="View all posts in 动效">动效</a></span>设计？什么时候需要用什么样的<span class="wp_keywordlink_affiliate"><a title="" href="http://dyartstyle.com/?tag=%e5%8a%a8%e6%95%88" target="_blank" data-original-title="View all posts in 动效">动效</a></span>？动效越酷炫越好吗？这里，我会用几篇文章分别回答这些问题。首先，我们先了解动效设计中如何用运动<span class="wp_keywordlink_affiliate"><a title="" href="http://dyartstyle.com/?tag=%e6%9b%b2%e7%ba%bf" target="_blank" data-original-title="View all posts in 曲线">曲线</a></span>表达动效以及缓动设计。

<strong>为什么要动效？</strong>

动效是元素的位移、姿态、大小和可见度等随时间的变化。这里我们以位移为例来学习下动效。为什么需要动效呢？比如这里，我希望让方块到右边的位置上，如果没有动效，我可以把它“传送”过去，就像这样：
<div><img class="alignnone size-full wp-image-1135" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/1.gif" alt="1" width="690" height="287" /></div>
&nbsp;

显然，这样的技术在现实生活中是不存在的（也许有一天能实现），所以看起来会很不自然。这就需要有一个运动的过程，动效设计就是在设计这个过程：
<div><img class="alignnone size-full wp-image-1136" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/2.gif" alt="2" width="690" height="288" /></div>
&nbsp;

这样就好多了。但这样的动效该如何表达呢？做过开发的同学都知道，可以用公式，绝大部分的动效用牛顿运动方程都是可以表达的。当然运动方程也可以做成图表，这里我们就用图表的方式来表达运动，这就是运动<span class="wp_keywordlink_affiliate"><a title="" href="http://dyartstyle.com/?tag=%e6%9b%b2%e7%ba%bf" target="_blank" data-original-title="View all posts in 曲线">曲线</a></span>。最常用的<span class="wp_keywordlink_affiliate"><a title="" href="http://dyartstyle.com/?tag=%e6%9b%b2%e7%ba%bf" target="_blank" data-original-title="View all posts in 曲线">曲线</a></span>是“位移 – 时间”曲线：横轴表示时间，纵轴表示在一个方向上的位移。（出于简化考虑，这里我们只考虑在一个维度上的运动，在三维空间中的运动可以分解成单个维度）。 我们先看最简单的运动，匀速直线运动：
<div><img class="alignnone size-full wp-image-1137" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/3.gif" alt="3" width="690" height="287" /></div>
&nbsp;

它的运动曲线其实就是条直线，线的斜率（目标位置 / 运动时间）就是它的运动速度：
<div><img class="alignnone size-full wp-image-1138" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/4.png" alt="4" width="400" height="259" /></div>
<div></div>
在现实生活中，如果物体在传送带上，我们就可以看成是匀速直线运动：

<img class="alignnone size-full wp-image-1139" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/5.gif" alt="5" width="690" height="287" />

不过这样的例子并不多，物体很少会自己突然获得速度，运动一段距离后又突然停止。在静止和运动两种状态之间，物体的速度往往会发生变化。这就是缓动（Easing）。

&nbsp;

<strong>缓动－减速运动（Ease out）</strong>

在缓动过程中，物体的运动速度会由于外力而发生变化。常见的缓动有三种：减速运动、加速运动、先加速后减速。我们先看减速运动：

<img class="alignnone size-full wp-image-1140" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/6.gif" alt="6" width="690" height="287" />

&nbsp;

减速运动的曲线是：

<img class="alignnone size-full wp-image-1141" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/7.png" alt="7" width="400" height="259" />

&nbsp;

我们发现，物体有一个初始速度，随着时间的推移，它的速度，也就是曲线的斜率在由大变小到0。什么样的物体会这样运动呢？比如这样：

<img class="alignnone size-full wp-image-1142" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/8.gif" alt="8" width="690" height="287" />

&nbsp;

<strong>缓动－加速运动（Ease in）</strong>

加速运动和减速运动的速度变化相反：
<div><img class="alignnone size-full wp-image-1143" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/9.gif" alt="9" width="690" height="287" /></div>
&nbsp;

曲线也是对称的：

<img class="alignnone size-full wp-image-1144" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/10.png" alt="10" width="400" height="259" />

&nbsp;

加速运动可以看作这样：

<img class="alignnone size-full wp-image-1145" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/11.gif" alt="11" width="690" height="287" />

&nbsp;

在界面设计中，减速和加速动效往往是成对使用的。通常元素飞入时用减速运动，飞出时用加速运动。例如iPhone App Store中的分类列表：
<div class="wp-video"><span class="mejs-offscreen">Video Player</span>
<div id="mep_0" class="mejs-container svg wp-video-shortcode mejs-video" tabindex="0">
<div class="mejs-inner">
<div class="mejs-mediaelement"><video id="video-1134-1" class="wp-video-shortcode" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/AppStoredrawer.m4v?_=1" preload="metadata" width="404" height="720"></video></div>
<div class="mejs-layers"></div>
<div class="mejs-controls">
<div class="mejs-button mejs-playpause-button mejs-play"></div>
<div class="mejs-time mejs-currenttime-container"><span class="mejs-currenttime">00:00</span></div>
<div class="mejs-time-rail"></div>
<div class="mejs-time mejs-duration-container"><span class="mejs-duration">00:08</span></div>
<div class="mejs-button mejs-volume-button mejs-mute"></div>
<div class="mejs-button mejs-fullscreen-button"></div>
</div>
<div class="mejs-clear"></div>
</div>
</div>
</div>
&nbsp;

<strong>缓动－先加速后减速（Ease In and Out）</strong>

可能大部分物体是这样运动的：

<img class="alignnone size-full wp-image-1147" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/12.gif" alt="12" width="690" height="287" />

&nbsp;

从曲线中，我们看到，物体的速度（曲线的斜率）由0开始增加，在中点达到最大值，然后又减小到0：

<img class="alignnone size-full wp-image-1148" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/12.png" alt="12" width="400" height="259" />

&nbsp;

我们可以看成这个物体在依靠自己的动力运动：

<img class="alignnone size-full wp-image-1149" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/13.gif" alt="13" width="690" height="287" />

&nbsp;

很多起点和终点都在界面内的运动都使用这种缓动形式，比如iOS天气App的城市切换动画：
<div class="wp-video">
<div class="wp-video"><span class="mejs-offscreen">Video Player</span>
<div id="mep_1" class="mejs-container svg wp-video-shortcode mejs-video" tabindex="0">
<div class="mejs-inner">
<div class="mejs-mediaelement"><video id="video-2157-1" class="wp-video-shortcode" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/AppStoredrawer.m4v?_=1" preload="metadata" width="640" height="1140"></video></div>
<div class="mejs-layers"></div>
<div class="mejs-controls">
<div class="mejs-button mejs-playpause-button mejs-play"></div>
<div class="mejs-time mejs-currenttime-container"><span class="mejs-currenttime">00:00</span></div>
<div class="mejs-time-rail"></div>
<div class="mejs-time mejs-duration-container"><span class="mejs-duration">00:08</span></div>
<div class="mejs-button mejs-volume-button mejs-mute"></div>
<div class="mejs-button mejs-fullscreen-button"></div>
</div>
<div class="mejs-clear"></div>
</div>
</div>
</div>
</div>
&nbsp;

<strong>缓动的组合</strong>

将上面三种最基本的缓动形式组合，可以表现出更多的运动形式，例如：

<img class="alignnone size-full wp-image-1151" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/14.gif" alt="14" width="690" height="287" />

&nbsp;

这就像用一个弹弓把物体弹射出去：

<img class="alignnone size-full wp-image-1152" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/15.gif" alt="15" width="690" height="287" />

&nbsp;

它运动曲线分为两段，物体先向反方向运动，再在正向以很高的速度开始减速运动：

<img class="alignnone size-full wp-image-1153" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/16.png" alt="16" width="400" height="259" />

&nbsp;

采用不同的缓动形式不仅能帮助用户建立方向感，还能表现出物体的材质和“性格”，比如iOS的锁屏界面落下时：

<img class="alignnone size-full wp-image-1154" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/17.gif" alt="17" width="690" height="388" />

&nbsp;

这体现出锁屏界面本身是一种弹性材质，而下方的相机是坚硬的材质。它会让用户感觉到锁屏很“轻盈”、易使用。如果我们希望下落的物体感觉起来很重，就可以这样：

<img class="alignnone size-full wp-image-1155" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/18.gif" alt="18" width="690" height="388" />

&nbsp;

或者是个很高科技的方块：

<img class="alignnone size-full wp-image-1156" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/19.gif" alt="19" width="690" height="388" />

&nbsp;

或者是个UFO？

<img class="alignnone size-full wp-image-1157" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/20.gif" alt="20" width="690" height="388" />

如果是个给小朋友用的app，也可以很有趣：

<img class="alignnone size-full wp-image-1158" src="http://mat1.gtimg.com/yslp/qqued/heyu/20150728/21.gif" alt="21" width="690" height="388" />

感兴趣的同学可以画下上面这些动效的运动曲线。

&nbsp;

<strong>小结</strong>

在本文中，我们讨论了动效设计的概念、缓动曲线的解读和几种常见的缓动类型，也看了一些复杂的缓动案例。在下一篇文章中我们会讨论这些动画的适用场景和用途。

注：部分图片来自 Apple iOS 7 Tech Talks 2013 – User Interface Design for iOS 7 Apps.";s:10:"post_title";s:21:"运动曲线与缓动";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:63:"%e8%bf%90%e5%8a%a8%e6%9b%b2%e7%ba%bf%e4%b8%8e%e7%bc%93%e5%8a%a8";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-07-26 18:38:10";s:17:"post_modified_gmt";s:19:"2016-07-26 10:38:10";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:25:"http://qisumu.com/?p=1040";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}