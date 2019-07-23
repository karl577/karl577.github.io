�+�Z<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:4:"2182";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-08-23 19:10:59";s:13:"post_date_gmt";s:19:"2016-08-23 11:10:59";s:12:"post_content";s:11991:"<h4><strong>信息架构</strong></h4>
说到<span class="wp_keywordlink_affiliate"><a title="查看 交互设计 中的全部文章" href="http://www.uisdc.com/tag/%e4%ba%a4%e4%ba%92%e8%ae%be%e8%ae%a1" target="_blank">交互设计</a></span>，就不能不提需求，因为所有的交互设计的工作都是基于需求，这也是交互设计的第一个着力点。因此，只有深刻理解需求以后，才有可能做出好的交互设计。

举一个饱含血泪的例子：在做一个项目的过程中，有一个需求是要将一个应用的数据展示做一下调整，使之能够查看在三个月之内的该数据。当时，自以为已经很了解需求，只是将时间限制放开到三个月，同时，数据的展示限制在一个月内。也就是说，可以查看三个月内任意小于三十天的时间段。优点是：1）满足了需求；2）页面显示效果比较好。但是，自己是没有真正的理解需求，用户要查看三个月的数据，更多的是要查看三个月所有的数据，而不是三个月中的一段数据。发现用户的真正需求后，我们又做了相应的调整，数据的可查时间范围不变，但是显示范围可以是一个可以页面显示并能够之间交互操作的时间轴。这样，产品的交互效果和显示效果都得到了很大的提高。相似的功能需求，交互解决方案如图所示：数据展示页面窗口大小保持不变，而用户可以通过调节X轴的滑块来查看某一时间段的数据。

<img class="alignnone size-full wp-image-198112" src="http://image.uisdc.com/wp-content/uploads/2016/08/pm20160822-2.png" alt="pm20160822 (2)" width="664" height="517" />

但是所花费的时间成本、人力成本都在那一点小小的偏差上成了无用功。因此，需求的理解详细到任何程度都不为过。

交互设计的第二个着力点是竞品分析。人们常说，如果一个人要走的快，那就一个人走；如果要走的远，那就一群人走。在中国当前的环境下，你很容易就能找到三五个相似的产品，充分的竞品分析与调研能够找到你的产品方向，能够补充你的需求以及用户场景，同时能够很好地了解用户习惯，尊重用户的习惯是以用户体验为中心的交互设计的第一要务。在尊重用户习惯的前提下，结合自身的优势与自己产品与竞品的定位差异，很容易就得到了你产品大致的信息架构。当然，这不是最终的信息架构。

要得到自己的信息架构，并能够有自己的特色与创新，还要一个着力点，那就是卡片分析法。关于卡片分析法的文章，网上有很多，在这里就不一一唠叨了。如何对卡片分析法结果进行处理，才是关键。不过，在这里要注意“层”和“度”的平衡。所谓的“层”就是你的产品的层级有多深。以移动端的应用为例，移动端的层级最好不要超过五层，因为移动端的应用没有类似PC网站的面包屑导航，如果层级太深，用户很容易在其中迷失，不能找到自己想要的功能。所谓的“度”就是产品功能的分类。产品功能分类的好坏，可以深刻的影响到用户的体验以及用户能不能顺利的找到自己想要的功能。这也是为什么使用卡片分类法的原因所在，卡片分类法能够将目标用户内心的心智模型表现出来，有利用用户顺利的寻找到目标。

在信息架构设计中，最后一个着力点是对信息架构的应用。通过对产品的“层”和“度”的整理，对其进行重要度分级。如果有若干一级标签属于第一优先级，那么，这种类型比较适合使用标签式导航。因为，用户在相同优先级标签之间的切换比较频繁，这样的导航强调若干相同优先级的标签之间的切换，使用户能够方便的浏览到不同分类的信息，这一类的应用比较多，如QQ、淘宝、天猫、京东等。

