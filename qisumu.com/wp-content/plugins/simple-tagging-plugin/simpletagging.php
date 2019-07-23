<?php
/*
Plugin Name: Simple Tagging
Plugin URI: http://simpletagging.herewithme.fr
Description: Simple Tagging is another tagging plugin for Wordpress: smarter, better, faster :-) 
Version: 1.7
Author: Amaury BALMER
Author URI: http://simpletagging.herewithme.fr

	----------------------------------------------------------------------------
	
	CONTRIBUTORS : 
	Ralph Inselsbacher( http://vernetzt.ws )
	Thomas Parisot ( http://www.oncle-tom.net )	
	
	----------------------------------------------------------------------------
	
	ORIGINAL CODE :
	Michael Woehrer (michael dot woehrer at gmail dot com) ( http://sw-guide.de )	
	
	----------------------------------------------------------------------------
	
	© Copyright 2007  Amaury BALMER (balmer.amaury@gmail.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	----------------------------------------------------------------------------
	
	ACKNOWLEDGEMENTS
	Many thanks to Jerome Lavigne for his Keywords Plugin: 
	<http://vapourtrails.ca/wp-keywords>
	Simple Tagging Plugin is based on Jerome's Plugin 2.0 Beta 3, however 
	heavily extended. Anyway, I think without Jerome's great work I would have 
	never started this project. 
	Also, many thanks to Christopher T. Holland for WICK ("Web Input 
	Completion Kit") <http://wick.sourceforge.net/> which I use for the 
	type-ahead feature.
	
	----------------------------------------------------------------------------
	
	INSTALLATION, USAGE:
	See plugin's homepage... http://simpletagging.herewithme.fr
	
	----------------------------------------------------------------------------
*/

$STagging =& new SimpleTagging();

class SimpleTagging {
	/**
	* @access public
	*/
	var $stp_version = '1.7';			// Plugin's version 
	var $stp_optname = 'stp_options';	// Name of the options in wp_options table
	var $option; 						// array containing the options
	var $defaultoption; 				// array containing the *default* options
	var $info;							// array containing addition information such as paths, URLs etc.
	
	/* Objects */
	var $objMu;
	var $objAdmin;
	var $objMuAdmin;
	
	// Structure of table, used for creation/installation
	var $tablestruct = " ( post_id bigint(20) unsigned NOT NULL, tag_name varchar(255) NOT NULL default '', PRIMARY KEY  (post_id, tag_name), KEY tag_name (tag_name) )";

	/**
	* @access private
	*/
	var $_postids = '';         // stores comma-separated list of post IDs in current view
	var $_posttags = null;      // post tag data cache
	var $_alltags = null;       // all published tag data cache
	var $_allcats = null;       // all published categories cache
	var $_allcombined = null;   // sorted compilation of tags & cats
	var $_initdone = false;
	var $_flushrules = false;

	/**
	* set during class setup
	*	 
	* @access public
	*/
	var $is_rewriteon = false;	// will be set to TRUE if rewrite rules are enabled
	var $base_url  = '';		// base URL for tags (depending on permalink style)
	var $is_wp_21 = false;		// will be set to TRUE if a WP version higher than 2.0.x is being used
	var $is_wpmu = false;		// will be set to TRUE if a WP Mu is being used
	var $version_mysql = '';
	var $use_cache = false;
	
	/**
	* set during class usage
	*	 
	* @access public
	*/
	var $search_tag = '';		// tag search value, will be set if tag search is being used
	var $backup_search_tag = ''; // Keep an copy for eventual used of query_posts()
	var $search_tag_count = 0;	// number of tags in search_tag. Users can use a tag search like bavaria+munich+beer, this would be 3
	
	/**
	 * Constructor for the SimpleTagging class. 
	 *
	 * @return SimpleTagging
	 */
	function SimpleTagging() {
		add_action('plugins_loaded', array(&$this, 'initSimpleTagging'));
	}
	
