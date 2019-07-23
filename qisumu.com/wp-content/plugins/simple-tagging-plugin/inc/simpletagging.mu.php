<?php
class SimpleTaggingMu {
	// Contains SimpleTagging Object
	var $sTagObj;
		
	// Mu Admin
	var $mu_stp_optname = 'mu_stp_options';	// Name of the options in site_meta table
	var $mu_defaultoption;
	var $mu_option;
	
	// Data
	var $blogs = false;
	var $tags_results = '';
	var $search_tag = '';
	
	var $base_url;
	var $mu_site = false;
	
	// Constructor
	function SimpleTaggingMu( $sTagObj ) {
		// Set object
		$this->sTagObj = $sTagObj;
		unset($sTagObj);
		
		// 1. Define default options
		$mu_defaultopt = array(	
		// miscellaneous
			'mu_query_varname'	=> 'site-tags',		// HTTP var name used for tag searches
			'mu_template'		=> 'pagetemplate.mu.simpletagging.php', // template file to use for displaying tag queries
			'mu_all_site'		=> '1', // Specifik site Mu			
			'include_page'		=> '1', // Include Page in results :)
			'include_protected_content' => '0',
			
			// Tag cloud options
			'cloud_linkformat'		=> __('<a style="%colorsize%" class="%scale%" title="Tag: %tagname% (%count%)" href="%taglink%">%tagname%</a>', 'simpletagging'),         // post tag format (initialized to $link_tagcloud)
			'cloud_tagseparator'	=> ' ',			// tag separator character(s)
			'cloud_includecats'		=> '0',			// include categories in tag cloud
			'cloud_sortorder'		=> 'natural',	// tag sorting: natural, countup/asc, countdown/desc, alpha
			'cloud_displaymax'		=> '0',			// maximum # of tags to display (all if set to zero)
			'cloud_displaymin'		=> '0',			// minimum tag count to include in tag cloud
			'cloud_scalemax'		=> '10',        // maximum value for count scaling (no scaling if zero)
			'cloud_scalemin'		=> '1',			// minimum value for count scaling
			'cloud_max_color'     	=> '#000000',		// Most popular color
			'cloud_min_color'		=> '#CCCCCC',		// Least popular color
			'cloud_max_size'	  	=> '18',			// Most popular font size
			'cloud_min_size'	  	=> '11',			// Least popular font size
			'cloud_unit'			=> 'px',			// The units to display the font sizes with		
			'cloud_notagstext'		=> __('No tags were found that match the criteria given.', 'simpletagging'),	// text to display if no tags found
		);
		
		// 2. Set class property for default options
		$this->mu_defaultoption = $mu_defaultopt;		
		
		// 3. Get options from WP options table
		$optionsFromTable = get_site_option($this->mu_stp_optname);

		if ( !$optionsFromTable ) {
			$this->resetToDefaultOptions( true ); // First save in DB.
		}

		// 4. Update default options by getting not empty values from options table
		foreach( $mu_defaultopt as $def_optname => $def_optval ) {
			if ( $optionsFromTable[$def_optname] != '' ) {
				$defaultopt[$def_optname] = $optionsFromTable[$def_optname];
			}
		}

		// 5. Set the class property
		$this->mu_option = $defaultopt;
		
			
		// 7. Determine Site
		if ( $this->mu_option['mu_all_site'] != 1 ) {
			global $current_site;
			$this->mu_site = $current_site->id;
		} 
		
		// 8. Get blogs
		$this->getBlogs();
		
		// 9. Filter and actions
		add_action('init', array(&$this, 'wpaction_InitRewrite'), 2);
		add_filter('query_vars', array(&$this, 'wpfilter_AddQueryVar'));
		add_action('parse_query', array(&$this, 'wpaction_ParseQuery'));
		add_action('posts_request', array(&$this, 'buildQueryForListPosts'));
		
		// 10. Load Mu functions
		require ( $this->sTagObj->info['install_dir'] . '/inc/simpletagging.mu.functions.php' );
	}
	
	/* Utilz Option */
	function setOption($optname, $optval) {
		$this->mu_option[$optname] = $optval;
	}
	
