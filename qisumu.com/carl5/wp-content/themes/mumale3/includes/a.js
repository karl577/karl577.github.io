
function getUSERID() {
	if (typeof USER !== "undefined" && USER.ID) {
		return USER.ID
	} else {
		return ""
	}
}
function isSTAFF() {
	if (typeof USER !== "undefined" && USER.ISSTAFF) {
		return true
	} else {
		return false
	}
}
function simpleMarqueeW(b, f, i, d) {
	var j = $(b),
	h = j.parent();
	if (j.children().length) {
		var f = f || 4000,
		i = i || 2,
		d = d || 20,
		l, m = false,
		c, k;
		var a = function() {
			c = j.children().first();
			k = c.outerWidth(true);
			clearInterval(l);
			l = setInterval(g, d)
		};
		var g = function() {
			if (m) {
				return
			}
			if (h.scrollLeft() + i >= k) {
				clearInterval(l);
				j.append(c);
				h.scrollLeft(0);
				setTimeout(a, f)
			} else {
				h.scrollLeft(h.scrollLeft() + i)
			}
		};
		j.mouseover(function() {
			m = true
		});
		j.mouseout(function() {
			m = false
		});
		setTimeout(a, f)
	}
}
$(function() {
	var a = $("#menucat");
	a.hover(function() {
		clearTimeout(a.data("timerhide"));
		a.data("timershow", setTimeout(function() {
			if (document.all) {
				$(this).css("border-color", "#DBDBDB")
			}
			a.addClass("menucat_hover").find("div").css("display", "block")
		},
		100))
	},
	function() {
		if (document.all) {
			$(this).css("border-color", "#F7F7F7")
		}
		clearTimeout(a.data("timershow"));
		a.data("timerhide", setTimeout(function() {
			a.removeClass("menucat_hover").find("div").css("display", "none")
		},
		50))
	});
	$("#myselect").hover(function() {
		$(this).addClass("myslt");
		$("#mytool,#mynews,#mymess").find("div").css({
			display: "none"
		});
		if (document.all) {
			$("#myselect div a").css("width", $(".oldnav").length ? $(this).width() - 32 : $(this).width() - 23)
		}
		$(".nvlist").css({
			display: "block",
			width: $(".oldnav").length ? $("#myselect").width() : $("#myselect").width() + 13
		});
		clearTimeout($(".nvlist").data("timer"))
	},
	function() {
		$(".nvlist").data("timer", setTimeout(function() {
			$("#myselect").removeClass("myslt");
			$(".nvlist").css({
				display: "none"
			})
		},
		$(".oldnav").length ? 100 : 500))
	});
	$("#mytool,#mynews,#mymess").hover(function() {
		$("#mytool,#mynews,#mymess,#myselect").find("div").css({
			display: "none"
		});
		var b = $(this).find("div")[0];
		$(b).css({
			display: "block"
		});
		clearTimeout($(b).data("timer"))
	},
	function() {
		var b = $(this).find("div")[0];
		$(b).data("timer", setTimeout(function() {
			$(b).css("display", "none")
		},
		500))
	})
});

