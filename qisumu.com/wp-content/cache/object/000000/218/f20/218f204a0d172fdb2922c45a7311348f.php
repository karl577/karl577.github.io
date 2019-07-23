^ߐZ<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":23:{s:2:"ID";s:3:"243";s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-07-18 19:02:55";s:13:"post_date_gmt";s:19:"2016-07-18 11:02:55";s:12:"post_content";s:23052:"<h1 id="-">程序的流程控制-循环语句</h1>
从这节开始，你将会接触到编程中一个重要且强大的知识点 - 循环语句。

在此之前，若你想在程序中画一万个圆，只能用一个可怕的方式去做，写一万行 ellipse。哪些千方百计为了提高效率（偷懒）的语言设计者肯定不会允许这样的事发生。所以就有了循环语句。通过它可以让你最直观地感受计算机自动化的威力。
<h2 id="for-">for循环</h2>
循环语句有多种，其中最常用的就是 for 循环。我们都了解 draw 函数是不断循环执行的。先从开头的第一句开始，由上至下执行直到最后一句，执行完一遍后，又会再从第一句开始重新运行。for 语句和它有点类似。写在它里面的代码都可以被反复执行。

它的语法结构是这样的：
<pre></pre>
<strong>for(表达式1;表达式2;表达式3){ </strong>

<strong>     循环体 </strong>

<strong>}</strong>

循环体中自然就是写我们希望被反复执行的语句。表达式 1 用作初始化，为循环变量赋初值。表达式 2 填写的是循环的条件。表达式 3 会更新循环变量的数值。

循环变量指的是什么？它其实相当于一个局部变量。我们先来看一个完整的写法。
<pre></pre>
<strong>for(int i = 0;i &lt; 10;i++){ </strong>

<strong>     循环体</strong>

<strong> }</strong>

&nbsp;

for 语句要实现循环的功能，主要依赖一个局部变量，循环的终止会需要用到它。在上面例子中即是 i。表达式 1 完成了局部变量的初始化。之后循环每执行一遍，这个变量就必须更新。其中实现更新功能部分的就是表达式 3 中的 i++ ,透过它变量每次更新就会增加 1。到最后，循环体中的代码是不能无限循环下去的，否则后面的语句都无法执行，因此我们需要存在一个终止条件，表达式 2 就起到了这个作用。这里程序会判断 i 是否小于 10，当满足就继续执行，不满足就跳出循环。

因此，for循环中的语句执行顺序就是这样的。

<strong>表达式1（局部变量初始化）</strong>

<strong>表达式2（满足继续往下执行）</strong>

<strong>循环体（第一次循环）</strong>

<strong>表达式3 (更新)</strong>

<strong>表达式2（满足继续往下执行）</strong>

<strong>循环体（第二次循环）</strong>

<strong>表达式3 (更新)</strong>

<strong>表达式2（满足继续往下执行）</strong>

<strong>循环体（第三次循环）</strong>

<strong>...</strong>

<strong>...</strong>

<strong>表达式3 (更新)</strong>

<strong>表达式2（不满足，跳出循环）</strong>
<pre></pre>
你可以对照这个执行顺序在脑海中模拟几遍。但不亲手敲一次代码是不可能真正理解的。当我们想摸清一个陌生的概念，可以先在控制台通过 println 语句输出数值。

－－代码示例（5-1）:

<strong>void setup(){</strong>

<strong>    for(int i = 0; i &lt; 10; i++){</strong>

<strong>        println ("run");</strong>

<strong>    }</strong>

<strong>}</strong>

&nbsp;

<img src="http://img.zcool.cn/community/02ae2e578c7e960000018c1b4e1ee3.jpg@800w_1l_2o" alt="cabe578c7e960000018c1beee822.jpg" width="529" height="592" />

你可以数一数控制台中输出 run 的数量，这里刚好为 10 个。由此就获悉了循环体中的代码执行的次数。但这样做还是无法察觉循环内具体发生了哪些变化。我们可以把输出的字符 “run” 改成变量 i 试试。

－－代码示例（5-2）:

<strong>void setup(){</strong>

<strong>    for(int i = 0; i &lt; 10; i++){</strong>

<strong>        println (i);</strong>

<strong>    }</strong>

<strong>}</strong>

&nbsp;