如果只有一个比较核心的功能且优先级比较高，其他的信息较为次要，这种情况的信息架构比较适合采用抽屉式导航。因为，用户在当前主要页面中就能完成任务，就没有必要进行导航的切换，这一类的应用主要有滴滴、UBER、小米邮箱等。

<img class="alignnone size-full wp-image-198113" src="http://image.uisdc.com/wp-content/uploads/2016/08/pm20160822-3.png" alt="pm20160822 (3)" width="225" height="400" />

完成了信息架构的设计，只是完成了产品功能的横向设计，还有产品功能的纵向设计。产品的纵向设计就要涉及到产品的流程设计，流程设计是在功能展示完备的情况下，对功能之间跳转的设计，是交互设计中的另外一个重点。

关于信息架构，还有这两篇好文可以借鉴：
<ol>
 	<li><a href="http://www.uisdc.com/designer-understand-information-architecture" target="_blank">《从优秀到卓越！交互设计师怎样理解信息架构？》</a></li>
 	<li><a href="http://www.uisdc.com/complex-information-architecture-product" target="_blank">《交互设计师来收！如何设计复杂信息架构产品？》</a></li>
</ol>
<h4><strong>流程设计</strong></h4>
相对于信息架构的横向信息布局与功能分类来说，流程设计更多的是纵向的完成任务的交互点的梳理，以达到让用户顺利的完成相关任务的目的。对于用户来讲，交互<span class="wp_keywordlink_affiliate"><a title="查看 设计流程 中的全部文章" href="http://www.uisdc.com/tag/%e8%ae%be%e8%ae%a1%e6%b5%81%e7%a8%8b" target="_blank">设计流程</a></span>是指用户能够顺利的完成想要完成的任务。而从业务层面来讲，以不干扰用户使用流程的方式完成业务需求，才是流程设计的完整定义。

好的流程设计不仅能够提升产品的用户体验，同时，能够更加顺利的完成业务目标。作为两大国民应用的支付宝和微信，在产品的交互流程上的经验也充分说明了这一点。通过与春节联欢晚会的合作，微信不仅实现了全民数百亿次摇一摇的互动，同时，实现了在两天之内完成了两亿张银行卡绑定的业务目标，这可是支付宝数年才完成的目标。这就是得益于微信红包的好的流程设计，相反支付宝的效果就没有那么明显了。这也就是为什么要做好交互流程设计的原因。

交互流程是依附于产品解决任务的过程而存在的，脱离任务来讲流程是不恰当的。因此，要做好交互流程设计，首先要明确的是围绕什么样的具体任务来展开。任何一个应用都有一个或者若干功能点，来解决某些问题。针对这些功能点来解决任务的过程就是任务，同一个任务可能有不同的用户场景。比如，同一个打电话任务就有若干不同场景：从未接电话开始、联系人开始、拨号开始等。所以，根据不同的任务，梳理出不同场景，因此，产品的交互流程可能不止一个，会拥有若干基于任务解决方案的流程设计。

<img class="alignnone size-full wp-image-198114" src="http://image.uisdc.com/wp-content/uploads/2016/08/pm201608231.png" alt="pm201608231" width="800" height="342" />

完成任务与场景的梳理以后，就要进第二步，就是要针对一个任务的一个主要场景梳理出用户与产品存在的交互点（InteractionPoint），也就是用户在完成任务过程中，与产品之间存在的物理与心理的互动关系。我们以通过微信找到好友并发送消息为例，来说明该任务中存在的用户与产品之间存在的交互点。在这个过程中，通过对交互点的整理，可以清楚的看到完成某项任务的难易程度，以及对于用户可能存在的交互障碍，需要在具体的界面设计时，对用进行引导，来避免用户出现困惑或者错误。

接下来就要将业务流程添加到交互点中，与相应的页面融合。添加业务目标的方法一般有两种，第一种是将其放置在核心任务流程结束的地方，比如，饿了么、美团外卖等，用户在完成一次订餐后，会提示用户将连接分享给朋友可以获得相应的优惠券。其业务目标就是让用户帮助应用推广应用，这样的好处是不影响用户完成其任务，在完成其任务以后，即使用户不分享也不会影响其体验。

