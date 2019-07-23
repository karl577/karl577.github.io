�ʐZ<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:915;s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-07-25 21:31:20";s:13:"post_date_gmt";s:19:"2016-07-25 13:31:20";s:12:"post_content";s:16626:"<blockquote>一年前，我发表过一篇文章<a href="http://www.woshipm.com/rp/211554.html" target="_blank">《Word产品需求文档，已经过时了》</a>，可能有一些关注我的朋友看过。而经过一年时间，我在以前的版本上又进行了一些更为细致的优化，所以在此将其分享出来。同时，一年当中，有许多朋友想让我将html文件分享出来，在此也满足大家的需求。唯一希望的是可以带给大家启迪，做出合适自己团队的需求文档。</blockquote>
<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/yitihuachanpin.jpg"><img class="size-full wp-image-380033 aligncenter" src="http://image.woshipm.com/wp-files/2016/07/yitihuachanpin.jpg" sizes="(max-width: 680px) 100vw, 680px" srcset="http://www.woshipm.com/wp-content/uploads/2016/07/yitihuachanpin.jpg 680x, http://www.woshipm.com/wp-content/uploads/2016/07/yitihuachanpin-404x190.jpg 404x" alt="yitihuachanpin" width="680" height="320" data-original="http://image.woshipm.com/wp-files/2016/07/yitihuachanpin.jpg" /></a>

产品需求文档大家都知道，可是什么是一体化产品需求文档呢？其实，这个一体化是我将自己创作的文档命名为一体化产品需求文档。之所以要叫这个名字，是因为此文档除了包含原型和需求描述以外，还承载了产品其他相关内容，比如需求列表、版本历史、产品介绍、思维导图等等。

做这样一个一体化产品需求文档出于的目的就是传统的方式产生的文件过多，过于杂乱，不易整理和回溯。如果把每个版本的内容都整理在一个html中，这样无论是团队协作还是文档回溯都能大大提高效率。

先放一张原来v3.0版本的一体化产品需求文档截图：

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/1_3.0%E4%BF%AE%E8%AE%A2%E5%8E%86%E5%8F%B2-1024x544.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/1_3.0%E4%BF%AE%E8%AE%A2%E5%8E%86%E5%8F%B2-1024x544.png" alt="1_3.0修订历史" width="719" height="382" data-original="http://image.woshipm.com/wp-files/2016/07/1_3.0修订历史-1024x544.png" /></a>

再放一张现在v3.2版本的截图进行对比：

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/2_%E4%BF%AE%E8%AE%A2%E5%8E%86%E5%8F%B2-1024x424.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/2_%E4%BF%AE%E8%AE%A2%E5%8E%86%E5%8F%B2-1024x424.png" alt="2_修订历史" width="719" height="298" data-original="http://image.woshipm.com/wp-files/2016/07/2_修订历史-1024x424.png" /></a>

明显可以看到的是，导航架构变了，以前的用例文档、需求卡片砍掉了，因为在实际攥写产品需求文档时，不会涉及到用例文档，而需求卡片，因为修改比较频繁，则是使用Excel或其他一些协作工具比较好，目前我使用的是Worktile。
<h2>修订历史</h2>
简介变成了修订历史。因为产品简介其实看一次两次就不会再看了，而将一个每次都不需要看的东西放在首页，明显是不太合理的。所以我将每次打开一定要看的修订历史放在了首页。如果需求有变动，团队成员可以从这里一眼看见，非常方便。然后将产品介绍放在了导航末尾，相比其他来说，产品简介确实是打开需求频次最低的。

修订历史里包括修改时间、修改描述、修改人和详情，如果有需要跳转的页面，可以点击查看按钮进行跳转。
<h2>版本说明</h2>
将版本说明从产品介绍里单独抽离出来，放在导航第二位置。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/3_%E7%89%88%E6%9C%AC%E8%AF%B4%E6%98%8E-1024x553.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/3_%E7%89%88%E6%9C%AC%E8%AF%B4%E6%98%8E-1024x553.png" alt="3_版本说明" width="721" height="389" data-original="http://image.woshipm.com/wp-files/2016/07/3_版本说明-1024x553.png" /></a>

