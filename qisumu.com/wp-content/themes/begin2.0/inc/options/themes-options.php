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

	// 将所有分类（categories）加入数组
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// 所有分类ID
	$categories = get_categories(); 
	foreach ($categories as $cat) {
	$cats_id .= '<li>'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</li>';
	}

	// 所有视频分类ID
	$categories = get_categories(array('taxonomy' => 'videos')); 
	foreach ($categories as $cat) {
	$catv_id .= '<li>'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</li>';
	}

	// 所有图片分类ID
	$categories = get_categories(array('taxonomy' => 'gallery')); 
	foreach ($categories as $cat) {
	$catp_id .= '<li>'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</li>';
	}

	// 所有商品分类ID
	$categories = get_categories(array('taxonomy' => 'taobao')); 
	foreach ($categories as $cat) {
	$catt_id .= '<li>'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</li>';
	}

	// 所有公告分类ID
	$categories = get_categories(array('taxonomy' => 'notice')); 
	foreach ($categories as $cat) {
	$catb_id .= '<li>'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</li>';
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
            'cms' => 'CMS布局',
        	'pany' => '公司主页',
        )
    );

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '首页幻灯',
		'desc' => '显示',
		'id' => 'slider',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
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

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '显示首页推荐文章',
		'desc' => '显示',
		'id' => 'cms_top',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '篇',
		'id' => 'cms_top_n',
		'std' => '4',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '图片布局显示摘要',
		'id' => 'hide_box',
		'std' => '0',
		'type' => 'checkbox'
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

	// CMS设置
	$options[] = array(
		'name' => 'CMS设置',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '最新文章',
		'desc' => '显示',
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
		'name' => '图片日志',
		'desc' => '显示',
		'id' => 'picture',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '选择图片日志分类',
		'desc' => '输入分类ID，多个分类用英文半角逗号","隔开',
		'id' => 'picture_id',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '图片分类ID对照',
		'desc' => '<ul>'.$catp_id.'</ul>',
		'id' => 'catids',
		'type' => 'info'
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
		'name' => '图文模块',
		'desc' => '显示',
		'id' => 'post_img',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '图文自定义栏目名称',
		'desc' => '通过为文章添加特定的自定义栏目，调用指定文章',
		'id' => 'key_img_n',
		'std' => 'thumbnail',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '图文显示篇数',
		'id' => 'post_img_n',
		'std' => '4',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '主体单栏分类列表',
		'desc' => '显示',
		'id' => 'cat_one',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '选择主体单栏分类列表分类',
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
		'name' => '视频日志',
		'desc' => '显示',
		'id' => 'video',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '选择视频日志分类',
		'desc' => '输入分类ID，多个分类用英文半角逗号","隔开',
		'id' => 'video_id',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '视频分类ID对照',
		'desc' => '<ul>'.$catv_id.'</ul>',
		'id' => 'catids',
		'type' => 'info'
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
		'name' => '主体两栏分类列表',
		'desc' => '显示',
		'id' => 'cat_small',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '选择主体两栏分类列表分类',
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
		'name' => '',
		'desc' => '不显示第一篇摘要（只显示自动裁剪后的缩略图）',
		'id' => 'cat_small_z',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => 'Tab切换',
		'desc' => '显示',
		'id' => 'tab_h',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => 'Tab显示篇数',
		'id' => 'tabt_n',
		'std' => '8',
		'type' => 'text'
	);

	$options[] = array(
		'name' => 'Tab“推荐文章”设置',
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
		'name' => 'Tab“专题文章”设置',
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
		'name' => 'Tab“随机文章”设置',
		'desc' => '自定义文字',
		'id' => 'tab_c',
		'std' => '随机文章',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '显示横向图片滚动',
		'desc' => '显示',
		'id' => 'flexisel',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '图片滚动自定义栏目名称',
		'desc' => '通过为文章添加自定义栏目，调用指定文章',
		'id' => 'key_n',
		'std' => 'views',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '横向滚动显示篇数',
		'id' => 'flexisel_n',
		'std' => '4',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '显示底部两栏分类列表',
		'desc' => '显示',
		'id' => 'cat_big',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '选择底部两栏列表分类',
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
		'name' => '',
		'desc' => '不显示第一篇摘要（只显示自动裁剪后的缩略图）',
		'id' => 'cat_big_z',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '淘客',
		'desc' => '显示',
		'id' => 'tao_h',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '选择淘客分类',
		'desc' => '输入分类ID，多个分类用英文半角逗号","隔开',
		'id' => 'tao_h_id',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '淘客分类ID对照',
		'desc' => '<ul>'.$catt_id.'</ul>',
		'id' => 'catids',
		'type' => 'info'
	);

	$options[] = array(
		'name' => '',
		'desc' => '淘客商品显示数量',
		'id' => 'tao_h_n',
		'std' => '4',
		'type' => 'text'
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
		'name' => '显示底部两栏无缩略图分类列表',
		'desc' => '显示，适用于无图片的分类文章',
		'id' => 'cat_big_not',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '选择底部两栏无缩略图列表分类',
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

	// 公司主页

	$options[] = array(
		'name' => '公司主页',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '',
		'desc' => '幻灯图片链接到文章',
		'id' => 'home_slider_url',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '简介及联系方式',
		'desc' => '显示',
		'id' => 'pany_contact',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '标题',
		'desc' => '自定义标题文字',
		'id' => 'pany_contact_t',
		'std' => '简介及联系方式',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '简介',
		'desc' => '',
		'id' => 'pany_contact_w',
		'std' => '输入简短的说明，用于描述站点。输入简短的说明，用于描述站点。输入简短的说明，用于描述站点。输入简短的说明，用于描述站点。输入简短的说明，用于描述站点。输入简短的说明，用于描述站点。输入简短的说明，用于描述站点。输入简短的说明，用于描述站点。',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '按钮',
		'desc' => '"查看详细"按钮文字',
		'id' => 'pany_more_z',
		'std' => '查看详细',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入"查看详细"链接地址',
		'id' => 'pany_more_url',
		'placeholder' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '"联系方式"按钮文字',
		'id' => 'pany_contact_z',
		'std' => '联系方式',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入"联系方式"链接地址',
		'id' => 'pany_contact_url',
		'placeholder' => '',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '选择一个分类',
		'desc' => '显示',
		'id' => 'cat_a',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义标题文字',
		'id' => 'cat_a_w',
		'std' => '选择一个分类',
		'type' => 'text'
	);

	if ( $options_categories ) {
	$options[] = array(
		'name' => '',
		'desc' => '选择一个分类',
		'id' => 'cat_a_id',
		'type' => 'select',
		'options' => $options_categories);
	}

	$options[] = array(
		'name' => '',
		'desc' => '显示篇数',
		'id' => 'cat_a_n',
		'std' => '4',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入更多按钮链接地址',
		'id' => 'cata_url',
		'placeholder' => '',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '调用指定文章和页面',
		'desc' => '显示',
		'id' => 'pageid',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义标题文字',
		'id' => 'pageid_w',
		'std' => '调用指定文章和页面',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入文章或者页面 ID',
		'id' => 'page_id',
		'std' => '6859,4826,4303,6431',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '自定义链接',
		'desc' => '显示',
		'id' => 'custom_links',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义链接标题文字',
		'id' => 'custom_links_w',
		'std' => '自定义链接',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '第一个自定义链接设置',
		'desc' => '标题1文字',
		'id' => 'custom_1_w',
		'std' => '标题1',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '标题1链接地址',
		'id' => 'custom_1_url',
		'placeholder' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '上传缩略图',
		'id' => 'custom_img_1',
        "std" => "$blogpath/random/11.jpg",
		'type' => 'upload'
	);

	$options[] = array(
		'name' => '第二个自定义链接设置',
		'desc' => '标题2文字',
		'id' => 'custom_2_w',
		'std' => '标题2',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '标题2链接地址',
		'id' => 'custom_2_url',
		'placeholder' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '上传缩略图',
		'id' => 'custom_img_2',
        "std" => "$blogpath/random/11.jpg",
		'type' => 'upload'
	);

	$options[] = array(
		'name' => '第三个自定义链接设置',
		'desc' => '标题3文字',
		'id' => 'custom_3_w',
		'std' => '标题3',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '标题3链接地址',
		'id' => 'custom_3_url',
		'placeholder' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '上传缩略图',
		'id' => 'custom_img_3',
        "std" => "$blogpath/random/11.jpg",
		'type' => 'upload'
	);

	$options[] = array(
		'name' => '第四个自定义链接设置',
		'desc' => '标题4文字',
		'id' => 'custom_4_w',
		'std' => '标题4',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '标题4链接地址',
		'id' => 'custom_4_url',
		'placeholder' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '上传缩略图',
		'id' => 'custom_img_4',
        "std" => "$blogpath/random/11.jpg",
		'type' => 'upload'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '自定义文字及链接',
		'desc' => '显示',
		'id' => 'pany_custom',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义标题文字',
		'id' => 'pany_custom_w',
		'std' => '自定义文字及链接',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '',
		'id' => 'custom_w',
		'std' => '输入一段文字，输入一段文字，输入一段文字，输入一段文字，输入一段文字，输入一段文字，输入一段文字，输入一段文字，输入一段文字，输入一段文字，输入一段文字，输入一段文字，输入一段文字，输入一段文字。',
		'type' => 'textarea'
	);

	$options[] = array(
		'name' => '',
		'desc' => '上传图片',
		'id' => 'custom_thumbnail',
        "std" => "http://ww3.sinaimg.cn/large/703be3b1jw1f0bs15229ej20f008c0tv.jpg",
		'type' => 'upload'
	);

	$options[] = array(
		'name' => '',
		'desc' => '查看详细文字',
		'id' => 'custom_z',
		'std' => '查看详细',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入查看详细按钮链接地址',
		'id' => 'custom_url',
		'placeholder' => '',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '公司主页一栏小工具A',
		'desc' => '显示',
		'id' => 'pany_one_a',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义文字,可以删除文字',
		'id' => 'pany_one_a_w',
		'std' => '公司主页一栏小工具A',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '公司主页两栏小工具A',
		'desc' => '显示',
		'id' => 'pany_two_a',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义文字,可以删除文字',
		'id' => 'pany_two_a_w',
		'std' => '公司主页两栏小工具A',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '公司主页一栏小工具B',
		'desc' => '显示',
		'id' => 'pany_one_b',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义文字,可以删除文字',
		'id' => 'pany_one_b_w',
		'std' => '公司主页一栏小工具B',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '公司主页两栏小工具B',
		'desc' => '显示',
		'id' => 'pany_two_b',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义文字,可以删除文字',
		'id' => 'pany_two_b_w',
		'std' => '公司主页两栏小工具B',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '图片滚动',
		'desc' => '显示',
		'id' => 'pany_scrolling',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义标题文字',
		'id' => 'cat_b_w',
		'std' => '图片滚动',
		'type' => 'text'
	);

	if ( $options_categories ) {
	$options[] = array(
		'name' => '',
		'desc' => '选择一个分类',
		'id' => 'cat_b_id',
		'type' => 'select',
		'options' => $options_categories);
	}

	$options[] = array(
		'name' => '',
		'desc' => '显示篇数',
		'id' => 'cat_b_n',
		'std' => '4',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入更多按钮链接地址',
		'id' => 'catb_url',
		'placeholder' => '',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '公司主页一栏小工具C',
		'desc' => '显示',
		'id' => 'pany_one_c',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义文字,可以删除文字',
		'id' => 'pany_one_c_w',
		'std' => '公司主页一栏小工具C',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '公司主页两栏小工具C',
		'desc' => '显示',
		'id' => 'pany_two_c',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义文字,可以删除文字',
		'id' => 'pany_two_c_w',
		'std' => '公司主页两栏小工具C',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	// 基本设置

	$options[] = array(
		'name' => '基本设置',
		'type' => 'heading'
	);

	$options[] = array(
		'name' => '管理站点',
		'desc' => '显示管理站点',
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
		'name' => '邀请码注册',
		'desc' => '启用',
		'id' => 'invitation_code',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入获取邀请码方式',
		'id' => 'to-code',
		'std' => '请联系站长获取邀请码',
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
		'name' => '',
		'desc' => '在移动设备上显示登录按钮',
		'id' => 'mobile_login',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '移动端导航按钮链接到页面',
		'id' => 'nav_no',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '选择页面',
		'id' => 'nav_url',
		'type' => 'select',
		'class' => 'mini',
		'options' => $options_pages
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
		'std' => '0',
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
		'name' => '缩略图自动裁剪尺寸设置',
		'id' => 'c_img',
	);

	$options[] = array(
		'desc' => '标准缩略图',
		'id' => 'img_c',
	);

	$options[] = array(
		'desc' => '宽 默认280',
		'id' => 'img_w',
		'std' => '280',
		'type' => 'text'
	);

	$options[] = array(
		'desc' => '高 默认210',
		'id' => 'img_h',
		'std' => '210',
		'type' => 'text'
	);

	$options[] = array(
		'desc' => '分类模块缩略图',
		'id' => 'img_c',
	);

	$options[] = array(
		'desc' => '宽 默认530',
		'id' => 'img_k_w',
		'std' => '530',
		'type' => 'text'
	);

	$options[] = array(
		'desc' => '高 默认200',
		'id' => 'img_k_h',
		'std' => '200',
		'type' => 'text'
	);

	$options[] = array(
		'desc' => '图片缩略图',
		'id' => 'img_c',
	);

	$options[] = array(
		'desc' => '宽 默认280',
		'id' => 'img_i_w',
		'std' => '280',
		'type' => 'text'
	);

	$options[] = array(
		'desc' => '高 默认210',
		'id' => 'img_i_h',
		'std' => '210',
		'type' => 'text'
	);

	$options[] = array(
		'desc' => '视频缩略图',
		'id' => 'img_c',
	);

	$options[] = array(
		'desc' => '宽 默认280',
		'id' => 'img_v_w',
		'std' => '280',
		'type' => 'text'
	);

	$options[] = array(
		'desc' => '高 默认210',
		'id' => 'img_v_h',
		'std' => '210',
		'type' => 'text'
	);

	$options[] = array(
		'desc' => '商品缩略图',
		'id' => 'img_c',
	);

	$options[] = array(
		'desc' => '宽 默认300',
		'id' => 'img_t_w',
		'std' => '300',
		'type' => 'text'
	);

	$options[] = array(
		'desc' => '高 默认300',
		'id' => 'img_t_h',
		'std' => '300',
		'type' => 'text'
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
		'name' => '图片延迟加载',
		'desc' => '启用缩略图延迟加载',
		'id' => 'lazy_s',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '启用正文图片延迟加载',
		'id' => 'lazy_e',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '启用留言头像延迟加载',
		'id' => 'lazy_c',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '文章Ajax滚动加载',
		'desc' => '启用',
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
		'name' => '评论Ajax翻页',
		'desc' => '启用',
		'id' => 'comment_scroll',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '公告',
		'desc' => '显示，并代替首页面包屑导航',
		'id' => 'bulletin',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '选择公告分类',
		'desc' => '输入分类ID，多个分类用英文半角逗号","隔开',
		'id' => 'bulletin_id',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '公告分类ID对照',
		'desc' => '<ul>'.$catb_id.'</ul>',
		'id' => 'catids',
		'type' => 'info'
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
		'desc' => '自定义阅读全文按钮文字',
		'id' => 'more_w',
		'std' => '阅读全文',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义直达链接按钮文字',
		'id' => 'direct_w',
		'std' => '直达链接',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '禁止冒充管理员留言',
		'id' => 'check_admin',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '管理员名称',
		'id' => 'admin_name',
		'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '管理员邮箱',
		'id' => 'admin_email',
		'std' => '',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '显示分类推荐文章',
		'id' => 'cat_top',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '在线视频支持（请禁用Smartideo插件，再勾选启用）',
		'id' => 'smart_ideo',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '滚动动画',
		'id' => 'wow_no',
		'std' => '1',
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
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '禁用xmlrpc',
		'id' => 'xmlrpc_no',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自动为文章添加标签（酌情开启）',
		'id' => 'auto_tags',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '页面添加.html后缀（更改后需重新保存一下固定链接设置）',
		'id' => 'page_html',
		'std' => '0',
		'type' => 'checkbox'
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
		'desc' => '显示评论等级',
		'id' => 'vip',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '显示评论楼层',
		'id' => 'comment_floor',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '3D标签云',
		'id' => '3dtag',
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
		'desc' => '显示',
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
		'name' => '图片、视频、商品文章归档',
		'desc' => '显示篇数，注：要求大于WP阅读设置页面博客页面至多显示篇数',
		'id' => 'taxonomy_cat_n',
		'std' => '16',
		'class' => 'mini',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '图片、视频、商品分类页面模板',
		'desc' => '分类显示篇数',
		'id' => 'custom_cat_n',
		'std' => '12',
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
		'desc' => '启用',
		'id' => 'footer_w',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '首页页脚链接',
		'desc' => '显示首页页脚链接',
		'id' => 'footer_link',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '可以输入链接分类ID，显示特定的链接在首页，留空则显示全部链接',
		'id' => 'link_f_cat',
		'std' => '',
		'type' => 'text'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '友情链接页面',
		'desc' => '可以输入链接分类ID，只显示特定的链接，留空显示全部链接',
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

	$options[] = array(
		'name' => '',
		'desc' => '显示链接分类名称',
		'id' => 'linkcat_h2',
		'std' => '0',
		'type' => 'checkbox'
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
		'name' => '',
		'desc' => '为Logo添加扫光动画',
		'id' => 'logo_css',
		'std' => '1',
		'type' => 'checkbox'
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
		'name' => '生成当前页面二维码',
		'desc' => '启用',
		'id' => 'qr_img',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '上传二维码中间小Logo图片',
		'desc' => '',
		'id' => 'qr_icon',
        "std" => "$blogpath/favicon.png",
		'type' => 'upload'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '新浪微博关注按钮',
		'desc' => '启用',
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
		'name' => 'QQ在线',
		'desc' => '启用',
		'id' => 'qq_online',
		'std' => '0',
		'type' => 'checkbox'
	);

	$options[] = array(
		'name' => '',
		'desc' => '自定义文字',
		'id' => 'qq_name',
		'std' => '在线咨询',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '输入QQ号码',
		'id' => 'qq_id',
		'std' => '8888',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '微信二维码',
		'id' => 'weixing_qr',
        "std" => "$blogpath/favicon.png",
		'type' => 'upload'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '显示简繁体转换按钮',
		'id' => 'gb2',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '点赞分享',
		'desc' => '启用正文底部点赞分享按钮',
		'id' => 'zm_like',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '',
		'desc' => '启用百度分享',
		'id' => 'share',
		'std' => '1',
		'type' => 'checkbox'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '打赏（赞助）按钮设置',
		'desc' => '自定义按钮文字，留空则不显示弹窗',
		'id' => 'alipay_name',
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
		'desc' => '自定义弹窗标题文字，留空则不显示',
		'id' => 'alipay_h',
		'std' => '您可以选择一种方式赞助本站',
		'type' => 'text'
	);

	$options[] = array(
		'name' => '',
		'desc' => '上传支付宝二维码图片（＜240px）',
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
		'desc' => '上传微信钱包二维码图片（＜250px）',
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
        "std" => "http://ww3.sinaimg.cn/large/703be3b1jw1ezoddh8a9mj21hc0u014s.jpg",
		'type' => 'upload'
	);

	$options[] = array(
		'id' => 'clear'
	);

	$options[] = array(
		'name' => '注册页面背景图片',
		'desc' => '上传背景图片',
		'id' => 'reg_img',
        "std" => "http://ww1.sinaimg.cn/large/703be3b1jw1ew0wrzdyguj21hc0u0tcy.jpg",
		'type' => 'upload'
	);

	$options[] = array(
		'name' => '注册页面视频背景',
		'desc' => '上传视频背景（默认视频外链自搜狐）',
		'id' => 'reg_video',
        "std" => "http://data.vod.itc.cn/?new=/241/113/LAHVGSHQTBO9H9nLD4iuNF.mp4&vid=2389831&ch=tv&cateCode=107;107102&plat=null&mkey=naGNastwo_0-KG4inoUSAquepq1SRBiy&prod=app",
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
		'name' => '',
		'desc' => '首页显示站点副标题',
		'id' => 'blog_info',
		'std' => '1',
		'type' => 'checkbox'
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
		'std' => '<a title="主题设计：知更鸟" href="http://zmingcx.com/" target="_blank"><img src="' . get_template_directory_uri() . '/ad/img/bt.png" alt="Begin主题" /></a>',
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
		'desc' => '显示',
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
		'desc' => '显示',
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
		'desc' => '显示',
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
		'desc' => '显示',
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
		'desc' => '显示',
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
		'desc' => '显示',
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
		'desc' => '默认值：1080，只适用于增加宽度，不使用自定义宽度请留空！',
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
		'name' => '自定义样式',
		'desc' => '例如输入：#menu-box {background: #568abc;} 将固定的导航背景改为深蓝色',
		'id' => 'custom_css',
        'std' => '',
		'type' => 'textarea'
    );

	return $options;
}