/* http://lorem.in  @author LoeiFy@gmail.com */
var Home = location.href,
    Pages = 4,
    xhr, xhrUrl = "",
    Diaspora = {
        L: function(a, b, c) {
            return a == xhrUrl ? !1 : (xhrUrl = a, xhr && xhr.abort(), void(xhr = $.ajax({
                type: "GET",
                url: a,
                timeout: 1e4,
                success: function(a) {
                    b(a),
                        xhrUrl = ""
                },
                error: function(b, d, e) {
                    "abort" == d ? c && c() : window.location.href = a,
                        xhrUrl = ""
                }
            })))
        },
        P: function() {
            return !! ("ontouchstart" in window)
        },
        PS: function() {
            window.history && history.pushState && (history.replaceState({
                    u: Home,
                    t: document.title
                },
                document.title, Home), window.addEventListener("popstate",
                function(a) {
                    var b = a.state;
                    b && (document.title = b.t, b.u == Home ? ($("#preview").css("position", "fixed"), setTimeout(function() {
                            $("#preview").removeClass("show").addClass("trans"),
                                $("#container").show(),
                                window.scrollTo(0, parseInt($("#container").data("scroll"))),
                                setTimeout(function() {
                                        $("#preview").html("")
                                    },
                                    300)
                        },
                        0)) : (Diaspora.loading(), Diaspora.L(b.u,
                        function(a) {
                            document.title = b.t,
                                $("#preview").html($(a).filter("#single")),
                                Diaspora.preview(),
                                setTimeout(function() {
                                        Diaspora.player(b.d)
                                    },
                                    0)
                        })))
                }))
        },
        HS: function(a, b) {
            var c = a.data("id") || 0,
                d = a.attr("href"),
                e = a.attr("title") || a.text();
            $("#preview").length && window.history && history.pushState || (location.href = d),
                Diaspora.loading();
            var f = {
                d: c,
                t: e,
                u: d
            };
            Diaspora.L(d,
                function(a) {
                    switch (b) {
                        case "push":
                            history.pushState(f, e, d);
                            break;
                        case "replace":
                            history.replaceState(f, e, d)
                    }
                    switch (document.title = e, $("#preview").html($(a).filter("#single")), b) {
                        case "push":
                            Diaspora.preview();
                            break;
                        case "replace":
                            window.scrollTo(0, 0),
                                Diaspora.loaded()
                    }
                    setTimeout(function() {
                            c || (c = $(".icon-play").data("id")),
                                Diaspora.player(c),
                                $(".content img").each(function() {
                                    $(this).attr("src").indexOf("dist/downloading.png") > -1 && ($(this).hide(), $(".downloadlink").attr("href", $(this).parent().attr("href")))
                                }),
                            "replace" == b && $("#top").show()
                        },
                        0)
                })
        },
        preview: function() {
            setTimeout(function() {
                    $("#preview").addClass("show"),
                        $("#container").data("scroll", window.scrollY),
                        setTimeout(function() {
                                $("#container").hide(),
                                    setTimeout(function() {
                                            $("#preview").css({
                                                position: "static",
                                                "overflow-y": "auto"
                                            }).removeClass("trans"),
                                                $("#top").show(),
                                                Diaspora.loaded()
                                        },
                                        500)
                            },
                            300)
                },
                0)
        },
        player: function(a) {
            var b = $("#audio-" + a + "-1");
            b.length && b.on({
                timeupdate: function() {
                    $(".bar").css("width", b[0].currentTime / b[0].duration * 100 + "%")
                },
                ended: function() {
                    $(".icon-pause").removeClass("icon-pause").addClass("icon-play")
                },
                playing: function() {
                    $(".icon-play").removeClass("icon-play").addClass("icon-pause")
                }
            })
        },
        loading: function() {
            var a = window.innerWidth,
                b = '<style class="loaderstyle" id="loaderstyle' + a + '">@-moz-keyframes loader' + a + "{100%{background-position:" + a + "px 0}}@-webkit-keyframes loader" + a + "{100%{background-position:" + a + "px 0}}.loader" + a + "{-webkit-animation:loader" + a + " 3s linear infinite;-moz-animation:loader" + a + " 3s linear infinite;}</style>";
            $(".loaderstyle").remove(),
                $("head").append(b),
                $("#loader").removeClass().addClass("loader" + a).show()
        },
        loaded: function() {
            $("#loader").removeClass().hide()
        },
        F: function(a, b, c) {
            var d = $(a).parent().height(),
                e = $(a).parent().width(),
                f = c / b;
            d / e > f ? (a.style.height = d + "px", a.style.width = d / f + "px") : (a.style.width = e + "px", a.style.height = e * f + "px"),
                a.style.left = (e - parseInt(a.style.width)) / 2 + "px",
                a.style.top = (d - parseInt(a.style.height)) / 2 + "px"
        }
    };