<img src="http://img.zcool.cn/community/027a63578c7ec30000012e7e432a19.jpg@800w_1l_2o" alt="ae6c578c7ec20000012e7e2b41e4.jpg" width="555" height="596" />

现在能看到，在循环体中的 i 值是不断增大的。以后我们可以通过这个值，来了解当前循环的进度。
<ul class=" list-paddingleft-2">
 	<li>在示例（5-2）中，i 的值是从 0 变化到 9。似乎和实际循环次数总是相差 1。若是觉得不习惯，for语句括号中的表达式也可以写成</li>
</ul>
<pre>     for(int i = 1; i &lt;＝ 10; i++)</pre>
&nbsp;

这样 i 就会恰好对应循环次数。 “&lt;＝” 含义是小于等于，所以当 i 等于 10 时会仍然满足条件，因此会比写成 i &lt; 10 在末尾中可多循环一遍。尽管是从 1 开始，但循环的次数一样为 10。当然，若是没有特别必要的话还是建议采取例子开头的写法。后面介绍到的 vector 或数组，都是通过下标来获取元素的，而下标默认都是从 0 开始。初值先设为 0，是较为常用的做法。
<ul class=" list-paddingleft-2">
 	<li>上例中若写 i 大于 0，程序是会崩溃的。因为变量持续递增，永远都会满足这个条件。这样相当于不能终止，程序会陷入死循环。</li>
 	<li>for语句中的局部变量不仅可以声明整形类型，还可以用诸如浮点类型来声明变量。可以写成 for(float i = 0;i &lt; 10;i+=0.02)。</li>
</ul>
<h2 id="for-">for循环解数学题</h2>
不了解大家是否还记得数学家高斯小时候的一则故事。高斯那时 10 岁，他的算术老师想在课堂上布置一个作业，题目是
<pre>     1＋2＋3＋4……＋97＋98＋99+100＝？</pre>
&nbsp;

如果用手算，自然会耗费很长的时间。但高斯估计是自己琢磨出了等差数列的求和方法，所以在题目刚报出时，就轻松地报出答案，让老师大吃一惊。

现在我们可能不大记得等差数列求和究竟是什么了，但却可以用一种原始而暴力的方式得到答案。那就是 for 循环。反正计算对电脑而言，是小菜一碟。我们只要将问题描述为计算机可识别的语言，就能轻松获得答案。

－－代码示例（5-3）:

void setup(){

int answer = 0;

for(int i = 1; i &lt;= 100; i++){

answer += i;

}

println(answer);

}

&nbsp;

相信你得到的结果会和高斯报出的答案一样，为 5050!
<ul class=" list-paddingleft-2">
 	<li>Tips:for 循环中局部变量的名字可以随意更改，只要符合变量的命名规则即可。可以写成 (int k = 1;k &lt;= 100;k++)。没有特殊情况，默认使用 i 作为变量名。</li>
</ul>
<h2 id="for-">for循环绘图</h2>
经过一番略显枯燥的铺垫，我们终于可以进入更有意思的环节了。就是用 for 循环画图。那些枯燥的数值计算可以先搁到一边了，设计师还是对图形更为敏感～
<h3 id="-for-">利用 for 循环绘制一排圆</h3>
当我们想用 for 循环去表现一组重复的元素。只要事先确定这些元素间的数量关系，就能很方便地用 for 循环去实现，而无需做大量的重复劳动。假如要画一排水平方向均匀分布的圆，它的纵坐标是不变的。变化的只是横坐标，而这个横坐标从左到右，是不断递增的，并且递增距离都一样。这时就可以通过 for 循环中的 i，来确定每个圆的横坐标。

－－代码示例（5-4）:

void setup(){

size(700,700);

background(83,51,194);

noStroke();

}

void draw(){

&nbsp;

for(int i = 0; i &lt; 7; i++){

ellipse(50.0 + i * 100.0, height/2.0, 80.0, 80.0);

}

}

&nbsp;

<img src="http://img.zcool.cn/community/024647578c7ef60000012e7e1350ec.png" alt="24aa578c7ef60000012e7e8c3094.jpg" width="399" height="401" />
<ul class=" list-paddingleft-2">
 	<li>50 代表左面第一个圆的起始位置，i * 100 中的 100 表示递增的距离。</li>