	function initSimpleTagging() {
		######################### INFO #########################################
		// Determine installation path & url
		$install_dirurl_tmp = basename(dirname(__FILE__)); // basename strips all parent directories of the directory of the given filename
		
		$info['siteurl'] = get_option('siteurl');
		if ( $this->is_mu_plugins() === true ) { // WordPRess Mu
			$info['install_url'] = $info['siteurl'] . '/wp-content/mu-plugins';
			$info['install_dir'] = ABSPATH . 'wp-content/mu-plugins';	
		
			if ( $install_dirurl_tmp != 'mu-plugins' ) { 
				$info['install_url'] .= '/' . $install_dirurl_tmp;
				$info['install_dir'] .= '/' . $install_dirurl_tmp;
			}			
		} else { // WordPress Classic			
			$info['install_url'] = $info['siteurl'] . '/wp-content/plugins';
			$info['install_dir'] = ABSPATH . 'wp-content/plugins';
		
			if ( $install_dirurl_tmp != 'plugins' ) { 
				$info['install_url'] .= '/' . $install_dirurl_tmp;
				$info['install_dir'] .= '/' . $install_dirurl_tmp;
			}
		}
		
		// Localization.
		$locale = get_locale();
		if ( empty($locale) ) {
			$locale = 'en_US';
		}
		
		$mofile = $info['install_dir'].'/languages/simpletagging-'.$locale.'.mo';
		load_textdomain('simpletagging', $mofile);
		
		########################## OPTIONS #####################################
		// 1. Define default options
		$defaultopt = array(
		'version_for_install' 	=> '0',    		// plugin's version, !! DON'T CHANGE THIS VALUE !! -- will be updated automatically. Change $stp_version instead 
		'tags_table'			=> 'stp_tags',	// table where tags are stored
		'use_cache'				=> '0',			// Use cache ? no default

		// Admin options
		'admin_max_suggest'		=> '30',			// Maximum number of suggested tags, zero (0) means no limit and shows all tags
		'admin_tag_suggested'	=> '1',			// Uses 'detection' for tags: 
		'admin_tag_sort'		=> 'alpha',	// 'relevance' => most relevant/used tags first, 'alpha' => alphabetic order 

		// miscellaneous
		'query_varname'			=> 'tag',		// HTTP var name used for tag searches
		'trailing_slash'		=> '0',			// include trailing slash on tag urls
		'template'				=> 'pagetemplate.simpletagging.php', // template file to use for displaying tag queries
		'usehyphen'				=> '0',			// use hyphens "-" as space separator in the tag URL instead of underscore "_"

		// feed options
		'use_feed_cats'			=> '1',			// insert tags into feeds as categories
		
		// meta keyword options
		'meta_autoheader'		=> '1',			// automatically output meta keywords in header
		'meta_always_include'	=> '',			// meta keywords to always include
		'meta_includecats'		=> 'default',	// 'default' => include cats in meta keywords only for home page, 'all' => includes cats on every page, 'none' => never included
		
		// post tag options
		'post_linkformat'		=> __('<a href="%fulltaglink%" title="Browse for %tagname%" rel="tag">%tagname%</a>', 'simpletagging'), // post tag format (initialized to $link_localsearch)
		'post_tagseparator'		=> ', ',       // tag separator string
		'post_includecats'		=> '0',        // include categories in post's tag list
		'post_notagstext'		=> __('none', 'simpletagging'),     // text to display if no tags found		
		'post_include_content_before'	=> __('<br /><strong>Tags:</strong> ', 'simpletagging'),     // text to display before automatic tags after post content
		'post_include_content_after'	=> '',     // text to display after automatic tags after post content
		'post_include_content'	=> '0',     // Auto display Tags after post content
		
		// tag cloud options
		'cloud_linkformat'		=> __('<a style="%colorsize%" class="%scale%" title="Tag: %tagname% (%count%)" href="%fulltaglink%">%tagname%</a>', 'simpletagging'),         // post tag format (initialized to $link_tagcloud)
		'cloud_tagseparator'	=> ' ',			// tag separator character(s)
		'cloud_includecats'		=> '0',			// include categories in tag cloud
		'cloud_sortorder'		=> 'natural',	// tag sorting: natural, countup/asc, countdown/desc, alpha
		'cloud_displaymax'		=> '0',			// maximum # of tags to display (all if set to zero)
		'cloud_displaymin'		=> '1',			// minimum tag count to include in tag cloud
		'cloud_scalemax'		=> '10',        // maximum value for count scaling (no scaling if zero)
		'cloud_scalemin'		=> '1',			// minimum value for count scaling
		'cloud_limit_days'		=> '365',
		'cloud_exclude_cat'		=> '0',		
		'cloud_max_color'		=> '#000000',		// Most popular color
		'cloud_min_color'		=> '#CCCCCC',		// Least popular color
		'cloud_max_size'		=> '18',			// Most popular font size
		'cloud_min_size'		=> '11',			// Least popular font size
		'cloud_unit'			=> 'px',			// The units to display the font sizes with	
		'cloud_include_page'	=> '1',
		'cloud_notagstext'		=> __('No tags were found that match the criteria given.', 'simpletagging'),	// text to display if no tags found

		// related posts options
		'related_format'		=> __('<li><a href="%permalink%" title="%title% (%date%)">%title%</a> (%commentcount%)</li>', 'simpletagging'),
		'related_postsseparator'=> ' ',			// related posts separator
		'related_sortorder'		=> 'date-desc',	// sort order: alpha, date-asc, date-desc, random
		'related_limit_qty'		=> '5',
		'related_limit_days'	=> '365',
		'related_dateformat'	=> get_option('date_format'),
		'related_nothingfound'	=> __('<li>None</li>', 'simpletagging'),
		'related_includepages'	=> '0',			// include pages in related posts list
		'related_excludecat' 	=> '0', // Exclude categories
		'related_excludetag'	=> '',
		
		// Related tags options
		'relatedtags_format'		=> __('<li><span>%count%</span> <a href="%taglink_plus%">+</a> <a href="%taglink%">%tagname%</a></li>', 'simpletagging'),
		'relatedtags_tagseparator'	=> ' ',	// related tags separator
		'relatedtags_sortorder'		=> 'alpha-asc',	// sort order: count-desc, count-asc, alpha-desc, alpha-asc
		'relatedtags_nonfoundtext'	=> __('No related tags found.', 'simpletagging'),
		'relatedtags_remove_format'	=> __('<li>&raquo; <a href="%url%">remove %tagname%</a></li>', 'simpletagging'),
		'relatedtags_remove_separator'=> ' ',	// remove tags separator
		'relatedtags_limit_qty' 	=> '10',
		'relatedtags_remove_nonfoundtext' => '<li>&nbsp;</li>',	// text if no result 
		
		// Tabs tags options
		'tabs_printjs'	=> '2', // Display or not JS/CSS for tabs in header.php ( 0 for no print, 1 for print in header, 2 for inline print )
		'tabs_linkformat'	=> __('<li><a style="%colorsize%" class="%scale%" title="Tag: %tagname% (%count%)" href="%fulltaglink%">%tagname%</a></li>', 'simpletagging'),         // post tag format (initialized to $link_tagtabs)
		'tabs_tagseparator'	=> ' ',			// tag separator character(s)
		'tabs_includecats'	=> '0',			// include categories in tag tabs
		'tabs_sortorder'	=> 'natural',	// tag sorting: natural, countup/asc, countdown/desc, alpha
		'tabs_displaymax'	=> '0',			// maximum # of tags to display (all if set to zero)
		'tabs_displaymin'	=> '1',			// minimum tag count to include in tag tabs
		'tabs_scalemax'		=> '10',        // maximum value for count scaling (no scaling if zero)
		'tabs_scalemin'		=> '1',			// minimum value for count scaling
		'tabs_limit_days'	=> '365',
		'tabs_exclude_cat'	=> '0',		
		'tabs_max_color'	=> '#000000',		// Most popular color
		'tabs_min_color'	=> '#CCCCCC',		// Least popular color
		'tabs_max_size'		=> '18',			// Most popular font size
		'tabs_min_size'		=> '11',			// Least popular font size
		'tabs_unit'			=> 'px',			// The units to display the font sizes with		
		'tabs_include_page'	=> '1',
		'tabs_notagstext'	=> __('No tags were found that match the criteria given.', 'simpletagging'),	// text to display if no tags found
		'tabs_notagslettertext'	=> __('No tags for this letter yet.', 'simpletagging'),
		
		// Embedded Tags
		'tag_embed_use'   => '0',		// Use embedded tags
		'tag_embed_start' => '[tags]',	// For tags to be places into the content: start tag 
		'tag_embed_end'	  => '[/tags]',	// For tags to be places into the content: end tag
		);
		// 2. Set class property for default options
		$this->defaultoption = $defaultopt;
		
		// 3. Get options from WP options table
		$optionsFromTable = get_option($this->stp_optname);

		// 4. Update default options by getting not empty values from options table
		foreach($defaultopt as $def_optname => $def_optval) {
			if ($optionsFromTable[$def_optname] != '' ) {
				$defaultopt[$def_optname] = $optionsFromTable[$def_optname];
			}
		}
		
		// 5. Set the class property
		$this->option = $defaultopt;
		
		######################### INFO #########################################	
		// Set custom table name
		global $wpdb;
		$info['stptable'] = $wpdb->prefix . $this->option['tags_table'];

		$this->info = array(	// repeated to get an overview of all available info values
			'siteurl' 			=> $info['siteurl'],
			'install_url'		=> $info['install_url'],
			'install_dir'		=> $info['install_dir'],
			'stptable'			=> $info['stptable'],
		);
		
		######################### WORDPRESS VERSION ############################
		// Get Wordpress Version since we use different queries etc. in case of WP 2.1, 2.2
		global $wp_version;
		if ( strpos($wp_version , "mu") === false ) {
			if ( strpos($wp_version , "2.0") === false ) {
				$this->is_wp_21 = true;
			} else {
				$this->is_wp_21 = false;
			} 
		} elseif ( phpversion() >= '5' ) {
			$this->is_wp_21 = true;
			$this->is_wpmu = true;
		} else {
			$this->is_wp_21 = true;
		}

		######################### MySQL VERSION ############################
		if ( DB_DRIVER == 'mysqli' ) { 
			$my_sql_server_info = mysqli_get_server_info( $wpdb->dbh );
		} else {
			$my_sql_server_info = mysql_get_server_info();
		}
		
		$mysql_version = (int) substr($my_sql_server_info, 0, 1);
		if ( $mysql_version == 5 ) { // MySQL v5
			$this->version_mysql = 5;
		} else { // MySQL v4.X
			$mysql_version = (int) substr($my_sql_server_info, 2, 1);
			if ( $mysql_version < 1) { // MySQL 4.0
				$this->version_mysql = 4;
			} else { // MySQL v4.1 and upper, compatibility with subquery
				$this->version_mysql = 5;
			}			
		}
		
		######################### CACHE ############################
		if ( $this->option['use_cache'] ) {
			$this->use_cache = true;
		} else {
			$this->use_cache = false;
		}
	
		################# SETUP FILTER/ACTION TRIGGERS #########################
		add_action('init', array(&$this, 'wpaction_InitRewrite'), 1);  // can't use WP rewrite flags until "init" hook
		add_filter('the_posts', array(&$this, 'wpfilter_GetPostIds'), 90);   // get post IDs once WP query is done
		add_filter('query_vars', array(&$this, 'wpfilter_AddQueryVar'));     // used for tag searches
		add_action('parse_query', array(&$this, 'wpaction_ParseQuery'));     // used for tag searches
		
		if ($this->option['tag_embed_use']) {
			add_filter('the_content', array(&$this, 'wpfilter_the_content'), 10);	// used for filtering the content -- e.g. removing embedded tags [tags]...[/tags]	
			add_filter('the_excerpt', array(&$this, 'wpfilter_the_content'), 10);	// used for filtering the content -- e.g. removing embedded tags [tags]...[/tags]
		}
		
		if ($this->option['use_feed_cats']) {      // insert tags into feeds as categories
			add_filter('the_category_rss', array(&$this, 'wpfilter_CreateFeedCategories'), 5, 2);
		}
		
		if ($this->option['meta_autoheader']) {     // automagic meta keywords in header
			add_action('wp_head', array(&$this, 'wpaction_OutputHeader'));
		}
		
		if ( $this->option['tabs_printjs'] == '1' ) {
			add_action('wp_head', array(&$this, 'printTabsHeaderJS'));
		}
		
		if ($this->option['post_include_content']) {
			add_filter('the_content', 'STP_Auto_PostTags');
		}
			
		################# Load admin file and initialize object ################
		require ($this->info['install_dir'] . '/inc/simpletagging.functions.php');
		
		if ( $this->is_wpmu == true ) {
			require ($this->info['install_dir'] . '/inc/simpletagging.mu.php');
			$this->objMu = new SimpleTaggingMu($this);					
		}
		
		if ( is_admin() || ( defined('XMLRPC_REQUEST') && XMLRPC_REQUEST ) ) {
					
			add_action('init', array(&$this, 'initAdmin'), 3);
			
			if ( $this->is_wpmu == true ) {				
				add_action('init', array(&$this, 'initAdminMu'), 4);
			}
		}
	}
	
	function initAdmin() {
		require ($this->info['install_dir'] . '/inc/simpletagging.admin.php');	
		$this->objAdmin = new SimpleTaggingAdmin( $this );
	}
	
	function initAdminMu() {
		require ($this->info['install_dir'] . '/inc/simpletagging.mu.admin.php');
		$this->objMuAdmin = new SimpleTaggingMuAdmin( $this );
	}

	##################

	/**
	 * Converts user tag input $taglist: string - a comma separated list of tags the user has entered and wants to save to the database
	 *
	 * @param string $tag_name_list
	 * @return string
	 */
	function tag_convertUserInput($tag_name_list) {
		$tag_name_list = strip_tags($tag_name_list);					// no HTML tags
		$tag_name_list = preg_replace('/\s\s+/', ' ', $tag_name_list); // Replace multiple spaces with one space
		$tag_name_list = trim($tag_name_list);
		$tag_name_list = str_replace('_', '-', $tag_name_list);
		if ($this->option['usehyphen']) {
			$tag_name_list = str_replace('-', ' ', $tag_name_list);
		}
		$tag_name_list = str_replace('+', '', $tag_name_list);	// we need + for adding multiple tags
		$tag_name_list = str_replace('\\', '-', $tag_name_list);
		$tag_name_list = str_replace('/', '-', $tag_name_list);
		$tag_name_list = preg_replace('|[\'"<>$%?&^#;*=]|i', '', $tag_name_list); // remove several special chars

		return $tag_name_list;
	}
	
	/**
	 * Converts Name to URL; E.g. 'Hans Dampf' to 'Hans_Dampf'
	 *
	 * @param string $tag_name
	 * @return string
	 */
	function tag_name2url($tag_name) {
		if ($this->option['usehyphen']) {
			$tag_name = str_replace(' ', '-', $tag_name);
		} else {
			$tag_name = str_replace(' ', '_', $tag_name);	// urlencode converts space ' ' into +. We wanna use _ instead		
		}

		$tag_name = urlencode($tag_name);
		$tag_name = str_replace('%2F', '/', $tag_name);	// seems that Apache's mod_rewrite are unable to handle urlencoded URLs properly
		$tag_name = str_replace('%2B', '+', $tag_name);	// seems that Apache's mod_rewrite are unable to handle urlencoded URLs properly
		$tag_name = str_replace('%20', '_', $tag_name);	// seems that Apache's mod_rewrite are unable to handle urlencoded URLs properly
		
		return $tag_name;
	}

