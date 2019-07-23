^ߐZ<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:3:"536";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-07-21 12:15:47";s:13:"post_date_gmt";s:19:"2016-07-21 04:15:47";s:12:"post_content";s:9492:"<img class="alignleft size-full wp-image-13403" src="http://uedc.163.com/wp-content/uploads/2016/03/banner.png" sizes="(max-width: 600px) 100vw, 600px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/banner-150x48.png 150x, http://uedc.163.com/wp-content/uploads/2016/03/banner-300x96.png 300x, http://uedc.163.com/wp-content/uploads/2016/03/banner.png 600x" alt="banner" width="600" height="192" />

曾几何时，每次交互稿都是徒手画，或者截个图在现有的界面上改造。渐渐感到同一平台，每个版本都有很多重复劳动，是时候做个交互组件库了~
<span id="more-13069"></span>

<strong>什么是组件库？</strong>
就是类似axure左侧栏的这一坨标准控件，方便直接拖拽使用。

<img class="size-full wp-image-13389 alignleft" src="http://uedc.163.com/wp-content/uploads/2016/03/axure%E9%BB%98%E8%AE%A4%E7%BB%84%E4%BB%B6.png" alt="axure默认组件" width="255" height="303" />

但如何制作满足自己产品需要的交互组件库，一开始是模糊的。最初只是根据自己的需要随便列一些出来，在做的过程中逐渐清晰。

<strong>交互组件库的作用：</strong>
<ul>
 	<li>提高个人工作效率</li>
 	<li>方便多人合作</li>
 	<li>使交互文档具有统一美</li>
</ul>
<strong>哪些东西可以做成交互组件？</strong>
只需记住一点：当你感觉到某种UI组合，每次都需要重新画一遍的时候，就可以考虑把这种UI组合做成交互组件。

上面所说的“重复劳动”对不同人来说可能定义不尽相同。比如对我来说，即使把Tab的选中状态变一下，也是一种重复劳动。那我就会把不同Tab的选中状态都做一份。这样等到要制作“我的音乐”相关交互的时候，直接把下面第二个组件拖过去就可以了。

<img class="alignleft size-full wp-image-13390" src="http://uedc.163.com/wp-content/uploads/2016/03/%E5%BA%95%E9%83%A8%E5%AF%BC%E8%88%AA.png" sizes="(max-width: 357px) 100vw, 357px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/%E5%BA%95%E9%83%A8%E5%AF%BC%E8%88%AA-300x249.png 300x, http://uedc.163.com/wp-content/uploads/2016/03/%E5%BA%95%E9%83%A8%E5%AF%BC%E8%88%AA.png 357x" alt="底部导航" width="357" height="296" />
但对于某些Tab组合来说，每个Tab底下的内容可能是差不多的，做交互的时候往往只需要表达第一个Tab下的页面就可以了。这种我就只把第一个Tab的选中状态做一下。总得来说，怎样对自己方便就怎样做。

<img class="alignleft size-full wp-image-13391" src="http://uedc.163.com/wp-content/uploads/2016/03/%E4%BA%8C%E7%BA%A7tab.png" sizes="(max-width: 347px) 100vw, 347px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/%E4%BA%8C%E7%BA%A7tab-300x55.png 300x, http://uedc.163.com/wp-content/uploads/2016/03/%E4%BA%8C%E7%BA%A7tab.png 347x" alt="二级tab" width="347" height="64" />

<strong>交互组件应该具备的特点：</strong>
组件组件，最大的一个特点就是可组合性。整理的时候，思考哪些UI组合是不同页面都会共用的，把这些元素剥离出来，就成了交互组件。根据自己的经验，我会把组件归为几大类：

<strong>顶栏类：</strong>

