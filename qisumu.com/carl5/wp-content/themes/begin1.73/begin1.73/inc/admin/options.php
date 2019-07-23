<?php

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

function optionsframework_options() {

	$blogpath =  get_stylesheet_directory_uri() . '/img';

	// 将所有分类（categories）加入数组y
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// 所有分类ID
	$categories = get_categories(); 
	$cats_id='';foreach ($categories as $cat) {
	$cats_id .= '<li>'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</li>';
	}

	// 将所有标签（tags）加入数组
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// 将所有页面（pages）加入数组
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = '选择页面:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	$options = array();


	// 首页设置

	$options[] = array(
		'name' => '首页设置',
		'type' => 'heading'
	);

    $options[] = array(
        'name' => '首页布局选择',
        'id' => 'layout',
        'std' => 'blog',
        'type' => 'radio',
        'options' => array(
            'blog' => '博客布局',
            'img' => '图片布局',
            'cms' => 'CMS布局'
        )
    );

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '首页幻灯',
		'desc' => '勾选后用于显示置顶文章',
		'id' => 'slider',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '幻灯设置',
		'desc' => '幻灯显示篇数',
		'id' => 'slider_n',
		'std' => '2',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '首页博客布局排除的分类文章',
		'desc' => '输入排除的分类ID，多个分类用半角逗号","隔开',
		'id' => 'not_cat_n',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '分类ID对照',
		'desc' => '<ul>'.$cats_id.'</ul>',
		'id' => 'catid',
		'type' => 'info'
	);


	// CMS设置
	$options[] = array(
		'name' => 'CMS设置',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '最新文章模块',
		'desc' => '勾选显示',
		'id' => 'news',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '最新文章显示篇数',
		'id' => 'news_n',
		'std' => '2',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入排除的分类ID，多个分类用英文半角逗号","隔开',
		'id' => 'not_news_n',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '分类ID对照',
		'desc' => '<ul>'.$cats_id.'</ul>',
		'id' => 'catids',
		'type' => 'info'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '图片日志模块',
		'desc' => '勾选显示',
		'id' => 'picture',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '图片日志显示篇数',
		'id' => 'picture_n',
		'std' => '4',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '随机显示图片日志',
		'id' => 'rand_img',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '显示图文模块',
		'desc' => '勾选显示',
		'id' => 'post_img',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '图文模块自定义栏目名称',
		'desc' => '通过为文章添加特定的自定义栏目，调用指定文章',
		'id' => 'key_img_n',
		'std' => 'thumbnail',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '图文模块显示篇数',
		'id' => 'post_img_n',
		'std' => '4',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '主体单栏分类列表模块',
		'desc' => '勾选显示',
		'id' => 'cat_one',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '选择主体单栏分类列表模块分类',
		'desc' => '输入分类ID，多个分类用英文半角逗号","隔开',
		'id' => 'cat_one_id',
		'std' => '1,2',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '分类ID对照',
		'desc' => '<ul>'.$cats_id.'</ul>',
		'id' => 'catids',
		'type' => 'info'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '视频日志模块',
		'desc' => '勾选显示',
		'id' => 'video',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '视频日志显示篇数',
		'id' => 'video_n',
		'std' => '4',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '随机显示视频日志',
		'id' => 'rand_video',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '主体两栏分类列表模块',
		'desc' => '勾选显示',
		'id' => 'cat_small',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '选择主体两栏分类列表模块分类',
		'desc' => '输入分类ID，多个分类用英文半角逗号","隔开',
		'id' => 'cat_small_id',
		'std' => '1,2',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '分类ID对照',
		'desc' => '<ul>'.$cats_id.'</ul>',
		'id' => 'catids',
		'type' => 'info'
	);

	$options[] = array(
		'name' => '',
		'desc' => '主体两栏分类列表显示篇数',
		'id' => 'cat_small_n',
		'std' => '4',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear',
		'class' => 'hidden'
	);

	$options[] = array(
		'name' => 'Tab切换模块',
		'desc' => '勾选显示',
		'id' => 'tab_h',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => 'Tab模块显示篇数',
		'id' => 'tabt_n',
		'std' => '8',
		'type' => 'text'
	);

	$options[] = array(
		'name' => 'Tab模块“推荐文章”设置',
		'desc' => '自定义文字',
		'id' => 'tab_a',
		'std' => '推荐文章',
		'type' => 'text'
	);

	if ( $options_categories ) {
	$options[] = array(
		'name' => '',
		'desc' => '选择一个分类',
		'id' => 'tabt_id',
		'type' => 'select',
		'options' => $options_categories);
	}

	$options[] = array(
		'name' => 'Tab模块“专题文章”设置',
		'desc' => '自定义文字',
		'id' => 'tab_b',
		'std' => '专题文章',
		'type' => 'text'
	);

	if ( $options_categories ) {
	$options[] = array(
		'name' => '',
		'desc' => '选择一个分类',
		'id' => 'tabz_n',
		'type' => 'select',
		'options' => $options_categories);
	}

	$options[] = array(
		'name' => 'Tab模块“随机文章”设置',
		'desc' => '自定义文字',
		'id' => 'tab_c',
		'std' => '随机文章',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '显示横向图片滚动模块',
		'desc' => '勾选显示',
		'id' => 'flexisel',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '图片滚动自定义栏目名称',
		'desc' => '通过为文章添加自定义栏目，调用指定文章',
		'id' => 'key_n',
		'std' => 'thumbnail',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '横向滚动模块显示篇数',
		'id' => 'flexisel_n',
		'std' => '4',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '显示底部两栏分类列表模块',
		'desc' => '勾选显示',
		'id' => 'cat_big',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '选择底部两栏列表模块分类',
		'desc' => '输入分类ID，多个分类用英文半角逗号","隔开',
		'id' => 'cat_big_id',
		'std' => '1,2',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '分类ID对照',
		'desc' => '<ul>'.$cats_id.'</ul>',
		'id' => 'catids',
		'type' => 'info');

	$options[] = array(
		'name' => '',
		'desc' => '底部两栏列表显示篇数',
		'id' => 'cat_big_n',
		'std' => '4',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '淘客模块',
		'desc' => '勾选显示',
		'id' => 'tao_h',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '淘客商品显示数量',
		'id' => 'tao_h_n',
		'std' => '4',
		'type' => 'text'
	);

    $options[] = array(
        'name' => '商品图片链接选择',
        'id' => 'tao_url',
        'std' => 'p_url',
        'type' => 'radio',
        'options' => array(
            'p_url' => '链接到本站商品',
            'm_url' => '跳转到商品购买页'
        )
    );

	$options[] = array(
		'name' => '',
		'desc' => '随机显示淘客商品',
		'id' => 'rand_tao',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '显示底部两栏无缩略图分类列表模块',
		'desc' => '勾选显示，适用于无图片的分类文章',
		'id' => 'cat_big_not',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '选择底部两栏无缩略图列表模块分类',
		'desc' => '输入分类ID，多个分类用英文半角逗号","隔开',
		'id' => 'cat_big_not_id',
		'std' => '1,2',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '底部两栏无缩略图列表显示篇数',
		'id' => 'cat_big_not_n',
		'std' => '4',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '分类ID对照',
		'desc' => '<ul>'.$cats_id.'</ul>',
		'id' => 'catids',
		'type' => 'info'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '显示文章列表日期',
		'id' => 'list_date',
		'std' => '1',
		'type' => 'checkbox'
	);

	// 基本设置

	$options[] = array(
		'name' => '基本设置',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '管理站点',
		'desc' => '显示管理站点模块',
		'id' => 'profile',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '显示登录按钮',
		'id' => 'login',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '使用默认登录页面',
		'id' => 'user_l',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '顶部欢迎语',
		'desc' => '',
		'id' => 'wel_come',
		'std' => '欢迎光临！',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '注册按钮',
		'desc' => '输入注册页面地址，留空则显示欢迎语',
		'id' => 'reg_url',
		'placeholder' => '',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '用户中心',
		'desc' => '选择用户中心页面',
		'id' => 'user_url',
		'type' => 'select',
		'class' => 'mini',
		'options' => $options_pages
	);

	$options[] = array(
		'name' => '用户信息',
		'desc' => '选择用户信息页面',
		'id' => 'user_profile',
		'type' => 'select',
		'class' => 'mini',
		'options' => $options_pages
	);

	$options[] = array(
		'name' => '用户投稿',
		'desc' => '选择投稿页面，否则不显示投稿按钮',
		'id' => 'tou_url',
		'type' => 'select',
		'class' => 'mini',
		'options' => $options_pages
	);

	$options[] = array(
		'name' => '',
		'desc' => '非管理员不允许进入后台',
		'id' => 'no_admin',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '移动端导航菜单',
		'desc' => '启用单独移动端导航菜单',
		'id' => 'm_nav',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '搜索设置',
		'desc' => '使用WP自带搜索',
		'id' => 'wp_s',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '百度站内搜索',
		'desc' => '使用百度站内搜索',
		'id' => 'baidu_s',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入百度站内搜索ID',
		'id' => 'baidu_id',
		'std' => '2817554795023086482',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '选择百度搜索结果页面',
		'id' => 'baidu_url',
		'type' => 'select',
		'class' => 'mini',
		'options' => $options_pages
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '图片延迟加载',
		'desc' => '启用正文图片及缩略图延迟加载',
		'id' => 'lazy_s',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '启用留言头像延迟加载',
		'id' => 'lazy_c',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '文章滚动加载',
		'desc' => '勾选启用',
		'id' => 'scroll',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '滚动加载页数',
		'id' => 'scroll_n',
		'std' => '3',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);


	$options[] = array(
		'name' => '公告',
		'desc' => '勾选显示，并代替首页面包屑导航',
		'id' => 'bulletin',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '公告滚动篇数',
		'id' => 'bulletin_n',
		'std' => '2',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '代码高亮显示',
		'id' => 'highlight',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '滑动才能提交（评论、注册）',
		'id' => 'qt',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '启用评论 ajax 翻页',
		'id' => 'comment_nav',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '启用特色图像，如不使用该功能请不要开启',
		'id' => 'wp_thumbnails',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '四级标题作为文章索引目录',
		'id' => 'index_c',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '外链接（包括评论者链接）添加自动跳转',
		'id' => 'link_to',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自动为文章中的关键词添加链接',
		'id' => 'tag_c',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '链接数量',
		'id' => 'chain_n',
		'std' => '2',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自动将文章标题作为图片ALT标签内容',
		'id' => 'image_alt',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '显示正文底部点赞分享按钮',
		'id' => 'zm_like',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '显示正文底部版权信息',
		'id' => 'copyright',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '评论@回复',
		'id' => 'at',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '彩色标签云',
		'id' => 'color_tag',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '3D标签云，只应用于主题集成的"热门标签"小工具',
		'id' => '3dtag',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '显示正文相关文章图片',
		'id' => 'related_img',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '显示篇数',
		'id' => 'related_n',
		'std' => '4',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '正文底部商品',
		'desc' => '勾选显示',
		'id' => 'single_tao',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '商品显示个数',
		'id' => 'single_tao_n',
		'std' => '4',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '最新文章图标',
		'desc' => '默认一周（168小时）内发表的文章显示，最短24小时',
		'id' => 'new_n',
		'std' => '168',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '联系方式',
		'desc' => '输入常用邮箱用于联系方式页面模板',
		'id' => 'email',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '页脚小工具',
		'desc' => '勾选启用',
		'id' => 'footer_w',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '首页页脚链接',
		'desc' => '勾选显示首页页脚链接',
		'id' => 'footer_link',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '留空则显示全部链接，可以输入链接分类ID，显示特定的链接在首页，多个分类用英文半角逗号","隔开',
		'id' => 'link_f_cat',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '友情链接页面',
		'desc' => '留空显示全部链接，可以输入链接分类ID，只显示特定的链接',
		'id' => 'link_cat',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '选择友情链接页面',
		'id' => 'link_url',
		'type' => 'select',
		'class' => 'mini',
		'options' => $options_pages
	);

	// 网站标志

	$options[] = array(
		'name' => '网站标志',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '站点LOGO',
		'desc' => '勾选并上传logo',
		'id' => 'logos',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '上传Logo',
		'desc' => '透明png图片最佳，比例 220×50px',
		'id' => 'logo',
        "std" => "$blogpath/logo.png",
		'class' => 'hidden',
		'type' => 'upload'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '自定义Favicon',
		'desc' => '上传favicon.ico，并通过FTP上传到网站根目录',
		'id' => 'favicon',
        "std" => "$blogpath/favicon.ico",
		'type' => 'upload'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '自定义IOS屏幕图标',
		'desc' => '上传苹果移动设备添加到主屏幕图标',
		'id' => 'apple_icon',
        "std" => "$blogpath/favicon.png",
		'type' => 'upload'
	);

	// 辅助功能

	$options[] = array(
		'name' => '辅助功能',
		'type' => 'heading'
	);

    $options[] = array(
        'name' => 'Gravatar 头像获取',
        'id' => 'gravatar_url',
        'std' => 'cn',
        'type' => 'radio',
        'options' => array(
            'no' => '默认',
            'cn' => '从官方cn服务器获取',
            'ssl' => '从官方ssl获取',
            'duoshuo' => '从多说服务器获取'
        )
    );

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '新浪微博关注按钮',
		'desc' => '勾选启用',
		'id' => 'weibo_t',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入新浪微博ID',
		'id' => 'weibo_id',
		'std' => '1882973105',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '百度分享',
		'desc' => '勾选启用',
		'id' => 'share',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '百度分享代码',
		'desc' => '输入你的百度分享代码，只需要后面的“<script&gt; </script&gt;”代码',
		'id' => 'share_code',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '打赏（赞助）按钮设置',
		'desc' => '自定义弹窗标题文字，留空则不显示',
		'id' => 'alipay_h',
		'std' => '您可以选择一种方式赞助本站',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义按钮文字',
		'id' => 'alipay_name',
		'class' => 'mini',
		'std' => '赏',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义提示文字',
		'id' => 'alipay_t',
		'std' => '赞助本站',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入您的支付宝账户，留空则不显示支付宝按钮',
		'id' => 'alipay_id',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '上传支付宝二维码图片',
		'id' => 'qr_a',
        "std" => "",
		'type' => 'upload'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义支付宝二维码图片文字说明，留空则不显示',
		'id' => 'alipay_z',
		'std' => '支付宝扫一扫赞助',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '上传微信钱包二维码图片',
		'id' => 'qr_b',
        "std" => "",
		'type' => 'upload'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义微信钱包二维码图片文字说明，留空则不显示',
		'id' => 'alipay_w',
		'std' => '微信钱包扫描赞助',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '付款表单设置',
		'desc' => '付款说明',
		'id' => 'reason',
		'std' => '赞助本站',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '备注',
		'id' => 'comments_area',
		'std' => '请填写您的联系方式，以便答谢！',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '订阅',
		'desc' => '输入feed地址，用于关注我们小工具',
		'id' => 'feed_url',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '微信',
		'desc' => '上传微信二维码图片，用于关注我们小工具',
		'id' => 'weixin',
        "std" => "$blogpath/weixin.jpg",
		'type' => 'upload'
	);

	$options[] = array(
		'name' => '新浪微博',
		'desc' => '输入新浪微博地址，用于关注我们小工具',
		'id' => 'tsina_url',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '腾讯微博',
		'desc' => '输入腾讯微博地址，用于关注我们小工具',
		'id' => 'tqq_url',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '自定义404页面标题',
		'desc' => '',
		'id' => '404_t',
		'std' => '亲，你迷路了！',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '自定义404页面内容',
		'desc' => '',
		'id' => '404_c',
		'std' => '亲，该网页可能搬家了！',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '首页新窗口或标签打开链接',
		'id' => 'blank',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '页面滚动更加顺滑。注：可能有兼容性问题，酌情启用。',
		'id' => 'nice_scroll',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '后台登录美化',
		'desc' => '启用后台登录美化',
		'id' => 'custom_login',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '上传背景图片',
		'id' => 'login_img',
        "std" => "http://ww2.sinaimg.cn/large/703be3b1jw1evuwvgfzwnj21hc0u0gxy.jpg",
		'type' => 'upload'
	);

	// SEO设置

	$options[] = array(
		'name' => 'SEO设置',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '',
		'desc' => '启用主题自带SEO功能，如使用其它SEO插件，请取消勾选',
		'id' => 'wp_title',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '首页描述（Description）',
		'desc' => '',
		'id' => 'description',
		'std' => '一般不超过200个字符',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '首页关键词（KeyWords）',
		'desc' => '',
		'id' => 'keyword',
		'std' => '一般不超过100个字符',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '将文章主动推送到百度',
		'desc' => '启用',
		'id' => 'baidu_submit',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入百度主动推送token值',
		'id' => 'token_p',
		'class' => 'mini',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '站点title连接符',
		'desc' => '修改站点title连接符号',
		'id' => 'connector',
		'std' => '|',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '自定义图片固定链接前缀别名',
		'desc' => '“图片”固定链接前缀别名',
		'id' => 'img_url',
		'std' => 'picture',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '“图片分类”固定链接前缀别名',
		'id' => 'img_cat_url',
		'std' => 'gallery',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '自定义视频固定链接前缀别名',
		'desc' => '“视频”固定链接前缀别名',
		'id' => 'video_url',
		'std' => 'video',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '“视频分类”固定链接前缀别名',
		'id' => 'video_cat_url',
		'std' => 'videos',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '自定义商品固定链接前缀别名',
		'desc' => '“商品”固定链接前缀别名',
		'id' => 'sp_url',
		'std' => 'tao',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '“商品分类”固定链接前缀别名',
		'id' => 'sp_cat_url',
		'std' => 'taobao',
		'class' => 'mini',
		'type' => 'text'
	);

	$wp_editor_settings = array(
		'wpautop' => true, // 默认
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '流量统计代码（异步）',
		'desc' => '用于在页头添加异步统计代码，',
		'id' => 'tongji_h',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '流量统计代码（同步）',
		'desc' => '用于在页脚添加同步统计代码',
		'id' => 'tongji_f',
		'std' => '',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '编辑页脚第一行信息',
		'desc' => '个性化页脚内容',
		'id' => 'footer_inf_t',
		'std' => 'Copyright &copy;&nbsp;&nbsp;站点名称&nbsp;&nbsp;版权所有.',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);

	$options[] = array(
		'name' => '编辑页脚第二行信息',
		'desc' => '注：这部分内容在小屏设备上会被隐藏掉',
		'id' => 'footer_inf_b',
		'std' => '<a title="该主题由Xiao伟破解授权" href="http://www.hfanshu.com/" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/bt.png" alt="Begin主题" /></a>',
		'type' => 'editor',
		'settings' => $wp_editor_settings
	);

	// 广告设置

	$options[] = array(
		'name' => '广告设置',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '头部通栏广告位',
		'desc' => '勾选显示',
		'id' => 'ad_h_t',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '输入头部通栏广告代码（非移动端）',
		'desc' => '宽度小于等于 1080px',
		'id' => 'ad_ht_c',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/ad.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '输入头部通栏广告代码（用于移动端）',
		'desc' => '',
		'id' => 'ad_ht_m',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/ad.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '头部两栏广告位',
		'desc' => '勾选显示',
		'id' => 'ad_h',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '输入头部左侧广告代码（非移动端）',
		'desc' => '宽度小于等于 758px',
		'id' => 'ad_h_c',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/ad.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '输入头部左侧广告代码（用于移动端）',
		'desc' => '',
		'id' => 'ad_h_c_m',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/ad.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '输入头部右侧广告代码（非移动端）',
		'desc' => '宽度小于等于 307px',
		'id' => 'ad_h_cr',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/adhr.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '文章列表广告位',
		'desc' => '勾选显示',
		'id' => 'ad_a',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '输入文章列表广告代码（非移动端）',
		'desc' => '宽度小于等于 760px',
		'id' => 'ad_a_c',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/ad.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '输入文章列表广告代码（用于移动端）',
		'desc' => '',
		'id' => 'ad_a_c_m',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/ad.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '正文标题广告位',
		'desc' => '勾选显示',
		'id' => 'ad_s',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '输入正文标题广告代码（非移动端）',
		'desc' => '宽度小于等于 740px',
		'id' => 'ad_s_c',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/ad.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '输入正文标题广告代码（用于移动端）',
		'desc' => '',
		'id' => 'ad_s_c_m',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/ad.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '正文底部广告位',
		'desc' => '勾选显示',
		'id' => 'ad_s_b',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '输入正文底部广告代码（非移动端）',
		'desc' => '宽度小于等于 740px',
		'id' => 'ad_s_c_b',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/ad.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '输入正文底部广告代码（用于移动端）',
		'desc' => '',
		'id' => 'ad_s_c_b_m',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/ad.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '评论上方广告位',
		'desc' => '勾选显示',
		'id' => 'ad_c',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '输入评论上方广告代码（非移动端）',
		'desc' => '宽度小于等于 760px',
		'id' => 'ad_c_c',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/ad.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '输入评论上方广告代码（用于移动端）',
		'desc' => '',
		'id' => 'ad_c_c_m',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/ad.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '下载弹窗广告代码',
		'desc' => '',
		'id' => 'ad_f',
		'std' => '<a href="#" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/adf.jpg" alt="广告也精彩" /></a>',
		'type' => 'textarea'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '需要在页头<head></head>之间加载的广告代码，如无必要不需添加任何东西',
		'desc' => '',
		'id' => 'ad_t',
		'std' => '',
		'type' => 'textarea'
	);

	// 定制CSS

	$options[] = array(
		'name' => '定制风格',
		'type' => 'heading'
	);

    $options[] = array(
		'name' => '页面宽度',
		'desc' => '默认值：1080，不使用自定义宽度请留空！',
		'id' => 'custom_width',
        'std' => '',
		'type' => 'text'
    );

	$options[] = array(
		'id' => 'clear'
	);

    $options[] = array(
		'name' => '颜色风格',
		'desc' => '选择自己喜欢的颜色，不使用自定义颜色清空即可',
		'id' => 'custom_color',
        'std' => '',
		'type' => 'color'
    );

	$options[] = array(
		'name' => '参考颜色值',
		'desc' => '<ul>#0ea385 #2f889a #ff4400 #cc0000 #8b786a #4cb6cb #e84266</ul>'
	);

	$options[] = array(
		'id' => 'clear'
	);

    $options[] = array(
		'name' => '输入自定义样式代码',
		'desc' => '例如输入：#menu-box {background: #568abc;} 将固定的导航背景改为深蓝色',
		'id' => 'custom_css',
        'std' => '',
		'type' => 'textarea'
    );

	return $options;
}