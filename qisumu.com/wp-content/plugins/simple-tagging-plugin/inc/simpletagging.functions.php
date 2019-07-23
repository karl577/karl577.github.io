<?php
/*******************************************************************************
 * Function:        STP_Auto_PostTags
 * Purpose:                Display a tag list after the post content
 * Input:                $content
 * Output:                $content+STP_GetRelatedTags: String
 ******************************************************************************/ 
function STP_Auto_PostTags($content) {	
	return $content.STP_GetPostTags(null, null, null, null, true);
}

/*******************************************************************************
* Function:	STP_PostTags / STP_GetPostTags
* Purpose:		Outputs the list of tags related to the current post.
* 				Use this function in the "Loop". 
* Input:		...
* Output:		STP_PostTags: Echo
* 				STP_GetPostTags: String
******************************************************************************/ 
function STP_GetPostTags($linkformat=null, $include_cats=null, $tagseparator=null, $notagstext=null, $include_content=null, $include_content_before=null, $include_content_after=null) {
	global $STagging;
	return $STagging->outputPostTags($linkformat, $include_cats, $tagseparator, $notagstext, $include_content, $include_content_before, $include_content_after);
}
function STP_PostTags($linkformat=null, $include_cats=null, $tagseparator=null, $notagstext=null, $include_content=null, $include_content_before=null, $include_content_after=null) { 
	echo STP_GetPostTags($linkformat, $include_cats, $tagseparator, $notagstext, $include_content, $include_content_before, $include_content_after); 
}

/*******************************************************************************
* Function:	STP_Tagcloud
* Purpose:		Displays a tagcloud
* Input:		...
* Output:		STP_Tagcloud: Echo
* 				STP_GetTagcloud: String
******************************************************************************/
function STP_GetTagcloud($linkformat=null, $tagseparator=null, $include_cats=null, $sort_order=null, $display_max=null, $display_min=null, $scale_max=null, $scale_min=null, $notagstext=null, $max_color=null, $min_color=null, $max_size=null, $min_size=null, $unit=null, $limit_days=null, $limit_cat=null, $exclude_cat=null) {
	global $STagging;
	return $STagging->createTagcloud($linkformat, $tagseparator, $include_cats, $sort_order, $display_max, $display_min, $scale_max, $scale_min, $notagstext, $max_color, $min_color, $max_size, $min_size, $unit, $limit_days, $limit_cat, $exclude_cat);
}
function STP_Tagcloud($linkformat=null, $tagseparator=null, $include_cats=null, $sort_order=null, $display_max=null, $display_min=null, $scale_max=null, $scale_min=null, $notagstext=null, $max_color=null, $min_color=null, $max_size=null, $min_size=null, $unit=null, $limit_days=null, $limit_cat=null, $exclude_cat=null) {
	echo STP_GetTagcloud($linkformat, $tagseparator, $include_cats, $sort_order, $display_max, $display_min, $scale_max, $scale_min, $notagstext, $max_color, $min_color, $max_size, $min_size, $unit, $limit_days, $limit_cat, $exclude_cat);
}

/*******************************************************************************
* Function:     STP_GetTagcloud_ByCategory / STP_Tagcloud_ByCategory
* Purpose:		Displays a tagcloud for a specifik category
* Input:		...
* Output:		STP_Tagcloud_ByCategory: Echo
* 				STP_GetTagcloud_ByCategory: String
******************************************************************************/ 
function STP_Tagcloud_ByCategory( $limit_cat ) {
	echo STP_GetTagcloud_ByCategory( $limit_cat );
}
function STP_GetTagcloud_ByCategory( $limit_cat ) {
	$limit_cat = (int) $limit_cat;
	return STP_GetTagcloud($linkformat, $tagseparator, $include_cats, $sort_order, $display_max, $display_min, $scale_max, $scale_min, $notagstext, $max_color, $min_color, $max_size, $min_size, $unit, $limit_days, $limit_cat, $exclude_cat);
}

/*******************************************************************************
* Function:	STP_RelatedPosts
* Purpose:		Presents related posts according to the tags of the current post.
* Input:		...
* Output:		STP_RelatedPosts: Echo
* 				STP_GetRelatedPosts: String
******************************************************************************/
function STP_GetRelatedPosts($format=null, $postsseparator=null, $sortorder=null, $limit_qty=null, $limit_days=null, $dateformat=null, $nothingfound=null, $includepages=null, $post_id=null, $excludecat=null, $excludetag=null) {
	global $STagging;
	return $STagging->createRelatedPostsList($format, $postsseparator, $sortorder, $limit_qty, $limit_days, $dateformat, $nothingfound, $includepages, $post_id, $excludecat, $excludetag);
}
function STP_RelatedPosts($format=null, $postsseparator=null, $sortorder=null, $limit_qty=null, $limit_days=null, $dateformat=null, $nothingfound=null, $includepages=null, $post_id=null, $excludecat=null, $excludetag=null) { 
	echo STP_GetRelatedPosts($format, $postsseparator, $sortorder, $limit_qty, $limit_days, $dateformat, $nothingfound, $includepages, $post_id, $excludecat, $excludetag);
}

