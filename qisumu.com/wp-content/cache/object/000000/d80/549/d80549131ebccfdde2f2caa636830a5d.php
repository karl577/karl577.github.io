���Z<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:4:"1862";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-08-08 10:17:48";s:13:"post_date_gmt";s:19:"2016-08-08 02:17:48";s:12:"post_content";s:12203:"当页面内容信息很多时，设计上应该使用分页，还是<span class="wp_keywordlink_affiliate"><a title="查看 瀑布流 中的全部文章" href="http://www.uisdc.com/tag/%e7%80%91%e5%b8%83%e6%b5%81" target="_blank">瀑布流</a></span>无限滚动的方式呢？今天这篇好文详细分析了各大信息流网站（谷歌、Pinterest、淘宝）的做法，列举了这两种方式的优缺点和适用场景。一篇精悍简练的干货文，来收！

同样是台湾设计师的好文：
<ol>
 	<li>上篇：<a href="http://www.uisdc.com/comprehensive-gradual-design-guideline" target="_blank">《一份全面系统的渐变色自学指南》</a></li>
 	<li>中篇：<a href="http://www.uisdc.com/comprehensive-gradual-design-guideline-2" target="_blank">《如何用渐变色绘制高格调的背景+球体》</a></li>
 	<li>下篇：<a href="http://www.uisdc.com/non-designer-gradient-color" target="_blank">《人气教程最终版！写给非科班设计师的渐变色学习指南》</a></li>
 	<li>实战：<a href="http://www.uisdc.com/create-elegant-gradual-background" target="_blank">《超好用！简单5步帮你做出优雅大气的渐变色背景》 </a></li>
 	<li>番外：<a href="http://www.uisdc.com/pokemon-go-design-kabigon" target="_blank">《POKEMON GO图标教程！教你绘制一枚可爱的卡比兽图标》</a></li>
 	<li>名片制作指南：<a href="http://www.uisdc.com/name-card-design-guideline" target="_blank">《超实用！写给非设计师的名片制作基础指南》</a></li>
 	<li>好东西都在这：<a href="http://www.uisdc.com/recommend-designers-websites-photographers" target="_blank">推荐一大波质量超高的网站、设计师和摄影师》</a></li>
</ol>
前阵子工作中，刚好有做到Log历史纪录的设计，窗体应该要采用哪种设计策略，也引起一阵讨论。无论是电子商务网站、搜寻结果、图片浏览、历史纪录等等，只要是内容信息量大时，设计师总是会面对到同样的问题。

来看看Google的设计，它在一般搜寻时，采用Pagination（页码）的方式，可是在图片搜寻时，却使用Infinite scroll（无限滚动，<span class="wp_keywordlink_affiliate"><a title="查看 瀑布流 中的全部文章" href="http://www.uisdc.com/tag/%e7%80%91%e5%b8%83%e6%b5%81" target="_blank">瀑布流</a></span>）。为什么会有如此的差异呢？

<img class="alignnone size-full wp-image-195867" src="http://image.uisdc.com/wp-content/uploads/2016/08/tf201608064.png" alt="tf201608064" width="800" height="562" />

△ Google Search

<img class="alignnone size-full wp-image-195866" src="http://image.uisdc.com/wp-content/uploads/2016/08/tf201608068.png" alt="tf201608068" width="800" height="506" />

△ Google image search

其实pagination和Infinite scroll有各自的特性，适合在不同的情境。Pagination把数据分成一页一页，下方有页数或是指示可以点击换页，让人有停顿的时间。而Infinite scroll则是将内容都放在同一页，当滚轮滚到页面下方时，会自动加载新的内容，无需点击换页。
<h4><strong>简单分析一下Infinite scroll的优缺点</strong></h4>
<strong>Infinite Scroll 优点</strong>

1. 流畅的体验，可以持续浏览内容：

在滚轮滚动的同时，背后也悄悄开始预载窗口下方的内容，用户可以无缝阅览，比较容易沉浸其中，不像pagination，点击完下一页之后，需等待页面载入。 它其实适合运用在没有特定目的的活动上，无聊的时候，可以打发时间的随意浏览，例如Facebook News Feed。

