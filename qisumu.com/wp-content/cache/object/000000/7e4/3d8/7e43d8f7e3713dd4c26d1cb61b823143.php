�
�Z<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:4:"2005";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-08-16 18:12:15";s:13:"post_date_gmt";s:19:"2016-08-16 10:12:15";s:12:"post_content";s:18964:"<blockquote>今天的文章不仅归纳了常用的3种<span class="wp_keywordlink_affiliate">版本控制</span>方法，还盘点了国内外各个<span class="wp_keywordlink_affiliate">版本控制</span>软件的优缺点，想知道哪个适合自己，这篇让你一目了然！</blockquote>
<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/banben.png"><img class="size-full wp-image-394228 aligncenter" src="http://image.woshipm.com/wp-files/2016/08/banben.png" sizes="(max-width: 680px) 100vw, 680px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/banben.png 680x, http://www.woshipm.com/wp-content/uploads/2016/08/banben-404x190.png 404x" alt="banben" width="680" height="320" data-original="http://image.woshipm.com/wp-files/2016/08/banben.png" /></a>

小明最近在做一个App设计，当初步设计完成评审时，各种大神就会亲自莅临指导各种戳屏：「这里往上些，Logo要大，再大，颜色要醒目！」经过1个小时的修改后，大神们往往会反思说：「嗯，这样效果是一般，还是改回第一稿吧！」…… 而当我们习惯不停的Ctrl+S之后，竟然让我们回退到第一版本！臣妾…请等臣妾重新调一遍吧！

估计以上的场景做设计的朋友基本都会遇到过，很多朋友也都写了很多关于「设计规范」的文章，推荐大家可以去读一读，这样可以让文件管理更标准，不过在大版本升级调整的情况下，我们在一个小版本上可能还有一些迭代，例如字体大小的变化啊，间距的调整啊，按钮的颜色之类的，完全不可以作为一个独立版本去保存，那么我们应该如何处理这些小版本的文件迭代呢？

这里我就要推荐给大家一些团队协作用的工具，包括大版本的保存和小版本迭代的使用方法，团队协作设计（或者个人设计）管理基本上有以下几种方法：

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/1git20160308.png"><img class="aligncenter wp-image-394139" src="http://image.woshipm.com/wp-files/2016/08/1git20160308.png" sizes="(max-width: 600px) 100vw, 600px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/1git20160308.png 800x, http://www.woshipm.com/wp-content/uploads/2016/08/1git20160308-404x130.png 404x, http://www.woshipm.com/wp-content/uploads/2016/08/1git20160308-768x248.png 768x" alt="1git20160308" width="600" height="194" data-original="http://image.woshipm.com/wp-files/2016/08/1git20160308.png" /></a>

因为方法比较多，且听我慢慢分析这几种方法的优劣：
<h2>一、网盘/公共硬盘</h2>
<h3>1、网络硬盘</h3>
网盘这个东西在国内已经很流行了，目前来说迅雷、百度网盘、115、微盘、华为网盘的备份效果都是可以的，不过我个人比较喜欢使用百度网盘，因为百度的网盘支持100个历史版本的缓存，对于我们设计文件的管理来讲十分方便。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/image001-2.png"><img class="aligncenter wp-image-394153" src="http://image.woshipm.com/wp-files/2016/08/image001-2.png" sizes="(max-width: 600px) 100vw, 600px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/image001-2.png 800x, http://www.woshipm.com/wp-content/uploads/2016/08/image001-2-391x300.png 391x, http://www.woshipm.com/wp-content/uploads/2016/08/image001-2-768x589.png 768x" alt="image001" width="600" height="461" data-original="http://image.woshipm.com/wp-files/2016/08/image001-2.png" /></a>

<strong>网络硬盘的优点：</strong>
<ul>
 	<li>支持多种设备连接备份；</li>
 	<li>多版本备份，最多支持100个文件版本；</li>
 	<li>不需要自己管理备份服务器等设备，相对来讲大公司的信誉基本还是可以保障的；</li>
 	<li>支持加密分享文件链接给别人。</li>
</ul>
<strong>网络硬盘的缺点：</strong>
<ul>
 	<li>大多数网盘有单个文件大小限制，有些设计素材文件大于1G等的需要压缩；</li>
 	<li>大文件上传备份速度慢；</li>
 	<li>安全性比较低，适合保密性不是很高的团队；</li>
 	<li>版本迭代没有更新说明，需要根据时间尝试版本恢复。</li>
</ul>
<h3>2、 本地硬盘</h3>
本地服务可以使用公司共享的硬盘空间，这个空间可以是服务器，也可以是一台公共主机或者是一块移动硬盘… 这种方法其实就是对数据的一种保护措施，较网盘的安全性高一些，这种方法其实算是比较传统的老方法了，不过老药方也有老药方的好处，也有可能更适合一些没有技术服务的小团队，并且这种方法的成本更低。

