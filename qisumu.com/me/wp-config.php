<?php
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
define('AUTH_KEY',         '*hy(pLx}oZSD=OD*EbfQ UwoK(-a;j2x/H@D)7i%Fd5~F!?AQ;h-z*?#a6)~uN @');
define('SECURE_AUTH_KEY',  'xvFlJm.$t1ApnAcL*Dt{Sm,=J:!dS>*bu9MX$;_ah[,CR?=2?7D6!>FvGImN1Ba&');
define('LOGGED_IN_KEY',    '/gA=C(fUCp SD)p;:rj%Ea;=)(X0?p&mw%9p-1Ag|hyZC*B{6~p)o_y:.b.W1ga9');
define('NONCE_KEY',        'l6 }5=N@LR|=-tH-pJt^[(gV~x6&I:<,!}3&W&zP2bW_5f:`m<2Ky%|sw?oZ_?Re');
define('AUTH_SALT',        '>~A}Hmv-={9Z6oZ+ie#9d()M9S[aw_:%`raWk^b?K.H>P37b>r_YP-7BHO-5]n6f');
define('SECURE_AUTH_SALT', ']$>?x%~k8Yk,W?9Yml4ZnCynFLpi77:x@iY%BZ{^weRvpRJe!!go`*6}l3]B~Qz.');
define('LOGGED_IN_SALT',   's>%6GZAyv>iiG7m4bJGBa2dI.T;VuUCB,(@8|`lG)/o$?Ezncz(wTjF}9vJc;gl*');
define('NONCE_SALT',       ',]2|Jzn{[5 gYCcBPs}/ FaNx,pYOYxo`<l{Q#Z*Xf/C5E}~PC3VfG9*z,dQiAI>');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'me_';

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
