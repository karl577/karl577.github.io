Y��Z<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:4:"1931";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-08-12 16:53:21";s:13:"post_date_gmt";s:19:"2016-08-12 08:53:21";s:12:"post_content";s:8679:"<blockquote>
<p class=""><strong>小编：</strong>今天和大家分享的是以物流服务为例的服务设计中的关于地址选择器的设计。感谢@<a href="http://i.ui.cn/ucenter/130189.html" target="_blank">Razer_YjJjJ</a>的分享。下面有五种地址选择器，希望对大家做设计的时候有帮助。</p>
<span id="pos_placeholder"></span>往期教程：

你问我什么是服务设计？<a href="http://www.xueui.cn/design-theory/thinking-about-service-design.html?ref=r" target="_blank">《关于服务设计的思考》</a>

你想知道怎么做体验地图？<a href="http://www.xueui.cn/design-theory/experience-map-in-service-design.html?ref=r" target="_blank">《服务设计中的体验地图》</a></blockquote>
之前一直在做物流项目，由于用户的特殊性（40岁左右用户，大部分学历初中），在用地址选择器的时候我们讨论了非常多，并做了一系列的用户调研，那么针对这个地址选择器的样式以及使用场景还有优劣我下面做一些分析，希望有特别好的建议一起讨论：

<strong>1.底部picker式</strong>

<strong>微信</strong>

<img class="alignnone size-large wp-image-70599" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/%E5%BE%AE%E4%BF%A1-575x1024.jpeg" alt="weixin" width="575" height="1024" data-bd-imgshare-binded="1" />

<strong>有货</strong>

<img class="alignnone size-large wp-image-70602" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/%E6%9C%89%E8%B4%A7-575x1024.jpeg" alt="youhuo" width="575" height="1024" data-bd-imgshare-binded="1" />

<strong>enjoy</strong>

<img class="alignnone size-large wp-image-70603" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/enjoy-575x1024.jpeg" alt="enjoy" width="575" height="1024" data-bd-imgshare-binded="1" />

<strong>新浪</strong>

<img class="alignnone size-large wp-image-70601" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/%E6%96%B0%E6%B5%AA%E5%BE%AE%E5%8D%9A-576x1024.png" alt="xinlangweibo" width="576" height="1024" data-bd-imgshare-binded="1" />

第一种底部滑出的picker式，这个形式的选择器，用到的应该是占很大一部分，我们能看到它通常是用在个人信息的编辑场景中选择地址的时候，优点是占用页面空间小，能实时预览其他信息，地址联动性较强。缺点是一屏展示的信息过少，找地址时如果想要找的地址太靠下，那需要花的时间成本就较大。

所用到的手势操作是：滑（很久）－点－滑－点。

<strong>2.列表选择式</strong>

<strong>途牛</strong>

<img class="alignnone size-large wp-image-70598" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/%E9%80%94%E7%89%9B-575x1024.jpeg" alt="tuniu" width="575" height="1024" data-bd-imgshare-binded="1" />

<strong>口碑</strong>

<img class="alignnone size-large wp-image-70609" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/%E5%8F%A3%E7%A2%91-575x1024.jpeg" alt="koubei" width="575" height="1024" data-bd-imgshare-binded="1" />

<strong>空格</strong>

<img class="alignnone size-large wp-image-70608" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/%E7%A9%BA%E6%A0%BC-575x1024.jpeg" alt="kongge" width="575" height="1024" data-bd-imgshare-binded="1" />

列表选择，这个选择器一般用在首页定位和选择起始地目的地的时候选择地址用的较多，定位的时候一般定位到城市即可，不需要选择省，再到市，最后到区，并且用户需要重新切换城市的时候直接可以通过lbs定位来切换，并不需要频繁的去操作切换。优点是可以根据右侧字母来找城市，也很快捷。缺点是使用场景较少，无法做联动选择多级省市区。

所用到的手势操作是：点／滑－滑－点。

<strong>3.下滑联动式</strong>

<strong>链家</strong>

<img class="alignnone size-large wp-image-70597" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/%E9%93%BE%E5%AE%B6-575x1024.jpeg" alt="lianjia" width="575" height="1024" data-bd-imgshare-binded="1" />

<strong>Q房网</strong>

<img class="alignnone size-large wp-image-70605" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/q%E6%88%BF%E7%BD%91-575x1024.jpeg" alt="Qfangwang" width="575" height="1024" data-bd-imgshare-binded="1" />

