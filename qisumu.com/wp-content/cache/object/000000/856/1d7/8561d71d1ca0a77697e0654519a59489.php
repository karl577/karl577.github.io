0ՐZ<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:3:"558";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-07-21 12:40:49";s:13:"post_date_gmt";s:19:"2016-07-21 04:40:49";s:12:"post_content";s:7816:"<p class="p1"><span class="s1">在无线场景下，无论是浏览wap页面，还是使用原生的app，所有人都一定都碰到过“弹窗广告”（如下图），从用户体验设计的经验看，这种缺少用户预期的广告形式，可能会打断原有的操作和认知，对体验的流畅有一定的负面影响，但从内容的推广角度看，弹窗广告可以在短时间内将广告内容强制展现给用户，一定程度上迫使用户阅读和点击，以达到更强的传播效果。</span></p>
<p class="p1"><span class="s1"><img src="http://img3.tbcdn.cn/tfscom/TB1pzDRKpXXXXcKXXXXwu0bFXXX.png" alt="" /></span></p>
<p class="p1"><span class="s1">前段时间，结合一个业务上的需求，对两种“弹窗广告”形式进行了的一些线上测试和数据分析；目的是希望能用更直观的数据，去对“弹窗广告”这种广告形式及其不同类型有更定量的了解，以便为后续的设计优化和以及不同形式线上使用的数据效果预期提供参考。</span></p>
<p class="p1"><span class="s1">业务的需求背景，是在“<a title="爱淘宝" href="http://ai.m.taobao.com/" target="_blank">爱淘宝</a>”的wap端首页，为“双十一预热会场”进行引流，考虑到是以引流为主要目的，大家都倾向于“弹窗广告”这种形式，但同时，对于“弹窗广告”的具体设计，也存在了两种观点，一种观点是，比较常规的全屏式“弹窗广告”的引流能力虽然好，但是这种形式有一定程度强迫用户阅读和点击，这对于广告本身的转化以及首页本身的转化上可能会有负面影响；另一种观点是，“弹窗广告”只是短暂出现的，并且会在用户没有操作后自动关闭，不会对原有页面的转化有影响，而且因为全屏的插入广告感官更强，转化效果也会更强一些。</span></p>
<p class="p1"><span class="s1">基于这两种观点，我们决定使用a/btest的方式，对两种类型的“弹窗广告”进行定量测试，</span>为此，我们设计了两种形式的“弹窗广告”作为测试方案：</p>
<p class="p1"><span class="s1">A方案是较为常规的全屏式的“弹窗广告”（见下图左），它在页面加载之后，以全屏浮层的形式展现在原有页面之上，在用户没有主动关闭或跳转的情况下，停留一段时间后自动关闭，A方案的特点对用户原有浏览和操作的干扰较大（需要等待或主动关闭），但是展示效果较强</span></p>
<p class="p1"><span class="s1">B方案是将常见的“全屏式“变为”半屏式“（见下图右），在页面加载之后，它会出现在原有页面的头部，占半屏的页面展示空间，除了等待时间结束或主动关闭，用户浏览页面的“上滑动作”同样可以关闭广告，它的特点是相比A方案，对用户原有的浏览和操作干扰较小，但是在展示效果上，没有A方案那么强烈。</span></p>
<p class="p1">主要测试的三个方面：广告本身的分流能力，引入流量的转化，对原有页面用户转化的影响；涉及到的数据有页面pv,页面uv，click，广告的点击uv，页面点击uv、引入流量的成交笔数等字段</p>
<img src="http://img3.tbcdn.cn/tfscom/TB1kXDAKpXXXXb.XpXXtKXbFXXX.gif" alt="" />     <img src="http://img1.tbcdn.cn/tfscom/TB1jwnDKpXXXXXsXpXXtKXbFXXX.gif" alt="" />
<p class="p1"><span class="s1">两种方案以7:3的流量占比（全屏7，半屏3，之所以这么分，是全屏的模式引流效果更强，考虑到测试本身对投放数据的影响，所以更多的流量投放了全屏方案，其实比较理想的状况，还需要设置一个参照组，即没有投放广告的“纯净版”，但同样出于上面原因，暂时将投放前三天的平均数据作为参考组）分桶投放了三天，得到了一些数据反馈，一些结果比较符合原有的预期，也拿到了相应的定量值，也有些与原有预期不一样的惊喜，出于公司数据保密的原因，没办法把原始数据放出来，下面仅把分析结果做下展示和简单分析：</span></p>
<p class="p1"><span class="s1"><strong>测试点1:不同类型的分流能力</strong></span></p>
<img src="http://img2.tbcdn.cn/tfscom/TB1kMfDKpXXXXXvXpXXwu0bFXXX.png" alt="" />