</ul>
<h3 id="-for-">利用 for 循环绘制随机圆点</h3>
上面图形的位置都是可预测的，这样就失去很多趣味。我们可以用前面提到的 random 函数，来创造更多的可能性。试试将它写在绘图函数中。

－－代码示例（5-5）:

void setup(){

size(700,700);

background(0);

noStroke();

}

void draw(){

background(0);

for(int i = 0;i &lt; 10;i++){

float randomWidth = random(60.0);

ellipse(random(width), random(height), randomWidth, randomWidth);

}

}

&nbsp;

<img src="http://img.zcool.cn/community/02154b578c7f420000018c1be64d6b.gif" alt="026a578c7f420000018c1b420e12.jpg" />

这里的圆的位置之所以不断闪动，是因为 random 函数每执行一次，结果都是随机的。由于 draw 函数默认每秒运行 60 帧，所以每次绘制的 10 个圆在一秒内，会随机改变 60 次位置。这种快速的闪动就让画面看上去不止有 10 个圆了。

程序里改变一个简单的数值，就能获得截然不同的效果。我们可以通过修改循环终结条件来改变循环的次数。下图的循环终结条件为 i &lt; 100

<img src="http://img.zcool.cn/community/02df37578c7f5d0000012e7ed0c775.gif" alt="cb8b578c7f5d0000012e7e92fd3b.jpg" />

下面是循环终结条件为 i &lt; 1000 时的效果

<img src="http://img.zcool.cn/community/029766578c7f740000018c1b129818.gif" alt="2398578c7f740000018c1bf8862d.jpg" />
<h2 id="randomseed">randomSeed</h2>
如果我不希望圆的位置是随机生成的，但又不希望它闪动。应该怎么做？一种做法是为每个圆的坐标都创建独立的变量去保存，并在 setup 中对这些变量进行初始化，一并赋上随机值。这样在 draw 里使用绘图函数，调用的就是变量中存储的数值，而不会随时发生改变。

画 10 个圆尚且可用这个方法去创建变量。但画 1000 个圆，10000 个圆。要创建这个数量的变量用传统的方式逐个去命名是会非常繁琐的。

我们先不用去学习新的创建变量的方式。这里有一个灵活的方法可以达到这个目的。就是使用 randomSeed。先看使用后的效果。

－－代码示例（5-6）:

void setup(){

size(700,700);

background(0);

noStroke();

}

void draw(){

background(0);

randomSeed(1);

for(int i = 0;i &lt; 10;i++){

float randomWidth = random(20.0, 60.0);

ellipse(random(width), random(height), randomWidth, randomWidth);

}

}

与前面的代码相比没有很大变化，除了让圆的半径随机范围改成从 10 到 30 之外，只多了一句 ofSeedRandom。但用上这句之后，图形似乎都变静止了。

<img src="http://img.zcool.cn/community/02a5b0578c7f940000018c1b281ad4.png" alt="8fb9578c7f940000018c1b7baf96.jpg" width="415" height="427" />

调用格式：
<pre>    randomSeed(a);</pre>
&nbsp;

其中的 a 设置的是种子，需要填写整数（在 P5 中填写浮点数不会报错，但只会将它化成整数处理）。randomSeed 的作用是设定随机数的种子,它会根据不同的种子，生成不同的随机数序列。在它之后调用的 random 函数，返回的结果都是确定的。这里的确定不是指结果是一个定值，它确定的只是生成的序列。也就是说对应的调用次数，返回的结果是确定的。

－－代码示例（5-7）:

void setup(){

randomSeed(0);

for(int i = 0;i &lt; 5;i++){

println(random(10));

}

}

&nbsp;

<img src="http://img.zcool.cn/community/025aa7578c7fb90000012e7ea998d6.png@800w_1l_2o" alt="4cf4578c7fb90000012e7e61240f.jpg" />

继续用 println 做个实验。使用了 randomSeed 后，你每次关闭程序，再运行程序。返回的都会是一串同样的结果。数值与顺序会一一对应的。去掉的话，每次返回的都是不同的数值。

之所以有这种设置。是因为程序中的随机数，本身都是“伪随机”的。结果看似随机，实则都是通过一个固定的，可重复的计算方法产生的。randomSeed 就相当于指定某个原始值。之后的结果都会根据这个种子来推算。而当我们不指定种子时，程序会默认根据系统的当前时间来生成种子。因此每次运行结果都不一样。

