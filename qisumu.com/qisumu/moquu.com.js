CheckLogin();

function openme(){
document.getElementById('div1').style.display='block';
document.getElementById('div2').style.display='block';
}
function closeme(){
document.getElementById('div1').style.display='none';
document.getElementById('div2').style.display='none';
}

function opendais(){
document.getElementById('div3').style.display='block';
document.getElementById('div4').style.display='block';
}
function closedais(){
document.getElementById('div3').style.display='none';
document.getElementById('div4').style.display='none';
}

function openxxx(){
document.getElementById('div5').style.display='block';
document.getElementById('div6').style.display='block';
}
function closexxx(){
document.getElementById('div5').style.display='none';
document.getElementById('div6').style.display='none';
}

(function(s){
	s(function(){
		var lock = true,url = location.href,index = document.getElementById('new-frame');


		s('#list .list-album a').click(function(e){
			var t = s(this),v = t.attr('href');
			history.pushState && new(function(){
				e.preventDefault();
				history.replaceState({u:v},'',v);
				s.get(v,function(d){
					s('.frame-fg .pd20').html('');
					document.title = s(d).filter('title').html();
					var c = s(d).filter('#website').appendTo('.frame-fg .pd20');
					setTimeout(function(){s('html').addClass('open');},300);
				});
			});
		});
		
		s('.frame-bg').click(function(e){
			history.pushState({u:url},'',url);
			document.title = nt;
			s('html').removeClass('open');
		});
		


		s(window).on('popstate',function(e){
			if(index){
				history.state && new(function(){
					if(history.state.u.indexOf('post')>-1){
						s.get(history.state.u,function(d){
							document.title = s(d).filter('title').html();
							s('.frame-fg .pd20').html('');
							var c = s(d).filter('#website').appendTo('.frame-fg .pd20');
							setTimeout(function(){s('html').addClass('open');},300);
						});
					}
					(history.state.u==url) && new(function(){
						s('html').removeClass('open');
						document.title = nt;
					});
				});
			}
		});
		

		
		function GetQueryString(name){
			var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
			var r = window.location.search.substr(1).match(reg);
			if (r!=null) return unescape(r[2]); return null;
		}
		
		var lh = decodeURIComponent(location.href);
		
		s(window).bind('message',function(e){
			s('#mucomment').height(e.originalEvent.data);
		});
	
	});
})($);