$(function(a) {
    document.body.childNodes.length > 9 && alert("检测到运营商插入广告，请刷新页面"),
    Diaspora.P() && a("body").addClass("touch");
    var b = [];
    if (b.t = a("#cover"), b.w = b.t.attr("width"), b.h = b.t.attr("height"), (b.o = function() {
            a("#mark").height(window.innerHeight)
        })(), b.t.prop("complete") && setTimeout(function() {
                b.t.load()
            },
            0), b.t.on("load",
            function() { (b.f = function() {
                var c, d, e, f, g = a("#mark").width(),
                    h = a("#mark").height();
                f = g >= 1e3 || h >= 1e3 ? 1e3: 500,
                    g >= h ? (e = g / f * 50, d = e, c = e * g / h) : (e = h / f * 50, c = e, d = e * h / g),
                    a(".layer").css({
                        width: g + c,
                        height: h + d,
                        marginLeft: -.5 * c,
                        marginTop: -.5 * d
                    }),
                    Diaspora.F(a("#cover")[0], b.w, b.h)
            })(),
                setTimeout(function() {
                        a("html, body").removeClass("loading")
                    },
                    1e3),
                a("#mark").parallax();
                var c = new Vibrant(b.t[0]),
                    d = c.swatches();
                a("#vibrant polygon").css("fill", d.DarkVibrant.getHex()),
                    a(".icon-menu").css("color", d.Vibrant.getHex())
            }), a("#preview").length) {
        a("#preview").css("min-height", window.innerHeight),
            Diaspora.PS(),
            a(".pview a").addClass("pviewa");
        var c;
        a(window).on("resize",
            function() {
                clearTimeout(c),
                    c = setTimeout(function() {
                            Diaspora.P() || location.href != Home || (b.o(), b.f()),
                            a("#loader").attr("class") && Diaspora.loading()
                        },
                        500)
            })
    } else a("#single").css("min-height", window.innerHeight),
        setTimeout(function() {
                a("html, body").removeClass("loading")
            },
            1e3),
        window.addEventListener("popstate",
            function(a) {
                a.state && (location.href = a.state.u)
            }),
        Diaspora.player(a(".icon-play").data("id")),
        a(".icon-icon").attr("href", "/"),
        a(".content img").each(function() {
            a(this).attr("src").indexOf("dist/downloading.png") > -1 && (a(this).hide(), a(".downloadlink").attr("href", a(this).parent().attr("href")))
        }),
        a("#top").show();
    a(window).on("scroll",
        function() {
            if (a(".scrollbar").length && !Diaspora.P() && !a(".icon-images").hasClass("active")) {
                var b = a(window).scrollTop(),
                    c = a(".content").height();
                b > c && (b = c),
                    a(".scrollbar").width((50 + b) / c * 100 + "%"),
                    b > 80 && window.innerWidth > 800 ? a(".subtitle").fadeIn() : a(".subtitle").fadeOut()
            }
        }),
        a(window).on("touchmove",
            function(b) {
                a("body").hasClass("mu") && b.preventDefault()
            }),
        a("body").on("click",
            function(b) {
                var c = a(b.target).attr("class") || "",
                    d = a(b.target).attr("rel") || "";
                if (c || d) switch (!0) {
                    case - 1 != c.indexOf("switchmenu") : window.scrollTo(0, 0),
                        a("html, body").toggleClass("mu");
                        break;
                    case - 1 != c.indexOf("more") : if (c = a(".more"), "loading" == c.data("status")) return ! 1;
                        var e = parseInt(c.data("page")) || 1;
                        if (1 == e && c.data("page", 1), e >= Pages) return;
                        return c.html("加载中..").data("status", "loading"),
                            Diaspora.loading(),
                            Diaspora.L(c.attr("href"),
                                function(b) {
                                    var d = a(b).find(".more").attr("href");
                                    void 0 != d ? (c.attr("href", d).html("加载更多").data("status", "loaded"), c.data("page", parseInt(c.data("page")) + 1)) : a("#pager").remove(),
                                        a("#primary").append(a(b).find(".post")),
                                        Diaspora.loaded()
                                },
                                function() {
                                    c.html("加载更多").data("status", "loaded")
                                }),
                            !1;
                    case - 1 != c.indexOf("comment") : Diaspora.loading(),
                        a(".comment").removeClass("link").html("");
                        var f = a(".comment").data("id"),
                            g = function() {
                                var b = document.createElement("div");
                                b.setAttribute("data-thread-key", f),
                                    DUOSHUO.EmbedThread(b),
                                    a(".comment").html(b),
                                    Diaspora.loaded()
                            };
                        window.DUOSHUO ? g() : a.getScript("http://static.duoshuo.com/embed.js",
                            function() {
                                g()
                            });
                        break;
                    case - 1 != c.indexOf("icon-images") : window.scrollTo(0, 0);
                        var h = a(".icon-images");
                        if ("loading" == h.data("status")) return ! 1;
                        if (h.hasClass("active")) h.removeClass("active"),
                            a(".article").css("height", "auto"),
                            a(".section").css("left", "-100%"),
                            setTimeout(function() {
                                    a(".images").data("height", a(".images").height()).css("height", "0")
                                },
                                0);
                        else if (h.addClass("active"), a(".images").css("height", a(".images").data("height")), a(".icon-images").hasClass("tg")) a(".section").css("left", 0),
                            setTimeout(function() {
                                    a(".article").css("height", "0")
                                },
                                0);
                        else {
                            Diaspora.P() && window.innerWidth < 700 || a(".zoom").Chocolat(),
                                Diaspora.loading(),
                                h.data("status", "loading");
                            var i = 5,
                                j = 120;
                            Diaspora.P() && window.innerWidth < 600 && (i = 1, j = 80),
                                a("#jg").justifiedGallery({
                                    margins: i,
                                    rowHeight: j
                                }).on("jg.complete",
                                    function() {
                                        a(".section").css("left", 0),
                                            a(".icon-images").addClass("tg"),
                                            h.data("status", ""),
                                            Diaspora.loaded(),
                                            setTimeout(function() {
                                                    a(".article").css("height", "0")
                                                },
                                                0)
                                    })
                        }
                        break;
                    case - 1 != c.indexOf("icon-wechat") : a(".icon-wechat").hasClass("tg") ? a("#qr").toggle() : (a(".icon-wechat").addClass("tg"), a("#qr").qrcode({
                        width: 128,
                        height: 128,
                        text: location.href
                    }).toggle());
                        break;
                    case - 1 != c.indexOf("icon-play") : a("#audio-" + a(".icon-play").data("id") + "-2")[0].play(),
                        a(".icon-play").removeClass("icon-play").addClass("icon-pause");
                        break;
                    case - 1 != c.indexOf("icon-pause") : a("#audio-" + a(".icon-pause").data("id") + "-2")[0].pause(),
                        a(".icon-pause").removeClass("icon-pause").addClass("icon-play");
                        break;
                    case - 1 != c.indexOf("icon-like") : var k = a(b.target).parent(),
                        l = k.attr("class");
                        if (k.prev().hasClass("icon-view")) return;
                        if (l = l.split(" "), "active" == l[1]) return;
                        k.addClass("active");
                        var f = k.attr("id").split("like-");
                        a.ajax({
                            type: "POST",
                            url: "/index.php",
                            data: "likepost=" + f[1],
                            success: function() {
                                var b = a("#like-" + f[1]).html(),
                                    c = /(\d)+/,
                                    d = c.exec(b);
                                d[0]++,
                                    a("#like-" + f[1]).html('<span class="icon-like"></span><span class="count">' + d[0] + "</span>")
                            }
                        });
                        break;
                    case - 1 != c.indexOf("cover") : return Diaspora.HS(a(b.target).parent(), "push"),
                        !1;
                    case - 1 != c.indexOf("posttitle") : return Diaspora.HS(a(b.target), "push"),
                        !1;
                    case - 1 != c.indexOf("relatea") : return Diaspora.HS(a(b.target), "replace"),
                        !1;
                    case - 1 != c.indexOf("relateimg") : return Diaspora.HS(a(b.target).parent(), "replace"),
                        !1;
                    case "prev" == d || "next" == d: if ("prev" == d) var k = a("#prev_next a")[0].text;
                    else var k = a("#prev_next a")[1].text;
                        return a(b.target).attr("title", k),
                            Diaspora.HS(a(b.target), "replace"),
                            !1;
                    case - 1 != c.indexOf("pviewa") : return a("body").removeClass("mu"),
                        setTimeout(function() {
                                Diaspora.HS(a(b.target), "push")
                            },
                            300),
                        !1;
                    default:
                        return
                }
            })
});