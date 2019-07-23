<?php
/*
* ----------------------------------------------------------------------------------------------------
*  Add link to the admin bar
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

class theme_options_admin_bar {

	function theme_options_admin_bar()
	{
		add_action('admin_bar_menu', array($this, 'theme_option_links'));
	}


	/**
	* Add's new global menu, if $href is false menu is added but registred as submenuable
	*
	* $name String
	* $id String
	* $href Bool/String
	*
	* @return void
	* @author Janez Troha
	**/
	function add_root_menu($name, $id, $href = false)
	{
		global $wp_admin_bar;
		if ( !is_super_admin() || !is_admin_bar_showing() )
		  return;

		$href = admin_url('admin.php?page=theme_general.php');
		$wp_admin_bar->add_menu( array(
			'id' => $id,
			'title' => $name,
			'href' => $href 
		));
	}


	/**
   * Add's new submenu where additinal $meta specifies class, id, target or onclick parameters
   *
   * $name String
   * $link String
   * $root_menu String
   * $meta Array
   *
   * @return void
   * @author Janez Troha
   **/
	function add_sub_menu($name, $link, $id, $root_menu, $meta = FALSE)
	{
		global $wp_admin_bar;
		if ( !is_super_admin() || !is_admin_bar_showing() )
		  return;

		$wp_admin_bar->add_menu( array(
		'parent' => $root_menu,
		'id' => $id,
		'title' => $name,
		'href' => $link,
		'meta' => $meta) );
	}


	/*
	* Add theme option links
	*/
	 function theme_option_links() {
		$this->add_root_menu('主题面板', 'HK');
		$this->add_sub_menu('一般', admin_url('admin.php?page=theme_general.php'), 'theme_general', 'HK');
		$this->add_sub_menu('头部', admin_url('admin.php?page=theme_header.php'), 'theme_header', 'HK');
		$this->add_sub_menu('页脚', admin_url('admin.php?page=theme_footer.php'), 'theme_footer', 'HK');
		$this->add_sub_menu('滑块', admin_url('admin.php?page=theme_slider.php'), 'theme_slider', 'HK');
		$this->add_sub_menu('博客', admin_url('admin.php?page=theme_blog.php'), 'theme_blog', 'HK');
		$this->add_sub_menu('投资组合', admin_url('admin.php?page=theme_portfolio.php'), 'theme_portfolio', 'HK');
		$this->add_sub_menu('产品', admin_url('admin.php?page=theme_product.php'), 'theme_product', 'HK');
		$this->add_sub_menu('字体', admin_url('admin.php?page=theme_font.php'), 'theme_font', 'HK');
		$this->add_sub_menu('样式', admin_url('admin.php?page=theme_style.php'), 'theme_style', 'HK');
	}

}


function theme_options_admin_bar_init() {
    global $theme_options_admin_bar; $theme_options_admin_bar = new theme_options_admin_bar();
}

add_action('init', 'theme_options_admin_bar_init');

?>