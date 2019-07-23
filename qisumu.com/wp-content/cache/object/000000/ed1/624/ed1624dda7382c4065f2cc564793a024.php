�A�Z<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:4:"1483";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-08-01 23:51:39";s:13:"post_date_gmt";s:19:"2016-08-01 15:51:39";s:12:"post_content";s:11289:"<img src="http://www.mijishe.com/upfile/201603/2016031042037813.jpg" alt="数据可视化与信息可视化浅谈" data-bd-imgshare-binded="1" />
<div class="post-body">

我们常常迷失在数据中，纷繁复杂的数据让我们无所适从。可视化作为解决这问题的有效手段，通过视觉的方式让数字易于理解。
数据可视化和信息可视化都是可视化的一种方式，数据可视化将数据库中每一个数据项作为单个图元元素表示，大量的数据集构成数据图像，同时将数据的各个属性值以多维数据的形式表示，可以从不同的维度观察数据，从而对数据进行

更深入的观察和分析。信息可视化，旨在把数据资料以视觉化的方式表现出。信息可视化是一种将数据与设计结合起来的图片，有利于个人或组织简短有效地向受众传播信息的数据表现形式。

本文梳理了可视化相关内容，并且根据数据平台组同仁们在可视化项目过程中使用经验，总结一些可视化使用注意事项，与大家分享。

<strong>数据可视化的图表类型简介</strong>
数据可视化有很多既定的图表类型，下面我们分别来谈谈这些图表类型，他们的适用场景，以及使用的优势和劣势。

1.柱状图

<a href="http://www.mijishe.com/upfile/201603/2016310114236496.png"><img src="http://www.mijishe.com/upfile/201603/2016310114236138.png" alt="2" width="690" height="366" data-bd-imgshare-binded="1" /></a>

适用场景：它的适用场合是二维数据集（每个数据点包括两个值x和y），但只有一个维度需要比较。
优势：柱状图利用柱子的高度，反映数据的差异。肉眼对高度差异很敏感，辨识效果非常好。
劣势：柱状图的局限在于只适用中小规模的数据集。

2.折线图

<a href="http://www.mijishe.com/upfile/201603/2016310114237351.png"><img src="http://www.mijishe.com/upfile/201603/2016310114237351.png" alt="3" width="688" height="454" data-bd-imgshare-binded="1" /></a>

适用场景: 折线图适合二维的大数据集，尤其是那些趋势比单个数据点更重要的场合。它还适合多个二维数据集的比较。
优势：容易反应出数据变化的趋势。

3.饼图

<a href="http://www.mijishe.com/upfile/201603/2016310114237314.png"><img src="http://www.mijishe.com/upfile/201603/2016310114237314.png" alt="4" width="688" height="454" data-bd-imgshare-binded="1" /></a>

适用场景：适用简单的占比图，在不要求数据精细的情况下可以适用。
劣势：饼图是一种应该避免使用的图表，因为肉眼对面积大小不敏感。

4.漏斗图

<a href="http://www.mijishe.com/upfile/201603/2016310114237649.png"><img src="http://www.mijishe.com/upfile/201603/2016310114237649.png" alt="5" width="688" height="454" data-bd-imgshare-binded="1" /></a>

适用场景：漏斗图适用于业务流程比较规范、周期长、环节多的流程分析，通过漏斗各环节业务数据的比较，能够直观地发现和说明问题所在。
优势:能够直观地发现和说明问题所在。在网站分析中，通常用于转化率比较，它不仅能展示用户从进入网站到实现购买的最终转化率，还可以展示每个步骤的转化率。
劣势:单一漏斗图无法评价网站某个关键流程中各步骤转化率的好坏。

5.地图

<a href="http://www.mijishe.com/upfile/201603/2016310114237658.png"><img src="http://www.mijishe.com/upfile/201603/2016310114237559.png" alt="7" width="690" height="555" data-bd-imgshare-binded="1" /></a>

适用场景：适用于有空间位置的数据集。
优劣势：特殊状况下使用。

