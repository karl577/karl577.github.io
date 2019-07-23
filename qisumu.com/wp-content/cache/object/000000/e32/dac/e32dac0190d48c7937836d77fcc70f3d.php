�ʐZ<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:1681;s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-08-04 16:29:39";s:13:"post_date_gmt";s:19:"2016-08-04 08:29:39";s:12:"post_content";s:9857:"<blockquote>当你搜索并查阅了很多网上资料后，仍可能不会编辑交互设计说明书。那么究竟该怎么编辑交互设计说明书呢？在编辑的过程中又有哪些要点和注意事项呢？</blockquote>
<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/jiaohushejishuofamf.jpg"><img class="size-full wp-image-386370 aligncenter" src="http://image.woshipm.com/wp-files/2016/08/jiaohushejishuofamf.jpg" sizes="(max-width: 680px) 100vw, 680px" srcset="http://www.woshipm.com/wp-content/uploads/2016/08/jiaohushejishuofamf.jpg 680x, http://www.woshipm.com/wp-content/uploads/2016/08/jiaohushejishuofamf-404x190.jpg 404x" alt="jiaohushejishuofamf" width="680" height="320" data-original="http://image.woshipm.com/wp-files/2016/08/jiaohushejishuofamf.jpg" /></a>

目前很多公司会采用敏捷式开发流程，这时很多产品经理或交互设计师会直接在 Axure 等原型设计工具中制作 PRD 而非原型，并且还会出现 多人编辑一份文档的情况。

下面简单介绍交互设计说明书的基本写法，也算是抛砖引玉吧，最后会给出完整的项目交互设计文档供大家学习参考。

这里需要注意的是，有时使用原型工具导出的交互设计说明书会很混乱，没有可读性，比如，完全是机器按照你的原型站点导航树结构导出的不符合业务逻辑的说明书，但当开发人员、UI 设计师或 PM 拿到这样一份“交互设计说明书”时，真的看不懂。所以需要设计师根据实际的业务需求与业务对象有针对性地编辑一份交互设计说明书。
<h2>交互设计说明书的阅读对象</h2>
交互设计文档都是给谁看的？这个文档会根据阅读的对象做什么优化吗？下面利用场景化模拟解释交互设计说明文档的使用场景。

交互设计说明书由交互设计师完成编辑、修订、发布。
<ul>
 	<li>交互设计师提交交互设计说明书给产品经理。</li>
 	<li>交互设计师提交交互设计说明书给 UI 设计师。</li>
 	<li>交互设计师提交交互设计说明书给研发人员。</li>
 	<li>交互设计师提交交互设计说明书给测试人员。</li>
</ul>
在交互设计过程中，上述四个角色会不断有所交集。所以，一旦编辑文档，就需要对这几个角色有针对性地解释和阅读优化。
<h3>1．产品经理场景</h3>
交互设计说明书的阅读人员包括：产品人员、设计人员、研发人员、测试人员等，他们就是交互设计文档的使用主角，产品经理在使用交互设计说明书的时候需要确认的方向是 ：交互逻辑、功能架构、交互事件、界面页面流转与内容布局等。这里的产品经理代表产品经理及以上管理层。

关键点：为项目梳理清楚逻辑关系，文档按照逻辑关系和功能架构分支等设置大纲讲清楚项目、功能、组件、页面流转关系。
<h3>2．UI设计师场景</h3>
UI 设计师在使用交互设计说明书的时候，更多的是看你的说明文档的具体页面数量，因为这决定 UI 设计师出多少效果图。另外，要看你的原型设计给 UI 设计师留了多少发挥空间，不能一开始就制作高保真原型。

关键点：例如，一个页面有三个状态，制作原型动态面板时加原型事件即可，但是设计的文档需要将三个状态都截图标注好，页面流转标记是告诉 UI 设计师这里有三个页面，而不是告诉 UI 设计师有三个状态。
<h3>3．研发工程师场景</h3>
研发人员拿到交互设计说明书的时候就非常关心细节实现，关心有多 少个功能、多少个功能新特性、多少个页面元素组件、多少个交互动效等， 但他不关心方案里一个输入框里是用彩色还是黑白，因为他是具体功能的实现者。

提供给研发人员的文档需要注意以下关键点 ：明确表示出关于功能设计、页面逻辑、组件交互等信息的细节，例如：一个页面刷新，要分为触发刷新事件、刷新加载中、刷新成功提示、刷新失败提示。其中失败提示又要分多种情况：网络不佳、程序异常等。如果你没有提出明确需求，责任就会在需求方，而不是程序部门。
<h3>4．测试与需求场景</h3>
测试是依靠需求说明书和交互设计说明书，进行测试用例与测试脚本的编写，在交互设计说明文档里需要说明白每一个功能的交互动作与事件，测试是抓细节的，所以需要配一些说明性文字解释交互设计的思路与实现路径，这样测试人员就可根据设计思路设计出测试用例。当然，测试用例分多种类型，这里指的是功能测试与逻辑测试，一些性能测试等需要依靠程序使用的软件、数据库等技术性的接口文档来定。