下滑联动，这种形式的选择器一般会用在首页做实时地址联动的时候，不会遮挡后面的主要内容信息，在选择完地址之后能立即看到地址的筛选结果。优点是能快速选择多级地址，并且层级分明，扩展性较强可以做成地址多选。缺点和一有点类似，并且也不够直观。

所用到的手势操作是：滑－点－滑－点－点。

<strong>4.列表跳转式</strong>

<strong>mono</strong>

<img class="alignnone size-large wp-image-70604" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/mono-575x1024.jpeg" alt="mono" width="575" height="1024" data-bd-imgshare-binded="1" />

<strong>蜗牛</strong>

<img class="alignnone size-large wp-image-70600" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/%E8%9C%97%E7%89%9B-575x1024.jpeg" alt="woniu" width="575" height="1024" data-bd-imgshare-binded="1" />

列表跳转式。这种类似是2和3的合并式，但是这样的地址选择器有点不伦不类，既不能高效又不是很直观，选择二级或三级之后有时会忘了上一级的内容又要切换到上一级，所以mono这个有点逼格的app用这样的选择器我就不是很理解，它也是用于信息编辑时候的地址选择，首先省是列表选择，这样的选择的效率没有平铺的效率高，人眼习惯扫视横向内容，所以横向的内容获取往往要比纵向的多，既然后面都是要到选择城市，那可以跟2列表选择那样全部城市列出来按字母来搜索。他所要用到的手势操作有：滑－点－点。

<strong>5.平铺式</strong>

<strong>货车帮</strong>

<img class="alignnone size-large wp-image-70607" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/%E8%B4%A7%E8%BD%A6%E5%B8%AE-575x1024.jpeg" alt="huochebang" width="575" height="1024" data-bd-imgshare-binded="1" />

平铺式。采用平铺式的地址选择器能一眼就看清楚所有地址，但是需要扫描一遍内容才能找到，这样的方式适用于频繁性进行模糊地址搜索，经常使用便形成记忆，再此搜索的时候就能形成记忆点击，效率很高。优点就是直观，适用于频繁性搜索，并且扩展性强，如地址多选。例如货运等app。缺点就是刚开始使用时候地址搜索没有1，3那么有效率。

所用到的手势操作是：点－点－点

其实以上说到的5个地址选择方式是针对不同的场景使用的，并没有特别冲突的地方，除了4之外。1对应的场景是信息编辑时候所用到的下滑展示。2对应的场景是首页定位，再进行地址切换时候的地址选择。3.使用的场景是首页多tab下多级选择，这种选择器不仅是地址选择，外卖应用，生鲜专送等多app的多层级选择也经常使用到。5.使用场景和3类似，但是跟3不同的是，下滑联动式可以直观看到1，2，3级内容，而平铺式这点就做不到了。

下面要列举一个错误示例：
今天在写这篇文章的时候偶然发现的案例：

<img class="alignnone size-large wp-image-70606" src="http://78rbeb.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/%E5%8F%8D%E9%9D%A2%E6%A1%88%E4%BE%8B-575x1024.jpeg" alt="fanmiananli" width="575" height="1024" data-bd-imgshare-binded="1" />

其实有点冤枉它。这个产品的微信推广h5页面的地址选择器和iOS原生app的地址选择器还不一样，但是这个地址选择器还是免不了想要吐槽一下：点击选择省份底部弹出picker，再点击选择城市再滑动选择，实在是让用户花了好多时间。

<strong>总结：</strong>

每一种地址选择器都有各自所适用的场景，根据不同的场景做设计才是我们需要思考的。一个小小的地址选择器也能看出我们对产品及用户的理解，怎样提高产品的可用性，我们要对各种细节去详细处理，如何提高用户完成操作的效率，以及有效性。如果觉得两种方案都可以也可以去针对性的做ab测试，看看哪种方案效率更高，操作更流畅。";s:10:"post_title";s:36:"地址选择器的五大类型解析";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:108:"%e5%9c%b0%e5%9d%80%e9%80%89%e6%8b%a9%e5%99%a8%e7%9a%84%e4%ba%94%e5%a4%a7%e7%b1%bb%e5%9e%8b%e8%a7%a3%e6%9e%90";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-08-12 16:57:18";s:17:"post_modified_gmt";s:19:"2016-08-12 08:57:18";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:25:"http://qisumu.com/?p=1931";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}