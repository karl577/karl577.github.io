(function ()
{
	// create dotShortcodes plugin
	tinymce.create("tinymce.plugins.dotShortcodes",
	{
		init: function ( ed, url )
		{
			ed.addCommand("dotPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				// load thickbox
				tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "dot_button" )
			{	
				var a = this;
					
				// adds the tinymce button
				btn = e.createMenuButton("dot_button",
				{
					title: "Insert Shortcode",
					image: "../wp-content/themes/cross-apple/wraps/shortcodes/tinymce/images/icon.png",
					icons: false
				});
				
				// adds the dropdown to the button
				btn.onRenderMenu.add(function (c, b)
				{					
					a.addWithPopup( b, "专栏", "columns" );
					a.addWithPopup( b, "按钮", "button" );
					a.addWithPopup( b, "博客滑块清单", "blog_slider_list");
					a.addWithPopup( b, "突出显示文本", "highlight_text" );
					a.addWithPopup( b, "图标列表", "icon_list" );
					a.addWithPopup( b, "图标盒", "icon_box");
					a.addWithPopup( b, "最新消息", "latest_news_list");
					a.addWithPopup( b, "消息框", "message_box");
					a.addWithPopup( b, "投资组合滑块列表", "portfolio_slider_list");
					a.addWithPopup( b, "投资组合分类列表", "portfolio_category_list");
					a.addWithPopup( b, "产品滑块列表", "product_slider_list");
					a.addWithPopup( b, "价格表", "pricing_table");
					a.addWithPopup( b, "风格图片", "style_image" );
					a.addWithPopup( b, "标签", "tabs" );
					a.addWithPopup( b, "客户评价", "testimonials" );
					a.addWithPopup( b, "开关", "toggle" );
				});
				
				return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("dotPopup", false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		addImmediate: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		},
		getInfo: function () {
			return {
				longname: 'Dot Shortcodes',
				author: 'HawkTheme',
				authorurl: 'http://themeforest.net/user/HawkTheme/',
				infourl: 'http://wiki.moxiecode.com/',
				version: "1.0"
			}
		}
	});
	
	// add dotShortcodes plugin
	tinymce.PluginManager.add("dotShortcodes", tinymce.plugins.dotShortcodes);
})();