Infinite Scroll架构也相对扁平，适合展示相同阶层架构的东西，而图片就是最好的内容物，因为视觉的信息比较文字更快被人所接收，我们总是能很扫射完图片，Pinterest就是利用Infinite Scroll的特点，不停给予各式图片，供设计师快速找寻灵感、给予源源不绝的刺激。

2. 操作简易快速：

不用过多瞄准点击的操作，只需滚动，就能有新的内容，操作效率较佳。而且在手机上，scroll浏览也比点击来得方便。

<img class="alignnone size-full wp-image-195865" src="http://image.uisdc.com/wp-content/uploads/2016/08/tf201608065.png" alt="tf201608065" width="800" height="413" />

△ Pinterest

<strong>Infinite Scroll 缺点</strong>

1. 难以回溯、确认数据位置：

在一个超长的页面中，如果要再往回找自己之前看过的东西，会很难寻找，不知道它的位置，不像pagination，可以记得内容是在第几页。

2. 找寻想要的特定信息时，较无效率：

无法略过不必要的内容，直接跳页看。自己在拍卖网站购买物品的经验是，下完关键词，选择价格排序后，往往最前面几笔和最后面几笔的数据，基本上都是和自己想买的对象不相关(有些卖家故意会用0元或99999999元，争取最佳排序位置)，这时候可以跳页就变得重要，当然多下一些过滤，也可以帮助找到数据。

3. 占用浏览器过多的资源：

单一个页面中，不停加载新的内容，容易导致浏览器负荷过高，网页效能降低。

4. Scroll bar的长短及位置，无法正确表达内容长短：

过去还没有infinite scroll时，无论是网页，或是desktop software，Scroll bar长度具有暗示数据内容多寡的效用，我们也会看scroll bar的位置，去了解还剩下多少数据在下方未读。但Infinite scroll因为页面长度会随着scroll行为不停增长，scroll bar长度和位置会不停变化，失去提示作用。

<img class="alignnone size-full wp-image-195864" src="http://image.uisdc.com/wp-content/uploads/2016/08/tf201608063.png" alt="tf201608063" width="356" height="319" />

Scroll bar往往会越变越小，位置也会一直更动

5. Footer（页脚）变得很难使用，甚至无法使用：

当滚轮滚动时，页面会自动加载更多内容，把Footer再往下推，消失于窗口中。常常有这样的经验，原本想要阅读Footer的信息，结果看到一半，就被加载的信息推走，我又往下scroll，然后又再度被推走，整个无法控制。有兴趣的朋友，可以试着和Dribbble Designers页面，与Footer玩追逐战。

<img class="alignnone size-full wp-image-195863" src="http://image.uisdc.com/wp-content/uploads/2016/08/tf201608067.png" alt="tf201608067" width="800" height="526" />

△ Dribbble

不过其实为了解决上述问题，Load more按钮会是一个解法。当Scroll到底，网页加载一定数量的东西后，便不再自动加载，必须按Load more，才会又再一轮的载入。这可以解决无法在一定数量内，来回观看、占用过多浏览器资源、Footer无法使用等问题。
<h4><strong>Pagination优点</strong></h4>
<strong>1. 双向互动，让使用者有时间思索、决策：</strong>

阅览完一页后，因为还要点击下一页的关系，有机会停顿一下，使用者有个喘息的机会，去思考是否还要继续看下一页。不像infinite scroll，一直出现新的内容，不停被喂养信息。

<strong>2. 给予使用者较佳的控制感：</strong>

在找寻时，pagnation的分页，会让使用者知道已经找了几页。有研究指出到达页面底端时，有种任务达到一个段落的感觉，会让使用者有种愉悦的成就感和控制感。

<strong>3. 快速查找过往信息：</strong>

相信大家都有过找寻一些历史消息的经验，可能找了几页数据，我们就可能10页10页这样跳，大概会抓说可能10页就是几天的讯息，可能可以利用页数，大概抓到资料会在第几页哪个位置。但是infinite scroll就无法做到这件事了，如果要找比较远的数据，就必须一直scroll到底再等待加载，中间加载了许多我们不需要的信息，就为了看比较久远的数据，强迫我们必须经历那个过程。

