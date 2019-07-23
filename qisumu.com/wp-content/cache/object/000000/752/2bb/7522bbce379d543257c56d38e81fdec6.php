���Z<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:4:"1401";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-08-01 10:46:15";s:13:"post_date_gmt";s:19:"2016-08-01 02:46:15";s:12:"post_content";s:14543:"国内关注<span class="wp_keywordlink_affiliate"><a title="查看 VR 中的全部文章" href="http://www.uisdc.com/tag/vr" target="_blank">VR</a></span>的设计师不多，能持续关注并产出优质内容的设计师更是凤毛麟角，建议想跟上趋势的同学多关注腾讯高级交互设计师<a href="http://weibo.com/u/1833937113" target="_blank">@C7210</a> 。今天他的译文实战性很强，包括从<span class="wp_keywordlink_affiliate"><a title="查看 Unity 中的全部文章" href="http://www.uisdc.com/tag/unity" target="_blank">Unity</a></span>商店下载环境资源、在项目中使用<span class="wp_keywordlink_affiliate"><a title="查看 Google VR 中的全部文章" href="http://www.uisdc.com/tag/google-vr" target="_blank">Google VR</a></span> <span class="wp_keywordlink_affiliate"><a title="查看 Unity 中的全部文章" href="http://www.uisdc.com/tag/unity" target="_blank">Unity</a></span> SDK提供的组件及第三方脚本等等。

欢迎关注译者（交互设计师、猫奴、吉他手、鼓手、老狗，现就职于腾讯ISUX）的微信公众号：Beforweb

这儿有他的访谈：<a href="http://www.uisdc.com/uisdc-designer-interview-c7210" target="_blank">《优设访谈！腾讯高级交互设计师C7210的十年设计路》</a>

<a href="http://weibo.com/u/1833937113" target="_blank">@C7210</a> ：时至今日，多少已经对<span class="wp_keywordlink_affiliate"><a title="查看 VR 中的全部文章" href="http://www.uisdc.com/tag/vr" target="_blank">VR</a></span>世界有些神往了吧？作为设计师，是否已经有了上手的兴趣？大家都差不多的样子。最近，有几篇不错的文章给到我(英文原文作者)一些启示，包括：
<ul>
 	<li><a href="https://medium.com/google-design/from-product-design-to-virtual-reality-be46fa793e9b#.9cw3qwi0n" target="_blank">From product design to virtual reality</a>(Medium，墙外，作者Jean-Marc Denis，Beforweb译文版：<a href="http://www.uisdc.com/vr-design-starter-guideline" target="_blank">从二维界面到虚拟现实</a>)</li>
 	<li><a href="https://medium.com/facebook-design/a-month-designing-in-vr-62474aef1f1c#.q2u3awfec" target="_blank">A month designing in VR</a>(Medium，墙外，作者Julius Tarng)</li>
 	<li><a href="https://ustwo.com/blog/designing-for-virtual-reality-google-cardboard/" target="_blank">Designing for virtual reality</a>(ustwo出品)</li>
</ul>
经过简单的研究与学习，我发现即便不曾有过3D设计或脚本编写等方面的背景经验，你仍然有可能创建出最基础最简单的VR世界，并以app的形式部署到手机当中，然后通过<span class="wp_keywordlink_affiliate"><a title="查看 Cardboard 中的全部文章" href="http://www.uisdc.com/tag/cardboard" target="_blank">Cardboard</a></span>进行体验。对产出形式没什么概念？我做的这款<a href="https://play.google.com/store/apps/details?id=com.liuliu.polyvr" target="_blank">PolyLand VR</a>就是实际范例；而具体的实践方法就是我将要在本文当中与各位分享的。
<h4><strong>所需要的工具</strong></h4>
<ul>
 	<li><span class="wp_keywordlink_affiliate"><a title="查看 Cardboard 中的全部文章" href="http://www.uisdc.com/tag/cardboard" target="_blank">Cardboard</a></span>：我个人使用Google Cardboard；其他Cardboard类设备也可。</li>
 	<li><span class="wp_keywordlink_affiliate"><a title="查看 Unity 中的全部文章" href="http://www.uisdc.com/tag/unity" target="_blank">Unity</a></span>：<a href="http://unity3d.com/get-unity" target="_blank">下载</a>并安装最新的免费个人版本即可。</li>
 	<li>Android SDK：<a href="http://developer.android.com/sdk/index.html#Other" target="_blank">下载</a>并安装最新的Android开发工具包(本文以Android平台作为演示；相似的方法同样可以用于iOS，详见“Unity与Cardboard app基础实践-1”一文)。</li>
 	<li><span class="wp_keywordlink_affiliate"><a title="查看 Google VR 中的全部文章" href="http://www.uisdc.com/tag/google-vr" target="_blank">Google VR</a></span> Unity SDK：<a href="https://github.com/googlesamples/cardboard-unity" target="_blank">在GitHub下载</a>；其中包含了SDK以及Google官方提供范例项目。</li>
 	<li>用于Google VR Unity SDK的自动行走脚本：<a href="https://github.com/JuppOtto/Google-Cardboard" target="_blank">在GitHub下载</a>；作者Jupp Otto。</li>