因为按正常的文档阅读顺序来说，应该是先看修订历史，然后顺次看版本说明，全篇概览整个版本需求。可能有一些同学会把需求列表做在Excel里，而我之所以放在一体化原型里，就是因为这样会让浏览者更加方便快捷，不需要在Excel和原型图中频繁切换。

此页面包括，当前版本号、新版描述（用来给市场同学提交新版本时添加描述）、功能列表（包含此版本所有需求，并进行需求分类，分页面，分模块。要详细清楚地描述需求，标明需求负责人，还要支持跳转链接）。
<h2>全局说明</h2>
原型图模块下的全局说明和交互原型和以前相比未做修改

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/4_%E5%85%A8%E5%B1%80%E8%AF%B4%E6%98%8E-1024x593.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/4_%E5%85%A8%E5%B1%80%E8%AF%B4%E6%98%8E-1024x593.png" alt="4_全局说明" width="721" height="418" data-original="http://image.woshipm.com/wp-files/2016/07/4_全局说明-1024x593.png" /></a>

全局说明中依然承载高频出现的需求。比如，凡是遇到输入框，在输入文字后都会显示删除按钮。比如，大多数页面的默认进入动效都是从右向左滑动显示。
<h2>交互原型</h2>
进行了细致的规范标注，各个地方的大小和边距都进行了标准化，这样做既提高了原型的美观程度，又提高了文档编写时的效率。我写的标注只是一个参考，请大家还是按自己实际情况做调整。之所以不选择一个页面呈现多个手机原型，是因为我需要用原型来感知交互操作或者页面跳转，所以单页面不会摆放过多手机模型。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/5.1_%E4%BA%A4%E4%BA%92%E5%8E%9F%E5%9E%8B-1024x614.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/5.1_%E4%BA%A4%E4%BA%92%E5%8E%9F%E5%9E%8B-1024x614.png" alt="5.1_交互原型" width="721" height="432" data-original="http://image.woshipm.com/wp-files/2016/07/5.1_交互原型-1024x614.png" /></a>

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/5.2__%E4%BA%A4%E4%BA%92%E5%8E%9F%E5%9E%8B-1024x617.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/5.2__%E4%BA%A4%E4%BA%92%E5%8E%9F%E5%9E%8B-1024x617.png" alt="5.2__交互原型" width="720" height="434" data-original="http://image.woshipm.com/wp-files/2016/07/5.2__交互原型-1024x617.png" /></a>

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/5.3_%E4%BA%A4%E4%BA%92%E5%8E%9F%E5%9E%8B-1024x713.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/5.3_%E4%BA%A4%E4%BA%92%E5%8E%9F%E5%9E%8B-1024x713.png" alt="5.3_交互原型" width="721" height="502" data-original="http://image.woshipm.com/wp-files/2016/07/5.3_交互原型-1024x713.png" /></a>
<h2>体系规则</h2>
体系规则是新加的模块，因为前段时间的工作内容涉及到了用户等级的设计。而且越是大的产品，规则体系越是纷繁复杂。这块其实是对于产品来说比较重要核心的东西，无论是电商产品还是UGC产品等，都离不开用户体系的搭建。
<h2>礼物体系</h2>
<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/6_%E7%A4%BC%E7%89%A9%E4%BD%93%E7%B3%BB-1024x627.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/6_%E7%A4%BC%E7%89%A9%E4%BD%93%E7%B3%BB-1024x627.png" alt="6_礼物体系" width="720" height="441" data-original="http://image.woshipm.com/wp-files/2016/07/6_礼物体系-1024x627.png" /></a>