<strong>本地硬盘的优点：</strong>
<ul>
 	<li>成本比较低，只要一台电脑链接局域网或者一块移动硬盘即可；</li>
 	<li>安全性还可以，毕竟是内部文件备份；</li>
 	<li>如果是苹果系统可以设置Time machine备份版本；</li>
 	<li>备份速度根据电脑和硬盘接口来定，最慢的也比网络的速度快多了。</li>
</ul>
本地硬盘的缺点：
<ul>
 	<li>如果是多人使用，不支持版本管理；</li>
 	<li>建议多地方备份，毕竟有可能造成设备损坏的忧虑；</li>
 	<li>如果误删或格式化，文件难以找回；</li>
 	<li>硬盘的容量有限，适当的需要扩容等措施。</li>
</ul>
<h3>3、私有云服务</h3>
<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/image002-1.png"><img class="aligncenter wp-image-394154" src="http://image.woshipm.com/wp-files/2016/08/image002-1.png" sizes="(max-width: 600px) 100vw, 600px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/image002-1.png 680x, http://www.woshipm.com/wp-content/uploads/2016/08/image002-1-404x220.png 404x" alt="image002" width="600" height="326" data-original="http://image.woshipm.com/wp-files/2016/08/image002-1.png" /></a>

感谢@BOXSHEEP 童鞋提醒这个方法，如果公司的技术比较强大可以尝试自己搭建私有云服务，相比于网盘来讲会更安全，而较github来讲速度应该会好一些，毕竟不用翻墙。

<strong>私有云的优点：</strong>
<ul>
 	<li>支持多种设备连接备份；</li>
 	<li>多版本备份；</li>
 	<li>文档文件信息比较安全。</li>
</ul>
<strong>私有云的缺点：</strong>
<ul>
 	<li>需要网络支持；</li>
 	<li>服务器成本不低；</li>
 	<li>定期管理员对数据备份。</li>
</ul>
<h2>二、SVN/Git系统</h2>
<h3>1、SVN系统</h3>
<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/image003-4.jpg"><img class="aligncenter wp-image-394156" src="http://image.woshipm.com/wp-files/2016/08/image003-4.jpg" sizes="(max-width: 600px) 100vw, 600px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/image003-4.jpg 800x, http://www.woshipm.com/wp-content/uploads/2016/08/image003-4-404x248.jpg 404x, http://www.woshipm.com/wp-content/uploads/2016/08/image003-4-768x472.jpg 768x" alt="image003" width="600" height="369" data-original="http://image.woshipm.com/wp-files/2016/08/image003-4.jpg" /></a>

我上一家公司就使用的SVN系统来备份文件和代码的，那么什么是SVN呢？看看来自百度的说明：
<blockquote>SVN是Subversion的简称，是一个开放源代码的<span class="wp_keywordlink_affiliate">版本控制</span>系统，相较于RCS、CVS，它采用了分支管理系统，它的设计目标就是取代CVS。互联网上很多版本控制服务已从CVS迁移到Subversion。</blockquote>
<blockquote>SVN可以满足各种企业VPN的要求，通过为公司内部网络、远程和移动用户、分支机构和合作伙伴提供基于Internet的安全连接。所以，我们可以将SVN看成是VPN、防火墙、基于企业策略的信息管理软件集成在一起的Internet安全的综合解决方案。在这样一个网络系统中，所有互联网服务器端和客户端都是安全的，并有一个信息管理机制以不断地通过这个外部网络环境动态地分析及满足客户的特定带宽需求。</blockquote>
通过上面2段其实就能明白，SVN服务系统是一个基于公司内部网络搭建的网络系统，可以通过一些安全协议来传输文件，如何搭建的大家可以自行去搜索（主要都是我们公司技术师傅搞定，我们用就好了），这种服务其实比较方便，管理员只要搭好服务，我们使用各种SVN的软件去同步文件就好了，每当你的本地文件修改时间新与服务器，就会覆盖之前的文件生成新的版本，当你本地的文件丢失，也可以从服务器下载回来。

<strong>SVN的优点：</strong>
<ul>
 	<li>同步方便，随时上传下载；</li>
 	<li>多版本管理，可根据时间下载相应的版本（每次更新可以加入说明）；</li>
 	<li>安全协议比较高，对于保密性要求高的公司建议使用；</li>
 	<li>如果是局域网传输速度快。</li>
</ul>
<strong>SVN的缺点：</strong>
<ul>
 	<li>需要有服务器，并且一个网管帮忙搭建设置权限（如果你技术Ok，自己也可以搞定的话…）；</li>
 	<li>如果是我们做设计用，需要很大的硬盘空间，因为设计稿的版本和文件，会日积月累的巨大无比；</li>
 	<li>权限管理比较麻烦，如果你的权限不够，需要访问其他文件的时候都需要重新设定。</li>