</ul>
我们将要一起学习制作的是一个非常简单的VR环境；在实际运行时，你可以通过头显上的按钮来打开或关闭自动行走功能。
<h4><strong>第1步：构建3D环境</strong></h4>
打开Unity，新建3D项目：

<img class="alignnone size-full wp-image-194917" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb201607301.png" alt="sb201607301" width="800" height="484" />

我将会使用<a href="https://www.assetstore.unity3d.com/en/#!/content/35361" target="_blank">Forest Environment</a>这套免费的模型来搭建环境，你也可以在<a href="https://www.assetstore.unity3d.com/en/#!/home" target="_blank">Unity资源商店</a>随便逛逛，选择自己更加喜欢的环境模型拿回来用。在资源页面中点击Open in Unity按钮，Unity会自动将其加载到Asset Store面板当中。点击面板上的Download按钮(需要注册并登录Unity帐户；Unity不允许用户直接通过网页下载资源)：

<img class="alignnone size-full wp-image-194918" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb201607302.png" alt="sb201607302" width="800" height="450" />
<div>

注意：如无法下载，请尝试VPN。

</div>
下载完成之后，在Import Unity Package对话框中，确保所有资源都有被勾选，然后点击Import按钮：

<img class="alignnone size-full wp-image-194919" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb201607303.png" alt="sb201607303" width="800" height="450" />

在Project面板当中，按照下图所示的路径找到demoScene_free.unity文件，双击，然后我们下载到的环境模型便会被加载到Scene面板中：

<img class="alignnone size-full wp-image-194920" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb201607304.png" alt="sb201607304" width="800" height="450" />

点击顶部的Play按钮，在Game模式中查看一下目前的实际效果：

<img class="alignnone size-full wp-image-194921" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb201607305.png" alt="sb201607305" width="800" height="450" />
<h4><strong>第2步：安装Google VR Unity SDK</strong></h4>
在左侧的Hierarchy面板中，删除First Person Controller和Main Camera：

<img class="alignnone size-full wp-image-194922" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb201607306.png" alt="sb201607306" width="800" height="450" />

将之前下载的Google VR Unity SDK解压，得到“gvr-unity-sdk-master”文件夹。回到Unity，点击菜单栏中的Assets &gt; Import Package &gt; Custom Package，选择刚刚解压缩的文件夹中的GoogleVRForUnity.unitypackage，点击Open按钮。在接下来弹出的Import Unity Package对话框中，确保所有资源都有被勾选，然后点击Import按钮：

<img class="alignnone size-full wp-image-194923" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb201607307.png" alt="sb201607307" width="800" height="450" /><img class="alignnone size-full wp-image-194924" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb201607308.png" alt="sb201607308" width="800" height="450" /><img class="alignnone size-full wp-image-194925" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb201607309.png" alt="sb201607309" width="800" height="450" />

导入完成后，在Project面板的资源列表中找到Assets &gt; GoogleVR &gt; Legacy &gt; Prefabs文件夹，将其中的GvrMain拖放到Scene面板中：

<img class="alignnone size-full wp-image-194926" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073010.png" alt="sb2016073010" width="800" height="450" /><img class="alignnone size-full wp-image-194927" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073011.png" alt="sb2016073011" width="800" height="450" />

点击Play按钮，界面会自动切换到Game面板。按住alt或control键，同时移动鼠标，测试一下主视角的移动方式。如果测试时发现之前拖放进来的GvrMain在位置上不太合适(主视角漂浮在空中或是位于地面以下)，你可以结束Play模式，回到Scene面板当中对其进行调整 – 在右侧检查器中调整“Position”的值，或是直接通过鼠标移动GvrMain对象均可。

<img class="alignnone size-full wp-image-194928" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073012.png" alt="sb2016073012" width="800" height="450" />
<h4><strong>第3步：添加自动行走功能</strong></h4>
将之前下载的自动行走脚本文件包解压，将其中的Autowalk.cs文件夹拖放到Project面板的Assets根目录下：

<img class="alignnone size-full wp-image-194929" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073013.png" alt="sb2016073013" width="800" height="450" /><img class="alignnone size-full wp-image-194930" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073014.png" alt="sb2016073014" width="800" height="450" />

双击Autowalk文件，使其在MonoDevelop编辑器当中被打开。Command+F，搜索“CardboardHead”，并替换为“GvrHead”；搜索“Cardboard.SDK”，全部替换为“GvrViewer.Instance”，然后保存文件并关闭MonoDevelop。