对于秀场直播类产品来说，礼物是一个非常非常核心的地方。用户的消费80%以上都是来自送礼物。所以，礼物体系的搭建至关重要。我这里只显示了两种礼物——连送礼物（走量）和超级礼物（走质）。其实还有一些人脸识别礼物、场景礼物等其他礼物。因为本篇主要介绍文档，所以这里就不详细介绍了。对于其他产品的小伙伴们，可以参考放自己产品的道具相关体系或者其他体系之类的东西。
<h2>等级体系</h2>
<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/7_%E7%AD%89%E7%BA%A7%E4%BD%93%E7%B3%BB%E4%B8%8A-1024x393.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/7_%E7%AD%89%E7%BA%A7%E4%BD%93%E7%B3%BB%E4%B8%8A-1024x393.png" alt="7_等级体系上" width="720" height="276" data-original="http://image.woshipm.com/wp-files/2016/07/7_等级体系上-1024x393.png" /></a>

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/8_%E7%AD%89%E7%BA%A7%E4%BD%93%E7%B3%BB%E4%B8%8B-1024x723.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/8_%E7%AD%89%E7%BA%A7%E4%BD%93%E7%B3%BB%E4%B8%8B-1024x723.png" alt="8_等级体系下" width="649" height="458" data-original="http://image.woshipm.com/wp-files/2016/07/8_等级体系下-1024x723.png" /></a>

等级体系页面下，主要展示具体的等级数值以及等级升级的方式等等，开发可以对照此表进行数据库的设计。除此以外也可以展示等级体系的一些思考逻辑和具体要达到的目的等等，方便以后回溯或者新人入职学习。

剩下的任务体系和弹幕规则就不具体介绍了。总之这里的原则就是，涉及到一些平台性的规则就可以放在体系规则模块下。
<h2>数据模型</h2>
此模块也是新加的模块。对于产品经理来说，日常的数据分析也是必备工作之一。而此模块就是记录一些常用的数据模型，不涉及到具体数值，只是用来记录当前版本数据分析的模型。比如最常用的漏斗模型，比如以前作满意度调查的kano模型，也可以用来当做需求分析模型。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/9_%E6%BC%8F%E6%96%97%E6%A8%A1%E5%9E%8B-1024x650.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/9_%E6%BC%8F%E6%96%97%E6%A8%A1%E5%9E%8B-1024x650.png" alt="9_漏斗模型" width="720" height="457" data-original="http://image.woshipm.com/wp-files/2016/07/9_漏斗模型-1024x650.png" /></a>

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/10_Kano%E9%9C%80%E6%B1%82%E5%88%86%E6%9E%90%E6%A8%A1%E5%9E%8B-1024x560.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/10_Kano%E9%9C%80%E6%B1%82%E5%88%86%E6%9E%90%E6%A8%A1%E5%9E%8B-1024x560.png" alt="10_Kano需求分析模型" width="720" height="394" data-original="http://image.woshipm.com/wp-files/2016/07/10_Kano需求分析模型-1024x560.png" /></a>
<h2>思维导图</h2>
此模块的页面条件图其实早有行内的名称叫checklist，也希望大家可以建立起自己的checklist，做好每次需求review。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/11_checklist-1024x694.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/11_checklist-1024x694.png" alt="11_checklist" width="720" height="488" data-original="http://image.woshipm.com/wp-files/2016/07/11_checklist-1024x694.png" /></a>
<h2>产品介绍</h2>
相比以前少了两个页面，而这三个页面都是相对用的比较低频。所以放在了最后，因为和以前一样，就没什么好说的了。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/12_%E4%BA%A7%E5%93%81%E7%AE%80%E4%BB%8B-1024x511.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/12_%E4%BA%A7%E5%93%81%E7%AE%80%E4%BB%8B-1024x511.png" alt="12_产品简介" width="721" height="360" data-original="http://image.woshipm.com/wp-files/2016/07/12_产品简介-1024x511.png" /></a>

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/13_%E5%BC%80%E5%8F%91%E5%91%A8%E6%9C%9F-1024x276.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/13_%E5%BC%80%E5%8F%91%E5%91%A8%E6%9C%9F-1024x276.png" alt="13_开发周期" width="719" height="194" data-original="http://image.woshipm.com/wp-files/2016/07/13_开发周期-1024x276.png" /></a>

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/14_%E7%89%88%E6%9C%AC%E5%8E%86%E5%8F%B2-1024x648.png"><img class="attachment-large aligncenter" src="http://image.woshipm.com/wp-files/2016/07/14_%E7%89%88%E6%9C%AC%E5%8E%86%E5%8F%B2-1024x648.png" alt="14_版本历史" width="720" height="456" data-original="http://image.woshipm.com/wp-files/2016/07/14_版本历史-1024x648.png" /></a>
<h2>一点小技巧——页面居中与导航自适应</h2>
因为每个人显示器宽度是不同的，所以我的文档固定了宽度1349px，这个宽度可以让大多数笔记本整屏显示，无须左右滑动。当然1200px宽度也是比较适合的，而且容易栅格化。