下面的例子可以帮助你更好地理解
randomSeed。

－－代码示例（5-8）:

void setup(){

size(700,700);

background(0);

noStroke();

}

void draw(){

randomSeed(1);

for(int i = 0;i &lt; 10;i++){

float randomWidth01 = random(10, 60);

ellipse(random(width), random(height), randomWidth01, randomWidth01);

println(randomWidth01);

}

&nbsp;

randomSeed(1);

for(int i = 0;i &lt; 10;i++){

float randomWidth02 = random(10, 60);

ellipse(random(width), random(height), randomWidth02, randomWidth02);

println(randomWidth02);

}

}

&nbsp;

尝试将第二个 randomSeed(1) 修改成 randomSeed(0) 对比最终的结果。
<ul class=" list-paddingleft-2">
 	<li>Tips:P5 中只要在 draw 的结尾调用 noLoop 函数，就可以达到同样的效果，它的作用是令程序中止运行。与上面的实现原理有本质的区别。</li>
</ul>
<h2 id="for-">for 循环画线</h2>
掌握 randomSeed 的用法之后，可以尝试替换绘图函数，例如将画圆变成画线。只要给直线的端点设计一些变化规则，就可用大量的线条交织出独特图案。

－－代码示例（5-9）:

void setup(){

size(700,700);

background(0);

}

void draw(){

randomSeed(0);

for(int i = 0; i &lt; 2000; i++){

float x1 = width/2.0;

float x2 = random(50.0, 650.0);

stroke(255, 20);

line(x1, 50, x2, 650);

}

}

&nbsp;

<img src="http://img.zcool.cn/community/02ec7f578c80510000018c1b43755c.png" alt="bed2578c80510000018c1b970bb9.jpg" width="452" height="432" />
<h2 id="-">制造简单笔刷</h2>
再回到 for 循环。前面例举的示例都是没有交互的，要让结果更有趣可不能忘记将 mouseX，mouseY 结合到代码中。

－－代码示例（5-10）:

void setup(){

size(700,700);

background(255);

noStroke();

}

void draw(){

for(int i = 0;i &lt; 1000;i++){

fill(0,30);

float x = mouseX + random(-50,50);

float y = mouseY + random(-50,50);

ellipse(x , y, 2, 2);

}

}

&nbsp;

<img src="http://img.zcool.cn/community/021774578c824a0000018c1b8db3ad.gif" alt="53fa578c824a0000018c1bd70480.jpg" />

<img src="http://img.zcool.cn/community/0236b8578c82610000018c1bbecebe.png" width="432" height="440" />

<img src="http://img.zcool.cn/community/020f4a578c82620000012e7ed910ad.png" width="447" height="465" />

一个“散点”笔刷就诞生了。由于每个细密的圆点坐标都是基于鼠标位置，往左右上下四个方向随机移动有限的距离，所以笔刷最终的形状分布就会近似于方形。

－－代码示例（5-11）:

void setup(){

size(700,700);

background(255);

noStroke();

}

&nbsp;

void draw(){

for(int i = 0;i &lt; 1000;i++){

float ratio = mouseX/(float)width;

float x = mouseX + random(-50,50);

float y = mouseY + random(-50,50);

fill(0, ratio * 255,255 * (1 - ratio), 30);

ellipse(x , y, 2, 2);

}

}

&nbsp;

<img src="http://img.zcool.cn/community/023647578c82910000012e7e22bca0.gif" alt="9fce578c82910000012e7e936ed8.jpg" />

<img src="http://img.zcool.cn/community/02fbd2578c82a60000012e7e63f3d0.png" alt="dc08578c82a60000012e7ec7ef9c.jpg" width="435" height="425" />

若是用 mouseX 的值来影响填充颜色，会得到更迷幻的色彩渐变
<h2 id="for-">for 循环的嵌套</h2>
for 循环是可以嵌套的。可以在 for 循环里面再写一个 for 循环。当你需要绘制二维的矩阵就可以采取这种写法。

－－代码示例（5-12）:

void setup(){

size(700, 700, P2D);

background(202, 240, 107);

}

