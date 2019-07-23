Y��Z<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:3:"319";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-07-19 18:36:32";s:13:"post_date_gmt";s:19:"2016-07-19 10:36:32";s:12:"post_content";s:8324:"<img class="fr-fin fr-dib" src="http://img.ui.cn/data/file/9/3/6/709639.png" alt="Image title" width="900" />

如果有一天，设计师只需专注界面设计，不需再做切图和标注的工作；如果有一天，工程师只需专注功能框架建设，不需再花太多心思在标注UI上面；没有如果，这一天真的来了。。。

随着sketch的普及，国内外很多项目团队都陆续用起了sketch＋zeplin的开发模式。不过话说回来，sketch真的有那么好用吗？很多小伙伴们表示用ps好几年了，要我重新学一个软件，臣妾做不到啊！～

其实楼主刚进公司的时候也是这种心情的，没用过mac更没用过sketch,完全的小白用户，当时内心几乎是奔溃的。但是自从接触sketch后，真的是爱不释手，都不想用回ps了。

开篇前先回答两个基本问题
<strong>1、sketch支持windows吗？</strong>
答：不好意思，目前没有！设计师为了提升工作效率，就算吃土一两个月也要买台mac。不过windows用户除了装mac虚拟机外，现在ps也支持zeplin插件了，只要安装个插件，没有mac也照样可以任性的告别切图和标注。
<strong>
2、zeplin支持windows吗？</strong>
答：真够意思，这个必须有！不久前只有mac版，不过zeplin团队怎么会放弃windows那么大块的市场呢。真是喜大普奔，现在zeplin也支持windows了，从此开发哥哥再也不会抱怨网页端的zeplin打开速度超级慢了。

好了，废话不多说，直接进正题。

<strong>首先总结一下sketch＋zeplin的优势：
1、sketch支持多画板，便于同时预览，占用内存较ps小很多；
2、sketch支持导出flinto，便于制作交互动效原型；
3、zeplin解放设计师的双手，从此告别切图和标注；
4、zeplin降低工程师的沟通成本，提高设计还原度。</strong>
那么问题来了，我没有mac怎么破？小伙伴们别灰心，现在ps也支持zeplin了，擦亮双眼往下看，只需三步曲，解放双手指日可待。

<strong>步骤一：
安装软件＋zeplin插件</strong>
<strong>Mac用户：</strong>安装sketch；Zeplin.app；zeplin-sketch插件
直接解压安装即可<strong>
Windows用户：</strong>安装Photoshop CC2015；Zeplin.app；zeplin－ps插件&amp;面板

<strong>如何安装的Photoshop插件？</strong>
通常，当你启动Zeplin，插件应自动安装。但是，如果你有问题，请确保你有最新的Photoshop CC2015年的版本。两件需要安装，插件和面板。

<strong>安装教程：</strong>
1、插件
解压并拷贝“io.zeplin.photoshop-plugin”到
“/Applications/Adobe Photoshop CC 2015/Plug-ins/Generator”文件夹中粘贴。
2、面板：
解压并拷贝“io.zeplin.photoshop-panel”到
“~/Library/Application Support/Adobe/CEP/extensions”文件夹中粘贴。
现在，当你重新启动你的Photoshop，你会看到在菜单中Zeplin面板往上顶：窗口&gt;扩展&gt; Zeplin

<strong>步骤二：
注册zeplin迭代帐号，邀请项目人员。  </strong>

打开zepelin官网：https://www.zeplin.io/
点击菜单栏的sign up free进入注册页面。

<img class="fr-image-dropped fr-fin fr-dib" src="http://img.ui.cn/data/file/8/9/5/709598.png" alt="Image title" width="900" />

<strong>首先要申请三个账号：</strong>
iOS一个，因为ios的单位是pt，导出的切图是3张图；(x,@2x,@3x)

andriod一个，因为andriod的单位是dp，导出的切图是5张图(mdpi,hdpi,xhdpi,xxhdpi,xxxhdpi)
以上两个供设计师使用，用做上传文件迭代管理。

开发一个，供iOS,andriod,前端开发人员使用。

<img class="fr-fin fr-dib" src="http://img.ui.cn/data/file/8/3/6/709638.png" alt="Image title" width="900" />

<strong>Tips：</strong>
Email建议用团队统一注册的账号并归档，不建议用个人的qq邮箱；
Username建议结合项目名称，方便好记即可，当然如果想用QQ,邮箱或个人生日也可以，你开心就好（曾经我用导师建的账号，结果不知不觉记住了导师的QQ&amp;出生年月日，哈哈）