每个网页须设置页面居中，这样即便大屏显示器浏览也能保证页面在屏幕中央。设置方法：Axure中在页面空白处点击左键，然后在右侧检查器样式设置下可以看到居中按钮，如下图。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/1_jianchaqishihe.png"><img class="size-full wp-image-380255 aligncenter" src="http://image.woshipm.com/wp-files/2016/07/1_jianchaqishihe.png" sizes="(max-width: 266px) 100vw, 266px" srcset="http://www.woshipm.com/wp-content/uploads/2016/07/1_jianchaqishihe.png 266x, http://www.woshipm.com/wp-content/uploads/2016/07/1_jianchaqishihe-179x300.png 179x" alt="1_jianchaqishihe" width="266" height="447" data-original="http://image.woshipm.com/wp-files/2016/07/1_jianchaqishihe.png" /></a>

而对于导航栏来说，通常都是横向平铺在浏览器，跟随浏览器的宽度进行伸缩。所以，这里我提供的思路是，先准备一张导航栏的图片，宽度不用太长，然后将其导入检查器的背景图像，设置为横向重复。其实意思就是，将这张图片横向平铺在页面顶端，无论页面横向怎么拉伸，都能保证导航横向覆盖。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/2_daohanglan1.png"><img class="size-full wp-image-380256 aligncenter" src="http://image.woshipm.com/wp-files/2016/07/2_daohanglan1.png" alt="2_daohanglan1" width="295" height="119" data-original="http://image.woshipm.com/wp-files/2016/07/2_daohanglan1.png" /></a>

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/07/3_jianchajietu2.png"><img class="size-full wp-image-380257 aligncenter" src="http://image.woshipm.com/wp-files/2016/07/3_jianchajietu2.png" sizes="(max-width: 266px) 100vw, 266px" srcset="http://www.woshipm.com/wp-content/uploads/2016/07/3_jianchajietu2.png 266x, http://www.woshipm.com/wp-content/uploads/2016/07/3_jianchajietu2-177x300.png 177x" alt="3_jianchajietu2" width="266" height="450" data-original="http://image.woshipm.com/wp-files/2016/07/3_jianchajietu2.png" /></a>
<h2>总结</h2>
至此一体化产品需求文档v3.2版本就介绍完了。其实这个文档每个按钮的大小，颜色，normal态和highlighted态都是经过精心打磨的。所有的标题字号和间距也都经过设计。这些都是为了能让自己的产品呈现更好的效果，也是为了磨练自己认真的态度。

可能有些同学会质疑这样一个文档会不会花费大量时间，也确实，在打磨过程中的确费了很大功夫。但你觉得不值得么？我觉得任何时候打磨自己的作品都不是在浪费时间，况且时间真的没那么紧，打几盘LOL的时间就搞定了。

其实，当文档格式成型以后，每期的迭代是极其省事的，我只需要复制模板，然后修改每个模块下的具体内容就好，其实根本没有多浪费任何时间。

有任何疑问可私信联系我（新人别问我转行问题，别问我怎么入门，多去看几本书就明白了）
<h3>文档下载：</h3>
作者源：http://pan.baidu.com/s/1dETfAMH

官方源：链接: http://pan.baidu.com/s/1nu64FPn 密码: pv95

&nbsp;";s:10:"post_title";s:66:"全面剖析｜一体化产品需求文档（附源文件下载）";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:198:"%e5%85%a8%e9%9d%a2%e5%89%96%e6%9e%90%ef%bd%9c%e4%b8%80%e4%bd%93%e5%8c%96%e4%ba%a7%e5%93%81%e9%9c%80%e6%b1%82%e6%96%87%e6%a1%a3%ef%bc%88%e9%99%84%e6%ba%90%e6%96%87%e4%bb%b6%e4%b8%8b%e8%bd%bd%ef%bc%89";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-07-25 21:31:20";s:17:"post_modified_gmt";s:19:"2016-07-25 13:31:20";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:24:"http://qisumu.com/?p=915";s:10:"menu_order";i:0;s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}