	/**
	 * Converts URL to Name; E.g. 'Hans_Dampf' -> 'Hans Dampf' or '100_dollar+200+300' -> '100 dollar, 200, 300'
	 *
	 * @param string $tag_url
	 * @param string $sep
	 * @return string
	 */
	function tag_url2name($tag_url, $sep=', ') {
		$tag_name = str_replace(' ', '+', $tag_url); // Replace ' ' with + if + became ' ' due to urlencode. Should always work since we don't allow spaces in URLS as we convert them to _ 	

		if ($this->option['usehyphen']) {
			$tag_name = str_replace('-', ' ', $tag_name);
		} else {
			$tag_name = str_replace('_', ' ', $tag_name);	// consider real blanks
		}
		$tag_name_array = explode('+', $tag_name);	// Create array

		$res = '';
		foreach ($tag_name_array as $val) {
			$res .= ($res == '') ? $val : $sep . $val;
		}
		return $res;
	}

	/**
	 * Converts an URL to an array containing all URLs.
	 * E.g.: '100+200+300' -> array('100','200','300')
	 *
	 * @param string $tag
	 * @return array
	 */
	function tag_url2url_array($tag) {
		// Replace ' ' with + if + became ' ' due to urlencode
		// Should always work since we don't allow spaces in URLS as we convert them to _
		$tag = str_replace(' ', '+', $tag); 

		// Now we can create the array
		$tag = explode('+', $tag);

		return $tag;			
	}
	
	/**
	 * Converts an URL to a comma separated string -- containing >'< before and after each tag to use it for MySQL query "IN"
	 * Input: e.g. $this->search_tag, may be comma separated
	 *
	 * @param array $tags
	 * @return string
	 */
	function tag_urls2names_IN ($tags) {
		$currtagArray = explode(' ', $tags); // Due to urlencode, + became ' ', so we explode with ' ' 
		$currtagArray = array_unique($currtagArray);
		foreach ( $currtagArray as $tag ) {
			$secure_currtagArray[] = $this->quoteSmart($tag);
		}		
		$tagList = implode(",", $secure_currtagArray);
		$tagList = $this->tag_url2name($tagList);
		$tagList = $tagList; 
		return $tagList;
	}

	function getTagPermalink($tag_url) {
		$trailing_slash = ($this->option['trailing_slash'] && $this->is_rewriteon) ? '/' : '';
		return ($this->base_url . $this->tag_name2url($tag_url) . $trailing_slash);
	}

	/**
	 * Removes one tag from the URL. E.g. 100+200+300 and 200 shall be removed -> 100+300
	 *
	 * @param string $tag_url
	 * @param string $remove
	 * @return string
	 */
	function removeTagFromURL($tag_url, $remove) {
		$tagarr = $this->tag_url2url_array($tag_url);
		$result = '';
		foreach ($tagarr as $var) {
			if ($var != $remove)
				$result .= ($result == '') ? $var : '+' . $var;
		}
		return $result;
	}

	/**
	 * Filter content for delete embedded tags
	 *
	 * @param string $content
	 * @return string
	 */
	function wpfilter_the_content($content) {
		// Remove "[tags]tag1, tag2[/tags]" from the content.		
		$tagstart = $this->option['tag_embed_start'];
		$len_tagstart = strlen($this->option['tag_embed_start']);
		
		$tagend = $this->option['tag_embed_end'];		
		$len_tagend = strlen($this->option['tag_embed_end']);
			
		while ( strpos($content, $tagstart) != false && strpos($content, $tagend) != false ) {
			$pos1 = strpos($content, $tagstart);
			$pos2 = strpos($content, $tagend);							
			$content = str_replace(substr($content, $pos1, ($pos2 - $pos1 + $len_tagend)), '', $content);
		}	
		return $content;
	}

	/**
	 * Initialize WP rewrite for STP
	 *
	 */
	function wpaction_InitRewrite() {
		global $wp_rewrite;
		
		/* detect permalink type & construct base URL for local links */
		$this->base_url = get_settings('home') . '/';
		if (isset($wp_rewrite) && $wp_rewrite->using_permalinks()) {
			$this->is_rewriteon = true;                    // using rewrite rules
			$this->base_url .= ( substr($wp_rewrite->front, 0, 1) == '/' ) ? substr($wp_rewrite->front, 1, strlen($wp_rewrite->front)) : $wp_rewrite->front;		// set to "index.php/" if using that style (use for WPmu First blog)
			$this->base_url .= $wp_rewrite->root;		// set to "index.php/" if using that style
			$this->base_url .= $this->option['query_varname'] . '/';
		} else {
			$this->base_url .= '?' . $this->option['query_varname'] . '=';
		}
		
		/* generate rewrite rules for tag queries */
		if ($this->is_rewriteon === true) {
			add_filter('search_rewrite_rules', array(&$this, 'createRewriteRules'));
		}
		
		/* flush rules if requested */
		$this->_initdone = true;
		if ($this->_flushrules) {
			$wp_rewrite->flush_rules();
		}
	}
	
	/**
	 * Gets post IDs once WP query is done.
	 *
	 * @param array $posts
	 * @return array
	 */
	function wpfilter_GetPostIds($posts) {
		if (!is_null($posts) && is_array($posts)) {
			foreach($posts as $p) {
				$this->_postids .= (!empty($this->_postids) ? ',' : '') . $p->ID;   //create comma-separated list
			}
		}
		return $posts;  //send'em back to WP
	}

	/**
	 * Used for tag searches.
	 *
	 * @param array $wpvar_array
	 * @return array
	 */
	function wpfilter_AddQueryVar($wpvar_array) {
		$wpvar_array[] = $this->option['query_varname'];
		return ($wpvar_array);
	}

	/**
	 * Set the search tag if it's available. WP2.0's new rewrite rules , mean we need to grab it from the query vars.
	 *
	 */
	function wpaction_ParseQuery() {
		$this->search_tag = stripslashes(get_query_var($this->option['query_varname']));

		if (get_magic_quotes_gpc()) {
			$this->search_tag = stripslashes($this->search_tag);  // why so many freakin' slashes?
		}

		// if this is a tag query, then reset other is_x flags and add query filters
		if ($this->search_tag != '') {
			global $wp_query;
			// Use for eventual query_posts
			$this->backup_search_tag = $this->search_tag;

			$wp_query->is_single = false;
			$wp_query->is_page = false;
			$wp_query->is_archive = false;
			$wp_query->is_search = false;
			$wp_query->is_home = false;
			$wp_query->is_paged = false; 
			$wp_query->is_comment_feed = false;
			
			if ( get_query_var('feed') != '' ) {  // Feed or not ?
				$wp_query->is_feed = true;
			}

			add_filter('posts_where', array(&$this, 'wpfilter_posts_where'));
			add_filter('posts_join',  array(&$this, 'wpfilter_posts_join'));
			add_filter('posts_groupby',  array(&$this, 'wpfilter_posts_groupby'));
			
			if ( !get_query_var('feed') != '' ) { // No Feed ? Go to template !
				add_filter('wp_title', array(&$this, 'wpfilter_wp_title')); 
				add_action('template_redirect', array(&$this, 'wpaction_template_redirect'));
			}
		}
	}

	/**
	 * Insert tags into feeds as categories.
	 *
	 * @param string $list
	 * @param string $type
	 * @return string
	 */
	function wpfilter_CreateFeedCategories($list, $type) {
		global $id;
		$post_tags = $this->getPostTags($id);
		
		foreach($post_tags as $tag) {
			if ( $type == 'rdf' ) {
				$list .= "<dc:subject>$tag</dc:subject>";
			} elseif ( $type == 'atom' ) {
				$list .= '<category scheme="'.$this->info['siteurl'].'" term="'.$tag.'" />';				
			} else {
				$list .= "<category>$tag</category>";
			}
		}
		return $list; 
	}


	/**
	 * Automatically output meta tags in header.
	 *
	 */
	function wpaction_OutputHeader() {
		echo "\t" . '<meta name="keywords" content="' . $this->getMetaKeywords() . '" />';
	}
	
	/**
	 * Update where clause to search on keywords table
	 *
	 * @param string $query
	 * @return string
	 */
	function wpfilter_posts_where( $query ) {
		if ( strpos($query, 'AND stptags.tag_name IN') != false ) { // No doublon.
			return $query;
		}
		
		if ( empty($this->search_tag) ) {
			// Use for eventual query_posts
			$this->search_tag = $this->backup_search_tag;
		}
		
		$tagList = $this->tag_urls2names_IN($this->search_tag);	// comma separated list
		$this->search_tag_count =  count(explode(',', $tagList));
		$result = $query . " AND stptags.tag_name IN ($tagList)";
		
		// include pages in search
		if ($this->is_wp_21) {
			$result = str_replace('post_type = \'post\'', 'post_type IN(\'page\', \'post\')', $result);
		}
		$result = str_replace(' AND (post_status = \'publish\'', ' AND (post_status IN(\'static\', \'publish\')', $result); 
		return $result;
	}

	/**
	 * Update where clause to search on keywords table
	 *
	 * @param string $join
	 * @return string
	 */
	function wpfilter_posts_join( $query ) {
		if ( strpos($query, 'ID = stptags.post_id') != false ) { // No doublon.
			return $query;
		}	

		global $wpdb;
		$query .= " LEFT JOIN {$this->info['stptable']} AS stptags ON ({$wpdb->posts}.ID = stptags.post_id) ";
		return ($query);
	}

	/**
	 * Add group in queries
	 *
	 * @param string $groupby
	 * @return string
	 */
	function wpfilter_posts_groupby( $query ) {
		if ( strpos($query, 'ID HAVING COUNT(ID) =') != false ) { // No doublon.
			return $query;
		}
		
		global $wpdb;
		$query = " {$wpdb->posts}.ID HAVING COUNT(ID) = {$this->search_tag_count}";
		return $query; 
	}
	
	/**
	* wpfilter_wp_title
	*
	* Apply a correct HTML page title according to the current tag browsing
	* Best called by the URI parser which determines if we are browsing a tar or not
	*/
	function wpfilter_wp_title( $title ) {
		return $this->tag_url2name( $this->search_tag );
	}
	
