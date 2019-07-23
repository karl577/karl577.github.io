T��Z<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:3:"382";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-07-20 10:56:06";s:13:"post_date_gmt";s:19:"2016-07-20 02:56:06";s:12:"post_content";s:11158:"<h4><strong>什么是弹框?</strong></h4>
弹框是一种交互方式，用作提醒，做决定或者解决某个任务。弹框一般包含一个蒙版，一个主体及一个关闭入口，常见于网页及移动端。其好处是让用户更聚焦，且不用离开当前页面，更快更容易完成任务。由于弹框与当下流行的卡片式设计在表现形式上十分接近，同时弹框也逐渐承载了更多功能性需求，不再是简单的内容堆砌，因此弹框设计正在被越来越多设计师关注。

<img class="alignnone size-full wp-image-190011" src="http://image.uisdc.com/wp-content/uploads/2016/06/tencent-popup-box-banner-npic1.jpg" alt="tencent-popup-box-banner-npic1" width="900" height="623" />
<h4><strong>弹框尺寸怎么定?</strong></h4>
在真正着手设计一个弹框时, 第一个遇到的问题就是弹框的尺寸到底要定多大。市面上各种各样尺寸的屏幕分辨率，如果你希望以一个尺寸适配所有屏幕分辨率，那可以参考以下数据。

2016年5月中国市场主流电脑分辨率统计Top 5 (资料来源自百度统计)

<img class="alignnone size-full wp-image-189390" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx201606202.png" alt="tx201606202" width="800" height="640" />

从上图得知市面上最小的屏幕是1024×768,因此只要保证在这个尺寸放得下, 其他尺寸也肯定没有问题。弹框的宽度一般不会太宽，1000px通常是足够有余的。高度的话，以Windows为例，去掉系统底部功能条的高度及浏览器的高度后，可以得出:

768px – 约60~100px(浏览器高度) – 40px(系统底部工具栏高度) = 约620px

<img class="alignnone size-full wp-image-189391" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx201606203.png" alt="tx201606203" width="800" height="350" />

弹框高度控制在620px以内，可以避免在小屏幕下滚动一点点才能看全整个弹框的尴尬情况。假设弹框本身有滚动条，页面因为超出一屏又有一个全局滚动条，那整个滚动体验就会变得很差。因此从体验角度及开发成本来看，我们一般会把弹框控制在620px高以内，而根据经验所得，这个尺寸内的弹框占了90%场景。

由于屏幕的尺寸愈来愈大，有时候为了在大屏幕下有更好的视觉表现，对于一些较复杂的弹框，可以选择做2种尺寸适配。拿以下2个例子为例:

Marvel的新建项目弹框中，在大屏幕下，弹框尺寸为640px(宽)x760px(高);

在小屏幕下，选项及Icon则会缩小，弹框尺寸变成了640px(宽)x620px(高)

<img class="alignnone size-full wp-image-189392" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx201606204.png" alt="tx201606204" width="800" height="583" />

InVision的升级弹框中，在大屏幕下，列表的行距比较宽松，弹框尺寸为1100px(宽)x800px(高);

在小屏幕下，列表的高度则减小，弹框尺寸为1100px(宽)x630px(高)。

<img class="alignnone size-full wp-image-189393" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx201606205.png" alt="tx201606205" width="800" height="571" />

当然，也可以按屏幕尺寸拉伸面板的尺寸。这裡处理的方法很多，总而言之如果弹框尺寸做得大，就要想好兼容方案，相对设计及开发成本也会增加。
<h4><strong>弹框的使用场景</strong></h4>
在设计时发现经常会遇到一种情况，到底是用弹框还是用页面来承载内容呢?如果了解到弹框的特性后，其实不难分辨什么时候使用那个表现手法更适合。

弹框特性:

– 较页面轻，可以更快回到之前的页面
– 相对独立，可以完全不影响页面的布局
– 适合解决简单，一次性的操作