关键点：功能点、业务逻辑、界面元素、交互过程分解步骤。上面解释了各角色使用交互设计说明文档的场景及他们期待的真实需求，只有清楚地了解这些内容，才能有针对性地制作交互设计说明书。
<h2>交互设计说明书包含的内容</h2>
众所周知，一份交互设计说明书最重要的当然是内容，下面介绍如何按照实际流程制作文档。
<h3>1. 写什么</h3>
很多新手在新建一份空白文档后不知道具体写什么内容，如前面所说，对一份交互设计说明书，你只需要把原型截图或原型直接画成一个文档即可。其实交互文档就是页面文档，所有的软件页面、状态都分离出页面进行展现，然后加入页面流程和交互动作说明文字、箭头指示线条等。

关键点：逻辑结构、页面跳转、交互状态的文字说明，统一交互体验动作，确保页面组件的一致性。

示例如图1所示，这是一个包含交互界面动作、逻辑步骤、页面流转、文案和注释的实例。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/1-12.png"><img class="attachment-large  aligncenter" src="http://image.woshipm.com/wp-files/2016/08/1-12.png" alt="1" width="580" height="381" data-original="http://image.woshipm.com/wp-files/2016/08/1-12.png" /></a>

图1包括交互界面动作、逻辑步骤、页面流转、文案与注释的实例

图中的这个交互动作是将所有出现的界面静态化地写在文档里进 行展示。如果你想直接展示动态交互，可以使用原型设计工具设计好交互 原型之后再截图编辑文档，在交付文档时结合原型演示，这样会更有效果。
<h3>2．怎么写</h3>
一般的交互设计说明书的文档结构如下 ：
<ul>
 	<li>文档封皮与版本信息。</li>
 	<li>目录页。</li>
 	<li>Log（日志）修订记录页。</li>
 	<li>交互行为逻辑图 + 文字说明。</li>
 	<li>页面展开图 + 逻辑 + 文字。</li>
 	<li>详细介绍其他单独的交互动作。</li>
</ul>
<strong>（1）封皮和版本</strong>

图2所示是交互设计说明书封皮和版本信息的示例。版本信息一般 包括版本、日期、参与人、变更内容简要、备注。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/2-8.png"><img class="attachment-large size-large aligncenter" src="http://image.woshipm.com/wp-files/2016/08/2-8.png" alt="2" width="367" height="510" data-original="http://image.woshipm.com/wp-files/2016/08/2-8.png" /></a>

图2交互设计说明书版本信息格式

<strong>（2）目录</strong>

这个无须多说，平时我们看的书基本上都有目录，不过要记住，目录 要合理分级，以分清主次。

<strong>（3）Log 更新记录页</strong>

这个页面用来描述某次更新的信息简介与页码导航等。图3为交互 设计说明文档的更新记录页的示例。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/3-5.png"><img class="attachment-large size-large aligncenter" src="http://image.woshipm.com/wp-files/2016/08/3-5.png" alt="3" width="330" height="458" data-original="http://image.woshipm.com/wp-files/2016/08/3-5.png" /></a>

图3交互设计说明书的更新日志

<strong>（4）交互行为逻辑图 + 文字说明</strong>

图4所示是某个应用商店的更新应用交互逻辑 + 文字说明图例。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/5-7.png"><img class="attachment-large  aligncenter" src="http://image.woshipm.com/wp-files/2016/08/5-7.png" alt="5" width="721" height="607" data-original="http://image.woshipm.com/wp-files/2016/08/5-7.png" /></a>

图4交互设计说明书中的交互逻辑页面流程

从图中可以看出，这个说明文档是把应用更新功能作为一页，具 体包括其架构、交互、流程、逻辑、交互事件及文字解释说明。

这个过程是针对产品经理和程序人员而言的，因为他们需要看明白交 互流程逻辑。

<strong>（5）页面展开图 + 逻辑 + 文字</strong>

图5是页面、元件、文案、逻辑、页面状态的展示。这部分是针对 视觉设计人员而言的，需要将所有的页面都展开解释一遍，公用部分可以单独标记。

<a class="highslide-image" href="http://image.woshipm.com/wp-files/2016/08/6-4.png"><img class="attachment-large  aligncenter" src="http://image.woshipm.com/wp-files/2016/08/6-4.png" alt="6" width="619" height="291" data-original="http://image.woshipm.com/wp-files/2016/08/6-4.png" /></a>

图5交互设计说明书的页面元素

<strong>（6）详细解释其他单独的交互动作</strong>

此部分是对不在流程中单独或独立的交互动作进行补充说明。

&nbsp;";s:10:"post_title";s:33:"如何编辑交互设计说明书";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:99:"%e5%a6%82%e4%bd%95%e7%bc%96%e8%be%91%e4%ba%a4%e4%ba%92%e8%ae%be%e8%ae%a1%e8%af%b4%e6%98%8e%e4%b9%a6";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-08-04 16:29:39";s:17:"post_modified_gmt";s:19:"2016-08-04 08:29:39";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:25:"http://qisumu.com/?p=1681";s:10:"menu_order";i:0;s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}