<img class="alignnone size-full wp-image-198115" src="http://image.uisdc.com/wp-content/uploads/2016/08/pm201608232.png" alt="pm201608232" width="224" height="400" />

另外一种是将业务目标弱化显示在流程页面中，比如我们在注册的时候，都会在底部显示用户协议的选项，而其是默认勾选的。因为这些信息使用户不愿意看的，所以弱化处理。

<img class="alignnone size-full wp-image-198116" src="http://image.uisdc.com/wp-content/uploads/2016/08/pm201608233.png" alt="pm201608233" width="281" height="500" />

在完成以上任务后，就可以进行相应的流程设计，针对不同的任务与场景制作不同的流程，其中必然会有一部分的交互点重叠，这样就可以将同一任务、不同场景下的交互流程整合到一起，完成核心功能的交互流程设计。相信大家对具体的流程设计的制作步骤都已经很熟悉了，在这里就不赘述了。很多同学，觉得到这里，似乎流程以及大功告成。但是，远远不够；至少，还有两件事情要完成。

<img class="alignnone size-full wp-image-198118" src="http://image.uisdc.com/wp-content/uploads/2016/08/pb20160823.png" alt="pb20160823" width="800" height="143" />

第一件事，相应信息架构的调整。我们一直在强调，信息架构是横向的信息布局与功能分类，在设计交互流程的过程中，我们会发现有些信息架构的设计、功能分类可能并不是那么合理，或者，信息架构本身没有问题，但是在用户的使用流程中，和用户的习惯有冲突，这样就需要调整信息架构，使信息架构更合理。第二件事，就是完成所有的流程设计，包括登录注册流程、异常状况流程等等，其中异常状况流程包括各种各样的问题，其中有一个偷懒的方法，就是把网络异常编号整理出来，合并其中的类似项目，这样就可以整理出若干类相应的异常反馈，并设计出反馈语言，结合Toast和Alert提示，就可以满足大部分的异常操作。

因此，流程设计的过程可以总结为：

<img class="alignnone size-full wp-image-198117" src="http://image.uisdc.com/wp-content/uploads/2016/08/pm201608234.png" alt="pm201608234" width="492" height="700" />

结合页面的用户场景故事，目的在于模拟一个典型的用户场景，来检查信息架构和交互流程的设计，是否符合用户的心智模型。这样，才能在后期的细节设计中减少由于架构与流程调整而增加的额外的工作量。

交互流程设计的意义更多在于，从功能角度模拟用户的使用过程，减少用在功能操作中的障碍，提高用户体验。但是，无论信息架构设计，还是流程设计都只是逻辑上的模型，只有将这些逻辑表现在具体的界面上，这些逻辑才会有意义，才会为用户了解、接受。这就牵扯到页面的布局、Icon的大小、交互动效、控件等等。

这儿再加上一个完整的<span class="wp_keywordlink_affiliate"><a title="查看 设计流程 中的全部文章" href="http://www.uisdc.com/tag/%e8%ae%be%e8%ae%a1%e6%b5%81%e7%a8%8b" target="_blank">设计流程</a></span>：<a href="http://www.uisdc.com/complete-interactive-design-workflow" target="_blank">《够专业！一个完整的交互设计流程是怎样的？》</a>";s:10:"post_title";s:72:"基础知识！聊聊交互设计三要素之信息架构和流程设计";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:198:"%e5%9f%ba%e7%a1%80%e7%9f%a5%e8%af%86%ef%bc%81%e8%81%8a%e8%81%8a%e4%ba%a4%e4%ba%92%e8%ae%be%e8%ae%a1%e4%b8%89%e8%a6%81%e7%b4%a0%e4%b9%8b%e4%bf%a1%e6%81%af%e6%9e%b6%e6%9e%84%e5%92%8c%e6%b5%81%e7%a8%8b";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-08-23 19:10:59";s:17:"post_modified_gmt";s:19:"2016-08-23 11:10:59";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:25:"http://qisumu.com/?p=2182";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}