<img class="alignnone size-full wp-image-194931" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073015.png" alt="sb2016073015" width="800" height="450" /><img class="alignnone size-full wp-image-194932" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073016.png" alt="sb2016073016" width="800" height="450" />

回到Unity，点选主界面左侧Hierarchy面板中的“GvrMain”，然后在主界面右侧的检查器中点击Add Component按钮，在搜索框中输入“autowalk”，点选该文件：

<img class="alignnone size-full wp-image-194933" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073017.png" alt="sb2016073017" width="800" height="450" />

检查器当中会出现新的“Autowalk”选项区。勾选“Walk When Triggered”，将“Speed”设置成“1”(或是你觉得更加合适的数值)：

<img class="alignnone size-full wp-image-194934" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073018.png" alt="sb2016073018" width="800" height="450" />

点击Play按钮，进入Game模式，你会发现在点击鼠标之后主视角会自动向前行进，再次点击则会停下。
<h4><strong>第4步：打包app</strong></h4>
<div>

注意：以下步骤仅针对安卓平台，因此译者并未执行到实际部署环节。iOS方面的流程大同小异，详见上周的<a href="http://www.uisdc.com/google-vr-app-unity-cardboard" target="_blank">「谷歌VR APP实战！UNITY与CARDBOARD APP基础实践（一）」</a>

</div>
点击菜单栏中的File &gt; Build Settings，在弹出的Build Settings窗口中，选择Platforms列表里的“Android”，然后点击列表下方的Player Settings按钮：

<img class="alignnone size-full wp-image-194935" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073019.png" alt="sb2016073019" width="800" height="450" />

Unity主界面右侧的检查器当中会出现PlayerSettings面板。在顶部的Company Name字段里输入公司或组织机构名称。接下来，在“Settings for Android”部分当中，点击“Resolution and Presentation”使其展开，将“Default Orientation”设置为“Auto Rotation”，然后取消勾选“Allowed Orientations for Auto Rotation”下的前三个选项，只保留最后一个“Landscape Left”为选中态：

<img class="alignnone size-full wp-image-194936" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073020.png" alt="sb2016073020" width="800" height="450" />

仍然在“Settings for Android”当中，点击“Other Settings”使其展开，并找到Bundle Identifier字段，在这里为你的app输入一个合法的安装包名称，譬如“com.mycompany.cardboarddemo”，只要遵循“com.&lt;公司或组织名称&gt;.&lt;app名称&gt;”的形式即可：

<img class="alignnone size-full wp-image-194937" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073021.png" alt="sb2016073021" width="800" height="450" />

仍然在“Settings for Android”当中，点击“Publishing Settings”使其展开。如果你没有keystore，那么在这里需要勾选“Create New Keystore”，然后输入密码，并点击“Browse Keystore”。在对话窗口中输入keystore的名称，点击Save按钮。此时在“Browse Keystore”按钮旁边会出现keystore所处的路径(更多信息请参考Android Studio官方文档当中的“<a href="http://developer.android.com/intl/zh-cn/tools/publishing/app-signing.html" target="_blank">Sign Your App</a>”部分)。在下方的“Key”选项区里，点击Alias下拉列表，选择“Create a new key”，在对话窗口中输入相关信息，点击Create Key按钮：

<img class="alignnone size-full wp-image-194938" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073022.png" alt="sb2016073022" width="800" height="450" />

如果觉得需要，还可以在“Icon”及“Splash Image”当中添加相应的素材作为app icon和闪屏图片。最后在Build Settings窗口中点击Build按钮。Building期间，你可能需要选择Android SDK的根目录。解压之前下载好的Android SDK压缩包，选择这个文件夹即可。此外你可能还会被要求升级SDK，点击确认即可。Build完成后，你便可以在Android手机上安装app了，然后放到Cardboard里尽情体验吧。

<img class="alignnone size-full wp-image-194916" src="http://image.uisdc.com/wp-content/uploads/2016/07/sb2016073023.png" alt="sb2016073023" width="800" height="450" />

有时你可能会发现视角不会随着头部的转动而相应的运动，这时重启app即可；具体原因或许和SDK及Android系统的版本有关。

&nbsp;

&nbsp;

文章来源：<a href="http://www.uisdc.com/google-vr-app-unity-cardboard-2">优设</a>";s:10:"post_title";s:63:"谷歌VR APP实战！UNITY与CARDBOARD APP基础实践（二）";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:141:"%e8%b0%b7%e6%ad%8cvr-app%e5%ae%9e%e6%88%98%ef%bc%81unity%e4%b8%8ecardboard-app%e5%9f%ba%e7%a1%80%e5%ae%9e%e8%b7%b5%ef%bc%88%e4%ba%8c%ef%bc%89";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-08-08 10:36:17";s:17:"post_modified_gmt";s:19:"2016-08-08 02:36:17";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:25:"http://qisumu.com/?p=1401";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}