两种类型对页面流量的分流能力上（广告点击uv／页面uv，广告点击数／页面pv），毫无疑问是“全屏式”的方案分流能力更强，这也与之前的预期相符，具体的结果显示，全屏方案在采用更强的展示效果和更大的展示空间（大概是半屏的2倍）后，其分流能力是“半屏”方案的1.5倍左右，而具体在整个页面流量中的占比，是受广告本身内容吸引力决定。
<h3 class="p1"><strong>测试点2:不同类型的转化能力</strong></h3>
<span class="s1"><img src="http://img1.tbcdn.cn/tfscom/TB1jn2nKpXXXXamXVXXwu0bFXXX.png" alt="" /></span>

出乎意料的是，对比两种类型的转化能力（广告成交笔数／广告点击uv），半屏方案的转化能力要强于全屏的方案（高6%左右），这说明，虽然全屏方案能分走更多的流量，但从分走流量最终是否促成成交上看，半屏方案的流量质量略胜一筹；分析之后，可能是因为，在全屏方案中，强制用户浏览和点击的作用较强，有较多的用户虽然对广告本身没有太多兴趣，但经由误操作或者一定程度被迫使同样点击了广告，这部分流量的进入，使得全屏方案的流量质量略低；反观b方案，由于其对用户干扰度较低，造成误操作的概率也较少，更多的是用户真的对广告内容感兴趣的情况下才会进入，相比之下，流量的转化能力也就要好一些了。
<h3 class="p1"><strong>测试点3:对原有页面的用户点击转化的影响</strong></h3>
<span class="s1"><img src="http://img2.tbcdn.cn/tfscom/TB1xVnfKpXXXXcaaXXXwu0bFXXX.png" alt="" /></span>

在对原有页面页面用户跳失率（1-页面点击uv／页面uv）的比较上，首先我们对比了全屏方案和半屏方案对整体页面跳失率的影响，发现并没有像预期的干扰度较高的全屏方案对原有页面造成更多的用户跳失，而是两种方案在用户跳失率上，几乎没有差别；之后再对比了“对照组”之后发现，加入两种样式“弹窗广告”的页面跳失率，与没有加入广告的纯净版的页面相比，跳失率也没有明显的变化；分析之后，可能是因为，两个方案，在用户没有任何操作的情况下，都会经过“读秒”后自动关闭，用户同样可以看到原有页面，这种交互形式，还在用户对干扰的可接受范围之内，所以内容本身不会对原有的页面跳失率有负面的影响。（如果有类似的机会，大家可以测测看需要不会读秒关闭的“弹窗广告”对用户跳失率的影响，以及“读秒”时间的长短对用户跳失率的影响）

结合以上的测试结果，对两种形式的弹窗广告给出以下结论和使用建议，希望能对大家有所帮助：
<h3><strong>结论和建议</strong></h3>
<img src="http://img2.tbcdn.cn/tfscom/TB1EMYIKpXXXXbmXXXXwu0bFXXX.png" alt="" />

（ps：本身是一个小测试，过程和结论仅供参考，但通过测试有那么一些小感悟：有些之前觉得理所当然的，顺理成章的结果和设计，在用户实际的使用中，可能并不如预料中的结果，设计中，可能更需要多一些客观验证和量化，而不仅仅是主观和推断，毕竟有时候，用户说想要的，都不一定是他真的想要的，更何况设计者呢）";s:10:"post_title";s:44:"无线端两种弹窗广告方案的A/B test";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:115:"%e6%97%a0%e7%ba%bf%e7%ab%af%e4%b8%a4%e7%a7%8d%e5%bc%b9%e7%aa%97%e5%b9%bf%e5%91%8a%e6%96%b9%e6%a1%88%e7%9a%84ab-test";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-07-21 12:40:49";s:17:"post_modified_gmt";s:19:"2016-07-21 04:40:49";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:24:"http://qisumu.com/?p=558";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}