</ul>
<h3>2、Git系统</h3>
相信做互联网产品设计相关的朋友基本都听说过这个大名鼎鼎的代码管理网站Github，全球工程师都在使用的网站,其实也是可以给我们设计师来使用的，因为它提供了图片对比服务，可以在线查看前后版本的不同，如图：

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/image004-1.jpg"><img class="aligncenter wp-image-394157" src="http://image.woshipm.com/wp-files/2016/08/image004-1.jpg" sizes="(max-width: 600px) 100vw, 600px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/image004-1.jpg 800x, http://www.woshipm.com/wp-content/uploads/2016/08/image004-1-404x198.jpg 404x, http://www.woshipm.com/wp-content/uploads/2016/08/image004-1-768x377.jpg 768x" alt="image004" width="600" height="295" data-original="http://image.woshipm.com/wp-files/2016/08/image004-1.jpg" /></a>

可以通过 「Swipe」左右拖动数轴来即时查看前后的区别，十分方便，同时你可以在本地设置github的服务，上传新版本的时候，可以添加这个版本的注释。

<strong>Git系统的优点：</strong>
<ul>
 	<li>方便的版本控制，软件同步；</li>
 	<li>可以和其他人分享；</li>
 	<li>不需要设置服务器等服务。</li>
</ul>
<strong>Git的缺点：</strong>
<ul>
 	<li>需要网络支持；</li>
 	<li>有的地方需要翻墙才能登录；</li>
 	<li>加密需要付费。</li>
</ul>
<h2>三、网络设计版本服务</h2>
随着互联网的发展，设计工作在产品上也越来越重要了，在做设计的时候，团队沟通和协作，对设计的一些说明和版本的迭代要求也越来越高，这样就衍生出很多不错的网络服务，这里也简单跟大家介绍几家比较好的互联网设计展示产品。

<strong>国外产品：</strong>
<ul>
 	<li>Folio</li>
 	<li>Pixelapse</li>
 	<li>Invisonapp</li>
</ul>
<strong>国内产品：</strong>
<ul>
 	<li>Designboard</li>
 	<li>白板</li>
</ul>
<strong><a href="http://folioformac.com/" target="_blank" rel="nofollow">Folio</a></strong>

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/image005-2.png"><img class="aligncenter wp-image-394158" src="http://image.woshipm.com/wp-files/2016/08/image005-2.png" sizes="(max-width: 600px) 100vw, 600px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/image005-2.png 800x, http://www.woshipm.com/wp-content/uploads/2016/08/image005-2-404x270.png 404x, http://www.woshipm.com/wp-content/uploads/2016/08/image005-2-768x514.png 768x" alt="image005" width="600" height="401" data-original="http://image.woshipm.com/wp-files/2016/08/image005-2.png" /></a>

这个设计版本控制其实还是根据Git系统的原理来实现的，只不过支持了系统应用和网络的配置，这个服务的使用需要一次性支付49刀，以后就不必付费了，相对于来讲如果是使用Git服务，其实还是用Github更好。

<strong><a href="https://www.pixelapse.com/" target="_blank" rel="nofollow">Pixelapse</a></strong>

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/image006-1.png"><img class="aligncenter wp-image-394160" src="http://image.woshipm.com/wp-files/2016/08/image006-1.png" sizes="(max-width: 600px) 100vw, 600px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/image006-1.png 800x, http://www.woshipm.com/wp-content/uploads/2016/08/image006-1-364x300.png 364x, http://www.woshipm.com/wp-content/uploads/2016/08/image006-1-768x634.png 768x" alt="image006" width="600" height="495" data-original="http://image.woshipm.com/wp-files/2016/08/image006-1.png" /></a>

Pixelapse也是线上版本同步的不错选择，支持PS/Ai/Fw/Id/Pdf/Sketch多种设计文件格式，可以对比不同版本的修改样式，支持多人在线评论。不过这个网站的服务比较严谨，只让体验15天就要付费使用了，而且付费的项目数仅有3个，如果需要更多的项目就要支付更多的金额了，稍后我会做出对比。

<strong><a href="http://www.invisionapp.com/" target="_blank">Invisonapp</a></strong>

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/image007-2.png"><img class="aligncenter wp-image-394162" src="http://image.woshipm.com/wp-files/2016/08/image007-2.png" sizes="(max-width: 600px) 100vw, 600px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/image007-2.png 800x, http://www.woshipm.com/wp-content/uploads/2016/08/image007-2-404x250.png 404x, http://www.woshipm.com/wp-content/uploads/2016/08/image007-2-768x476.png 768x" alt="image007" width="600" height="372" data-original="http://image.woshipm.com/wp-files/2016/08/image007-2.png" /></a>

