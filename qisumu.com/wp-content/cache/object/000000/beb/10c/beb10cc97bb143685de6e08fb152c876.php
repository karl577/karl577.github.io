yːZ<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:2167;s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-01-22 20:04:51";s:13:"post_date_gmt";s:19:"2016-01-22 12:04:51";s:12:"post_content";s:5341:"最小的分辨率是320x480，我们把这个尺寸定为基准界面尺寸（baseline），基准尺寸所用的图标定为1倍图（1x）。

在实际设计过程中，为了降低设计成本，一般拿设备最高的分辨率作为设计稿的原始尺寸，拿iphone来说就是iphone5或5s的640x1136啦，当然也可以用iphone4或4s的640x960，因为宽度都是640px，他们切图的标准是一样的。显然，以1倍图的基准尺寸（宽320px）为相对的参考依据，宽640px的设计稿，以原始尺寸切出来的图标称为2倍图（2x）。

有人可能会问：为什么不拿320px作为设计稿的原始尺寸呢？因为1倍图放大成为2倍图远比2倍图缩小成1倍图来得模糊！

于是，在不考虑iphone6和iphone 6 plus的情况下，为了适配iphone，每个图标需要切两份。
<h3></h3>
<h3>Android - 更为繁多的界面尺寸</h3>
Android开源自由的代价就是设备规范的不可控，市面上充斥着各种品牌的android手机，有着各种各样的尺寸和分辨率，为了适配各种不同分辨率的设备，同一个图标需要切成N份，每一份对应一个尺寸。

另外需要注意的是，Android里面开发用的尺寸单位是dp或sp（dp为元素表现尺寸，sp为字体尺寸）而不是iphone中的px。。。

对于分辨率繁多的android设备，为了方便原生应用的界面适配，Google按照dpi大小将它们分成了4中模式（MDPI、HDPI、XHDPI和XXHDPI，也许有一天会增加第五种XXXHDPI，谁知道呢）：

<img title="原生App切图的那些事儿" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/20020964C-1.jpg" alt="原生App切图的那些事儿" />

看到这里，传统的web前端同学可能已经凌乱了，iphone用px，android用dp，而视觉设计稿则统一用的px，怎么将使用px作为单位的psd给使用dp作为单位的android app切图啊???

显然，我们得花点脑细胞去弄清楚px与dp的换算关系。
<h3>px与dp的换算关系</h3>
一般情况下，手机分辨率与所运行的dpi模式是匹配的，例如hvga(320x480像素)的手机屏幕一般在3.5英寸左右，运行在mdpi模式下。当运行在mdpi下时，1dp=1px：也就是说设计师以320x480作为设计稿的尺寸时，在PS里定义一个item高48px，开发就会定义该item高48dp；Photoshop中14px大的字体，开发会定义为14sp。

对于一部wvga（480x800像素）的手机（G7、N1、NS），一般是运行在hdpi模式下。当运行在hdpi模式下时，1dp=1.5px：也就是说设计师以480x800作为设计稿的尺寸时，在PS里定义一个item高72px，开发就会定义该item高48dp；Photoshop中21px大的字体，开发会定义为14sp。

关于px与dp的更多详细信息，请参考文章<a href="http://www.zhihu.com/question/19625584">http://www.zhihu.com/question/19625584</a>
<h3>IPhone应用切图尺寸与Android应用切图尺寸的对应关系</h3>
在Android应用中，以MDPI为基准界面尺寸，恰好对应上面提及的iphone应用的基准界面尺寸（320x480），所需的切图图标为iphone中对应的1倍图；XHDPI则对应2倍图，HDPI和XXHDPI可依此类推。

<img title="原生App切图的那些事儿" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/2002092428-2.jpg" alt="原生App切图的那些事儿" />

换一种说法再看看：如果要以最低的设计成本做一个app，iphone版和android版用的同一套设计稿，那么设计稿的尺寸最好是640x960像素。因为这个尺寸切出来的图标尺寸涵盖了iphone 3 ~ 5的分辨率，以及android的MDPI、HDPI、XHDPI模式。XXHDPI模式会自动利用低一级的XHDPI的图标进行放大展示。
<h3>把切图交给工具</h3>
看了上面提及的各种界面尺寸，如果全手工切，一次切完你能忍。如果切完了还有各种图标的增加、修改，没几次你多半会崩溃血喷屏幕～

幸好我们有一些很好的切图工具可以用，具体使用方法可参考它们的官网教程。
<h4>推荐切图工具1 - <a href="http://77g2n3.com2.z0.glb.qiniucdn.com/v/23561.html" target="_self">cut&amp;slice me</a></h4>
&nbsp;

<img title="原生App切图的那些事儿" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/2002091252-3.jpg" alt="原生App切图的那些事儿" />
<h4>推荐切图工具2 - <a href="http://77g2n3.com2.z0.glb.qiniucdn.com/v/24899.html" target="_self">cutterman</a></h4>
<img title="原生App切图的那些事儿" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/20020933S-4.jpg" alt="原生App切图的那些事儿" />
<h4>推荐切图工具3 - <a href="http://77g2n3.com2.z0.glb.qiniucdn.com/v/25142.html" target="_blank">devRocket</a></h4>
<img title="原生App切图的那些事儿" src="http://77g2n3.com2.z0.glb.qiniucdn.com/images/201411/2002093211-5.jpg" alt="原生App切图的那些事儿" />

注：damao推荐，看了官网好像很强悍的样子，但是收费哦。
<h2></h2>
<h2>小结</h2>
借助工具，原生App中的切图变得简易，但是“一个图标要切多套尺寸”的问题依旧没有改变，有没有更好的图标解决方案呢？譬如应用网页应用中的图标字体？ 敬请期待《Iconfont在原生App中的应用》。";s:10:"post_title";s:30:"原生App切图的那些事儿";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:84:"%e5%8e%9f%e7%94%9fapp%e5%88%87%e5%9b%be%e7%9a%84%e9%82%a3%e4%ba%9b%e4%ba%8b%e5%84%bf";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-08-22 20:05:33";s:17:"post_modified_gmt";s:19:"2016-08-22 12:05:33";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:25:"http://qisumu.com/?p=2167";s:10:"menu_order";i:0;s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}