6.雷达图

<a href="http://www.mijishe.com/upfile/201603/2016310114237289.png"><img src="http://www.mijishe.com/upfile/201603/2016310114237289.png" alt="8" width="688" height="454" data-bd-imgshare-binded="1" /></a>

适用场景：雷达图适用于多维数据（四维以上），且每个维度必须可以排序。但是，它有一个局限，就是数据点最多6个，否则无法辨别，因此适用场合有限。
劣势：需要注意的时候，用户不熟悉雷达图，解读有困难。使用时尽量加上说明，减轻解读负担。

<strong>数据可视化使用小贴士</strong>
饼图顺序不当

<a href="http://www.mijishe.com/upfile/201603/2016310114237493.png"><img src="http://www.mijishe.com/upfile/201603/2016310114237824.png" alt="9" width="690" height="235" data-bd-imgshare-binded="1" /></a>

（最好的做法是将份额最大的那部分放在12点方向，顺时针放置第二大份额的部分，以此类推。）

2.在线状图中使用虚线

<a href="http://www.mijishe.com/upfile/201603/2016310114237830.png"><img src="http://www.mijishe.com/upfile/201603/2016310114238948.png" alt="10" width="690" height="184" data-bd-imgshare-binded="1" /></a>

（虚线会让人分心，用实线搭配合适的颜色更容易区分。）

3.数据被遮盖

<a href="http://www.mijishe.com/upfile/201603/2016310114238687.png"><img src="http://www.mijishe.com/upfile/201603/2016310114238626.png" alt="11" width="690" height="466" data-bd-imgshare-binded="1" /></a>

（确保数据不会因为设计而丢失或被覆盖。例如在面积图中使用透明效果来确保用户可以看到全部数据。）

4. 耗费用户更多的精力

<a href="http://www.mijishe.com/upfile/201603/2016310114238277.png"><img src="http://www.mijishe.com/upfile/201603/2016310114238920.png" alt="12" width="690" height="205" data-bd-imgshare-binded="1" /></a>

（通过辅助的图形元素来使数据更易于理解，比如在散点图中增加趋势线。）

5.柱状过宽或过窄

<a href="http://www.mijishe.com/upfile/201603/2016310114238655.png"><img src="http://www.mijishe.com/upfile/201603/2016310114238337.png" alt="13" width="690" height="187" data-bd-imgshare-binded="1" /></a>

（经过调研，柱子的间隔最好调整为宽的1/2。）

6．数据对比困难

<a href="http://www.mijishe.com/upfile/201603/2016310114238147.png"><img src="http://www.mijishe.com/upfile/201603/2016310114238442.png" alt="14" width="690" height="212" data-bd-imgshare-binded="1" /></a>

（选择合适的图表，让数据对比更明显直接。上图的数据作用是为了比较，显然，柱状图比饼图在视觉上更易于比较。）

7.错误呈现数据

<a href="http://www.mijishe.com/upfile/201603/2016310114238273.png"><img src="http://www.mijishe.com/upfile/201603/2016310114238124.png" alt="15" width="690" height="175" data-bd-imgshare-binded="1" /></a>

（确保任何呈现都是准确的，比如，上图气泡图的面积大小应该跟数值一样。）

8.不要过分设计

<a href="http://www.mijishe.com/upfile/201603/2016310114238360.png"><img src="http://www.mijishe.com/upfile/201603/2016310114238532.png" alt="16" width="690" height="196" data-bd-imgshare-binded="1" /></a>

（清楚标明各个图形表示的数据，避免用与主要数据不相关的颜色，形状干扰视觉。）

9. 数据没有很好归类，没有重点区分

<a href="http://www.mijishe.com/upfile/201603/2016310114238176.png"><img src="http://www.mijishe.com/upfile/201603/2016310114239591.png" alt="17" width="690" height="526" data-bd-imgshare-binded="1" /></a>