<img class="alignleft size-full wp-image-13405" src="http://uedc.163.com/wp-content/uploads/2016/03/%E9%A1%B6%E6%A0%8F%E7%B1%BB.png" sizes="(max-width: 688px) 100vw, 688px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/%E9%A1%B6%E6%A0%8F%E7%B1%BB-300x203.png 300x, http://uedc.163.com/wp-content/uploads/2016/03/%E9%A1%B6%E6%A0%8F%E7%B1%BB.png 688x" alt="顶栏类" width="688" height="465" />

<strong>导航类：</strong>

<img class="alignleft size-full wp-image-13392" src="http://uedc.163.com/wp-content/uploads/2016/03/%E5%AF%BC%E8%88%AA%E7%B1%BB.png" sizes="(max-width: 353px) 100vw, 353px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/%E5%AF%BC%E8%88%AA%E7%B1%BB-213x300.png 213x, http://uedc.163.com/wp-content/uploads/2016/03/%E5%AF%BC%E8%88%AA%E7%B1%BB.png 353x" alt="导航类" width="353" height="497" />

<strong>弹窗类：</strong>

<img class="alignleft size-full wp-image-13393" src="http://uedc.163.com/wp-content/uploads/2016/03/%E5%BC%B9%E7%AA%97%E7%B1%BB.png" sizes="(max-width: 567px) 100vw, 567px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/%E5%BC%B9%E7%AA%97%E7%B1%BB-300x241.png 300x, http://uedc.163.com/wp-content/uploads/2016/03/%E5%BC%B9%E7%AA%97%E7%B1%BB.png 567x" alt="弹窗类" width="567" height="456" />

<strong>弹出浮层类：</strong>

<img class="alignleft size-full wp-image-13394" src="http://uedc.163.com/wp-content/uploads/2016/03/%E5%BC%B9%E5%87%BA%E6%B5%AE%E5%B1%82.png" sizes="(max-width: 1049px) 100vw, 1049px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/%E5%BC%B9%E5%87%BA%E6%B5%AE%E5%B1%82-300x173.png 300x, http://uedc.163.com/wp-content/uploads/2016/03/%E5%BC%B9%E5%87%BA%E6%B5%AE%E5%B1%82-1024x591.png 1024x, http://uedc.163.com/wp-content/uploads/2016/03/%E5%BC%B9%E5%87%BA%E6%B5%AE%E5%B1%82.png 1049x" alt="弹出浮层" width="1049" height="605" />

<strong>toast类：</strong>

<img class="alignleft size-full wp-image-13395" src="http://uedc.163.com/wp-content/uploads/2016/03/toast%E7%B1%BB.png" sizes="(max-width: 591px) 100vw, 591px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/toast%E7%B1%BB-150x148.png 150x, http://uedc.163.com/wp-content/uploads/2016/03/toast%E7%B1%BB-300x296.png 300x, http://uedc.163.com/wp-content/uploads/2016/03/toast%E7%B1%BB.png 591x" alt="toast类" width="591" height="583" />

<strong>列表类：</strong>

<img class="alignleft size-full wp-image-13396" src="http://uedc.163.com/wp-content/uploads/2016/03/%E5%88%97%E8%A1%A8%E7%B1%BB.png" sizes="(max-width: 940px) 100vw, 940px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/%E5%88%97%E8%A1%A8%E7%B1%BB-150x47.png 150x, http://uedc.163.com/wp-content/uploads/2016/03/%E5%88%97%E8%A1%A8%E7%B1%BB-300x94.png 300x, http://uedc.163.com/wp-content/uploads/2016/03/%E5%88%97%E8%A1%A8%E7%B1%BB.png 940x" alt="列表类" width="940" height="296" />

<strong>键盘类：</strong>