<strong>其次，登录你刚申请的账号，进入首页点击create，选择你要创建的项目，例如iOS；</strong><img class="fr-fin fr-dib" src="http://img.ui.cn/data/file/5/0/6/709605.png" alt="Image title" width="900" />

<strong>第三，选择画板尺寸，建议选择1x（前提是sketch作图时也是用1x做的，也就是375*667）；如果是用ps做的，一般选择2x，也就是750*1334）</strong>

<img class="fr-fin fr-dib" src="http://img.ui.cn/data/file/2/3/6/709632.png" alt="Image title" width="900" />

<strong>第四，给这个项目命名并邀请项目人员加入</strong>

命名建议：项目名＋版本号＋客户端，例如：VUE-V1.2(iOS)
Density:你刚才选择的画板尺寸，例如:1x
Web app:复制网址并提供账号和密码给开发，开发网页端打开即可查看标注＋导出切图。
invite项目成员加入，建议设计师用一个账号，开发用一个账号。名字下面带有Owner的才有上传修改文件的权限，避免非设计人员误删文件。

<strong>Tips：</strong>
由于一个账号只能免费创建一个项目，而单个项目不能满足快速迭代的需求。
因此，有两种解决方案：
1、只需申请一个账号，登录官网购买，根据自己的需求选择对应的服务。一般选择（25美元／月，创建8个项目），完全可以满足iOS&amp;andriod的迭代需求。
2、申请多个账号

<img class="fr-fin fr-dib" src="http://img.ui.cn/data/file/3/3/6/709633.png" alt="Image title" width="900" />

建议大家有能力的还是选择购买，支持一下zeplin（毕竟为设计师做了这么大的贡献）。然而楼主因为各种原因，默默的选择了方案二，申请了7个账号（6个设计，1个开发）为了降低沟通成本，减少开发哥哥的记忆负担，我把每个对应的设计账号邀请开发账号加入，最后开发只要登陆一个账号，就可以看到所有迭代版本的设计图，方便很多吧！

<img class="fr-fin fr-dib" src="http://img.ui.cn/data/file/4/3/6/709634.png" alt="Image title" width="900" />

<strong>Tips：</strong>
建议web端单独建一个项目文件上传，不要和ios的一起。虽然图是共用的，都有3个倍率的图，但是web端可以支持一键导出代码，把这个小诀窍告诉前端，可可大大减少前端工作量。顺便，让前端请你粗个饭吧，哈哈！

<img class="fr-fin fr-dib" src="http://img.ui.cn/data/file/5/3/6/709635.png" alt="Image title" width="900" />

<strong>步骤三：
把sketch或ps里的文件导出到zeplin</strong>

当你在sketch里完成设计稿时，你只需要再做两个操作，就可以成功的和切图标注say goodbye了。
1、 找到界面里需要切图的地方，选择切片工具或者快捷键s，并把切片的虚框和对应要切片的图层放到一个组。然后选中切片的虚框，在右上角的切片属性里设置切片 大小并选中export group contents only,这一步很重要，不然到时候开发导出的切图会有背景。

2、选中切片后的画板(支持多个同时选），点击菜单plugins—zeplin—export selected artboard或者快捷键“⌘+E”,上传成功后屏幕右上方会弹出一个export completed的提醒。

<img class="fr-fin fr-dib" src="http://img.ui.cn/data/file/0/2/6/709620.png" alt="Image title" width="900" />

当你做完这三步曲后，你只要复制一个项目网址给到开发。开发哥哥打开对应的界面，哪里需要点哪里。单击即可看到对应字体的属性，边距，还支持一键导出代码，对比一下之前标注＋切图的工作模式，是不是方便了很多？

<img class="fr-fin fr-dib" src="http://img.ui.cn/data/file/6/3/6/709636.png" alt="Image title" width="900" />

终于可以从枯燥的体力活中解放出来，再也不用跟开发扯皮或者一对一的去调整界面了，想想就很激动，终于可以多留出点时间学（ba)习(mei)了。以上是结合项目迭代的经验分享，在使用过程中欢迎小伙伴们多多交流和分享～";s:10:"post_title";s:35:"告别切图标注-Sketch/PS+Zeplin";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:69:"%e5%91%8a%e5%88%ab%e5%88%87%e5%9b%be%e6%a0%87%e6%b3%a8-sketchpszeplin";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-07-19 18:36:32";s:17:"post_modified_gmt";s:19:"2016-07-19 10:36:32";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:24:"http://qisumu.com/?p=319";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}