void draw(){

fill(0);

for(int i = 0;i &lt; 5;i++){

for(int j = 0;j &lt; 5;j++){

float x = 150 + i * 100;

float y = 150 + j * 100;

ellipse(x, y , 60, 60);

println(i + ":" + j);

}

}

}

&nbsp;

<img src="http://img.zcool.cn/community/02b303578c82c90000012e7edc626a.png" alt="142f578c82c90000012e7eef4ce6.jpg" width="467" height="487" />

初次使用嵌套循环，需要理清其中的逻辑关系。程序中的代码执行顺序始终是由上至下的，因此首先执行的必定是最外层的循环。外循环每执行一次，内循环就要持续执行直到不满足条件为止，此后才执行第二次的外循环。第二次开始后，内循环又会继续从头执行直到条件不满足，如此反复，直到所有条件都不满足，跳出循环为止。

上面的代码，外循环中的循环体一共执行了 5 次，而内循环中的循环体则执行了 25 次。这 25 次中，根据 i ，j 的数值不同，分别用来确定圆的横纵坐标。例子中嵌入了一段 print ，你可以观察输出的数值揣摩其中的变化。仅仅用两个循环嵌套，就能将 i，j 的数值组合都遍历了。
<ul class=" list-paddingleft-2">
 	<li>Tips</li>
 	<li>第二层的 for 循环一般在开头键入 Tab 进行缩进，这样做可以使代码结构更清晰</li>
 	<li>两层 for 循环中的局部变量必须起不同的变量名。其中，”i”,”j”,”k” 是最为常用的</li>
</ul>
<h2 id="-i-j-">灵活运用 “i” ，”j”</h2>
“i”,”j” 这两个变量名指代的是两层 for 循环中的局部变量。下面的例子会加深你对 “i””j” 的理解。根据“i” ,“j” 值的不同，可以传入参数来对元素进行“分组”。

－－代码示例（5-13）:

void setup() {

size(700, 700);

background(0);

noStroke();

}

void draw() {

background(0);

fill(250, 233, 77);

for (int i = 0; i &lt; 7; i++) {

for (int j = 0; j &lt; 7; j++) {

pushMatrix();

translate(50 + i * 100, 50 + j * 100);

// 设置 1

//float angle = sin(millis() / 1000.0) * PI/2;

// 设置 2

//float ratio = i/7.0;

//float angle = sin(millis() / 1000.0 + ratio * (PI/2)) * PI/2;

// 设置 3

float ratio = (i * 7 + j)/49.0;

float angle = sin(millis() / 1000.0 +  ratio * (PI/2)) * PI/2;

rotate(angle);

rectMode(CENTER);

// 绘制图形 1

rect(0, 0, 80, 80);

// 绘制图形 2

// rect(0, 0, 100, 20);

// 绘制图形 3

//rect(0,0,ratio * 50);

popMatrix();

}

}

}

&nbsp;
<h3 id="-">代码说明</h3>
<ul class=" list-paddingleft-2">
 	<li>rectMode(CENTER) 可以改变矩形的绘制方式，原来 rect 的前两个参数是用来确定矩形左上角的坐标。开启此命令后，这两个参数会用于设定矩形中心的坐标。由于这里是通过 rotate 来对图形进行旋转操作的，所以就需要通过这种方式，将矩形的中心绘制到坐标原点上。</li>
 	<li>millis() 获取的是程序从运行到当前所经过的时间，单位是毫秒。此值会影响 sin 输出值的变化速度，若直接写 millis ，变化幅度则太大，因此将它除以 1000.0</li>
</ul>
这段代码中运用注释符 “//” 隐藏了多个设置。你可以通过开启或是关闭去快速地切换效果。例如开启了 “设置 3” 后的语句，就需要把 “设置 1” 和 “设置 2” 后的代码块用注释符关闭掉。对于这类程序结构相似而局部代码有所区别的例子，就可以用这种形式去写，这样就无需分别保存多个工程文件了。练习和创作的时候可以多运用这种技巧，以此来保存一些自己满意的参数设置。