/*******************************************************************************
* Function:     STP_getRelatedPostsForPost / STP_RelatedPostsForPost
* Purpose:		Presents related posts according to the tags of a selected post.
* Input:		...
* Output:		STP_RelatedPosts: Echo
* 				STP_GetRelatedPosts: String
******************************************************************************/ 
function STP_getRelatedPostsForPost( $post_id ) {
	$post_id = (int) $post_id;
	return STP_GetRelatedPosts($format, $postsseparator, $sortorder, $limit_qty, $limit_days, $dateformat, $nothingfound, $includepages, $post_id, $excludecat);
}
function STP_RelatedPostsForPost( $post_id ) {
	echo STP_getRelatedPostsForPost( $post_id );
}

/*******************************************************************************
* Function:	STP_RelatedTags / STP_GetRelatedTags
* Purpose:		Outputs related tags in tag search. Useful if you want to display
* 				related tags like in del.icio.us.
* Input:		...
* Output:		STP_RelatedTags: Echo
* 				STP_GetRelatedTags: String
******************************************************************************/ 
function STP_GetRelatedTags($format=null, $tagseparator=null, $sortorder=null, $nonfoundtext=null, $limit_qty=null) {
	global $STagging;
	return $STagging->outputRelatedTags($format, $tagseparator, $sortorder, $nonfoundtext, $limit_qty);
}
function STP_RelatedTags($format=null, $tagseparator=null, $sortorder=null, $nonfoundtext=null, $limit_qty=null) {
	echo STP_GetRelatedTags($format, $tagseparator, $sortorder, $nonfoundtext, $limit_qty);
}

/*******************************************************************************
* Function:	STP_RelatedTagsRemoveTags / STP_GetRelatedTagsRemoveTags
* Purpose:		For removing tags links
* Input:		...
* Output:		STP_RelatedTagsRemoveTags: Echo
* 				STP_GetRelatedTagsRemoveTags: String
******************************************************************************/ 
function STP_GetRelatedTagsRemoveTags($format=null, $separator=null, $nonfoundtext=null) {
	global $STagging;
	return $STagging->outputRelatedTagsRemoveTags($format, $separator, $nonfoundtext);
}
function STP_RelatedTagsRemoveTags($format=null, $separator=null, $nonfoundtext=null) {
	echo STP_GetRelatedTagsRemoveTags($format, $separator, $nonfoundtext);
}

/*******************************************************************************
* Function:	STP_MetaKeywords
* Purpose:		Outputs the list of meta keywords for the current view
* 				Use this within your site's header, e.g.
* 				<meta name="keywords" content="<X?php STP_MetaKeywords(); ?X>" />
* Input:		...
* Output:		STP_MetaKeywords: Echo
* 				STP_GetMetaKeywords: String
******************************************************************************/
function STP_GetMetaKeywords($before='', $after='', $separator=',', $include_cats=null) {
	global $STagging;
	return $STagging->getMetaKeywords($before, $after, $separator, $include_cats);
}
function STP_MetaKeywords($before='', $after='', $separator=',', $include_cats=null) {
	echo STP_GetMetaKeywords($before, $after, $separator, $include_cats);
}

/*******************************************************************************
* Function:	STP_IsTagView
* Purpose:		Use this to determine if the current view will be returning 
* 				tag search results.
* Input:		...
* Output:		Returns TRUE if a tag search was requested, FALSE otherwise.
******************************************************************************/
function STP_IsTagView() {
	global $STagging;
	return $STagging->is_tag_view();
}

/*******************************************************************************
* Function:	STP_CurrentTagSet
* Purpose:		Outputs the keyword used in a keyword search.  Useful in your 
* 				tags.php page:
* 				<h2>All results for "<X?php STP_CurrentTagSet(); ?X>"</h2>
* Input:		Separator if more than one tag is used
* Output:		STP_CurrentTagSet: Echo
* 				STP_GetCurrentTagSet: String
******************************************************************************/
function STP_GetCurrentTagSet($separator=', ') {
	global $STagging;
	return $STagging->tag_url2name($STagging->search_tag, $separator);
}
function STP_CurrentTagSet($separator=', ') {
	echo STP_GetCurrentTagSet($separator);
}

/*******************************************************************************
* Function:	STP_TagTabs
* Purpose:		Displays a tagtabs
* Input:		...
* Output:		STP_TagTabs: Echo
* 				STP_GetTagTabs: String
******************************************************************************/
function STP_GetTagTabs($linkformat=null, $tagseparator=null, $include_cats=null, $sort_order=null, $display_max=null, $display_min=null, $scale_max=null, $scale_min=null, $notagstext=null, $max_color=null, $min_color=null, $max_size=null, $min_size=null, $unit=null, $limit_days=null, $limit_cat=null, $exclude_cat=null) {
	global $STagging;
	return $STagging->createTagTabs($linkformat, $tagseparator, $include_cats, $sort_order, $display_max, $display_min, $scale_max, $scale_min, $notagstext, $max_color, $min_color, $max_size, $min_size, $unit, $limit_days, $limit_cat, $exclude_cat);
}
function STP_TagTabs($linkformat=null, $tagseparator=null, $include_cats=null, $sort_order=null, $display_max=null, $display_min=null, $scale_max=null, $scale_min=null, $notagstext=null, $max_color=null, $min_color=null, $max_size=null, $min_size=null, $unit=null, $limit_days=null, $limit_cat=null, $exclude_cat=null) {
	echo STP_GetTagTabs($linkformat, $tagseparator, $include_cats, $sort_order, $display_max, $display_min, $scale_max, $scale_min, $notagstext, $max_color, $min_color, $max_size, $min_size, $unit, $limit_days, $limit_cat, $exclude_cat);
}
?>