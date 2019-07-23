<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-CN">
<body class="home blog">

<div id="page">

<?php
/*
Template Name: Guestbook
*/
?>

<?php get_header(); ?>



	

	<div class="wrapper" style="margin-top:20px;">

		<div id="content" class="narrowcolumn" role="main">
<?php if (have_posts()) : ?>

		

		<?php while (have_posts()) : the_post(); ?>
												<div class="post" id="post-<?php the_ID(); ?>">

						<!--<div class="gravatar"><img alt='' src='http://0.gravatar.com/avatar/4f869583945a7ed96bf4f998b2ffe17a?s=32&d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D32&r=G' class='avatar avatar-40 photo' height='40' width='40' /></div>-->

						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>

						

						<div class="entry">

						
<p> <?php the_content(); ?></p> 
					

						

						<!--<div class="feedback">

																			</div>-->

					</div>

									
</div>
						


	

									

					

								



	<?php comments_template(); ?>

	

	 <?php endwhile; ?>

	

		

	

<?php endif; ?>
</div>	
				<?php get_sidebar(); ?>

			


<script type="text/javascript">

(function(){

	var log=document.getElementById("meta-3"),logbox=log.getElementsByTagName("li"),user="欢迎回来，",url=parseInt(window.location.href.split("?page_id=")[1]);

	var proc=function(num,type,texts){

		for(var i=0;i<logbox.length;i++){

			if(i>num) logbox[i].style.display="none";

			else logbox[i].getElementsByTagName("a")[0].innerHTML="<strong>"+logbox[i].getElementsByTagName("a")[0].innerHTML+"</strong>";

		};

		logbox[num].getElementsByTagName("a")[0].className=type;

		if(texts!=""){

			var pa=document.createElement("p");

			log.appendChild(pa);

			pa.innerHTML=texts;

		};

	};

	if(logbox.length==4) proc(0,"login","");

	else if(logbox.length==5) proc(1,"logout",user);

	document.getElementById("searchsubmit").value="SEARCH";

	if(url!=4&&url!=6&&url!=8&&url!=10) document.getElementById("sidebar").style.display="block";

	if(url==12||url==1291) document.getElementById("album").id="display";

	if(url==1316) document.getElementById("album").id="content";

})();

//(function(){

//	var ld_speed=500,

//	basic={

//		getXHR:(function(){// Get xmlHTTP

//			var x=null;

//			try{

//				x=new XMLHttpRequest();

//			}

//			catch(e){

//				x=new ActiveXObject("Msxml2.XMLHTTP");

//			}

//			return x;

//		})(),

//		getInfo:function(url){// Return content of the XML

//			basic.getXHR.onreadystatechange=function(){

//				if (basic.getXHR.readyState==4){ 

//					eval(basic.getXHR.responseText);

//				};

//			};

//			basic.getXHR.open("GET",url,true);

//			basic.getXHR.send(null);

//		}

//	},

//	jsonp1292931273698=function(o){

//		var infos=o["data"],

//		ctt=[];

//		for(var i=0;i<10;i++){

//			ctt.push('<li title="'+infos[i]["content"]+'">'+infos[i]["content"]+'</li>')

//		}

//		document.getElementById("weibo").innerHTML=ctt.join("")+'<li>&gt;&gt;<strong><a href="http://t.qq.com/tgideas" target="_blank">收听TGideas</a></strong></li>';

//	};

//	basic.getInfo("wp-content/getwb.php");

//})();

</script>	</div>





<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->



		<script type="text/javascript">

if(document.getElementById("content")){

	function setimg(){

		var imgs=document.getElementById("content").getElementsByTagName("img");

		for(var i=0;i<imgs.length;i++){

			if(imgs[i].width>652){

				imgs[i].height=imgs[i].height/imgs[i].width*652;

				imgs[i].width=652;

			}

		}

	}

	window.onload=setimg;

}

</script>

<script type="text/javascript" src="http://pingjs.qq.com/ping.js"></script>

<script type="text/javascript">if(typeof(pgvMain)=='function')pgvMain();</script>

</body>

</html>



<script type="text/javascript">

(function(){

	var vari={

		width:960,

		pics:document.getElementById("pics"),

		prev:document.getElementById("prev"),

		next:document.getElementById("next"),

		len:document.getElementById("pics").getElementsByTagName("li").length,

		intro:document.getElementById("pics").getElementsByTagName("p"),

		now:1,

		step:5,

		dir:null,

		span:null,

		span2:null,

		begin:null,

		begin2:null,

		end2:null,

		move:function(){

			if(parseInt(vari.pics.style.left,10)>vari.dir*vari.now*vari.width&&vari.dir==-1){

				vari.step=(vari.step<2)?1:(parseInt(vari.pics.style.left,10)-vari.dir*vari.now*vari.width)/5;

				vari.pics.style.left=parseInt(vari.pics.style.left,10)+vari.dir*vari.step+"px";

			}

			else if(parseInt(vari.pics.style.left,10)<-vari.dir*(vari.now-2)*vari.width&&vari.dir==1){

				vari.step=(vari.step<2)?1:(-vari.dir*(vari.now-2)*vari.width-parseInt(vari.pics.style.left,10))/5;

				vari.pics.style.left=parseInt(vari.pics.style.left,10)+vari.dir*vari.step+"px";

			}

			else{

				vari.now=vari.now-vari.dir;

				clearInterval(vari.begin);

				vari.begin=null;

				vari.step=5;

				vari.width=960;

			}

		},

		scr:function(){

			if(parseInt(vari.span.style.top,10)>-31){

				vari.span.style.top=parseInt(vari.span.style.top,10)-5+"px";

			}

			else{

				clearInterval(vari.begin2);

				vari.begin2=null;

			}

		},

		stp:function(){

			if(parseInt(vari.span2.style.top,10)<0){

				vari.span2.style.top=parseInt(vari.span2.style.top,10)+10+"px";

			}

			else{

				clearInterval(vari.end2);

				vari.end2=null;

			}

		}

	};

	vari.prev.onclick=function(){

		if(!vari.begin&&vari.now!=1){

			vari.dir=1;

			vari.begin=setInterval(vari.move,20);

		}

		else if(!vari.begin&&vari.now==1){

			vari.dir=-1

			vari.width*=vari.len-1;

			vari.begin=setInterval(vari.move,20);

		};

	};

	vari.next.onclick=function(){

		if(!vari.begin&&vari.now!=vari.len){

			vari.dir=-1;

			vari.begin=setInterval(vari.move,20);

		}

		else if(!vari.begin&&vari.now==vari.len){

			vari.dir=1

			vari.width*=vari.len-1;

			vari.begin=setInterval(vari.move,20);

		};

	};

	for(var i=0;i<vari.intro.length;i++){

		vari.intro[i].onmouseover=function(){

			vari.span=this.getElementsByTagName("span")[0];

			vari.span.style.top=0+"px";

			if(vari.begin2){clearInterval(vari.begin2);}

			vari.begin2=setInterval(vari.scr,20);

		};

		vari.intro[i].onmouseout=function(){

			vari.span2=this.getElementsByTagName("span")[0];

			if(vari.begin2){clearInterval(vari.begin2);}

			if(vari.end2){clearInterval(vari.end2);}

			vari.end2=setInterval(vari.stp,5);

		};

	}

})();

</script>
<?php get_footer(); ?>


             


              

</body>