<!DOCTYPE html>
<html class="no-js" lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
<meta content="webkit" name="renderer" />
<meta content="mobantu" name="author" />
<title><?php wp_title( '-', true, 'right' ); ?></title>
<?php monkey_keywords();monkey_description();$options = get_option('monkey-options');?>
<link href="<?php bloginfo("template_url")?>/style.css" media="all" rel="stylesheet" />
<script>window._MBT = {uri: '<?php echo get_bloginfo("template_url") ?>',ajax: '<?php echo $options['ajaxpage'];?>'}</script>
<script src="<?php bloginfo("template_url")?>/static/js/base.js"></script>
<!--[if lt IE 9]>
<script src="<?php bloginfo("template_url")?>/static/js/html5shiv.js"></script>
<![endif]-->

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/stickUp.js"></script>
 <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/36kr.js"></script> 
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/wow.js"></script>
<link href="http://apps.bdimg.com/libs/fontawesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">

<?php wp_head();?>
<?php if($options['css']){echo '<style type="text/css">'.$options['css'].'</style>';}?>
<?php if($options['fixtop']){ ?><style>header.common-header {position:fixed;}body {padding-top: 62px;}</style><?php }?>
</head><a name="tops"></a>
<body <?php body_class();?>>
<noscript>
</noscript>
<header class="common-header J_commonHeaderWrapper header-wrap">
  <a class="logo" href="<?php bloginfo('url')?>"> <img src="<?php echo $options['logo']?$options['logo']:get_bloginfo("template_url").'/static/img/logo.png'?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"> </a>
    <div class="triggers"> <a class="headericon-header-search J_searchTrigger" href="javascript:void(0)"></a> <a class="headericon-header-menu J_menuTrigger" href="javascript:void(0)"></a> </div>
    <nav>
      <ul class="J_navList">
        <?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'header', 'echo' => false)) )); ?>
        <li class="mobile-show"> </li>
      </ul>
    </nav>
    <div class="right-col J_rightNavWrapper">
      <ul class="sub-nav">
        <li class="search-item"> <a href="javascript:void(0)"><i class="headericon-header-search"></i> 搜索</a>
          <div class="search-wrap pop-up">
            <div class="searchbar">
              <form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="J_searchForm">
                <input type="text" placeholder="输入关键字" ng-model="keyword" name="s">
                <button class="headericon-header-search search-icon" type="submit"></button>
                <button class="headericon-close close-icon" type="button"></button>
              </form>
            </div>
          </div>
        </li>
        <!--li class="app-download"> <a href="#"><i class="headericon-header-app"></i> 客户端</a>
          <div class="mobile-wrap pop-up"> <img class="qr" src="<?php if($options['weixin']){ echo $options['weixin'];} else{ echo get_bloginfo("template_url").'/static/img/qrcode.jpg'; }?>" alt="扫一扫下载">
            <div class="btns"> <span>敬请期待</span> <a href="#"><i class="headericon-apple"></i> App Store</a> <a href="#"><i class="headericon-android"></i> Android</a> </div>
          </div>
        </li-->
        <?php if(!is_user_logged_in()){ if(get_option('users_can_register')==1) $register = 'on'; else $register = 'off'; ?>
        <li class="zhuce"><?php wp_register('', ''); ?></li><li class="zhuce"><?php wp_loginout(); ?> </li>
        <?php }else{
			$current_user = wp_get_current_user();
		?>
        <li class="user-menu"> <a href="<?php echo get_permalink(get_page_id_from_template('page-user.php'));?>" class="head-avatar"> <img src="<?php echo MBT_monkey_get_avatar(get_current_user_id());?>" alt="<?php echo $current_user->display_name;?>"> </a>
          <div class="menu-wrap pop-up"> <a class="brief" href="<?php echo get_permalink(get_page_id_from_template('page-user.php'));?>"> <img src="<?php echo MBT_monkey_get_avatar(get_current_user_id());?>" alt="<?php echo $current_user->display_name;?>"> <span><?php echo $current_user->display_name;?></span> </a>
            <div class="menu">
              <?php $menuParameters = array('theme_location' => 'user',  'container' => false,'echo' => false,'items_wrap' => '%3$s','depth' => 0,); echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );?>
              <a href="<?php echo wp_logout_url(get_bloginfo('siteurl'));?>" class="J_logout">退出</a> </div>
          </div>
        </li>
        <?php }?>
        
      </ul>
    </div>
  <div class="ontainer"> </div>
</header>

