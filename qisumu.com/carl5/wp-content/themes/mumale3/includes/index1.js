$(function() {
	var a = 0,
	b = $("#coslider");
	b.children().each(function(c, d) {
		a += $(d).outerWidth(true)
	});
	if (a > b.parent().outerWidth()) {
		simpleMarqueeW(b)
	}
	$("#idxcatebt").delegate("a", "mousedown",
	function(c) {
		_gaq.push(["_trackPageview", "/_trc/home/category_bottom/?name=" + encodeURI($(this).text())])
	});
	$("#dym-area").delegate("a.a", "mousedown",
	function(c) {
		_gaq.push(["_trackPageview", "/_trc/home/waterfall"])
	});
	
	$("#idxtagsp").smallslider({
		viewNum: 5,
		prebtn: "#idxgopre",
		nextbtn: "#idxgonext",
		itemTag: "dd"
	})
}); (function(a) {
	a.fn.smallslider = function(d) {
		var e = a.extend(true, {},
		a.fn.smallslider.defaults, d);
		cntInfo = [];
		cntInfo.$t = a(this);
		c();
		function c() {
			cntInfo.items = cntInfo.$t.find(e.itemTag);
			cntInfo.width = cntInfo.$t.width();
			cntInfo.itemWidth = cntInfo.width / 5;
			cntInfo.curItem = 0;
			cntInfo.$nextbtn = a(e.nextbtn);
			cntInfo.$prebtn = a(e.prebtn);
			if (e.eventType == "click") {
				cntInfo.$t.delegate(e.prebtn, "click",
				function() {
					b("pre")
				});
				cntInfo.$t.delegate(e.nextbtn, "click",
				function() {
					b("next")
				})
			}
		}
		function b(f) {
			if (cntInfo.curItem == 0 && f == "pre") {
				return
			}
			if (cntInfo.curItem == cntInfo.items.length - e.viewNum && f == "next") {
				return
			}
			var h = cntInfo.items.eq(cntInfo.curItem),
			i = cntInfo.items.eq(cntInfo.curItem - 1),
			g = cntInfo.items.eq(cntInfo.curItem).outerWidth();
			if (f == "next") {
				h.animate({
					width: 0
				},
				{
					duration: 500,
					easing: e.animate,
					complete: function() {
						a(this).css("display", "none")
					}
				}); ++cntInfo.curItem
			}
			if (f == "pre") {
				if (cntInfo.items.filter(":animated").length) {
					return
				}
				i.css("display", "block");
				i.stop(true).animate({
					width: g
				},
				{
					duration: 500,
					easing: e.animate
				}); --cntInfo.curItem
			}
		}
	};
	a.fn.smallslider.defaults = {
		animate: "swing",
		eventType: "click",
		viewNum: 1,
		itemTag: "",
		prebtn: null,
		nextbtn: null
	}
})(jQuery);