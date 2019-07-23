/*
 * TouchSlide v1.1
 * javascript触屏滑动特效插件，移动端滑动特效，触屏焦点图，触屏Tab切换，触屏多图切换等
 * 详尽信息请看官网：http://www.SuperSlide2.com/TouchSlide/
 *
 * Copyright 2013 大话主席
 *
 * 请尊重原创，保留头部版权
 * 在保留版权的前提下可应用于个人或商业用途

 * 1.1 宽度自适应（修复安卓横屏时滑动范围不变的bug）
 */
var TouchSlide=function(AS){AS=AS||{};var AQ={slideCell:AS.slideCell||"#touchSlide",titCell:AS.titCell||".hd li",mainCell:AS.mainCell||".bd",effect:AS.effect||"left",autoPlay:AS.autoPlay||!1,delayTime:AS.delayTime||200,interTime:AS.interTime||2500,defaultIndex:AS.defaultIndex||0,titOnClassName:AS.titOnClassName||"on",autoPage:AS.autoPage||!1,prevCell:AS.prevCell||".prev",nextCell:AS.nextCell||".next",pageStateCell:AS.pageStateCell||".pageState",pnLoop:"undefined "==AS.pnLoop?!0:AS.pnLoop,startFun:AS.startFun||null,endFun:AS.endFun||null,switchLoad:AS.switchLoad||null},AR=document.getElementById(AQ.slideCell.replace("#",""));if(!AR){return !1}var AU=function(H,E){H=H.split(" ");var G=[];E=E||document;var K=[E];for(var A in H){0!=H[A].length&&G.push(H[A])}for(var A in G){if(0==K.length){return !1}var I=[];for(var J in K){if("#"==G[A][0]){I.push(document.getElementById(G[A].replace("#","")))}else{if("."==G[A][0]){for(var C=K[J].getElementsByTagName("*"),D=0;D<C.length;D++){var B=C[D].className;B&&-1!=B.search(new RegExp("\\b"+G[A].replace(".","")+"\\b"))&&I.push(C[D])}}else{for(var C=K[J].getElementsByTagName(G[A]),D=0;D<C.length;D++){I.push(C[D])}}}}K=I}return 0==K.length||K[0]==E?!1:K},F=function(D,B){var C=document.createElement("div");C.innerHTML=B,C=C.children[0];var A=D.cloneNode(!0);return C.appendChild(A),D.parentNode.replaceChild(C,D),AP=A,C},AT=function(B,A){!B||!A||B.className&&-1!=B.className.search(new RegExp("\\b"+A+"\\b"))||(B.className+=(B.className?" ":"")+A)},AK=function(B,A){!B||!A||B.className&&-1==B.className.search(new RegExp("\\b"+A+"\\b"))||(B.className=B.className.replace(new RegExp("\\s*\\b"+A+"\\b","g"),""))},AL=AQ.effect,AI=AU(AQ.prevCell,AR)[0],AJ=AU(AQ.nextCell,AR)[0],AO=AU(AQ.pageStateCell)[0],AP=AU(AQ.mainCell,AR)[0];if(!AP){return !1}var Ao,Ap,AM=AP.children.length,AN=AU(AQ.titCell,AR),AC=AN?AN.length:AM,AD=AQ.switchLoad,AA=parseInt(AQ.defaultIndex),AB=parseInt(AQ.delayTime),AG=parseInt(AQ.interTime),AH="false"==AQ.autoPlay||0==AQ.autoPlay?!1:!0,AE="false"==AQ.autoPage||0==AQ.autoPage?!1:!0,AF="false"==AQ.pnLoop||0==AQ.pnLoop?!1:!0,Ay=AA,Az=null,Ax=null,At=null,Ar=0,As=0,Av=0,Aw=0,Au=/hp-tablet/gi.test(navigator.appVersion),Am="ontouchstart" in window&&!Au,An=Am?"touchstart":"mousedown",Ak=Am?"touchmove":"",Al=Am?"touchend":"mouseup",Aq=AP.parentNode.clientWidth,Ae=AM;if(0==AC&&(AC=AM),AE){AC=AM,AN=AN[0],AN.innerHTML="";var Af="";if(1==AQ.autoPage||"true"==AQ.autoPage){for(var Ac=0;AC>Ac;Ac++){Af+="<li>"+(Ac+1)+"</li>"}}else{for(var Ac=0;AC>Ac;Ac++){Af+=AQ.autoPage.replace("$",Ac+1)}}AN.innerHTML=Af,AN=AN.children}"leftLoop"==AL&&(Ae+=2,AP.appendChild(AP.children[0].cloneNode(!0)),AP.insertBefore(AP.children[AM-1].cloneNode(!0),AP.children[0])),Ao=F(AP,'<div class="tempWrap" style="overflow:hidden; position:relative;"></div>'),AP.style.cssText="width:"+Ae*Aq+"px;position:relative;overflow:hidden;padding:0;margin:0;";for(var Ac=0;Ae>Ac;Ac++){AP.children[Ac].style.cssText="display:table-cell;vertical-align:top;width:"+Aq+"px"}var Ad=function(){"function"==typeof AQ.startFun&&AQ.startFun(AA,AC)},Ai=function(){"function"==typeof AQ.endFun&&AQ.endFun(AA,AC)},Aj=function(C){var A=("leftLoop"==AL?AA+1:AA)+C,B=function(G){for(var D=AP.children[G].getElementsByTagName("img"),E=0;E<D.length;E++){D[E].getAttribute(AD)&&(D[E].setAttribute("src",D[E].getAttribute(AD)),D[E].removeAttribute(AD))}};if(B(A),"leftLoop"==AL){switch(A){case 0:B(AM);break;case 1:B(AM+1);break;case AM:B(0);break;case AM+1:B(1)}}},Ag=function(){Aq=Ao.clientWidth,AP.style.width=Ae*Aq+"px";for(var B=0;Ae>B;B++){AP.children[B].style.width=Aq+"px"}var A="leftLoop"==AL?AA+1:AA;Ah(-A*Aq,0)};window.addEventListener("resize",Ag,!1);var Ah=function(C,A,B){B=B?B.style:AP.style,B.webkitTransitionDuration=B.MozTransitionDuration=B.msTransitionDuration=B.OTransitionDuration=B.transitionDuration=A+"ms",B.webkitTransform="translate("+C+"px,0)translateZ(0)",B.msTransform=B.MozTransform=B.OTransform="translateX("+C+"px)"},Aa=function(B){switch(AL){case"left":AA>=AC?AA=B?AA-1:0:0>AA&&(AA=B?0:AC-1),null!=AD&&Aj(0),Ah(-AA*Aq,AB),Ay=AA;break;case"leftLoop":null!=AD&&Aj(0),Ah(-(AA+1)*Aq,AB),-1==AA?(Ax=setTimeout(function(){Ah(-AC*Aq,0)},AB),AA=AC-1):AA==AC&&(Ax=setTimeout(function(){Ah(-Aq,0)},AB),AA=0),Ay=AA}Ad(),At=setTimeout(function(){Ai()},AB);for(var A=0;AC>A;A++){AK(AN[A],AQ.titOnClassName),A==AA&&AT(AN[A],AQ.titOnClassName)}0==AF&&(AK(AJ,"nextStop"),AK(AI,"prevStop"),0==AA?AT(AI,"prevStop"):AA==AC-1&&AT(AJ,"nextStop")),AO&&(AO.innerHTML="<span>"+(AA+1)+"</span>/"+AC)};if(Aa(),AH&&(Az=setInterval(function(){AA++,Aa()},AG)),AN){for(var Ac=0;AC>Ac;Ac++){!function(){var A=Ac;AN[A].addEventListener("click",function(){clearTimeout(Ax),clearTimeout(At),AA=A,Aa()})}()}}AJ&&AJ.addEventListener("click",function(){(1==AF||AA!=AC-1)&&(clearTimeout(Ax),clearTimeout(At),AA++,Aa())}),AI&&AI.addEventListener("click",function(){(1==AF||0!=AA)&&(clearTimeout(Ax),clearTimeout(At),AA--,Aa())});var Ab=function(B){clearTimeout(Ax),clearTimeout(At),Ap=void 0,Av=0;var A=Am?B.touches[0]:B;Ar=A.pageX,As=A.pageY,AP.addEventListener(Ak,f,!1),AP.addEventListener(Al,L,!1)},f=function(B){if(!Am||!(B.touches.length>1||B.scale&&1!==B.scale)){var A=Am?B.touches[0]:B;if(Av=A.pageX-Ar,Aw=A.pageY-As,"undefined"==typeof Ap&&(Ap=!!(Ap||Math.abs(Av)<Math.abs(Aw))),!Ap){switch(B.preventDefault(),AH&&clearInterval(Az),AL){case"left":(0==AA&&Av>0||AA>=AC-1&&0>Av)&&(Av=0.4*Av),Ah(-AA*Aq+Av,0);break;case"leftLoop":Ah(-(AA+1)*Aq+Av,0)}null!=AD&&Math.abs(Av)>Aq/3&&Aj(Av>-0?-1:1)}}},L=function(A){0!=Av&&(A.preventDefault(),Ap||(Math.abs(Av)>Aq/10&&(Av>0?AA--:AA++),Aa(!0),AH&&(Az=setInterval(function(){AA++,Aa()},AG))),AP.removeEventListener(Ak,f,!1),AP.removeEventListener(Al,L,!1))};AP.addEventListener(An,Ab,!1)};