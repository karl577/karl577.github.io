4��Z<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:4:"2197";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-09-05 15:13:38";s:13:"post_date_gmt";s:19:"2016-09-05 07:13:38";s:12:"post_content";s:6277:"在设计工作中，我们一般都需要进行版本管理。然而，对于传统设计师，版本管理往往是透过手工完成。这里，我将介绍如何使用 <span class="wp_keywordlink_affiliate"><a title="查看 SVN 中的全部文章" href="http://www.uisdc.com/tag/svn" target="_blank">SVN</a></span> 作为版本管理工具，给设计文件进行管理。这里除了初始化过程需要使用到少量命令，往后的操作都在客户端下完成。

想知道更多版本管理方法和工具：<a href="http://www.uisdc.com/ui-design-version-control-tools" target="_blank">《来收神器！UI设计师常用的版本控制工具有哪些？》</a>

如果是本地素材管理，可以参考：<a href="http://www.uisdc.com/low-cost-asset-library" target="_blank">《15G的素材怎么管？手把手教你打造一个低管理成本的素材库》</a>
<h4><strong>理念</strong></h4>
<span class="wp_keywordlink_affiliate"><a title="查看 SVN 中的全部文章" href="http://www.uisdc.com/tag/svn" target="_blank">SVN</a></span> 的工作依赖于一个「远程库」或者称呼为「数据中心」。我们可以在本地搭建这个数据中心。

接着，在从数据中心 Check out 文件，我们称呼为「本地数据」，我们把本地数据修改好了，再用「命令」commit 一下给「数据中心」。

这样，数据中心就会把我们的修改记录在案，并把以前的旧数据做备份。
<h4><strong>初始化准备</strong></h4>
目录的初始化我们需要在百度云上，建立两个活页夹
<ul>
 	<li>Subversion</li>
 	<li>Working（或你喜欢的其他名字）</li>
</ul>
随后，删除他们。

<img class="alignnone size-full wp-image-199530" src="http://image.uisdc.com/wp-content/uploads/2016/09/uisdc-201609041.png" alt="uisdc-201609041" width="800" height="480" />
<h4><strong>为 Subversion 进行初始化</strong></h4>
#A1 第一步，初始化本地 svn 数据库
<pre><code>svnadmin create /Users/qoli/百度云同步盘/Subversion/
</code></pre>
<img class="alignnone size-full wp-image-199520" src="http://image.uisdc.com/wp-content/uploads/2016/09/uisdc-2016090411.png" alt="uisdc-2016090411" width="800" height="450" />

#A2 第二步，运行服务
<pre><code>svnserve -d -r /Users/qoli/百度云同步盘/Subversion/
</code></pre>
<img class="alignnone size-full wp-image-199528" src="http://image.uisdc.com/wp-content/uploads/2016/09/uisdc-201609043.png" alt="uisdc-201609043" width="800" height="450" />

这样就好了！
<h4><b>为客户端进行开始工作</b></h4>
我这里使用 <a href="https://www.zennaware.com/cornerstone/index.php" target="_blank">Cornerstone</a> 这个著名的 SVN 客户端作为示范。

#B1 添加「Repository」

在顶部菜单栏中，或者 Cornerstone 的主要界面上，选择「Add Repository」指令。

选择「SVN Server」并在 Server 地址中输入：localhost

<img class="alignnone size-full wp-image-199527" src="http://image.uisdc.com/wp-content/uploads/2016/09/uisdc-201609044.png" alt="uisdc-201609044" width="800" height="450" /><img class="alignnone size-full wp-image-199529" src="http://image.uisdc.com/wp-content/uploads/2016/09/uisdc-201609042.png" alt="uisdc-201609042" width="800" height="480" />

#B2 Check out 一份工作目录

对着你刚才加入的 SVN Repo，右击它，并 Check out。

接着，把位置保存在你的百度云下。

<img class="alignnone size-full wp-image-199523" src="http://image.uisdc.com/wp-content/uploads/2016/09/uisdc-201609048.png" alt="uisdc-201609048" width="800" height="450" /><img class="alignnone size-full wp-image-199521" src="http://image.uisdc.com/wp-content/uploads/2016/09/uisdc-2016090410.png" alt="uisdc-2016090410" width="800" height="450" />

#B3 导入你的工作文件到刚才 Check out 的目录

把你之前的文件复制进来吧。

不过要注意，每次迁移进入的文件不能超过 4g，否则网盘会不让你上传的哦。

所以，你先加入 3G 左右的文件进来，做第一次的「commit」。

<img class="alignnone size-full wp-image-199525" src="http://image.uisdc.com/wp-content/uploads/2016/09/uisdc-201609046.png" alt="uisdc-201609046" width="800" height="480" />

基本而言，初始化工作就结束了。
<h4><strong>应用</strong></h4>
<b>查看设计文件的修改历程</b>

我们点击先在 Cornerstone 选中一个文件，点击 Timeline，就会显示这个文件的设计提交历史了。

<img class="alignnone size-full wp-image-199522" src="http://image.uisdc.com/wp-content/uploads/2016/09/uisdc-201609049.png" alt="uisdc-201609049" width="800" height="480" /><img class="alignnone size-full wp-image-199519" src="http://image.uisdc.com/wp-content/uploads/2016/09/uisdc-2016090412.png" alt="uisdc-2016090412" width="800" height="480" />

<b>恢复文件到指定版本</b>

恢复文件到指定版本才是最为重要的嘛！

无论你是删除了，还是修改了，只要是提交过的，SVN 一切都会帮你乖乖记录下来的。

如果某一天，甲方和你说，还是第一稿好。有了<span class="wp_keywordlink_affiliate"><a title="查看 版本控制 中的全部文章" href="http://www.uisdc.com/tag/%e7%89%88%e6%9c%ac%e6%8e%a7%e5%88%b6" target="_blank">版本控制</a></span>，你就不用怕咯。

首先，第一步，还是选中你要恢复的文件。

接着，在菜单栏选择，Working Copy 》Revert。

接着，在右边的三横线就可以选择可以恢复的版本历史了。

<img class="alignnone size-full wp-image-199524" src="http://image.uisdc.com/wp-content/uploads/2016/09/uisdc-201609047.png" alt="uisdc-201609047" width="800" height="450" /><img class="alignnone size-full wp-image-199526" src="http://image.uisdc.com/wp-content/uploads/2016/09/uisdc-201609045.png" alt="uisdc-201609045" width="800" height="450" />
<h4><strong>结语</strong></h4>
好了，一切就是这么简单了。

千万要记住，不要一次导入超过 4g 的文件，超过 4g 的话，就分多几次提交。

否则，百度盘会跟你说「不支持上传超过 4g 文件哦」！

这些内容放在别的网盘也是一样的操作办法。";s:10:"post_title";s:78:"学会用SVN做版本管理，帮设计师随时改回第一稿（附教程）";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:192:"%e5%ad%a6%e4%bc%9a%e7%94%a8svn%e5%81%9a%e7%89%88%e6%9c%ac%e7%ae%a1%e7%90%86%ef%bc%8c%e5%b8%ae%e8%ae%be%e8%ae%a1%e5%b8%88%e9%9a%8f%e6%97%b6%e6%94%b9%e5%9b%9e%e7%ac%ac%e4%b8%80%e7%a8%bf%ef%bc%88";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-09-05 15:13:38";s:17:"post_modified_gmt";s:19:"2016-09-05 07:13:38";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:25:"http://qisumu.com/?p=2197";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}