（将同类数据归类，简化色彩，帮助用户更快理解数据。上图的第一张没有属于同类型手机中不同系统进行颜色上的归类，从而减少了比较的作用。下图就通过蓝色系很好的把iPhone,Android,WP版归为一类，很好的与iPad版，其他比较。）

10.误导用户的图表

<a href="http://www.mijishe.com/upfile/201603/2016310114239422.png"><img src="http://www.mijishe.com/upfile/201603/2016310114239128.png" alt="18" width="690" height="218" data-bd-imgshare-binded="1" /></a>

（要客观反映真实数据，纵坐标不能被截断，否则视觉感受和实际数据相差很大。左图的数据起始点被截断从50开始。）

<strong>信息可视化案例</strong>
信息可视化囊括了数据可视化，信息图形，知识可视化，科学可视化，以及视觉设计方面的所有发展与进步。下面是信息可视化的案例分享。

<a href="http://www.mijishe.com/upfile/201603/2016310114239833.jpg"><img src="http://www.mijishe.com/upfile/201603/2016310114239652.jpg" alt="19" width="690" height="518" data-bd-imgshare-binded="1" /></a>

(上图为关系网——基于60000封电子邮件存档数据，用不同颜色深度的线条呈现了地址簿中用户和个体之间的关系，比如回复、发送、抄送。)

<a href="http://www.mijishe.com/upfile/201603/2016310114239131.jpg"><img src="http://www.mijishe.com/upfile/201603/2016310114239131.jpg" alt="20" width="550" height="657" data-bd-imgshare-binded="1" /></a>

（上图通过数据化的比较，用变形的柱状图等图形，形象的展示了不同国家老师的收入水平，社会包括学生和公众对其的尊重度。）

如何制作信息可视化？
第一步：确定表意正确明确信息图表达内容，确定最主要的表现内容。
第二步：优化展现形式内容正确还不够，还要易懂。我们需要在这个步骤里寻找信息图最优表现形式，让读者 一目了然，降低理解难度。
第三步：探索视觉风格在探索视觉风格时要注意抓大放小，先定下来最主要模块的风格，再做延展。
第四步：完善细节视觉风格确定后，可根据需要添加、完善细节。
第五步：风格延展“一致”的视觉设定有助于用户理解，也能更好的提升品牌形象。所以主风格确定后，我们需要把它延展到其它有需要的页面上。

以上是分享了数据可视化和信息可视化相关内容，不过信息可视化和数据可视化是两个容易混淆的概念，基于数据生成的数据可视化和信息可视化这两者在现实应用中非常接近，并且有时能够互相替换使用。但是这两者其实是不同的，数据可视化是指那些用程序生成的图形图像，这个程序可以被应用到很多不同的数据上。信息可视化是指为某一数据定制的图形图像，它往往是设计者手工定制的，只能应用在那个数据中。信息可视化的代表特征：具体化的，自解释性的和独立的。为了满足这些特征，这个图是需要手工定制的。 并没有任何一个可视化程序能够基于任一数据生成这样具体化的图片并在上面标注所有的解释性文字。
数据可视化则是普适的，比如平行坐标图并不因为数据的不同而改变自己的可视化设计。可视化的强大的普适性能够使用户快速应用某种可视化技术在一些新的数据上，并且通过可视化结果图像理解新数据，与针对已知特定数据进行信息可视化设计绘制相比，用户更像是通过对数据进行可视化的应用来学习和挖掘数据，而普适性的数据可视化技术本身并没有解释数据的功能。

</div>
&nbsp;

文章来源：http://www.mijishe.com";s:10:"post_title";s:39:"数据可视化与信息可视化浅谈";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:117:"%e6%95%b0%e6%8d%ae%e5%8f%af%e8%a7%86%e5%8c%96%e4%b8%8e%e4%bf%a1%e6%81%af%e5%8f%af%e8%a7%86%e5%8c%96%e6%b5%85%e8%b0%88";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-08-03 20:19:22";s:17:"post_modified_gmt";s:19:"2016-08-03 12:19:22";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:25:"http://qisumu.com/?p=1483";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}