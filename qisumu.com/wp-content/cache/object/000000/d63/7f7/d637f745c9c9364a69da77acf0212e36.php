|ʐZ<?php exit; ?>a:1:{s:7:"content";O:8:"stdClass":24:{s:2:"ID";i:583;s:11:"post_author";s:1:"1";s:9:"post_date";s:19:"2016-07-21 15:07:29";s:13:"post_date_gmt";s:19:"2016-07-21 07:07:29";s:12:"post_content";s:8891:"<blockquote><span class="token p">编者按：“二十年后，我希望在我的嘴里有根管子，里面装满了 Soylent；然后，在我的后脑上，也有根管。人类，这种这么低级的生物，需要这样更高效地 IO 管道。”隔着一万公里，我仿佛看到这名疯狂的工程师，眼睛中冒出的光。在长达一个小时的沟通中，他有关效率的逻辑推论，完全打动了我。</span>

<span class="token p">但，总觉得哪里不对。以下，就是他疯狂的逻辑和对效率世界的想象。他甚至，还找出了已经安全商业化的产品，以支撑他的观点。这个奇点，他认为，就在二十年后。”</span></blockquote>
说起来，随着计算机技术的飞速发展， IO（注释：输入输出）的瓶颈，最终还是在人本身。

人类的主要输入方式为视觉和听觉。视觉输入抽象数据的方法为阅读文字，并进行处理。听觉输入抽象数据的方法为听其他人（或计算机）讲话，并进行处理。辅助的，输入的元信息包括且不限于色彩、字体、排版方式、讲话语调语气。辅助输入还包括图像信息以及音乐信息。某些输入中，图像以及音乐是一个整体。

<img class="size-full wp-image-688388 aligncenter" src="http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/titu-1.png" sizes="(max-width: 1200px) 100vw, 1200px" srcset="http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/titu-1.png 1200x, http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/titu-1-360x225.png 360x, http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/titu-1-768x480.png 768x, http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/titu-1-1024x640.png 1024x" alt="titu" width="1200" height="750" />

同样的，人类的主要抽象输出方式包括视觉的输出以及听觉的输出。视觉的输出，主要为文字性的输出以及图像式的输出。听觉的输出，主要为语音性质的输出以及音乐性质的输出。

在这些输入输出方法中，最有效的输入方式为抽象的文本性输入以及抽象的文本性输出。绘画以及音乐，虽然信息熵更高，但输入过程的细节丢失也更多，且此类输入会受到个人的理解严重影响。作为稳定的输入输出手段，文字性的似乎为最合适的。

通常，中文发音的速率大约为 180 wpm（注释：Words per minute），约合 3 个汉字每秒。英文大约为 160 wpm。传递的信息量，大约是一致的。此时，折合的字节数，大约为中文 72bps，英文 100bps。英文看似信息量更高，但其实折合起来，并没有这么高。考虑信息熵（注释：信息熵由香农提出，是指接收的每条消息中包含的信息的平均量）后，英文的输出速度甚至可能更低 —— 有效的单字信息量，英文比中文的低一些。写字的速度，不论语言，均低于讲话的速度。

<img class="size-full wp-image-688391 aligncenter" src="http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/p2365498458.jpg" sizes="(max-width: 1200px) 100vw, 1200px" srcset="http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/p2365498458.jpg 1200x, http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/p2365498458-360x225.jpg 360x, http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/p2365498458-768x480.jpg 768x, http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/p2365498458-1024x640.jpg 1024x" alt="p2365498458" width="1200" height="750" />

<span class="token p">根据调查，阅读速度对于各种语言都在为 180 wpm 左右。也就是说，阅读的输入速率与发音的输出速率大致一致，都在百字节/秒以内。</span>

<span class="token p">因此，对于原生的语音和文字来说，人类的处理速率是几乎一致的。当然，由于人进行 context switching （注释：上下文切换，环境切换）的成本很高，因此进行输入的 multiplexing（注释：多路复用） 是不经济的。</span>

<span class="token p">进入信息时代，阅读的输入并没有产生本质的变化。键盘的输出速率毫无疑问低于语音输出速率。触摸选择的速率，更是低于，或在最好情况下与手写持平。这也导致了一个本质的问题 —— 人机界面的 I/O 速率在最好情况下依然低于人类习惯的 I/O 速率，更远低于计算机三十年前的 I/O 速率。</span>

<span class="token p">理想中，最高效率的 HCI（注释：人机交互） 方法即为语音 I/O，辅助文本 I/O。然而，语音文本 I/O 的缺陷也是显著的。我相信大家都对车载 GPS 的语音输入深恶痛绝 —— 下面是个绝佳的例子。</span>
<blockquote><span class="token p">You: Send me to the gas station along my way to downtown LA before I hit the ten.</span>

<span class="token p">GPS: Sorry, I can’t understand that. After the beep, say a command, or say help for additional help.</span>

<span class="token p">You: Navigate to nearest gas station.</span>

<span class="token p">GPS: I’ve found 16 gas stations near you. Which one do you want?</span>

looking at GPS screen. rear ended on another car</blockquote>
<span class="token p">此类语音控制的 epic fail（注释：惨败） 随处可见。 Siri 听起来不错，甚至会给你讲段子，但是对于这种人类理解起来非常简单的语音，计算机目前却无计可施。人类对上面的回答会很不一样：</span>
<blockquote><span class="token p">你：我要去洛杉矶市区，在我上 10 号高速之前指给我最近的加油站。 </span>

<span class="token p">你女朋友：我看看地图，你继续开。（过了半分钟） </span>

<span class="token p">你女朋友：上高速之前在 Cloverfield Blvd 上右拐一下有一家加油站。</span></blockquote>
<span class="token p">人类的思考过程，在很大程度上依然是未知的。但是，人类目前了解到的是，经过某种过程后，人类通过神经冲动的方式，或是控制声带，或是控制手，使用目标器官进行控制。当然，我时常发现，使用语音输出信息的速度低于我的思考速度。因此，似乎最好、最快、最高效的方法，便是使人类可以用原生的神经冲动进行控制。</span>

<img class="size-full wp-image-688406 aligncenter" src="http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/openbci.jpg" sizes="(max-width: 1291px) 100vw, 1291px" srcset="http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/openbci.jpg 1291x, http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/openbci-360x159.jpg 360x, http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/openbci-768x338.jpg 768x, http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/openbci-1024x451.jpg 1024x" alt="openbci" width="1291" height="569" />

<span class="token p">对于直接或间接用神经冲动的交互，从几十年前到现在一直都是在不断继续的，从脑袋上贴电极到脑袋里插电线，类似的尝试一直在不断的继续。比较有侵入性的，是让盲人复明的摄像头以及电子耳蜗 —— 这些装置的侵入性主要因为对进行信息的输入的需求上。无侵入性的解决方案主要是脑袋上贴电极的方法 —— 也是恐怖电影里外星人抓到地球人后做的事情 —— 探测人脑的活动而进行反应。</span>

<img class="size-full wp-image-688400 aligncenter" src="http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/sh.jpg" sizes="(max-width: 1125px) 100vw, 1125px" srcset="http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/sh.jpg 1125x, http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/sh-360x222.jpg 360x, http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/sh-768x473.jpg 768x, http://ifanr-cdn.b0.upaiyun.com/wp-content/uploads/2016/07/sh-1024x631.jpg 1024x" alt="sh" width="1125" height="693" />

<span class="token p">对于大部分人来说，提高计算机和人类的交互效率，并不需要真的进行双向的加速 —— 从计算机到人的下行带宽已经足够，需要解决的问题只是更快的人到计算机的上行带宽。目前，已经有一些头盔式脑机输入装置走上了商业销售的道路（注释：emotiv 脑控装置与 openic 脑控装置已经投入商业化销售）。</span>

<span class="token p">虽然他们仍然需要进行训练方可使用，而且输入的速率也非常低，精度也有问题，但是在未来，这类技术在解决了精度和速率问题后，很有可能变成下一代的主要输入方式之一。也许，现在被大家调侃的脑上插管用于通讯、嘴里插管用于喝 Soylent 的情景，在 20 年后已为常态。</span>";s:10:"post_title";s:84:"为了更好地与世界交互，这个疯狂的工程师建议往脑子插根管！";s:12:"post_excerpt";s:0:"";s:11:"post_status";s:7:"publish";s:14:"comment_status";s:4:"open";s:11:"ping_status";s:4:"open";s:13:"post_password";s:0:"";s:9:"post_name";s:198:"%e4%b8%ba%e4%ba%86%e6%9b%b4%e5%a5%bd%e5%9c%b0%e4%b8%8e%e4%b8%96%e7%95%8c%e4%ba%a4%e4%ba%92%ef%bc%8c%e8%bf%99%e4%b8%aa%e7%96%af%e7%8b%82%e7%9a%84%e5%b7%a5%e7%a8%8b%e5%b8%88%e5%bb%ba%e8%ae%ae%e5%be%80";s:7:"to_ping";s:0:"";s:6:"pinged";s:0:"";s:13:"post_modified";s:19:"2016-07-21 15:07:29";s:17:"post_modified_gmt";s:19:"2016-07-21 07:07:29";s:21:"post_content_filtered";s:0:"";s:11:"post_parent";i:0;s:4:"guid";s:24:"http://qisumu.com/?p=583";s:10:"menu_order";i:0;s:9:"post_type";s:4:"post";s:14:"post_mime_type";s:0:"";s:13:"comment_count";s:1:"0";s:6:"filter";s:3:"raw";}}