<img class="alignleft size-full wp-image-13397" src="http://uedc.163.com/wp-content/uploads/2016/03/%E9%94%AE%E7%9B%98%E7%B1%BB.png" sizes="(max-width: 1054px) 100vw, 1054px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/%E9%94%AE%E7%9B%98%E7%B1%BB-150x79.png 150x, http://uedc.163.com/wp-content/uploads/2016/03/%E9%94%AE%E7%9B%98%E7%B1%BB-300x159.png 300x, http://uedc.163.com/wp-content/uploads/2016/03/%E9%94%AE%E7%9B%98%E7%B1%BB-1024x541.png 1024x, http://uedc.163.com/wp-content/uploads/2016/03/%E9%94%AE%E7%9B%98%E7%B1%BB.png 1054x" alt="键盘类" width="1054" height="557" />

<strong>icon类：</strong>

<img class="alignleft size-full wp-image-13398" src="http://uedc.163.com/wp-content/uploads/2016/03/icon%E7%B1%BB.png" sizes="(max-width: 374px) 100vw, 374px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/icon%E7%B1%BB-233x300.png 233x, http://uedc.163.com/wp-content/uploads/2016/03/icon%E7%B1%BB.png 374x" alt="icon类" width="374" height="481" />

另外，一些常用的主界面和内容页我也会做成组件。这样当我要拿搜索页说事儿的时候，就可以直接把整个搜索页拖过去，而不需要花时间再搭一遍积木了。

<img class="alignleft size-full wp-image-13399" src="http://uedc.163.com/wp-content/uploads/2016/03/%E5%86%85%E5%AE%B9%E9%A1%B5.png" sizes="(max-width: 950px) 100vw, 950px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/%E5%86%85%E5%AE%B9%E9%A1%B5-300x187.png 300x, http://uedc.163.com/wp-content/uploads/2016/03/%E5%86%85%E5%AE%B9%E9%A1%B5.png 950x" alt="内容页" width="950" height="592" />

单个交互组件应该具备的特点：可编辑性。PNG图标、文字、选中……每一个元素都是可以单独编辑的。

<img class="alignleft size-full wp-image-13400" src="http://uedc.163.com/wp-content/uploads/2016/03/%E5%8F%AF%E7%BC%96%E8%BE%91%E6%80%A7.png" sizes="(max-width: 355px) 100vw, 355px" srcset="http://uedc.163.com/wp-content/uploads/2016/03/%E5%8F%AF%E7%BC%96%E8%BE%91%E6%80%A7-150x38.png 150x, http://uedc.163.com/wp-content/uploads/2016/03/%E5%8F%AF%E7%BC%96%E8%BE%91%E6%80%A7-300x76.png 300x, http://uedc.163.com/wp-content/uploads/2016/03/%E5%8F%AF%E7%BC%96%E8%BE%91%E6%80%A7.png 355x" alt="可编辑性" width="355" height="90" />

<strong>组件的颜色？</strong>
尽量以黑(性)白(冷)灰(淡)风格为主。

<strong>如何把各种组件想全？</strong>
不用想全，边做边补。所以不同平台的交互组件库应该有专人维护更新，才能保证组件库始终好用。这点其实知易行难，一定要提醒自己“磨刀不误砍柴工”。

<strong>组件边上需要写说明文字吗？</strong>
个人喜好组件边上不写任何说明文字，组件的名字已经反映在axure文档的侧导航上。只要侧导航分类符合心智模型（好找），页面上清清爽爽的组件（方便拖拽），就能满足我的需求了。

组件库是给画交互稿的人用的，不是给别人看的。给别人看的是另外一种东西，交互规则库，那种需要说明文字。

<strong>因此，判断一个交互组件库是否好用的标准是：</strong>
<ul>
 	<li>你自己是不是经常使用自己的组件库</li>
 	<li>别人乐不乐意使用你的组件库</li>
</ul>";s:10:"post_title";s:27:"如何制作交互组件库";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:81:"%e5%a6%82%e4%bd%95%e5%88%b6%e4%bd%9c%e4%ba%a4%e4%ba%92%e7%bb%84%e4%bb%b6%e5%ba%93";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-07-21 12:15:47";s:17:"post_modified_gmt";s:19:"2016-07-21 04:15:47";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:24:"http://qisumu.com/?p=536";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}