/*
* jQuery blockUI plugin
* Version 2.39 (23-MAY-2011)
* @requires jQuery v1.2.3 or later
*
* Examples at: http://malsup.com/jquery/block/
* Copyright (c) 2007-2010 M. Alsup
* Dual licensed under the MIT and GPL licenses:
* http://www.opensource.org/licenses/mit-license.php
* http://www.gnu.org/licenses/gpl.html
*
* Thanks to Amir-Hossein Sobhi for some excellent contributions!
*/
(function(c) {
	var b = c.browser.msie && c.browser.version === "6.0",
	a = c.browser.opera;
	c.fn.sidepop = function(d) {
		var g = {
			_create: function(k, n) {
				var m = n.id,
				j = k.$pop;
				var l = ["none", "none", "none"];
				if (n.btnset == 1) {
					l[2] = ""
				} else {
					if (n.btnset == 2) {
						l[0] = ""
					} else {
						if (n.btnset == 3) {
							l[2] = "";
							l[0] = ""
						}
					}
				}
				k.$dom = c('<div class="' + m + '"></div>').append(c(n.btnset ? ['<div class="', n.btnClass.bars, '"><a  class="', n.btnClass.min, '" style="display:', l[0], '" href="javascript:;" target="_self">-</a><a class="', n.btnClass.max, '" style="display:', l[1], '" href="javascript:;" target="_self">+</a><a class="', n.btnClass.close, '" style="display:', l[2], '" href="javascript:;" target="_self">X</a></div>'].join("") : "")).append(c('<div class="' + n.btnClass.cont + '"></div>').append(j)).appendTo(n.position)
			},
			_feature: function(n, q) {
				var m = n.$pop,
				k = n.$dom,
				o = c(window),
				p = o.width(),
				l = o.height(),
				j = o.scrollTop();
				n.size = [q.width === null ? c("." + q.btnClass.cont, k).outerWidth() : q.width, q.height === null ? c("." + q.btnClass.cont, k).outerHeight() : q.height];
				k.css({
					position: "absolute",
					bottom: "auto",
					zIndex: q.zIndex,
					width: n.size[0],
					height: n.size[1]
				});
				n.bias = q.bias === "middle" ? (l - n.size[1]) / 2 : q.bias;
				n.departure = q.departure === "center" ? (p - n.size[0]) / 2 : q.departure;
				if (b && q.baseline == "bottom" || a && q.baseline == "bottom") {
					n.bias -= 2
				}
				k.css({
					left: q.dockSide === "right" ? "auto": n.departure,
					right: q.dockSide === "left" ? "auto": n.departure
				});
				if (q.baseline == "bottom") {
					if (!b && q.isFixed == 1) {
						k.css({
							position: "fixed",
							top: "auto",
							bottom: n.bias
						})
					}
				} else {
					if (q.baseline == "top") {
						if (!b && q.isFixed == 1) {
							k.css({
								position: "fixed",
								bottom: "auto",
								top: n.bias
							})
						}
					}
				}
			},
			_bindBars: function(k, m) {
				var j = k.$dom,
				l = m.btnClass;
				c("." + l.bars, j).click(function(n) {
					var o = c(n.target);
					if (o.hasClass(l.close)) {
						g.close(k, m)
					} else {
						if (o.hasClass(l.show)) {
							g.show(k, m)
						} else {
							if (o.hasClass(l.min)) {
								g.min(k, m)
							} else {
								if (o.hasClass(l.max)) {
									g.max(k, m)
								}
							}
						}
					}
				})
			},
			_scrollAnim: function(j, k) {
				if (k.scroll === 2) {
					j.$dom.stop().css({
						opacity: 0,
						top: g._getTop(j, k)
					}).animate({
						opacity: 1
					},
					k.fadeSpeed)
				} else {
					j.$dom.animate({
						top: g._getTop(j, k)
					},
					k.floatSpeed)
				}
			},
			_eventScroll: function(k) {
				var j = k.data.props,
				l = k.data.c;
				if (l.scroll === 2) {
					j.$dom.not(":animated").css({
						opacity: 0
					})
				}
				window.clearTimeout(j.scrollTimer);
				j.scrollTimer = window.setTimeout(function() {
					g._scrollAnim(j, l)
				},
				l.scrollDelayTime)
			},
			_bindScroll: function(j, k) {
				if (!b && k.isFixed == 1 || k.scroll === 0) {
					return
				}
				c(window).scroll({
					props: j,
					c: k
				},
				g._eventScroll);
				g._scrollAnim(j, k)
			},
			_unbindScroll: function() {
				c(window).unbind("scroll", g._eventScroll)
			},
			_getTop: function(o, n) {
				var p = o.bias,
				s = o.$dom,
				q = s.outerHeight(true),
				l = c(window).width(),
				j = c(window).height(),
				m = c(window).scrollTop(),
				k = q + p - j;
				k = k < 0 ? 0 : k;
				switch (n.baseline) {
				case "top":
					return m + p - k;
				case "bottom":
					return m + j - q - p + k
				}
			},
			close: function(l, n) {
				var j = l.$dom,
				m = n.btnClass;
				j.css("display", "none");
				g._unbindScroll(l, n);
				var k = m.close;
				c("." + k, j).removeClass(k).addClass(m.show);
				if (c.isFunction(n.fnAfterClose)) {
					n.fnAfterClose.call(g, l, n)
				}
			},
			show: function(l, n) {
				var j = l.$dom,
				m = n.btnClass;
				j.css("display", "block");
				g._bindScroll(l, n);
				var k = m.show;
				c("." + k, j).removeClass(k).addClass(m.close)
			},
			min: function(l, o) {
				var k = l.$dom,
				m = o.btnClass,
				n = o.expandDir === "left-right",
				j = n ? {
					width: o.remainArea
				}: {
					height: o.remainArea
				};
				if (!n && o.baseline === "bottom") {
					j.marginTop = l.size[1] - o.remainArea
				}
				k.animate(j,
				function() {
					c("." + m.min, k).css("display", "none");
					c("." + m.max, k).css("display", "inline")
				})
			},
			max: function(l, o) {
				var k = l.$dom,
				m = o.btnClass,
				n = o.expandDir === "left-right",
				j = n ? {
					width: l.size[0]
				}: {
					height: l.size[1]
				};
				if (!n && o.baseline === "bottom") {
					j.marginTop = 0
				}
				k.animate(j,
				function() {
					c("." + m.min, k).css("display", "inline");
					c("." + m.max, k).css("display", "none")
				})
			},
			_noop: c.noop
		};
		var i = c.extend(true, {},
		c.fn.sidepop.defaults, d);
		var f = c(this),
		h = {};
		h.$pop = f;
		g._create(h, i);
		g._feature(h, i);
		g._bindBars(h, i);
		g._bindScroll(h, i);
		if (c.isFunction(i.fnInitExe)) {
			i.fnInitExe.call(g, h, i)
		}
		return this
	};
	c.fn.sidepop.defaults = {
		id: "",
		position: "body",
		width: null,
		height: null,
		remainArea: 25,
		initTop: null,
		btnClass: {
			min: "SG-sidemin",
			max: "SG-sidemax",
			close: "SG-sideclose",
			show: "SG-sideshow",
			bars: "SG-sidebar",
			cont: "SG-sidecont"
		},
		btnset: 1,
		scroll: 2,
		fnInitExe: null,
		fnAfterClose: null,
		dockSide: "left",
		departure: 0,
		baseline: "bottom",
		popregion: 300,
		isFixed: 0,
		bias: 100,
		expandDir: "top-down",
		floatSpeed: 150,
		fadeSpeed: 250,
		scrollDelayTime: 350,
		zIndex: 1000
	}
})(jQuery);