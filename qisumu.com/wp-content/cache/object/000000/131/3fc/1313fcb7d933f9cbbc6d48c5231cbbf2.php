�ƐZ<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:2136;s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-01-20 01:47:28";s:13:"post_date_gmt";s:19:"2016-01-19 17:47:28";s:12:"post_content";s:6719:"现在有很多产品为了降低设计成本并保持多平台体验的一致性，都以iOS为主做一套交互设计，应用于iOS和Android两个平台。但是在标注与切图的环节，如何高效的与开发对接，似乎并没有什么更高明的办法。很多团队的做法是先做一套iOS的UI+标注+切图，再在iOS的基础上缩放一套Android的UI+标注+切图。事实上这样的做法是低效，且无效的。为什么且如何做呢？

首先本文大前提是，交互以iOS的设计为主导，应用于iOS和Android两个平台。本文描述的方法更适用于人力资源较为匮乏的设计团队。

对于设计环节。

我对iOS和Android使用同一套iOS的交互设计这种做法不置可否，毕竟好多人都已经这么干了。而很多情况下，到底用一套交互还是两套，这个问题是被设计部门的话语权、项目的周期、人力资源等多个因素影响的，并不是简单的节操问题。所以这里不讨论到底一套交互对不对，只讨论这种情况下怎么干活。

那么既然是同一套设计，如果仅仅是为了达到的交付物标准，输出两套几乎完全一样的iOS和Android的UI图，这种事情略显蛋疼。据我所知有一些设计团队都在不明真相地这么干着。

来看设计环节的交付物。

iOS和Android开发需要的设计交付物至少要有：高保真UI图，标注，切图。

高保真UI图所起到的作用是，开发会参照其画页面，仅仅是获知页面样子的一个手段，并非什么高精度的事情。仅仅基于这一条，设计师就没有必要出iOS和Android两套样子一样只是大小不同的图的，对于开发来说，他们只需要看到页面样子即可。

标注和切图的作用是，开发会按照标注的尺寸，把切图按照高保真UI图的摆放方式做到界面上。那么问题来了，iOS的开发和Android开发所需要的标注和切图是不一样的。如何在一套iOS的高保真UI图上做出两套标注和切图呢？

众所周知iOS设计的像素尺寸是640*960/1136，Android主流的hdpi模式下的像素尺寸是480*800。如图，他们的换算关系是，iOS像素尺寸的75%是Android的像素尺寸

&nbsp;

<img title="如何高效地输出iOS和Android标注和切图" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/194520MU-0.jpg" alt="如何高效地输出iOS和Android标注和切图" border="0" hspace="0" vspace="0" />

&nbsp;

于是很多设计团队就基于这个75%的关系去做Android的图了，但是这不是个好方法，这是一个设计和开发没有成为好基友的状态下所使用的方法。

我们知道Android开发所使用的单位并非像素，而是一个叫做dp/sp的单位，人家压根就不用像素，你费劲半天调一个480*800又有啥用呢？你给他标注上，这个宽度300像素，又有啥用呢？设计不懂开发，开发也不懂设计，Android不懂iOS，iOS也不懂Android，很多同志就在这种“矩阵式的彼此的不理解”中凑合干着。

关于dp与dpi等概念，请参考文章：<a href="http://www.zhihu.com/question/19625584" target="_blank">http://www.zhihu.com/question/19625584</a>

我们以480*800像素尺寸下做的设计图为基准。开发将部件尺寸换算成dp尺寸的方法是，像素尺寸*2/3。这也是为什么要让Android部件尺寸能让3整除的原因。所以在hdpi模式，480*800像素尺寸设计图中，开发看到300px宽度的标注，会定义其为宽200dp，到这里Android开发才得到一个他们真正会用于开发的数值。

这整个过程，设计师做iOS尺寸图并标注，设计师调整iOS尺寸图为Android尺寸并标注px，Android开发看着设计师交付的标注，再将其换算成dp，很长的一个过程。

其实经过以上整个过程之后，我们已经得出了一个更简单的换算关系：iOS像素尺寸*75%=Android像素尺寸，Android像素尺寸*2/3=Android的dp尺寸。进而得出：iOS像素尺寸*75%*2/3=Android的dp尺寸。所以，iOS里一个宽600px的东西，在Android的hdpi模式下，正好300dp，正好是50%，很容易算是吧？

在这个关系的指导下，我们可以在同一套UI图上做适用于两个平台的标注。只要Android的开发知道，标注600px的东西，在hdpi模式下等于300dp这个换算关系，一切都简单了。当然，平台的区别要留意，例如iOS使用十进制色值，Android使用16进制，iOS可以绘制圆角和阴影，Android更倾向于用.9.png等。这些差异要在同一套标注中体现出来，让两端的开发各取所需。（如果你发现标注软件中无法在同一张图上标十进制和十六进制色值，你可以用文字标注替代其中一个，qq的截屏工具中也是带色值提示的，办法很多不再赘述。）

至此，已经可以做一套标注，让Android和iOS的开发共同使用了。当然前提是你要告诉开发这个标注怎么看，怎么用！

下面看切图

在iOS切图与Android切图的转换中，是可以使用75%的换算关系的。也就是说iOS的切图缩小75%之后，就是Android的hdpi模式下的切图，而Android开发还需要其他dpi模式的切图，按照如下关系换算即可。

<img title="如何高效地输出iOS和Android标注和切图" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/1945202Y3-1.jpg" alt="如何高效地输出iOS和Android标注和切图" border="0" hspace="0" vspace="0" />

&nbsp;

关于Android不同dpi的参考文章：<a href="http://www.zhihu.com/question/20697111" target="_blank">http://www.zhihu.com/question/20697111</a>

我们会发现xhdpi模式和hdpi模式的换算比例也是75%。也就是说xhdpi模式下切图尺寸跟iOS下是一样的。所以iOS的切图可以直接适用于Android的xhdpi模式。至于除hdpi和xhdpi之外的其他模式，如果需要适配，就需要单独处理图片了。

要注意的是切图在缩放之后像素会糊在一起，很可能需要重新调整，还有各种虚边情况，尤其是那些带透明阴影的，都要重新调，但是这个工作量显然要比重新调UI重新切，要小多了。

至此，我们设计一套适配iOS的高保真UI，基于该UI做一套适用于iOS和Android两类开发人员的标注，再输出一套可适用于iOS和 Android的xhdpi模式的切图，再调整一套Android的hdpi模式切图，基本上大部分工作就已经完成了。

是不是感觉这种方法的工作量，一个人能干三个人的活了？

&nbsp;

&nbsp;

原文地址：http://www.tuyiyi.com/v/33652.html";s:10:"post_title";s:49:"如何高效地输出iOS和Android标注和切图";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:127:"%e5%a6%82%e4%bd%95%e9%ab%98%e6%95%88%e5%9c%b0%e8%be%93%e5%87%baios%e5%92%8candroid%e6%a0%87%e6%b3%a8%e5%92%8c%e5%88%87%e5%9b%be";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-08-20 01:52:24";s:17:"post_modified_gmt";s:19:"2016-08-19 17:52:24";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:25:"http://qisumu.com/?p=2136";s:10:"menu_order";i:0;s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}