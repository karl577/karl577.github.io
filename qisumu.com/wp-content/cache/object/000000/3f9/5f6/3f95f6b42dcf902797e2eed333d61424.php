�
�Z<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:4:"2180";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-08-23 19:09:43";s:13:"post_date_gmt";s:19:"2016-08-23 11:09:43";s:12:"post_content";s:9552:"<h4>为什么想到这个问题</h4>
前段时间做了一个数据可视化的项目，由于是工作的第一次项目，项目不小，又有一定的自由度，所以下了点功夫准备，仅前期报告就做了八十多页。

“可视化”这个词，通常人一眼就觉得等同于“图形化”，因此“数据可视化”显然就是将数据设计成直观又好看的图表。可是，我怀疑“数据可视化”除了“图形化”之外，是否还有别的可能性？例如，人类最常用最自然的沟通方式——“语言文字”？由于目前大众还不习惯语音交互，所以于是我开始从“文字化”的角度研究“数据可视化”，于是发现了令自己也觉得震惊的事实……
<h4><strong>数据文字可视化的好处</strong></h4>
举个例子，如果给你三秒钟分别扫一眼下图左边的图表或右边的文字，看哪个你能复述出最详细的内容？

<img class="alignnone size-full wp-image-197901" src="http://image.uisdc.com/wp-content/uploads/2016/08/cyb201608213.png" alt="cyb201608213" width="800" height="305" />

△ 图形总是比文字高效吗？

最高效的是文字而非图表。为什么呢？虽然两者都给出相同的关键点（国家、GDP、单位、年份、数量）等，但是前者将这些信息都分散开来，让读者不得不四处扫视，才能将零碎的信息整理起来并理解。而后者的那段文字中，所有的信息从单一的方向有序排列，只需要横向扫视两次就能看完并理解。

<img class="alignnone size-full wp-image-197902" src="http://image.uisdc.com/wp-content/uploads/2016/08/cyb201608214.png" alt="cyb201608214" width="800" height="305" />

△ 看图和看文的差别

从文字方向解读数据可视化的好处我总结如下：

1. 更加高效：少量数据（如上面的例子）时，让信息传达更加高效

2. 抽取特征：复杂情况（如各地区人口分布数据）下，文字比图表更容易抽取特征并让人理解（例如沿海地区密度比内陆地去高X%等）

3. 趋势归纳：文字在提炼数据变化趋势时，有很大的优势，例如数据的稳定上升/下降、变化周期等

4. 意义检索：上面三项好处结合起来，可以引出这一项，那就是直接通过特征和趋势检索数据的可能性，例如使用 “连续三周上升”、“单日浮动3倍以上”等关键词搜寻数据。

想学数据可视化，有这篇文章就够了（方法，类型，软件都有）：<a href="http://www.uisdc.com/comprehensive-infographic-design-guideline" target="_blank">《超全面！一份详尽实用的信息可视化绘制指南》</a>
<h4><strong>纵观历史</strong></h4>
<h4><strong>一、起点</strong></h4>
文字界面（TUI）并不是什么新的东西，它反倒是计算机系统的初始模样——命令行。然而，命令行界面虽然创造了人与机器对话的语言，但失败之处在于，它要求人类像机器一样思考并说话/打字。这显然是很难的，所以除了专家之外，普通人根本无法顺畅使用这种文字界面。

<img class="alignnone size-full wp-image-197899" src="http://image.uisdc.com/wp-content/uploads/2016/08/cyb201608211.png" alt="cyb201608211" width="720" height="402" />

△ TUI的前世——命令行界面
<h4><strong>二、GUI革命</strong></h4>
TUI碰壁后，计算机走上了图形化的革命。这一走就是几十年，知道今天都尚未结束。图形界面（GUI）的关键，在我看来，并不是“图形”，而是选择。TUI的最大困难不是其它，而是输入——人类难以适应机器的语言方式，所以无法顺畅地对机器进行信息输入。

GUI提供的解决方式是，既然人类很难直接告诉机器他们想要做什么，那就绕其道而行，让机器提供可能的选项，人类只需要进行选择。这样一来，人类与机器的沟通问题就以选择的方式得到了解决。GUI革命的成功案例就是下图的Windows桌面。

<img class="alignnone size-full wp-image-197900" src="http://image.uisdc.com/wp-content/uploads/2016/08/cyb201608212.jpg" alt="cyb201608212" width="580" height="435" />

△ GUI革命代表——早期的Windows桌面
<h4><strong>三、过渡阶段</strong></h4>
GUI创造的“选择”解决方式有一个漏洞，那就是当系统提供的功能较为强大时，需要提供大量选项，这给使用者带来了寻找信息的挑战。当前<span class="wp_keywordlink_affiliate"><a title="查看 交互设计 中的全部文章" href="http://www.uisdc.com/tag/%e4%ba%a4%e4%ba%92%e8%ae%be%e8%ae%a1" target="_blank">交互设计</a></span>的一切几乎都是围绕这一漏洞——“如果让用户在合适的情况看到合适的信息”。

于是“搜索”作为一个过渡方案诞生，而Google的传奇是这一时势造就的英雄。信息过多时，用户不能高效地寻找到想要的东西，所以我们不得不再次面对之前回避的问题——如何输入（让计算机理解人类的语言）。