其中 i,j 值对程序的影响，主要通过切换 “设置1（设置2）（设置3）” 来体现。可以对比下面的输出结果
<h4 id="-1-1">绘制图形 1：设置 1</h4>
<img src="http://img.zcool.cn/community/024439578c82ec0000012e7e81313a.gif" alt="96d5578c82ec0000012e7e7f5501.jpg" />
<h4 id="-1-2">绘制图形 1：设置 2</h4>
<img src="http://img.zcool.cn/community/02e272578c82fd0000018c1b7eb6d1.gif" alt="4650578c82fd0000018c1b572807.jpg" />
<h4 id="-1-3">绘制图形 1：设置 3</h4>
<img src="http://img.zcool.cn/community/0291de578c83160000018c1b137739.gif" alt="3a8d578c83160000018c1b0645e7.jpg" />
<h4 id="-2-1">绘制图形 2：设置 1</h4>
<img src="http://img.zcool.cn/community/027664578c832e0000012e7e755c82.gif" alt="d4dd578c832e0000012e7e88867a.jpg" />
<h4 id="-2-2">绘制图形 2：设置 2</h4>
<img src="http://img.zcool.cn/community/0238d0578c833e0000018c1be329ca.gif" alt="e5ac578c833e0000018c1bc3f0bf.jpg" />
<h4 id="-2-3">绘制图形 2：设置 3</h4>
<img src="http://img.zcool.cn/community/0270e2578c835f0000018c1b06a918.gif" alt="338e578c835f0000018c1b537600.jpg" />

在设置 1 中，没有使用到 i 或 j 去影响每个元素的旋转角度。因此可以看到每个元素的运动效果都是一致的。而设置 2 用到了 i 值，设置 3 同时用到了 i 和 j。它们最终通过 ratio 值去影响 sin 函数的参数输入，以此改变 angle 的周期变化。由于设置 2 与设置 3 的具体效果在动图中并不明显，我们可以通过下面的截图去观察。
<h4 id="-2-2-3-">绘制图形2( 左图：设置2 - 右图：设置3 )</h4>
<img src="http://img.zcool.cn/community/023bd7578c837d0000012e7e585a75.png@800w_1l_2o" alt="cfdf578c837d0000012e7e35bba8.jpg" />
<h4 id="-3-2-3-">绘制图形3( 左图：设置2 - 右图：设置3 )</h4>
<img src="http://img.zcool.cn/community/025453578c83890000012e7ef07903.png@800w_1l_2o" alt="da8d578c83890000012e7e1ece21.jpg" />

第一张图中，ratio 用于影响矩形的旋转角度。而第二张图，则直接用来控制圆形的半径大小。可以看到，只使用了 i 值的语句：
<pre>float ratio = i/7.0;</pre>
&nbsp;

它的纵向元素的变化都是完全一致，因为控制图形横坐标的只依赖 i 值,所以横坐标相同的图形，ratio 的值也相同，旋转角度，圆的半径大小也相同。

而同时用到 i，j 的语句
<pre>float ratio = (i * 7 + j)/49.0;</pre>
&nbsp;

它可以描述“渐变”，这里通过相乘一个系数的方式，将行与列的影响组合到了一起。使每个元素都有所区别。
<h2 id="while-">While 循环</h2>
for 循环还有一个兄弟。那就是 while 循环。for 循环能做的事，while 循环也能做。只是 while 循环的在 creativeCoding 中的使用频率并没有 for 循环高。

－－代码示例（5-14）:

void setup(){

int a = 0;

while(a &lt; 10){

println(a);

a++;

}

}

&nbsp;

while 的语法结构其实比 for 更好理解。while 语句的前面先创建变量，接着中括号内填写一个表达式，当满足时就执行循环体中的语句，最后在循环体内放上一个对变量进行更新的表达式，这样 while 循环就完成了。对于循环次数确定的，多用 for 循环。当变量的数值不确定时,更推荐使用 while 循环。";s:10:"post_title";s:40:"写给设计师的Processing编程指南";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:100:"%e5%86%99%e7%bb%99%e8%ae%be%e8%ae%a1%e5%b8%88%e7%9a%84processing%e7%bc%96%e7%a8%8b%e6%8c%87%e5%8d%97";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-07-19 12:35:18";s:17:"post_modified_gmt";s:19:"2016-07-19 04:35:18";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";s:1:"0";s:4:"guid";s:24:"http://qisumu.com/?p=243";s:10:"menu_order";s:1:"0";s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";}}