	function saveOptions() {
		// Flush WP rewrite rules if query var has changed
		global $wp_rewrite;
		$qvar = 'mu_query_varname';

		$optTable = get_site_option($this->mu_stp_optname);	
		if ( $this->mu_option[$qvar] != $optTable[$qvar] ) {
			if ($this->sTagObj->_initdone) {
				$wp_rewrite->flush_rules();
			} else {
				$this->sTagObj->_flushrules = true;
			}
		}
		// write current option values to the database
		update_site_option($this->mu_stp_optname, $this->mu_option);		
	}

	function resetToDefaultOptions( $full = false ) {
		// Flush WP rewrite rules if query var has changed
		global $wp_rewrite;
		$qvar = 'mu_query_varname';

		if ( $this->mu_option[$qvar] != $this->defaultoption[$qvar] ) {
			if ($this->sTagObj->_initdone) {
				$wp_rewrite->flush_rules();
			} else {
				$this->sTagObj->_flushrules = true;
			}
		}
		
		if ( $full === true ) {
			// write option values to database
			update_site_option($this->mu_stp_optname, $this->mu_defaultoption);
			// set class options
			$this->mu_option = $this->mu_defaultoption;
		}
	}
	
	function getBlogs() {
		// Todo : option for last_updated!!!
		global $wpdb;
		
		$and_siteID_sql = '';
		if ( $this->mu_site != false ) {
			$and_siteID_sql = "AND site_id = '{$this->mu_site}'";
		}
	
		$blogs = wp_cache_get('getBlogs'.$this->mu_site, 'simpletagging');
		if ( false === $blogs ) {
			$blogs = $wpdb->get_results("
				SELECT * 
				FROM {$wpdb->blogs} 
				WHERE 1 = 1
				{$and_siteID_sql}
				AND public = '1' 
				AND archived = '0' 
				AND mature = '0' 
				AND spam = '0' 
				AND deleted = '0'
				AND last_updated != '0000-00-00 00:00:00'
				AND last_updated != registered
				");
			wp_cache_set('getBlogs'.$this->mu_site, $blogs, 'simpletagging');
		}
		
		if ( $blogs ) {
			foreach ( $blogs as $blog ) {
				$this->blogs[$blog->blog_id] = array (
					'site_id' => $blog->site_id,
					'blog_id' => $blog->blog_id,
					'domain' => $blog->domain,
					'path' => $blog->path,
					'registered' => $blog->registered,
					'last_updated' => $blog->last_updated,
					'lang_id' => $blog->lang_id
					);
			}
		}
	}
	
	function getTags( $mini = null, $limit = null, $include_page = false ) {
		global $wpdb;
		
		if ( !is_null($limit) && $limit != 0 ) {
			$limit_sql = 'LIMIT '.$limit;
		}
			
		if ( $include_page == true )  {
			$type_sql = "('post', 'page')";
		} else {
			$type_sql = "('post')";
		}
		
		$restrict_sql = '';
		if ( $this->mu_option['include_protected_content'] == 0 ) {
			$restrict_sql = 'AND post_password = ""';
		}

		if ( $this->blogs ) {
			foreach ( $this->blogs as $blog ) {				
				$select_union[] = "
					(SELECT tags.tag_name, COUNT(tags.tag_name) as total
					FROM wp_{$blog['blog_id']}_{$this->sTagObj->option['tags_table']} tags, wp_{$blog['blog_id']}_posts posts
					WHERE tags.post_id = posts.ID 
					AND posts.post_type IN {$type_sql}
					AND posts.post_status IN ('publish', 'private')
					{$restrict_sql}
					GROUP BY tags.tag_name)";
			}				
		
			$unions = implode( "\n\tUNION ALL\n\t", $select_union );
			$query = "
				SELECT tag_name, SUM(total) AS tags_count
				FROM ({$unions}) AS all_tags
				GROUP BY tag_name
				ORDER BY total DESC
				{$limit_sql}";
			
			$results = wp_cache_get('getTagsForAllBlogs'.$limit, 'simpletagging');
			if (false === $results) {
				$results = $wpdb->get_results($query);
				wp_cache_set('getTagsForAllBlogs'.$limit, $results, 'simpletagging');
			}
			
			$alltags = array();
			if ( $results ) {
				foreach ($results as $tag) {
					$alltags[$tag->tag_name] = array('name' => $tag->tag_name, 'count'=> $tag->tags_count);
				}
			}
			
			$this->tags_results = $alltags;
		}
	}
		
	function createSiteTagCloud($format=null, $tagseparator=null, $sort_order=null, $display_max=null, $display_min=null, $scale_max=null, $scale_min=null, $notagstext=null, $max_color=null, $min_color=null, $max_size=null, $min_size=null, $unit=null, $site_id = null, $include_page = null) {
		// check parameters vs. class options
		$format			= (is_null($format))		? $this->mu_option['cloud_linkformat']		: $format;
		$tagseparator	= (is_null($tagseparator))	? $this->mu_option['cloud_tagseparator']	: $tagseparator;
		$sort_order		= (is_null($sort_order))	? $this->mu_option['cloud_sortorder']		: $sort_order;
		$display_max	= (is_null($display_max))	? $this->mu_option['cloud_displaymax']		: $display_max;
		$display_min	= (is_null($display_min))	? $this->mu_option['cloud_displaymin']		: $display_min;
		$scale_max		= (is_null($scale_max))		? $this->mu_option['cloud_scalemax']		: $scale_max;
		$scale_min		= (is_null($scale_min))		? $this->mu_option['cloud_scalemin']		: $scale_min;
		$notagstext		= (is_null($notagstext))	? $this->mu_option['cloud_notagstext']		: $notagstext;
		$max_color		= (is_null($max_color))		? $this->mu_option['cloud_max_color']		: $max_color;
		$min_color		= (is_null($min_color))		? $this->mu_option['cloud_min_color']		: $min_color;
		$max_size		= (is_null($max_size))		? $this->mu_option['cloud_max_size']		: $max_size;
		$min_size		= (is_null($min_size))		? $this->mu_option['cloud_min_size']		: $min_size;
		$unit			= (is_null($unit))			? $this->mu_option['cloud_unit']			: $unit;
		$include_page	= (is_null($include_page))	? $this->mu_option['include_page']			: $include_page;
				
		// Force site.
		// Todo

		// Gets tags
		$this->getTags( $display_min, $display_max, $include_page );
		$alltags = $this->tags_results;
		
		if ( !is_array($alltags) || count($alltags) <= 0 ) {
			return $notagstext;			
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
						$color = "color: ". $this->sTagObj->getColorByScale($scale_color, $min_color, $max_color).';';
					}
					$color_size = $size.' '.$color;
					$output .= (($output != '') ? $tagseparator : '') . $this->formatLink($tag['name'], $format, $scaleResult, $tag['count'], $color, $size, $color_size)."\n";
				}
			}
		} else {
			foreach($alltags as $tag) {
				$output .= (($output != '') ? $tagseparator : '') . $this->formatLink($tag['name'], $format, $scaleResult, $tag['count'])."\n";
			}
		}
		
		if ( $output != '' ) {
			return "\n" . '<!-- Generated by \'Simple Tagging Plugin ' . $this->sTagObj->stp_version . '\' - http://trac.herewithme.fr/project/simpletagging/ -->' . "\n" . $output . "\n"; // Please do not remove this line.
		}
		return $notagstext;			
	} 
	
	function formatLink($name, $format, $scale=0, $count=0, $color=null, $size=null, $color_size=null) {
		/* substitute values into link format */
		$newlink = $format;
		$newlink = str_replace('%tagname%', $name, $newlink);
		$newlink = str_replace('%taglink%', $this->buildTagLink($name), $newlink);
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
	
	function buildTagLink( $tag_name ) {
		$tag_name = str_replace(' ', '_', $tag_name);	// urlencode converts space ' ' into +. We wanna use _ instead		
		$tag_name = urlencode($tag_name);
		$tag_name = str_replace('%2F', '/', $tag_name);	// seems that Apache's mod_rewrite are unable to handle urlencoded URLs properly
		$tag_name = str_replace('%2B', '+', $tag_name);	// seems that Apache's mod_rewrite are unable to handle urlencoded URLs properly
		$tag_name = str_replace('%20', '_', $tag_name);	// seems that Apache's mod_rewrite are unable to handle urlencoded URLs properly
		
		$trailing_slash = ($this->sTagObj->option['trailing_slash'] && $this->sTagObj->is_rewriteon) ? '/' : '';
		return ($this->base_url . $tag_name . $trailing_slash);
	}
	
	function buildQueryForListPosts( $actual_query ) { 
	    if ( !$this->is_mu_tag_view() ) {
	      return $actual_query;
	    }
	   
	    if ( strpos($actual_query, 'LIMIT') != false ) {
	      $pos1 = strpos($actual_query, 'LIMIT');
	      $limit_sql = substr( $actual_query, $pos1, strlen($actual_query) );
	    }

		if ( $this->mu_option['include_page'] == 1 ) {
			$type_sql = "('post', 'page')";
		} else {
			$type_sql = "('post')";
		}
		
		$restrict_sql = '';
		if ( $this->mu_option['include_protected_content'] == 0 ) {
			$restrict_sql = 'AND post_password = ""';
		}	
			
		foreach ( $this->blogs as $blog ) {	
			$select_union[] = "(
				SELECT DISTINCT posts.*, {$blog['blog_id']} AS blog_id
				FROM wp_{$blog['blog_id']}_{$this->sTagObj->option['tags_table']} tags, wp_{$blog['blog_id']}_posts posts
				WHERE tags.post_id = posts.ID 
				AND tags.tag_name = '{$this->search_tag}' 
				AND posts.post_type IN {$type_sql}
				{$restrict_sql}
				GROUP BY posts.post_name
       			ORDER BY post_date DESC )";
		}
			
		$unions = implode("\n\tUNION ALL\n\t", $select_union);
		
		$new_query = "
        		SELECT SQL_CALC_FOUND_ROWS DISTINCT *
				FROM ({$unions}) AS all_posts
				ORDER BY post_date DESC
				{$limit_sql}";        
		
		return $new_query;
	}

	function createRewriteRules($rewrite) {
		global $wp_rewrite;
		
		// Page Tags		
		$qvar =& $this->mu_option['mu_query_varname'];
		
		$token = '%' . $qvar . '%';
		$wp_rewrite->add_rewrite_tag($token, '(.+)', $qvar . '=');
		
		$tags_structure = $wp_rewrite->root . $qvar . "/$token/";
		$tags_rewrite = $wp_rewrite->generate_rewrite_rules($tags_structure);

		return ( $rewrite + $tags_rewrite );
	}
	
	function wpaction_InitRewrite() {
		global $wp_rewrite;
		
		if ( $this->mu_site == false ) { // All sites, take first site !
			global $sites;
			$current_site = $sites[0];
		} else {
			global $current_site;			
		}
		$this->base_url = 'http://'.$current_site->domain.$current_site->path;
		
		if ($this->sTagObj->is_rewriteon === true) {
			$this->base_url .= $wp_rewrite->root;		// set to "index.php/" if using that style
			$this->base_url .= $this->mu_option['mu_query_varname'] . '/';
		} else {
			$this->base_url .= '?' . $this->mu_option['mu_query_varname'] . '=';
		}
		
		/* generate rewrite rules for tag queries */
		if ($this->sTagObj->is_rewriteon === true) {
			add_filter('search_rewrite_rules', array(&$this, 'createRewriteRules'));
		}
	}
	
	function wpfilter_AddQueryVar($wpvar_array) {	 	
		$wpvar_array[] = $this->mu_option['mu_query_varname'];
		return ($wpvar_array);
	}

	function wpaction_ParseQuery() {
		$this->search_tag = stripslashes(get_query_var($this->mu_option['mu_query_varname']));
		
		if (get_magic_quotes_gpc()) {
			$this->search_tag = stripslashes($this->search_tag);  // why so many freakin' slashes?
		}

		if ($this->search_tag != '') {
			global $wp_query;

			$wp_query->is_single = false;
			$wp_query->is_page = false;
			$wp_query->is_archive = false;
			$wp_query->is_search = false;
			$wp_query->is_home = false;
			$wp_query->is_paged = false; 
			$wp_query->is_comment_feed = false;
				
			add_action('template_redirect', array(&$this, 'mu_template_redirect'));
		}
	}
	
	function mu_template_redirect() {
		if ( $this->is_mu_tag_view() ) {
			$template = '';			
			if ( is_file(TEMPLATEPATH . '/' . $this->mu_option['mu_template']) ) {
				$template = TEMPLATEPATH . '/' . $this->mu_option['mu_template'];
			}
			
			if ($template) {
				load_template($template);
				exit();
			} else {
				wp_die(__('Template file missing. You must have a valid template in your theme!', 'simpledlm'));			
			}
		}
	}
	
	function is_mu_tag_view() {
		if (!is_null($this->search_tag) && ($this->search_tag != '')) {
			return true;
		} else {
			return false;
		}
	}	
}
?>