人类的语法千变万化，让机器理解太过困难，那么暂时搁置。但是我们发现，文字片段有很高的几率是不会变化的。例如，不论是“苹果掉在地上”、“苹果砸到地面”还是什么其它的表述方式，“苹果”和“地”这两个关键词通常是不会改变的。于是我们可以用关键词对海量的选项进行检索，达到一种看起来像是输入，其实并不是输入的“伪输入”效果。

例如，以下就是我写这篇文章时的Windows桌面，上面没有几个图标，因为我可以用搜索功能找到任何我想要的应用。

<img class="alignnone size-full wp-image-197903" src="http://image.uisdc.com/wp-content/uploads/2016/08/cyb201608215.jpg" alt="cyb201608215" width="800" height="450" />

△ 我通过搜索就可以找到大部分应用
<h4><strong>四、TUI的回归</strong></h4>
GUI鼎盛时期，人们以为TUI是糟糕的发明，GUI才是未来。然而，将搜索研究到极致后，TUI却穿着<span class="wp_keywordlink_affiliate"><a title="查看 对话式交互 中的全部文章" href="http://www.uisdc.com/tag/%e5%af%b9%e8%af%9d%e5%bc%8f%e4%ba%a4%e4%ba%92" target="_blank">对话式交互</a></span>（Coversational Interaction）的马甲回来了。以Siri为代表，很多语言助手都在这条路上做了很多不够成熟的尝试。

未来的TUI虽然还是TUI，却早已不同于曾经的命令行界面，它要求机器适应人类的语言，而不是人类适应机器的语言。最理想的状态是，除非是用户必须在既定的项目中做出选择，否则GUI是完全不需要的。这就有点像宋代禅宗大师青原行思提出的“参禅之初，看山是山，看水是水；禅有悟时，看山不是山，看水不是水；禅中彻悟，看山仍然山，看水仍然是水”的意味了。

下图是<a href="https://medium.com/the-layer/the-future-of-conversational-ui-belongs-to-hybrid-interfaces-8a228de0bdb5#.cf54r9ouj" target="_blank">The Future of Conversational UI Belongs to Hybrid</a>这篇文章里提供的，虽然不是TUI最先进的形式，但已经可以窥探其趋势。该文作者Tomaž Štolfa给出了很详细的研究，值得拜读。

<img class="alignnone size-full wp-image-197904" src="http://image.uisdc.com/wp-content/uploads/2016/08/cyb201608216.png" alt="cyb201608216" width="800" height="538" />

△ 会话式交互的可能形态
<h4><strong><span class="wp_keywordlink_affiliate"><a title="查看 对话式交互 中的全部文章" href="http://www.uisdc.com/tag/%e5%af%b9%e8%af%9d%e5%bc%8f%e4%ba%a4%e4%ba%92" target="_blank">对话式交互</a></span>的未来是怎样的</strong></h4>
1. 不再需要选择/寻找：说出需求后，机器便能理解并执行

2. 用户对机器的输入将超过机器对用户的输出：不同于GUI时代主要靠机器输入和用户选择，<span class="wp_keywordlink_affiliate"><a title="查看 对话式交互 中的全部文章" href="http://www.uisdc.com/tag/%e5%af%b9%e8%af%9d%e5%bc%8f%e4%ba%a4%e4%ba%92" target="_blank">对话式交互</a></span>的TUI时代需要机器从用户那里获取大量信息，才能加深双方的“默契”。就像长期在一起的好友，一个词、一句话便能心意互通。

3. 界面将成为<span class="wp_keywordlink_affiliate"><a title="查看 交互设计 中的全部文章" href="http://www.uisdc.com/tag/%e4%ba%a4%e4%ba%92%e8%ae%be%e8%ae%a1" target="_blank">交互设计</a></span>的一个小类：我们现在通常的划分方式是界面设计=<span class="wp_keywordlink_affiliate"><a title="查看 交互设计 中的全部文章" href="http://www.uisdc.com/tag/%e4%ba%a4%e4%ba%92%e8%ae%be%e8%ae%a1" target="_blank">交互设计</a></span>+视觉设计。而在对话式交互的TUI时代，也许交互设计=界面设计+信息设计，也可能新的职业将产生。

4. 语言学，这个已经存在好久，却一直不太受关注的学科，可能会火起来。
<h4><strong>总结</strong></h4>
我曾在Quora上看到一个问题——“界面设计是一个稳定的工作吗？”投票率最高的答案是——不，因为在未来，我们也许根本不需要“界面”了。当时觉得那会是很远很远的未来，现在想来，图形界面的末路也许还早，但衰败恐怕早在Google成名的那天就已经开始了。";s:10:"post_title";s:75:"图形界面的末路？聊聊未来可能会流行的「对话式交互」";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:198:"%e5%9b%be%e5%bd%a2%e7%95%8c%e9%9d%a2%e7%9a%84%e6%9c%ab%e8%b7%af%ef%bc%9f%e8%81%8a%e8%81%8a%e6%9c%aa%e6%9d%a5%e5%8f%af%e8%83%bd%e4%bc%9a%e6%b5%81%e8%a1%8c%e7%9a%84%e3%80%8c%e5%af%b9%e8%af%9d%e5%bc%8f";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-08-23 19:09:43";s:17:"post_modified_gmt";s:19:"2016-08-23 11:09:43";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:25:"http://qisumu.com/?p=2180";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}