说它是一个设计版本控制其实比较牵强了，它更强大的功能是对设计界面的演示和交流，Invisonapp支持Web 网站演示和手机端的App 演示，可以在线设置交互方式，页面跳转等动作，这样的话可以把我们的设计页面做成高保真的演示模型，给团队或客户演示的时候效果非常棒！当然最好的服务相对的服务费也不低，好在你可以免费使用1个项目，当你的项目不多，并且不是同时进行的时候，完全可以使用免费版就可以了~

以下为3个网站的优劣对比：

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/image008-2.png"><img class="aligncenter wp-image-394163" src="http://image.woshipm.com/wp-files/2016/08/image008-2.png" sizes="(max-width: 600px) 100vw, 600px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/image008-2.png 800x, http://www.woshipm.com/wp-content/uploads/2016/08/image008-2-404x141.png 404x, http://www.woshipm.com/wp-content/uploads/2016/08/image008-2-768x268.png 768x" alt="image008" width="600" height="209" data-original="http://image.woshipm.com/wp-files/2016/08/image008-2.png" /></a>

<strong>Designboard（已关闭注册）</strong>

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/image009-2.png"><img class="aligncenter wp-image-394164" src="http://image.woshipm.com/wp-files/2016/08/image009-2.png" sizes="(max-width: 600px) 100vw, 600px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/image009-2.png 800x, http://www.woshipm.com/wp-content/uploads/2016/08/image009-2-404x273.png 404x, http://www.woshipm.com/wp-content/uploads/2016/08/image009-2-768x519.png 768x" alt="image009" width="600" height="406" data-original="http://image.woshipm.com/wp-files/2016/08/image009-2.png" /></a>

Designboard其实是我们团队开发的一套设计版本控制服务，主要功能是把设计图已流程的方式连接起来，让团队中所有的人对项目更加熟悉，同时支持在线评论交流、多版本控制，方便产品和设计师之间的快速沟通，迭代设计产出。不过因为公司业务关系这个服务我们关闭注册了~

<strong><a href="https://bearyboard.com/" target="_blank">白板</a></strong>

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/image010-1.png"><img class="aligncenter wp-image-394165" src="http://image.woshipm.com/wp-files/2016/08/image010-1.png" sizes="(max-width: 600px) 100vw, 600px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/image010-1.png 800x, http://www.woshipm.com/wp-content/uploads/2016/08/image010-1-404x250.png 404x, http://www.woshipm.com/wp-content/uploads/2016/08/image010-1-768x476.png 768x" alt="image010" width="600" height="372" data-original="http://image.woshipm.com/wp-files/2016/08/image010-1.png" /></a>

白板设计服务是我在使用Designboard之后感觉比较好的国内设计版本讨论网站了，主要支持多版本上传，标记点讨论等，是线上讨论交流比较好的服务，在打开详情后还可以选择1倍图、2倍图或者全屏展示，对于很多开会演示Demo的团队来讲，这样不进入会议室也可以畅快的交流，迭代设计版本了。

以上2个服务对比：

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/image011-2.png"><img class="aligncenter wp-image-394167" src="http://image.woshipm.com/wp-files/2016/08/image011-2.png" sizes="(max-width: 600px) 100vw, 600px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/image011-2.png 800x, http://www.woshipm.com/wp-content/uploads/2016/08/image011-2-404x95.png 404x, http://www.woshipm.com/wp-content/uploads/2016/08/image011-2-768x180.png 768x" alt="image011" width="600" height="141" data-original="http://image.woshipm.com/wp-files/2016/08/image011-2.png" /></a>
<h2>四、总结</h2>
这些经验有的可能已经比较过时或是陈旧，有些服务的收费会比较昂贵，这些需要你根据公司或者团队的情况去权衡，我一直觉得好的方法可以让我们工作事半功倍，减少我们设计的重复工作，加强我们对自己设计的理念阐述，可以让团队的其他成员更了解你的设计思路，这样对我们的成长也会有所帮助。

当然以上这些仅是我个人的使用经验，如果大家有其他好的方法可以联系告诉我，让我和大家一起学习进步，用更实用高效的工具提高我们的设计效率。

&nbsp;

来源：http://www.uisdc.com/designer-version-control-method";s:10:"post_title";s:51:"设计师，你常用的版本控制是哪种呢？";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:153:"%e8%ae%be%e8%ae%a1%e5%b8%88%ef%bc%8c%e4%bd%a0%e5%b8%b8%e7%94%a8%e7%9a%84%e7%89%88%e6%9c%ac%e6%8e%a7%e5%88%b6%e6%98%af%e5%93%aa%e7%a7%8d%e5%91%a2%ef%bc%9f";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-08-16 18:12:15";s:17:"post_modified_gmt";s:19:"2016-08-16 10:12:15";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:25:"http://qisumu.com/?p=2005";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}