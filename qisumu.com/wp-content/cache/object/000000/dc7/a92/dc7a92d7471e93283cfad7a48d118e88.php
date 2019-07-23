�ǐZ<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:2216;s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-05-05 16:14:48";s:13:"post_date_gmt";s:19:"2016-05-05 08:14:48";s:12:"post_content";s:4889:"&nbsp;
<div class="chicuntitle">

Android的设计尺寸

</div>
<h3>屏幕尺寸</h3>
&nbsp;

指实际的物理尺寸，为屏幕对角线的测量。
为了简单起见，Android把实际屏幕尺寸分为四个广义的大小：小，正常，大，特大。

&nbsp;
<h3>像素（PX）</h3>
&nbsp;

代表屏幕上一个物理的像素点代表屏幕上一个物理的像素点。

&nbsp;
<h3>屏幕密度</h3>
&nbsp;

为解决Android设备碎片化，引入一个概念DP，也就是密度。指在一定尺寸的物理屏幕上显示像素的数量，通常指分辨率。 为了简单起见，Android把屏幕密度分为了四个广义的大小：低（120dpi）、中（160dpi）、高（240dpi）和超高（320dpi） 像素= DP * （ DPI / 160 ) 例如，在一个240dpi的屏幕里，1DP等于1.5PX。
于设计来说，选取一个合适的尺寸作为正常大小和中等屏幕密度（尺寸的选取依据打算适配的硬件，建议参考现主流硬件分辨率），然后向下和向上 做小、大、特大和低、高、超高的尺寸与密度。

&nbsp;
<h3>典型的设计尺寸</h3>
&nbsp;

• 320dp：一个普通的手机屏幕（240X320，320×480，480X800）
• 480dp：一个中间平板电脑像（480×800）
• 600dp：7寸平板电脑（600x1024）
• 720dp：10寸平板电脑（720x1280，800x1280）

&nbsp;
<div class="chicuntitle">

Android安卓系统dp/sp/px换算表

</div>
<table class="TableStyle" border="0" width="100%" cellspacing="0" cellpadding="0">
<thead>
<tr>
<th width="300" height="60">名称</th>
<th width="200">分辨率</th>
<th width="200">比率 rate (针对320px)</th>
<th width="200">比率 rate (针对640px)</th>
<th width="200">比率 rate (针对750px)</th>
</tr>
</thead>
<tbody>
<tr>
<td>idpi</td>
<td>240 × 320</td>
<td>0.75</td>
<td>0.375</td>
<td>0.32</td>
</tr>
<tr>
<td>mdpi</td>
<td>320 × 480</td>
<td>1</td>
<td>0.5</td>
<td>0.4267</td>
</tr>
<tr>
<td>hdpi</td>
<td>480 × 800</td>
<td>1.5</td>
<td>0.75</td>
<td>0.64</td>
</tr>
<tr>
<td>xhdpi</td>
<td>720 × 1280</td>
<td>2.25</td>
<td>1.125</td>
<td>1.042</td>
</tr>
<tr>
<td>xxhdpi</td>
<td>1080 × 1920</td>
<td>3.375</td>
<td>1.6875</td>
<td>1.5</td>
</tr>
</tbody>
</table>
<div class="chicuntitle">

iPhone分辨率和显示屏规格

</div>
<table class="TableStyle" border="0" width="100%" cellspacing="0" cellpadding="0">
<thead>
<tr>
<th width="250" height="60">设备</th>
<th width="150">尺寸</th>
<th width="150">分辨率</th>
<th width="250">设备</th>
<th width="150">尺寸</th>
<th width="150">分辨率</th>
</tr>
</thead>
<tbody>
<tr>
<td>三星Galaxy S3</td>
<td>4.8英寸</td>
<td>720 × 1280</td>
<td>三星Galaxy S4</td>
<td>5英寸</td>
<td>1080 × 1920</td>
</tr>
<tr>
<td>三星Galaxy S5</td>
<td>5.1英寸</td>
<td>1080 × 1920</td>
<td>三星Galaxy S6</td>
<td>4.5英寸</td>
<td>1200 × 1920</td>
</tr>
<tr>
<td>小米1</td>
<td>4英寸</td>
<td>480 × 854</td>
<td>小米1s</td>
<td>4英寸</td>
<td>480 × 854</td>
</tr>
<tr>
<td>小米2</td>
<td>4.3英寸</td>
<td>720 × 1280</td>
<td>小米2s</td>
<td>4.3英寸</td>
<td>720 × 1280</td>
</tr>
<tr>
<td>小米3</td>
<td>5英寸</td>
<td>1080 × 1920</td>
<td>小米3s(概念)</td>
<td>5英寸</td>
<td>1080 × 1920</td>
</tr>
<tr>
<td>小米4</td>
<td>5英寸</td>
<td>1080 × 1920</td>
<td>红米</td>
<td>4.7英寸</td>
<td>720 × 1280</td>
</tr>
<tr>
<td>红米Note</td>
<td>5.5英寸</td>
<td>720 × 1280</td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td>OPPO Find 7</td>
<td>5.5英寸</td>
<td>1440 × 2560</td>
<td>OPPO Find 7 轻装版</td>
<td>5.5英寸</td>
<td>1080 × 1920</td>
</tr>
<tr>
<td>OPPO N1 mini</td>
<td>5英寸</td>
<td>720 × 1280</td>
<td>OPPO R3</td>
<td>5英寸</td>
<td>720 × 1280</td>
</tr>
<tr>
<td>OPPO R1S</td>
<td>5英寸</td>
<td>720 × 1280</td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td>华为 Ascend P7</td>
<td>5英寸</td>
<td>1080 × 1920</td>
<td>华为 Ascend Mate7</td>
<td>6英寸</td>
<td>1080 × 1920</td>
</tr>
<tr>
<td>华为 荣耀6</td>
<td>5英寸</td>
<td>1080 × 1920</td>
<td>华为 Ascend Mate2</td>
<td>6.1英寸</td>
<td>720 × 1280</td>
</tr>
<tr>
<td>华为 C199</td>
<td>5.5英寸</td>
<td>720 × 1280</td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td>HTC One (M8)</td>
<td>约 66 x 66</td>
<td>约 44 x 44</td>
<td>HTC Desire 820</td>
<td>5.5英寸</td>
<td>720 × 1280</td>
</tr>
<tr>
<td>魅族 MEIZU MX4</td>
<td>5英寸</td>
<td>1080 × 1920</td>
<td></td>
<td></td>
<td></td>
</tr>
<tr>
<td>锤子 Smartisan T1</td>
<td>4.95英寸</td>
<td>1080 × 1920</td>
<td>魅族 MEIZU MX3</td>
<td>5.1英寸</td>
<td>1080 × 1800</td>
</tr>
</tbody>
</table>
&nbsp;";s:10:"post_title";s:19:"android设计规范";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:43:"android%e8%ae%be%e8%ae%a1%e8%a7%84%e8%8c%83";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-09-05 16:15:42";s:17:"post_modified_gmt";s:19:"2016-09-05 08:15:42";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:25:"http://qisumu.com/?p=2216";s:10:"menu_order";i:0;s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}