以下列出了一些较适合使用弹框的场景及案例:
<h4><strong>1. 新手引导</strong></h4>
第一感觉是非常重要的。Google+及Carbonmade的新手引导采用了弹框，配上漂亮的插图。这种处理手法美观，不影响页面布局，卡片式的表现手法还能贯穿网页及移动的一致体验。

<img class="alignnone size-full wp-image-189394" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx201606206.png" alt="tx201606206" width="800" height="641" />

Google Photos的新手引导更结合了微动画，效果非常惊艳，让人过目不忘。

<img class="alignnone size-full wp-image-189406" src="http://image.uisdc.com/wp-content/uploads/2016/06/ddd20160620-1.gif" alt="ddd20160620 (1)" width="590" height="379" />
<h4><strong>2. 选择器</strong></h4>
选择器的特点是用一个内滚区域来承载一个很长的页面，而该内滚区域的高度是可以根据浏览器的高度拉伸的。其好处是除了能放下很长的页面，同时能保留一些操作一直停留在屏幕上。这裡可以选择性的为弹框设置一个最大及最小高度，但要注意的是必须把背景锁定，否则出现2条滚动条的体验是很糟糕的。以QQ公众平台的图文选择器为例:

<img class="alignnone size-full wp-image-189405" src="http://image.uisdc.com/wp-content/uploads/2016/06/ddd20160620-2.gif" alt="ddd20160620 (2)" width="590" height="366" />

Flickr的图片选择器。

<img class="alignnone size-full wp-image-189395" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx201606207.png" alt="tx201606207" width="800" height="350" />
<h4><strong>3. 任务</strong></h4>
有时候某些任务只是一些简单的操作，并不特地需要一个页面来表现，弹框是一个很好的方法。

Duolingo用插图和icon等视觉元素来丰富任务弹框的表现形式，减轻枯燥感。

<img class="alignnone size-full wp-image-189396" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx201606208.png" alt="tx201606208" width="800" height="350" />

Trello的任务弹框虽然信息较多，但好处是能快速切换到不同的任务，增加效率。

<img class="alignnone size-full wp-image-189397" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx201606209.png" alt="tx201606209" width="800" height="350" />
<h4><strong>4. 提示</strong></h4>
提示是最基础的弹框应用，设计时需记往保持统一性。视觉上的统一性: 颜色，间距，文案风格等。交互的统一性: 主要操作是左边还是右边按钮，关闭是点击蒙版还是点击叉叉。

腾讯企点的提示弹框整理：

<img class="alignnone size-full wp-image-190012" src="http://image.uisdc.com/wp-content/uploads/2016/06/tencent-popup-box-banner-npic12.jpg" alt="tencent-popup-box-banner-npic12" width="960" height="1000" />
<h4><strong>几个容易被忽视的弹框细节</strong></h4>
<strong>1. 背景锁定与滚动条引起的抖动问题</strong>

浏览网页时经常会发现弹框出现后，滚动鼠标时，蒙版下面的页面还是可以滚动的，其实这些滚动都是没必要的，因为弹框的原意就是要聚焦用户的注意力。

因此我们要做的是 – 背景锁定（从技术角度其实是暂时性干掉滚动条）。

<img class="alignnone size-full wp-image-189407" src="http://image.uisdc.com/wp-content/uploads/2016/06/hb201606202.gif" alt="hb201606202" width="590" height="366" />

从前端同学扒出其技术原理如下：

当Dialog弹框出现的时候，根元素overflow:hidden.

<img class="alignnone size-full wp-image-189399" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx2016062011.png" alt="tx2016062011" width="800" height="41" />

此时，由于页面滚动条从有到无，页面会晃动，这样糟糕的体验显然是不能容忍了，于是，对&lt;body&gt;元素进行处理，右侧增加一个滚动条宽度（假设宽度是widthScrollbar）的透明边框。