另外，有时候我们查找一些数据，需要再跳回去看的时候，我们大概会依稀记得之前看到的数据，大概会是在第几页，除了帮助记忆外，可以让我们可以更快跳到想要的内容上。Infinite scroll因为scroll bar长度及位置的不停变动，无法像pagniation易于定位。
<h4><strong>结论</strong></h4>
Pagination和Infinite scroll有各自的优缺点，运用在适当的情境时，可以将优点及大化，缺点甚至会转为优点。Pagination是比较常见的设计，因为需要点击才有下页内容，让人有停顿的时间，适合用在目标导向、一些需要思考决策、有目的性的活动，例如搜寻商品，或是找寻数据。

而Infinite scroll适合快速且随意浏览的情境，也因为结构较为扁平，适合放同性质的内容。由使用者产生的内容（例如：Facebook、Twitter）以及图片内容（如：Pinterest、Dribbble）都相当适合Infinite scroll，而面对较差的控制感、浏览器负荷高等缺点，能以Load more按钮，作为折衷的办法。

再回过头看最初的问题，历史纪录应该用pagination还是infinite scroll？ 或许一开始数据量不大的时候，infinite scroll是好用的，可是当数据量慢慢累积，需要好几页的内容时，为了找寻特定目标的需要，pagination会是比较好的选择。

电子商务究竟较适合Pagination还是Infinite Scroll呢？

我认为，要看情境做判断。如果今天这个购物网站，比较像是让人能快速找到所需物品，使用者知道自己要买什么，买了就走，功能性取向的，就使用Pagination较为合适。但如果今天的购物网站，是想要营造逛街购物的氛围，让使用者随意看看，激起购物欲望，那么或许Infinite scroll也是可以考虑的，只是最好能在每个商品的Tile上，能有我的最爱功能，点击爱心之后，可以收藏起来，避免最后找不到自己心动的商品。

其实有研究指出，pagination会拖慢浏览速度，也会让用户懒得点击去看其他页面的产品，降低产品曝光度。不过另外一方面，使用Pagination，会让使用者花比较多的时间在第一页。当我们知道这些现象的时候，其实就可以运用一些策略手法，把看似缺点变成优点。例如使用Pagination，多数人都停在第一页，这时候，第一页就可以放主打商品。

<img class="alignnone size-full wp-image-195862" src="http://image.uisdc.com/wp-content/uploads/2016/08/tf201608061.png" alt="tf201608061" width="800" height="415" />

△ Fancy：无限滚动模式的购物网站
<h4><strong>One More Thing：单页的内容数量</strong></h4>
另外，无论是Pagination或是Infinite Scroll with Load More button都会面对一个问题，就是究竟Pagination的一页或Infinite scroll 出现按钮的长度应该要多长，要放多少东西，才是适宜的？这也是值得探讨的议题。

有文章指出，在电子商务的情境下运用Infinite scroll，从产品类别点进去看的商品，可以列出50-100项产品，再出现Load more按钮，但如果是搜寻结果，则建议25–75项，在手机上，则是因为屏幕的限制，建议15–30项商品即可。

同样是电子商务，简单看了一下市面上的网络购物平台，运用Pagination的平台，一页也是50–100个物件间。

<img class="alignnone size-full wp-image-195861" src="http://image.uisdc.com/wp-content/uploads/2016/08/tf201608062.png" alt="tf201608062" width="800" height="652" />

△ Taobao：每一页有85个商品

<img class="alignnone size-full wp-image-195860" src="http://image.uisdc.com/wp-content/uploads/2016/08/tf201608066.png" alt="tf201608066" width="800" height="423" />

eBay：默认50个商品，用户可以自由选择展示数量。

如果今天情境转为非电子商务平台，又会是什么结果呢？还可以再多做探索与研究。

&nbsp;

原文地址：http://www.uisdc.com/website-page-or-waterfall

&nbsp;";s:10:"post_title";s:75:"网站信息量大，该采用分页式设计还是瀑布流滚动设计？";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:43:"page-design-or-waterfall-flow-scroll-design";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-08-08 11:19:47";s:17:"post_modified_gmt";s:19:"2016-08-08 03:19:47";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:25:"http://qisumu.com/?p=1862";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}