	/**
	 * Switch template when doing a keyword search
	 *
	 */
	function wpaction_template_redirect() {
		if ( $this->is_tag_view() ) {
			$template = '';
			
			if ( is_file(TEMPLATEPATH . "/" . $this->option['template']) ) {
				$template = TEMPLATEPATH . "/" . $this->option['template'];
			} else if ( is_file(TEMPLATEPATH . "/tags.php") ) {
				$template = TEMPLATEPATH . "/tags.php";
			} else if ( is_file(TEMPLATEPATH . "/tag.php") ) {
				$template = TEMPLATEPATH . "/tag.php";
			} else {
				$template = get_category_template();
			}
			
			if ($template) {
				load_template($template);
				exit();
			}
		}
		return;
	}

	/**
	 * Get tags for current post
	 *
	 * @param string $linkformat
	 * @param boolean $include_cats
	 * @param string $tagseparator
	 * @param string $notagstext
	 * @param string $include_content
	 * @param string $include_content_before
	 * @param string $include_content_after
	 * @return string
	 */
	function outputPostTags($linkformat=null, $include_cats=null, $tagseparator=null, $notagstext=null, $include_content=null, $include_content_before=null, $include_content_after=null, $force_id=null) {
		if ( !is_null($force_id) && is_int($force_id) && $force_id > 0 ) {
			$id = $force_id;
		} else {
			global $id;
			if ($id < 1 || ! is_int($id)) {
				global $post;
				$id = $post->ID;
			}
		}

		// check parameters vs. class options
		$linkformat		= (is_null($linkformat))	? $this->option['post_linkformat']  : $linkformat;
		$include_cats	= (is_null($include_cats))	? $this->option['post_includecats'] : $include_cats;
		$tagseparator	= (is_null($tagseparator))	? $this->option['post_tagseparator'] : $tagseparator;
		$notagstext		= (is_null($notagstext))	? $this->option['post_notagstext'] : $notagstext;
		$include_content_before	= (is_null($include_content_before)) ? $this->option['post_include_content_before'] : $include_content_before;
		$include_content_after = (is_null($include_content_after)) ? $this->option['post_include_content_after'] : $include_content_after;

		// create array of tags & full links
		$taglinks = array();
		if ($include_cats) {
			$categories = get_the_category();
			foreach($categories as $cat) {
				$taglinks[ $cat->cat_name ] = get_category_link( (int) $cat->cat_ID );
			}
		}
		
		$post_tags = $this->getPostTags($id);
		foreach($post_tags as $tag) {
			$taglinks [ $tag ] = $this->getTagPermalink($tag);
		}
		
		// substitute values into link format
		$output = '';
		foreach($taglinks as $tag => $url) {
			$output .= (($output != '') ? $tagseparator : '') . $this->formatLink($tag, $url, $linkformat);
		}
		
		if (empty($output)) {
			return $notagstext;
		} else {
			if ($include_content) {
				return $include_content_before.$output.$include_content_after;
			}
			return $output;
		}
	}

	/**
	 * get Tag Cloud
	 *
	 * @param string $format
	 * @param string $tagseparator
	 * @param boolean $include_cats
	 * @param string $sort_order
	 * @param integer $display_max
	 * @param integer $display_min
	 * @param integer $scale_max
	 * @param integer $scale_min
	 * @param string $notagstext
	 * @param string $max_color
	 * @param string $min_color
	 * @param integer $max_size
	 * @param integer $min_size
	 * @param string $unit
	 * @param integer $limit_days
	 * @param integer $limit_cat
	 * @param string $exclude_cat
	 * @param integer $include_page
	 * @return string
	 */
	function createTagcloud($format=null, $tagseparator=null, $include_cats=null, $sort_order=null, $display_max=null, $display_min=null, $scale_max=null, $scale_min=null, $notagstext=null, $max_color=null, $min_color=null, $max_size=null, $min_size=null, $unit=null, $limit_days=null, $limit_cat=null, $exclude_cat=null, $include_page=null) {
		// check parameters vs. class options
		$format			= (is_null($format))		? $this->option['cloud_linkformat']		: $format;
		$tagseparator	= (is_null($tagseparator))	? $this->option['cloud_tagseparator']	: $tagseparator;
		$include_cats	= (is_null($include_cats))	? $this->option['cloud_includecats']	: $include_cats;
		$sort_order		= (is_null($sort_order))	? $this->option['cloud_sortorder']		: $sort_order;
		$display_max	= (is_null($display_max))	? $this->option['cloud_displaymax']		: $display_max;
		$display_min	= (is_null($display_min))	? $this->option['cloud_displaymin']		: $display_min;
		$scale_max		= (is_null($scale_max))		? $this->option['cloud_scalemax']		: $scale_max;
		$scale_min		= (is_null($scale_min))		? $this->option['cloud_scalemin']		: $scale_min;
		$notagstext		= (is_null($notagstext))	? $this->option['cloud_notagstext']		: $notagstext;
		$limit_days		= (is_null($limit_days))	? $this->option['cloud_limit_days']		: $limit_days;
		$exclude_cat	= (is_null($exclude_cat))	? $this->option['cloud_exclude_cat']	: $exclude_cat;			
		$max_color		= (is_null($max_color))		? $this->option['cloud_max_color']		: $max_color;
		$min_color		= (is_null($min_color))		? $this->option['cloud_min_color']		: $min_color;
		$max_size		= (is_null($max_size))		? $this->option['cloud_max_size']		: $max_size;
		$min_size		= (is_null($min_size))		? $this->option['cloud_min_size']		: $min_size;
		$unit			= (is_null($unit))			? $this->option['cloud_unit']			: $unit;
		$include_page	= (is_null($include_page))	? $this->option['cloud_include_page']	: $include_page;

		if ( !is_null($limit_cat) ) {
			$exclude_cat = null;
		}
		
		// create array of tags & full links
		if ($include_cats) {
			$alltags = $this->getAllCombined('', $limit_days, $limit_cat, $exclude_cat, $include_page);
		} else {
			$alltags = $this->getAllTags('', $limit_days, $limit_cat, $exclude_cat, $include_page);
		}
		
		// limit results
		$limit = (int) $display_max;		
		if ( ($limit > 0) && (count($alltags) > $limit) ) {       
			$alltags = array_slice($alltags, 0, $limit);  // already in descending order
		}
		
		// re-sort results
		$lower_sort_order = strtolower($sort_order);
		if ( $lower_sort_order == 'alpha' ) {
			ksort($alltags);
		} elseif ( $lower_sort_order == 'countup' || $lower_sort_order == 'asc' ) {
			$alltags = array_reverse($alltags, true);       // reverse array order to be ascending
		} elseif ( $lower_sort_order == 'countdown' || $lower_sort_order == 'desc' ) {
			$alltags = $alltags; // already in descending order
		} elseif ( $lower_sort_order == 'random' ) {
			srand((float)microtime() * 1000000);
			shuffle($alltags);                              // WARNING: keys not kept!
		} else {
			uksort($alltags, 'strnatcasecmp');
		}

		// scaling
		$do_scale = ($scale_max != 0);
		if ($do_scale) {
			$minval = $maxval = $alltags[ key($alltags) ]['count'];
			foreach($alltags as $tag) {
				$minval = min($tag['count'], $minval);
				$maxval = max($tag['count'], $maxval, $display_min);
			}
			$minval = max($minval, $display_min);
			$minout = max($scale_min, 0);
			$maxout = max($scale_max, $minout);
			$scale = ($maxval > $minval) ? (($maxout - $minout) / ($maxval - $minval)) : 0;
		}
		
		// scale counts & format links
		$output = '';
		if ($do_scale) {
			foreach($alltags as $tag) {
				if ($tag['count'] >= $display_min) {	
					$scaleResult = (int) (($tag['count'] - $minval) * $scale + $minout);
					$size = 'font-size: '.round(($scaleResult - $scale_min)*($max_size-$min_size)/($scale_max - $scale_min) + $min_size, 1).$unit.';';
						
					if ($min_color!='' && $max_color!='') {
						$scale_color = round(($scaleResult - $scale_min)*(100)/($scale_max - $scale_min), 1);
						$color = "color: ". $this->getColorByScale($scale_color, $min_color, $max_color).';';
					}
					
					$output .= (($output != '') ? $tagseparator : '') . $this->formatLink($tag['name'], $tag['link'], $format, $scaleResult, $tag['count'], $color, $size, $size.' '.$color)."\n";
				}
			}
		} else {
			foreach($alltags as $tag) {
				$output .= (($output != '') ? $tagseparator : '') . $this->formatLink($tag['name'], $tag['link'], $format, $scaleResult, $tag['count'])."\n";
			}
		}

		if ( $output <> '' ) {
			return "\n" . '<!-- Generated by \'Simple Tagging Plugin ' . $this->stp_version . '\' - http://trac.herewithme.fr/project/simpletagging/ -->' . "\n" . $output . "\n"; // Please do not remove this line.
		}
		return $notagstext;		
	}
	