<img class="alignnone size-full wp-image-189400" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx2016062012.png" alt="tx2016062012" width="800" height="41" />

Dialog隐藏的时候再把滚动条放开。

<img class="alignnone size-full wp-image-189408" src="http://image.uisdc.com/wp-content/uploads/2016/06/hbbbb20160620.gif" alt="hbbbb20160620" width="590" height="313" />

<strong>2.避免弹框上再弹出弹框</strong>

要尽量避免在弹框上再弹一层弹框，2层蒙版会让用户觉得负担很重。可以改用轻量弹框或重新把交互梳理。

<img class="alignnone size-full wp-image-189409" src="http://image.uisdc.com/wp-content/uploads/2016/06/hbbhh20160620.gif" alt="hbbhh20160620" width="590" height="400" />

<strong>3.蒙版增强品牌感</strong>

过去我们对蒙版颜色可能没有仔细关注过，也许颜色不是纯黑#000，就是纯白#fff。其实蒙版的颜色及透明度可以再深入搭配的，例如产品是蓝色调性的可以在黑色中混入一点蓝色，产品是轻盈的可以用白色或淡灰色，或者尝试用没那么深的颜色搭配高一点透明度等等，根据产品的调性设计出一个适合产品气质的蒙版。

Tumblr的蒙版颜色採用了它的品牌色rgba(54,70,93,.95)

<img class="alignnone size-full wp-image-189401" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx2016062013.png" alt="tx2016062013" width="800" height="350" />

Twitch的蒙版颜色在黑色中混入了一点紫色rgba(32,28,43,.9)，与它的品牌色相符。

<img class="alignnone size-full wp-image-189402" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx2016062014.png" alt="tx2016062014" width="800" height="350" />
<h4><strong>对弹框的其他思考</strong></h4>
<strong>未来的趋势</strong>

移动在影响著人们生活，也同时引领著设计趋势，这些年产品都在追求多终端的一致性，早已衍生出自适应网页设计(Responsive Web Design)的布局解决方案，因此网页设计也日趋移动化。可以想像将会有一大波移动上的体验会搬到网页设计上，如弹框中包含多个层级，透过左上角返回的交互体验，更灵动及细腻的动画效果等。

<img class="alignnone size-full wp-image-189410" src="http://image.uisdc.com/wp-content/uploads/2016/06/bc20160620.gif" alt="bc20160620" width="590" height="360" />

视觉表现方面，之前也提到过，将会有更多产品会为了在大屏幕下有更好的视觉效果做出针对性的设计。而随著产品愈来愈追求简洁，UI也变得愈来愈轻盈，甚至透明。弹框也许不再需要用一个框框去包住主体。市面上已经有不少产品使用这种手法，以整个屏幕来取代框框。

这些也许是未来的一个趋势, 让我们拭目以待。

Squarespace的登录弹框

<img class="alignnone size-full wp-image-189403" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx2016062015.png" alt="tx2016062015" width="800" height="350" />

Evernote的修改标签弹框

<img class="alignnone size-full wp-image-189404" src="http://image.uisdc.com/wp-content/uploads/2016/06/tx2016062016.png" alt="tx2016062016" width="800" height="350" />

&nbsp;";s:10:"post_title";s:69:"超全面！腾讯设计师做了100个弹框后总结的设计经验";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:192:"%e8%b6%85%e5%85%a8%e9%9d%a2%ef%bc%81%e8%85%be%e8%ae%af%e8%ae%be%e8%ae%a1%e5%b8%88%e5%81%9a%e4%ba%86100%e4%b8%aa%e5%bc%b9%e6%a1%86%e5%90%8e%e6%80%bb%e7%bb%93%e7%9a%84%e8%ae%be%e8%ae%a1%e7%bb%8f";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-07-20 10:56:06";s:17:"post_modified_gmt";s:19:"2016-07-20 02:56:06";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:24:"http://qisumu.com/?p=382";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}