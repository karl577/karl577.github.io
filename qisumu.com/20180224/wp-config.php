<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** Enable W3 Total Cache */
 //Added by WP-Cache Manager

/** Enable W3 Total Cache */
 //Added by WP-Cache Manager

/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
 //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/data/home/bxu2340740174/htdocs/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'bdm23872145_db');

/** MySQL数据库用户名 */
define('DB_USER', 'bdm23872145');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'w104615626');

/** MySQL主机 */
define('DB_HOST', 'bdm23872145.my3w.com');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'TC~|$-vwxktJ R+-c2i9^M+Po?|-~FbvxGA;{{#i(`Mo~qD(<`xW6hS.w[45z}*S');
define('SECURE_AUTH_KEY',  ' H!{gxXM5X%}q8JjUhL-2fzL_xiQm,j|v|h(~ofo,`i#)eyHkFL#:)aka9;;_)g)');
define('LOGGED_IN_KEY',    'XZ)s:D)Li74cT@HwfMllPL2P~5R@KH>okJ?iH!5ae^Q>lBj.74_iK+g(L3C!66rX');
define('NONCE_KEY',        'sR%|([^[u{z03+P=+FT-|J FG8Kq}xq}i?9i UZ#SQu^ISfY1,KUZ]^LaK*K>7l[');
define('AUTH_SALT',        ':g5ony;@DGF&hT|Bp8<gGe#i%`p3T~Uu8@Mm^bX#a?8Z(uf0}```:R*R!CD!3BR=');
define('SECURE_AUTH_SALT', '@u]s+]LPv1IJ/dV(z@Fc.`&.`l=qC,[<SaYO%*C{~?xhd%_y^p&fpt_Hal,g+PW5');
define('LOGGED_IN_SALT',   'b(#vbfgf5 tMb6nQP+(.%~;]>(Q4-t-ygTxYfMU&a5:8wf)mh$d,_Hr/IFvGP.Qv');
define('NONCE_SALT',       '}~g%t%AekE-CT8:q?FnKv4l=3#0%1W,P<knT5ME[VgdVtx7=(go<>[A6.O!3@g/v');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