	/**
	 * Create tab tags
	 *
	 * @param string $format
	 * @param string $tagseparator
	 * @param boolean $include_cats
	 * @param string $sort_order
	 * @param integer $display_max
	 * @param integer $display_min
	 * @param integer $scale_max
	 * @param integer $scale_min
	 * @param string $notagstext
	 * @param string $max_color
	 * @param string $min_color
	 * @param integer $max_size
	 * @param integer $min_size
	 * @param string $unit
	 * @param integer $limit_days
	 * @param integer $limit_cat
	 * @param string $exclude_cat
	 * @param integer $include_page
	 * @return string
	 */
	function createTagTabs($format=null, $tagseparator=null, $include_cats=null, $sort_order=null, $display_max=null, $display_min=null, $scale_max=null, $scale_min=null, $notagstext=null, $max_color=null, $min_color=null, $max_size=null, $min_size=null, $unit=null, $limit_days=null, $limit_cat=null, $exclude_cat=null, $include_page=null) {
		// check parameters vs. class options
		$format			= (is_null($format))		? $this->option['tabs_linkformat']		: $format;
		$tagseparator	= (is_null($tagseparator))	? $this->option['tabs_tagseparator']	: $tagseparator;
		$include_cats	= (is_null($include_cats))	? $this->option['tabs_includecats']		: $include_cats;
		$sort_order		= (is_null($sort_order))	? $this->option['tabs_sortorder']		: $sort_order;
		$display_max	= (is_null($display_max))	? $this->option['tabs_displaymax']		: $display_max;
		$display_min	= (is_null($display_min))	? $this->option['tabs_displaymin']		: $display_min;
		$scale_max		= (is_null($scale_max))		? $this->option['tabs_scalemax']		: $scale_max;
		$scale_min		= (is_null($scale_min))		? $this->option['tabs_scalemin']		: $scale_min;
		$notagstext		= (is_null($notagstext))	? $this->option['tabs_notagstext']		: $notagstext;
		$limit_days		= (is_null($limit_days))	? $this->option['tabs_limit_days']		: $limit_days;
		$exclude_cat	= (is_null($exclude_cat))	? $this->option['tabs_exclude_cat']		: $exclude_cat;			
		$max_color		= (is_null($max_color))		? $this->option['tabs_max_color']		: $max_color;
		$min_color		= (is_null($min_color))		? $this->option['tabs_min_color']		: $min_color;
		$max_size		= (is_null($max_size))		? $this->option['tabs_max_size']		: $max_size;
		$min_size		= (is_null($min_size))		? $this->option['tabs_min_size']		: $min_size;
		$unit			= (is_null($unit))			? $this->option['tabs_unit']			: $unit;
		$include_page	= (is_null($include_page))	? $this->option['tabs_include_page']	: $include_page;

		if ( !is_null($limit_cat) ) {
			$exclude_cat = null;
		}
		// create array of tags & full links
		if ($include_cats) {
			$alltags = $this->getAllCombined('', $limit_days, $limit_cat, $exclude_cat, $include_page);
		} else {
			$alltags = $this->getAllTags('', $limit_days, $limit_cat, $exclude_cat, $include_page);
		}
		
		// Controle if tag exists.
		if ( !$alltags ) {
			return $notagstext;	
		}
		
		// limit results
		$limit = (int) $display_max;		
		if ( ($limit > 0) && (count($alltags) > $limit) ) {       
			$alltags = array_slice($alltags, 0, $limit);  // already in descending order
		}
		
		// re-sort results
		$lower_sort_order = strtolower($sort_order);
		if ( $lower_sort_order == 'alpha' ) {
			ksort($alltags);
		} elseif ( $lower_sort_order == 'countup' || $lower_sort_order == 'asc' ) {
			$alltags = array_reverse($alltags, true);       // reverse array order to be ascending
		} elseif ( $lower_sort_order == 'countdown' || $lower_sort_order == 'desc' ) {
			$alltags = $alltags; // already in descending order
		} elseif ( $lower_sort_order == 'random' ) {
			srand((float)microtime() * 1000000);
			shuffle($alltags);                              // WARNING: keys not kept!
		} else {
			uksort($alltags, 'strnatcasecmp');
		}
		
		// Format ouput
		$list_ouput = true;
		if ( strpos( $format, '<li' ) === false ) {
			$list_ouput = false;
		}

		// scaling
		$do_scale = ($scale_max != 0);
		if ($do_scale) {
			$minval = $maxval = $alltags[ key($alltags) ]['count'];
			foreach($alltags as $tag) {
				$minval = min($tag['count'], $minval);
				$maxval = max($tag['count'], $maxval, $display_min);
			}
			$minval = max($minval, $display_min);
			$minout = max($scale_min, 0);
			$maxout = max($scale_max, $minout);
			$scale = ($maxval > $minval) ? (($maxout - $minout) / ($maxval - $minval)) : 0;
		}
		
		$alphabet = array('0-9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

		foreach ( $alphabet as $letter ) {
			$new_tags[$letter] = array();
		}
		
		// scale counts & format links
		$output = '';
		if ($do_scale) {
			foreach($alltags as $tag) {
				if ($tag['count'] >= $display_min) {	
					// Formating
					$scaleResult = (int) (($tag['count'] - $minval) * $scale + $minout);
					$size = 'font-size: '.round(($scaleResult - $scale_min)*($max_size-$min_size)/($scale_max - $scale_min) + $min_size, 1).$unit.';';
						
					if ($min_color!='' && $max_color!='') {
						$scale_color = round(($scaleResult - $scale_min)*(100)/($scale_max - $scale_min), 1);
						$color = "color: ". $this->getColorByScale($scale_color, $min_color, $max_color).';';
					}					
					$output = $this->formatLink($tag['name'], $tag['link'], $format, $scaleResult, $tag['count'], $color, $size, $size.' '.$color)."\n";

					// Tabs
					$index = substr( trim(strtolower($tag['name'])), 0, 1 );
					if ( ctype_digit($index) ) {
						$new_tags['0-9'][] = $output;
					} else {
						$new_tags[$index][] = $output;
					}
					
					// To be sure
					unset($output);							
				}
			}
		} else {
			foreach($alltags as $tag) {
				// Formating
				$output = $this->formatLink($tag['name'], $tag['link'], $format, $scaleResult, $tag['count'])."\n";
				
				// Tabs
				$index = substr( trim(strtolower($tag['name'])), 0, 1 );
				if ( ctype_digit($index) ) {
					$new_tags['0-9'][] = $output;
				} else {
					$new_tags[$index][] = $output;
				}
				
				// To be sure
				unset($output);
			}
		}

		$output = '';
		
		if ( $this->option['tabs_printjs'] == '2' ) {
			$output .= $this->printTabsHeaderJS(false);
		}
		
        $output .= '<div id="containertags">'."\n";
			foreach ( $alphabet as $letter ) {
				$nb_tag = count($new_tags[$letter]);
				$output .= '<div id="letter-'.$letter.'" '.(( $nb_tag == 0 ) ? 'class="tabs-disabled"' : '').'>'."\n";
	            	$output .= '<h4 class="title_tabs">'.strtoupper($letter).'</h2>'."\n";
					if ( $nb_tag > 0 ) {
						$tmp_output = '';
						foreach ( $new_tags[$letter] as $tag ) {
							$tmp_output .= $tag;
						}
						if ( $list_ouput == true ) {
							$output .= '<ul class="tag_list">'."\n".$tmp_output."\n".'</ul>'."\n";
						} else {
							$output .= '<div class="tag_list">'."\n".$tmp_output."\n".'</div>'."\n";
						}
						unset($tmp_output);
					} else {
						if ( $list_ouput == true ) {
							$output .= '<ul class="tag_list">'."\n<li>".$this->option['tabs_notagslettertext']."</li>\n".'</ul>'."\n";
						} else {
							$output .= '<div class="tag_list">'."\n".$this->option['tabs_notagslettertext']."\n".'</div>'."\n";
						}
					}					
	            $output .= '</div>'."\n";
			}
        $output .= '</div>'."\n";	
		
		if ( $output <> '' ) {
			return "\n" . '<!-- Generated by \'Simple Tagging Plugin ' . $this->stp_version . '\' - http://trac.herewithme.fr/project/simpletagging/ -->' . "\n" . $output . "\n"; // Please do not remove this line.
		}
		return $notagstext;		
	}
	
	function printTabsHeaderJS( $display = true ) {	
		$url = $this->info['install_url'];
		$output = <<<EOF
<script src="$url/inc/js/jquery-1.1.3.1.pack.js" type="text/javascript"></script>
<script src="$url/inc/js/jquery.tabs.pack.js" type="text/javascript"></script>
<script src="$url/inc/js/jquery.auto-tabs.js" type="text/javascript"></script>
<link rel="stylesheet" href="$url/inc/css/jquery.tabs.client.css" type="text/css" media="print, projection, screen" />
<script type="text/javascript">
    $(function() {
		$('#containertags').AutoTabs(1, {fxFade: true});		
	});		
	
</script>
EOF;
		if ( $display == true ) {
			echo $output;
		} else {
			return $output;
		}
	}


	/**
	 * Get related posts list.
	 *
	 * @param string $format
	 * @param string $postsseparator
	 * @param string $sortorder
	 * @param integer $limit_qty
	 * @param integer $limit_days
	 * @param string $dateformat
	 * @param string $nothingfound
	 * @param boolean $includepages
	 * @param integer $post_id
	 * @param string $excludecat
	 * @param string $excludetag
	 * @return string
	 */
	function createRelatedPostsList($format=null, $postsseparator=null, $sortorder=null, $limit_qty=null, $limit_days=null, $dateformat=null, $nothingfound=null, $includepages=null, $post_id=null, $excludecat=null, $excludetag=null) {	
		global $id, $wpdb;
		
		if ( is_null($post_id) || !is_int($post_id) ) {
			if ($id < 1 || ! is_int($id)) {
				global $post;
				$id = $post->ID;
			}
		} else {
			$id = (int)	$post_id;
		}

		// check parameters vs. class options
		$format			= (is_null($format))		? $this->option['related_format'] : $format;
		$postsseparator	= (is_null($postsseparator))? $this->option['related_postsseparator'] : $postsseparator;
		$sortorder 		= (is_null($sortorder)) 	? $this->option['related_sortorder']: $sortorder;
		$limit_qty  	= (is_null($limit_qty)) 	? $this->option['related_limit_qty'] : $limit_qty;
		$limit_days 	= (is_null($limit_days))	? $this->option['related_limit_days']  : $limit_days;
		$dateformat		= (is_null($dateformat))	? $this->option['related_dateformat'] : $dateformat;
		$nothingfound	= (is_null($nothingfound))	? $this->option['related_nothingfound'] : $nothingfound;
		$includepages	= (is_null($includepages))	? $this->option['related_includepages'] : $includepages;
		$excludecat		= (is_null($excludecat))	? $this->option['related_excludecat'] : $excludecat;
		$excludetag		= (is_null($excludetag))	? $this->option['related_excludetag'] : $excludetag;

		// Get tags of current post
		$tags_arr = $this->getPostTags($id);
		if (empty ($tags_arr)) {
			return $nothingfound;
		}
		
		// Exclude tags
		$excludetag_array = explode(',', $excludetag);		
		foreach ($excludetag_array as $value) {
			$excludetags[] = trim($value);
		}
		
		// Tags lists
		$tags_comma_separated = '';
		foreach($tags_arr as $loopval) {
			if ( !in_array($loopval, $excludetags) ) {
				$tags_comma_separated .= mysql_real_escape_string($loopval) . "','";
			}
		}	
		$tags_comma_separated = substr($tags_comma_separated, 0, -3);	// remove trailing ','
		
		$restrict = $this->sqlCategory( $excludecat );
		
		// PREPARE ORDER
		$lower_sortorder = strtolower($sortorder);
		if ( $lower_sortorder == 'alpha' ) {
			$order_by = 'posts.post_title ASC';
		} elseif ( $lower_sortorder == 'date-asc' ) {
			$order_by = 'posts.post_date ASC';
		} elseif ( $lower_sortorder == 'random' ) {
			$order_by = 'RAND()';
		} else {
			$order_by = 'posts.post_date DESC';
		}

		// Set limit of posting date. 86400 seconds = 1 day
		$timelimit = '';
		if ($limit_days != 0) {
			$timelimit = 'AND posts.post_date > ' . date( 'YmdHis', time() - $limit_days * 86400 );
		}
		
		// Include pages ?
		if ($includepages) {
			$posts_pages = ($this->is_wp_21) ? "AND posts.post_type IN('page','post') AND posts.post_status = 'publish'" : "AND posts.post_status IN('static','publish')";
		} else {
			$posts_pages = ($this->is_wp_21) ? "AND posts.post_type = 'post' AND posts.post_status = 'publish'" : "AND posts.post_status = 'publish'";
		}
		
		$time_sql = current_time('mysql');
		
		// SQL query
		$query = "SELECT DISTINCT posts.ID, posts.post_title, posts.post_date, posts.comment_count
				FROM {$wpdb->posts} posts
				LEFT JOIN {$this->info['stptable']} tags ON (posts.ID = tags.post_id)
				WHERE posts.ID <> {$id}
				{$posts_pages}
				AND posts.post_date < '{$time_sql}'
				AND tags.tag_name IN ('{$tags_comma_separated}')
				{$restrict}
				{$timelimit}
				ORDER BY {$order_by}
				LIMIT {$limit_qty}";
				
		if ( $this->use_cache === true ) {
			$key_cache = md5('createRelatedPostsList'.$id.$tags_comma_separated.$limit_qty.$order_by.$excludecat_sql);
			$results = wp_cache_get($key_cache, 'simpletagging');
			if (false === $results) {
				$results = $wpdb->get_results($query);
				wp_cache_set($key_cache, $results, 'simpletagging');
			}
			unset($key_cache);
		} else {
			$results = $wpdb->get_results($query); 
		}		
		
		// RETURN LIST
		$permalist = '';
		if ( count($results) > 0 && is_array($results) ) {
			foreach($results as $result) {
				// Date of post
				$loop_postdate = mysql2date($dateformat, $result->post_date);
				// Replace placeholders
				$element_loop = $format;
				$element_loop = str_replace('%date%', $loop_postdate, $element_loop);
				$element_loop = str_replace('%permalink%', get_permalink($result->ID), $element_loop);
				$element_loop = str_replace('%title%', $result->post_title, $element_loop);
				$element_loop = str_replace('%commentcount%', $result->comment_count, $element_loop);

				// Add to list
				$permalist .= (($permalist != '') ? $postsseparator : '') . $element_loop;    // Incl. adding separator
				$permalist .= (substr($format,0,3) == '<li') ? "\n" : '';                    // new line only if list is used
				
			}
			$res = "\n" . '<!-- Generated by \'Simple Tagging Plugin ' . $this->stp_version . '\' - http://trac.herewithme.fr/project/simpletagging/ -->' . "\n" . $permalist . "\n"; // Please do not remove this line.
			return $res;
		}
		return $nothingfound;
	}

	/**
	 * Get Related Tags
	 *
	 * @param string $format
	 * @param string $tagseparator
	 * @param string $sortorder
	 * @param string $nonfoundtext
	 * @param integer $limit_qty
	 * @return string
	 */
	function outputRelatedTags($format=null, $tagseparator=null, $sortorder=null, $nonfoundtext=null, $limit_qty=null) {
		global $wpdb;
		// check parameters vs. class options
		$format			= (is_null($format))		? $this->option['relatedtags_format'] 		: $format;
		$tagseparator	= (is_null($tagseparator))	? $this->option['relatedtags_tagseparator'] : $tagseparator;
		$sortorder		= (is_null($sortorder))		? $this->option['relatedtags_sortorder'] 	: $sortorder;
		$nonfoundtext	= (is_null($nonfoundtext))	? $this->option['relatedtags_nonfoundtext']	: $nonfoundtext;
		$limit_qty		= (is_null($limit_qty))		? $this->option['relatedtags_limit_qty']	: $limit_qty;
		
		if ( !($this->is_tag_view()) ) {
			return $nonfoundtext;
		}
		
		// prepare values	
		$tagList = $this->tag_urls2names_IN($this->search_tag);			// comma separated list for IN()
		$tagListArray = $this->tag_url2url_array($this->search_tag);	// tag array
		$number_tags_base0 = $this->search_tag_count - 1;				// number of tags -1
		
		$limit_qty = (int) $limit_qty;
		if ( $limit_qty && $limit_qty != 0 ) {
			$limit_qty = 'LIMIT 0, '.$limit_qty;			
		}
		
		$postidsIN = '';
		if ( $this->version_mysql == 4 ) { // MySQL 4.0
			$query = "SELECT post_id FROM {$this->info['stptable']}
					WHERE tag_name IN ($tagList)
					GROUP BY post_id
					HAVING COUNT(post_id) > $number_tags_base0
					";			
			if ( $this->use_cache === true ) {
				$key_cache = md5('Sub_outputRelatedTags'.$tagList.$number_tags_base0);
				$results = wp_cache_get($key_cache, 'simpletagging');
				if (false === $results) {
					$results = $wpdb->get_results($query);
					wp_cache_set($key_cache, $results, 'simpletagging');
				}
				unset($key_cache);
			} else {
				$results = $wpdb->get_results($query);
			}

			if (count($results) < 1) {
				return $nonfoundtext;
			}

			// Convert to use in IN() 			
			foreach( $results as $post ) {
				$postidsIN .= ($postidsIN == '') ? $post->post_id : ',' . $post->post_id;
			}
		} else { //  Subqueries for MySQL 5
			$postidsIN = "SELECT post_id FROM {$this->info['stptable']}
								WHERE tag_name IN ({$tagList})
								GROUP BY post_id
								HAVING COUNT(post_id) > {$number_tags_base0}";
		}
				
		// 1. We need all tags of these post IDs but not the ones that are already used
		// prepare order
		$lower_sortorder = strtolower($sortorder);
		if ( $lower_sortorder == 'count-desc' ) {
			$order_by = 'qty DESC';
		} elseif ( $lower_sortorder == 'count-asc' ) {
			$order_by = 'qty ASC';
		} elseif ( $lower_sortorder == 'alpha-desc' ) {
			$order_by = 'tag_name DESC';
		} else {
			$order_by = 'tag_name ASC';
		}

		$query = "
			SELECT tag_name, COUNT(*) AS qty FROM {$this->info['stptable']}
			WHERE post_id IN ($postidsIN)
			AND tag_name NOT IN ($tagList)
			GROUP BY tag_name
			ORDER BY {$order_by}
			{$limit_qty}";
	
		if ( $this->use_cache === true ) {
			$key_cache = md5('outputRelatedTags'.$postidsIN.$tagList.$order_by.$limit_qty);
			$results = wp_cache_get($key_cache, 'simpletagging');
			if (false === $results) {
				$results = $wpdb->get_results($query);
				wp_cache_set($key_cache, $results, 'simpletagging');
			}
			unset($key_cache);
		} else {
			$results = $wpdb->get_results($query);
		}
		
		if (count($results) < 1) {
			return $nonfoundtext;
		}
		
		// 2. Ouput
		$result = '';
		foreach( $results as $tag ) {
			// Tag Link
			$vr['taglink'] = $this->getTagPermalink($tag->tag_name);

			// Tag Link + Additional Tag
			$current_url = $this->search_tag;	// Current URL
			$current_url = str_replace(' ', '+', $current_url);	// + was replaced by ' ', so restore that
			$current_url_add = $current_url . '+' . $tag->tag_name; // Current URL + additional tag
			$vr['taglink_plus'] = $this->getTagPermalink($current_url_add); // Permalink with additional tag
			// Number of tags		
			$vr['count'] = $tag->qty;
			// Tag Name
			$vr['tagname'] = $tag->tag_name;
			// Format			
			$fmt_res = $format;
			$fmt_res = str_replace('%tagname%', $vr['tagname'], $fmt_res);
			$fmt_res = str_replace('%taglink%', $vr['taglink'], $fmt_res);
			$fmt_res = str_replace('%taglink_plus%', $vr['taglink_plus'], $fmt_res);
			$fmt_res = str_replace('%count%', $vr['count'], $fmt_res);			
			// Result
			$result .= (($result != '') ? $tagseparator : '') . $fmt_res . "\n";	// Incl. adding separator	
		}
		$result = "\n" . '<!-- Generated by \'Simple Tagging Plugin ' . $this->stp_version . '\' - http://trac.herewithme.fr/project/simpletagging/ -->' . "\n" . $result . "\n"; // Please do not remove this line.
		return $result;		
	}

	/**
	 * Get link "remove tags" for related tags
	 *
	 * @param string $format
	 * @param string $separator
	 * @param string $nonfoundtext
	 * @return string
	 */
	function outputRelatedTagsRemoveTags($format=null, $separator=null, $nonfoundtext=null) {
		// check parameters vs. class options
		$format		= (is_null($format))	? $this->option['relatedtags_remove_format'] : $format;
		$separator	= (is_null($separator))	? $this->option['relatedtags_remove_separator'] : $separator;
		$nonefound	= (is_null($nonefound))	? $this->option['relatedtags_remove_nonfoundtext'] : $nonefound;

		if ( !($this->is_tag_view()) ) {
			return $nonefound;
		}

		$tagListArray = $this->tag_url2url_array($this->search_tag);	// tag array

		if ($this->search_tag_count > 1) {
			$result = '';
			foreach ($tagListArray as $lval) {
				// Get Permalink
				$url = $this->removeTagFromURL($this->search_tag, $lval);	// remove current tag
				$url = $this->getTagPermalink($url); // permalink
				
				// Get Tag Name
				$name = $this->tag_url2name($lval);
				
				// Format
				$fmt_res = $format;
				$fmt_res = str_replace('%url%', $url, $fmt_res);
				$fmt_res = str_replace('%tagname%', $name, $fmt_res);
				
				// Result
				$result .= (($result != '') ? $separator : '') . $fmt_res;	// Incl. adding separator
				$result .= (substr($format,0,3) == '<li') ? "\n" : '';			// new line only if list is used
			}			
			return $result;			
		} 
		return $nonefound;		
	}

	/**
	 * Get meta keywords
	 *
	 * @param string $before
	 * @param string $after
	 * @param string $separator
	 * @param string $include_cats
	 * @return array
	 */
	function getMetaKeywords($before='', $after='', $separator=',', $include_cats=null) {
		// add pre-defined keywords
		$pagekeys = explode(',', $this->option['meta_always_include']);
		
		// get tags for all posts in current view
		foreach($this->getPostTags() as $post_tags) {
			$pagekeys = array_merge($pagekeys, $post_tags);
		}
		
		// add categories if necessary
		if (is_null($include_cats)) {
			$include_cats = $this->option['meta_includecats'];
		}
		if ($include_cats) {
			global $category_cache;
			if ( ($include_cats == 'all') || (($include_cats == 'default') && is_home()) ) {
				// include all site categories
				foreach($this->getAllCats() as $category) {
					$pagekeys[] = $category['name'];
				}
			} elseif (isset($category_cache) && ($include_cats != 'none')) {
				// include only categories from posts in current view. Array is pretty encapsulated so we use several foreach loops. 
				foreach($category_cache as $arrayA) {
					foreach($arrayA as $arrayB) {
						if ($this->is_wp_21) {	// In WP 2.1, the category is inside another array :-(
							foreach($arrayB as $category) {
								$pagekeys[] = $category->cat_name;
							}
						} else {
							$pagekeys[] = $arrayB->cat_name;
						}
					}
				}
			}
		}
		$pagekeys = array_unique($pagekeys);    // remove duplicates
		
		// setup meta keywords for page header
		$keywordlist = '';
		foreach($pagekeys as $keyword) {
			$keywordlist .= (($keywordlist != '') ? $separator : '') . $before . $keyword . $after;
		}
		return htmlspecialchars($keywordlist);
	}

	/**
	 * This is pretty filthy.  Doing math in hex is much too weird.  It's more likely to work,  this way!
	 * Provided from UTW. Thanks.
	 *
	 * @param string $scale_color
	 * @param integer $min_color
	 * @param integer $max_color
	 * @return string
	 */
	function getColorByScale($scale_color, $min_color, $max_color) {
		$scale_color = $scale_color / 100;

		$minr = hexdec(substr($min_color, 1, 2));
		$ming = hexdec(substr($min_color, 3, 2));
		$minb = hexdec(substr($min_color, 5, 2));

		$maxr = hexdec(substr($max_color, 1, 2));
		$maxg = hexdec(substr($max_color, 3, 2));
		$maxb = hexdec(substr($max_color, 5, 2));

		$r = dechex(intval((($maxr - $minr) * $scale_color) + $minr));
		$g = dechex(intval((($maxg - $ming) * $scale_color) + $ming));
		$b = dechex(intval((($maxb - $minb) * $scale_color) + $minb));

		if (strlen($r) == 1) {
			$r = '0'.$r;
		}
		if (strlen($g) == 1) {
			$g = '0'.$g;
		}
		if (strlen($b) == 1) {
			$b = '0'.$b;
		}

		return '#'.$r.$g.$b;
	}
	
	/**
	 * Add rewrite tokens
	 *
	 * @param unknown_type $rewrite
	 * @return unknown
	 */
	function createRewriteRules($rewrite) {
		global $wp_rewrite;
		
		// Page Tags		
		$qvar =& $this->option['query_varname'];
		
		$token = '%' . $qvar . '%';
		$wp_rewrite->add_rewrite_tag($token, '(.+)', $qvar . '=');
		
		$tags_structure = $wp_rewrite->root . $qvar . "/$token/";
		$tags_rewrite = $wp_rewrite->generate_rewrite_rules($tags_structure);

		return ( $rewrite + $tags_rewrite );
	}
	
	/**
	 * Update an option value  -- note that this will NOT save the options.
	 *
	 * @param string $optname
	 * @param string $optval
	 */
	function setOption($optname, $optval) {
		$this->option[$optname] = $optval;
	}

	/**
	 * Save all current options
	 *
	 */
	function saveOptions() {
		// Flush WP rewrite rules if query var has changed
		global $wp_rewrite;
		$qvar = 'query_varname';

		$optTable = get_option($this->stp_optname);	
		if ( $this->option[$qvar] != $optTable[$qvar] ) {
			if ($this->_initdone) {
				$wp_rewrite->flush_rules();
			} else {
				$this->_flushrules = true;
			}
		}
		// write current option values to the database
		update_option($this->stp_optname, $this->option);
	}

	/**
	 * Reset to default options
	 *
	 * @param boolean $full
	 */
	function resetToDefaultOptions( $full = false ) {
		// Flush WP rewrite rules if query var has changed
		global $wp_rewrite;
		$qvar = 'query_varname';

		if ( $this->option[$qvar] != $this->defaultoption[$qvar] ) {
			if ($this->_initdone) {
				$wp_rewrite->flush_rules();
			} else {
				$this->_flushrules = true;
			}
		}
		
		if ( $full === true ) {
			// write option values to database
			update_option($this->stp_optname, $this->defaultoption);
			// set class options
			$this->option = $this->defaultoption;
		}
	}
	
	/**
	 * Prepare data for SQL queries
	 *
	 * @param string $value
	 * @return string
	 */
	function quoteSmart( $value = '' ) {
		// Stripslashes
		if ( get_magic_quotes_gpc() ) {
			$value = stripslashes( $value );
		}
		if ( is_string( $value ) ) {
			$value = trim( $value );
		}
		// Protection si ce n'est pas une valeur numérique ou une chaine numérique
		if ( !is_numeric( $value ) ) {
			$value = "'" . mysql_real_escape_string( $value ) . "'";
		}
		return $value;
	}

	/**
	 * Caches all tags matching current post selection
	 *
	 * @param integer $postid
	 * @param boolean $force
	 * @return array
	 */
	function getPostTags($postid=null, $force=false) {
		if (isset($postid)) {
			$this->_postids = $postid;
		}
		
		if (is_null($this->_posttags) || !isset($this->_posttags[$postid]) || $force) {
			if (empty($this->_postids)) {
				$this->_posttags = array(); // no posts, thus no tags
				return $this->_posttags;
			}
			
			global $wpdb;
			$qry = "SELECT DISTINCT post_id, tag_name AS name
				FROM {$this->info['stptable']} tags
				WHERE post_id IN ({$this->_postids})
				ORDER BY post_id, name";
			
			if ( $this->use_cache === true ) {
				$key_cache = md5('getPostTags'.$this->_postids);
				$tag_results = wp_cache_get($key_cache, 'simpletagging');
				if (false === $tag_results) {
					$tag_results = $wpdb->get_results($qry);
					wp_cache_set($key_cache, $tag_results, 'simpletagging');
				}
				unset($key_cache);
			} else {
				$tag_results = $wpdb->get_results($qry);
			}
			
			$post_tags = array();
			if (!is_null($tag_results) && is_array($tag_results)) {
				foreach ($tag_results as $tag) {
					$post_id = $tag->post_id;
					if (!isset($post_tags[$post_id])) {
						$post_tags[$post_id] = array();
					}
					$post_tags[$post_id][] = $tag->name;
				}
			}
			$this->_posttags =& $post_tags;
		}
		
		if (is_null($postid)) {
			return $this->_posttags;
		} elseif (isset($this->_posttags[$postid])) {
			return $this->_posttags[$postid];
		} else {
			return array();
		}
	}
	
	/**
	 * Helper for create queries with limit category and exclude categories
	 *
	 * @param integer $limit_cat
	 * @param integer $excludecat
	 * @return string
	 */
	function sqlCategory( $limit_cat = null, $excludecat = null ) {
		global $wpdb;
		$result = '';
		
		$limit_cat = (int) $limit_cat;	
		if ( !is_null($limit_cat) && $limit_cat != 0  ) { // Limit to a category specified
			
					
			$result = "SELECT post_id FROM {$wpdb->post2cat} WHERE category_id = {$limit_cat}";
			
			if ( $this->version_mysql != 5 ) {
				$results = $wpdb->get_col($result);
				if ( $results ) {
					foreach ($results as $post) {
						$result .= $post.',';
					}
					$result = substr( $result, 0, strlen($result) -1);
				}
			}
			
			if ( $result != '' ) {
				return ('AND posts.ID IN ('. $result . ')');
			}
			
		} elseif( !is_null($excludecat) && $excludecat != 0 ) { // Exclude one or more categories							
			if ( $excludecat != '0' || $excludecat != '' || $excludecat = ' ' ) {				
				if ( strpos( $excludecat, ',' ) ) {
					$result = "SELECT post_id FROM {$wpdb->post2cat} WHERE category_id IN ( ";
						$excludecats = explode(',', $excludecat);
						$countexcludecats = count($excludecats);				
						for ( $a = 0; $a <= $countexcludecats; $a++) {
							$result .= (int) trim($excludecats[$a]) .',';				
						}
					$result = substr($result, 0, -1); // remove trailing ,
					$result .= ' )';	
				} else {
					$result = "SELECT post_id FROM {$wpdb->post2cat} WHERE category_id = ".(int) $excludecat;	
				}
				
				if ( $this->version_mysql != 5 ) {
					$results = $wpdb->get_col($result);
					if ( $results ) {
						foreach ($results as $post) {
							$result .= $post.',';
						}
						$result = substr( $result, 0, strlen($result) -1);
					}
				}
				
				if ( $result != '' ) {
					return ('AND posts.ID NOT IN ('. $result . ')');
				}							
			}			
		}		

		return '';		
	}

	/**
	 * Gets all published site tags
	 *
	 * @param boolean $force
	 * @param integer $limit_days
	 * @param integer $limit_cat
	 * @param integer $excludecat
	 * @return array
	 */
	function getAllTags($force=false, $limit_days=null, $limit_cat=null, $excludecat=null, $include_page=null) {
		if (is_null($this->_alltags) || $force) {
			global $wpdb;
			
			// Set limit of posting date. 86400 seconds = 1 day
			$timelimit = '';
			if ($limit_days != 0 && !is_null($limit_days)) {
				$timelimit = "AND posts.post_date_gmt >= '" . date('YmdHis', time() - $limit_days*86400) . "'";
			}
			
			// Include pages ?
			if ( $include_page == 1 ) {
				$posts_pages = ($this->is_wp_21) ? "AND posts.post_type IN('page','post') AND posts.post_status = 'publish'" : "AND posts.post_status IN('static','publish')";
			} else {
				$posts_pages = ($this->is_wp_21) ? "AND posts.post_type = 'post' AND posts.post_status = 'publish'" : "AND posts.post_status = 'publish'";
			}
			
			$restrict = $this->sqlCategory( $limit_cat, $excludecat );
			
			$table = $this->info['stptable'];
			$query = "SELECT tag.tag_name AS name, COUNT(tag.post_id) AS numposts
				FROM {$table} tag
				INNER JOIN {$wpdb->posts} posts ON tag.post_id = posts.id
				WHERE 1 = 1
				{$posts_pages}
				AND posts.post_date_gmt <= '" . gmdate("Y-m-d H:i:s", time()) . "'
				{$restrict}
				{$timelimit}
				GROUP BY tag.tag_name
				ORDER BY numposts DESC ";
				
			if ( $this->use_cache === true ) {
				$key_cache = md5('getAllTags'.$restrict.$timelimit);
				$tag_results = wp_cache_get($key_cache, 'simpletagging');
				if (false === $tag_results) {
					$tag_results = $wpdb->get_results($query);
					wp_cache_set($key_cache, $tag_results, 'simpletagging');
				}
				unset($key_cache);
			} else {
				$tag_results = $wpdb->get_results($query);
			}
			
			$alltags = array();
			if (!is_null($tag_results) && is_array($tag_results)) {
				foreach ($tag_results as $tag) {
					$alltags[$tag->name] = array('name' => $tag->name, 'count'=> $tag->numposts, 'link' => $this->getTagPermalink($tag->name));
				}
			}
			$this->_alltags =& $alltags;
		}
		return $this->_alltags;
	}

	/**
	 * Gets all published site categories (same format as getAllTags)
	 *
	 * @param boolean $force
	 * @param integer $limit_days
	 * @param integer $limit_cat
	 * @param integer $excludecat
	 * @return array
	 */
	function getAllCats($force=false, $limit_days=null, $limit_cat=null, $excludecat=null, $include_page=null) {
		if (is_null($this->_allcats) || $force) {
			global $wpdb;
			
			// Set limit of posting date. 86400 seconds = 1 day
			$timelimit = '';
			if ($limit_days != 0 && !is_null($limit_days)) {
				$timelimit = "AND posts.post_date_gmt >= '" . date('YmdHis', time() - $limit_days*86400) . "'";
			}
			
			// Include pages ?
			if ( $include_page == 1 ) {
				$posts_pages = ($this->is_wp_21) ? "AND posts.post_type IN('page','post') AND posts.post_status = 'publish'" : "AND posts.post_status IN('static','publish')";
			} else {
				$posts_pages = ($this->is_wp_21) ? "AND posts.post_type = 'post' AND posts.post_status = 'publish'" : "AND posts.post_status = 'publish'";
			}
				
			$restrict = $this->sqlCategory( $limit_cat, $excludecat );

			$query = "SELECT p2c.category_id AS cat_id, COUNT(p2c.rel_id) AS numposts,
				UNIX_TIMESTAMP(max(posts.post_date_gmt)) + '" . get_option('gmt_offset') . "' AS last_post_date,
				UNIX_TIMESTAMP(max(posts.post_date_gmt)) AS last_post_date_gmt
				FROM {$wpdb->post2cat} p2c
				INNER JOIN {$wpdb->posts} posts ON p2c.post_id=posts.id
				WHERE 1 = 1
				{$posts_pages}
				AND posts.post_date_gmt <= '" . gmdate("Y-m-d H:i:s", time()) . "'
				{$restrict}
				{$timelimit}
				GROUP BY p2c.category_id
				ORDER BY numposts DESC ";
			
			if ( $this->use_cache === true ) {
				$key_cache = md5('getAllCats'.$restrict.$timelimit);
				$results = wp_cache_get($key_cache, 'simpletagging');
				if (false === $results) {
					$results = $wpdb->get_results($query);
					wp_cache_set($key_cache, $results, 'simpletagging');
				}
				unset($key_cache);
			} else {
				$results = $wpdb->get_results($query);
			}
			
			$allcats = array();
			if (!is_null($results) && is_array($results)) {
				foreach ($results as $cat) {
					$catname = get_catname($cat->cat_id);
					$allcats[$catname] = array('name' => get_catname($cat->cat_id), 'count'=> $cat->numposts, 'link' => get_category_link((int)$cat->cat_id));
				}
			}
			$this->_allcats =& $allcats;
		}
		return $this->_allcats;
	}
	
	/**
	 * combines all published tags & categories
	 *
	 * @param boolean $force
	 * @param integer $limit_days
	 * @param integer $limit_cat
	 * @param integer $exclude_cat
	 * @return array
	 */
	function getAllCombined($force=false, $limit_days=null, $limit_cat=null, $exclude_cat=null) {	
		if (is_null($this->_allcombined) || $force) {
			$combined = array_merge($this->getAllTags('', $limit_days, $limit_cat, $exclude_cat), $this->getAllCats('', $limit_days, $limit_cat, $exclude_cat));
			uasort($combined, array(&$this, 'sortCombined'));
			$this->_allcombined =& $combined;
		}
		return $this->_allcombined;
	}

	/**
	 * Sort by descending count, ties broken by nat case ascending name
	 *
	 * @param string $a
	 * @param string $b
	 * @return array
	 */
	function sortCombined($a, $b) {
		if ($a['count'] == $b['count']) {
			return strnatcasecmp($a['name'], $b['name']);
		} else {
			return ( ($a['count'] > $b['count']) ? -1 : 1 );
		}
	}
	
	/**
	 * Substitute values into link format
	 *
	 * @param string $name
	 * @param string $full_link
	 * @param string $format
	 * @param integer $scale
	 * @param integer $count
	 * @param string $color
	 * @param string $size
	 * @param string $color_size
	 * @return string
	 */
	function formatLink($name, $full_link, $format, $scale=0, $count=0, $color=null, $size=null, $color_size=null) {
		/* substitute values into link format */
		$newlink = $format;
		$newlink = str_replace('%tagname%', $name, $newlink);
		$newlink = str_replace('%taglink%', $this->tag_name2url($name), $newlink);
		$newlink = str_replace('%flickr%', $this->flickrLink($name), $newlink);
		$newlink = str_replace('%delicious%', $this->deliciousLink($name), $newlink);
		$newlink = str_replace('%fulltaglink%', $full_link, $newlink);
		$newlink = str_replace('%feedtaglink%', $this->feedLink($full_link), $newlink);
		$newlink = str_replace('%scale%', $scale, $newlink);
		$newlink = str_replace('%count%', $count, $newlink);
		/* Color  Cloud */
		if ($color != null) {
			$newlink = str_replace('%color%', $color, $newlink);
		}
		if ($size != null) {
			$newlink = str_replace('%size%', $size, $newlink);
		}
		if ($color_size != null) {
			$newlink = str_replace('%colorsize%', $color_size, $newlink);
		}
			
		return $newlink;
	}
	
	/**
	 * Create feed link from tag link
	 *
	 * @param string $link
	 * @return string
	 */
	function feedLink( $link ) {
		if ( $this->is_rewriteon == true ) {
			if ($this->option['trailing_slash'] == 1) {
				return $link.'feed/';
			} else {
				return $link.'/feed';
			}
		}
		return $link.'&feed=rss2';
	}
	
	/**
	 * Format tag for Flickr
	 *
	 * @param string $tag
	 * @return string
	 */
	function flickrLink($tag) {
		return urlencode(preg_replace('/[^a-zA-Z0-9]/', '', strtolower($tag)));
	}
	
	/**
	 * Format tags for Delicious
	 *
	 * @param string $tag
	 * @return string
	 */
	function deliciousLink($tag) {
		$del = str_replace(' ', '', $tag);	// Strip whitespace
		if (strstr($del, '+')) {
			$del = '"' . $del . '"';
		}
		
		return str_replace('%2F', '/', rawurlencode($del));
	}

	/**
	 * Use this to check if the current view will be returning tag search results.
	 *
	 * @return boolean
	 */
	function is_tag_view() {
		if (!is_null($this->search_tag) && ($this->search_tag != '')) {
			return true;
		} else {
			return false;
		}
	}	
	
	/**
	 * Test if local installation is Mu Plugins or a classic plugins
	 *
	 * @return boolean
	 */
	function is_mu_plugins() {
		global $wp_version;

		if ( strpos($wp_version , "mu") === false ) {
			return false;
		}
		
		$install_dirurl_tmp = dirname(__FILE__);
		if ( strpos($install_dirurl_tmp, 'mu-plugins') ) {
			return true;
		}
		return false;
	}
}
?>