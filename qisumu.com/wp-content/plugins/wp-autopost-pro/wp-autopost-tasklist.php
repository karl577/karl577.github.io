<style>
.postbox h3 {
	font-family: Georgia, "Times New Roman", "Bitstream Charter", Times, serif;
	font-size: 15px;
	padding: 10px 10px;
	margin: 0;
	line-height: 1;
}
</style>
<?php 
global $t_ap_config,$t_ap_config_option,$t_ap_config_url_list,$t_ap_updated_record,$t_ap_log,$t_ap_more_content;?>
<?php 
$id = $_REQUEST['id'];
?>

<?php 
$saction = $_REQUEST['saction'];
switch($saction){
 case 'new':
?> 
<div class="wrap">
<div class="icon32" id="icon-wp-autopost"><br/></div>
<h2>Auto Post - New Task</h2>
<form id="myform"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php" > 
<input type="hidden" name="saction" id="saction" value="newConfig">
  <br/> 
  <table> 	   
       <tbody id="the-list">         	  
       <tr> 
		 <td width="10%"><?php echo __('Task Name','wp-autopost'); ?>:</td>
		 <td><input type="text" name="config_name" id="new_config_name" value="" size="60"></td>
	   </tr>
	   <tr> 
		 <td width="10%"><?php echo __('Copy Task','wp-autopost'); ?>:</td>
		 <td>
		 <?php
           $tasks = $wpdb->get_results('SELECT id,name FROM '.$t_ap_config.' ORDER BY id');
	     ?>
		  <select name="copy_task_id" id="copy_task_id">
		    <option value="0"><?php echo __('No'); ?></option>
			<?php foreach($tasks as $task){ ?>
               <option value="<?php echo $task->id; ?>"><?php echo $task->name; ?></option>
			<?php } ?>
		  </select>
		 </td>
	   </tr>
	   </tbody>
  </table>
  <p class="submit"><input type="button" class="button-primary" value="<?php echo __('Submit'); ?>"  onclick="addNew()"/> <a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php" class="button"><?php echo __('Return','wp-autopost'); ?></a></p>
</form>

</div>
<?php break;
 case 'newConfig':
 case 'edit':
 case 'save2':
 case 'save3':
 case 'save4':
 case 'save5':
 case 'testFetch':
 case 'save6':
 case 'save7':
 case 'save8':
 case 'save9':
 case 'save10':
 case 'save11':
 case 'save12':
 case 'save14':
 case 'save15':
 case 'testCookie':
 case 'editSubmit':

 if($saction=='newConfig'){
  $config_name = $_POST['config_name'];
  $copy_task_id = $_POST['copy_task_id'];
  if($copy_task_id==0){
    $wpdb->query("insert into $t_ap_config(name) values ( '$config_name')");
    $id = $wpdb->get_var("SELECT LAST_INSERT_ID()");
    $_REQUEST['p'] = 1;
  }else{
   //$old_task = $wpdb->get_row('SELECT * FROM '.$t_ap_config.' WHERE id ='.$copy_task_id );
   $wpdb->query('insert into '.$t_ap_config.' (name,m_extract,page_charset,content_test_url,a_match_type,title_match_type,content_match_type,page_match_type,a_selector,title_selector,content_selector,page_selector,fecth_paged,same_paged,source_type,start_num,end_num,title_prefix,title_suffix,content_prefix,content_suffix,cat,author,update_interval,published_interval,post_scheduled,download_img,img_insert_attachment,auto_tags,whole_word,tags,use_trans,use_rewrite,reverse_sort,add_source_url,proxy,post_type,post_format,check_duplicate,custom_field,err_status,cookie) select "'.$config_name.'", m_extract,page_charset,content_test_url,a_match_type,title_match_type,content_match_type,page_match_type,a_selector,title_selector,content_selector,page_selector,fecth_paged,same_paged,source_type,start_num,end_num,title_prefix,title_suffix,content_prefix,content_suffix,cat,author,update_interval,published_interval,post_scheduled,download_img,img_insert_attachment,auto_tags,whole_word,tags,use_trans,use_rewrite,reverse_sort,add_source_url,proxy,post_type,post_format,check_duplicate,custom_field,err_status,cookie from '.$t_ap_config.' where id='.$copy_task_id);
   
   $id = $wpdb->get_var("SELECT LAST_INSERT_ID()");

   //_ap_config_url_list
   $wpdb->query('insert into '.$t_ap_config_url_list.' (config_id,url) select '.$id.',url from '.$t_ap_config_url_list.' where config_id='.$copy_task_id );
   
   //_ap_config_option
   $wpdb->query('insert into '.$t_ap_config_option.' (config_id,option_type,para1,para2) select '.$id.',option_type,para1,para2 from '.$t_ap_config_option.' where config_id='.$copy_task_id );

   //_ap_more_content
   $wpdb->query('insert into '.$t_ap_more_content.' (config_id,option_type,content) select '.$id.',option_type,content from '.$t_ap_more_content.' where config_id='.$copy_task_id );
     
   $_REQUEST['p'] = 1;

  }
  echo '<div id="message" class="updated fade"><p>'.__('A new task has been created.','wp-autopost').'</p></div>';
}

 $config = $wpdb->get_row('SELECT * FROM '.$t_ap_config.' WHERE id ='.$id ); 
?>

<div class="wrap">
  <div class="icon32" id="icon-wp-autopost"><br/></div>
  <h2>Auto Post - Setting : <?php echo $config->name; ?><a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php&saction=new" class="add-new-h2"><?php echo __('Add New Task','wp-autopost'); ?></a> </h2>
   <div class="clear"></div>

<br/>
<a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php&p=<?php echo $_REQUEST['p']; ?>" class="button"><?php echo __('Return','wp-autopost'); ?></a> 
&nbsp;<input type="button" class="button-primary"  value="<?php echo __('Test Fetch','wp-autopost'); ?>"    onclick="testFetch()"/>
<br/><br/>

<?php include WPAPPRO_PATH.'/wp-autopost-saction.php'; ?>

<?php

if($saction=='editSubmit'){
   echo $msg;
}

if($_REQUEST['reset_scheduled']==1){
  $wpdb->query("update $t_ap_config  set post_scheduled_last_time=0 where id= ".$id); 

  $showBox1=true;
  $msg = '<div class="updated fade"><p>'.__('Updated!','wp-autopost').'</p></div>';
  echo $msg;
}


?>

<form id="myform"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
 <input type="hidden" name="saction" id="saction" value="">
 <input type="hidden" name="id"  value="<?php echo $id; ?>"> 
 <input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">
</form>


<form id="myform1"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php"> 
<input type="hidden" name="saction" value="editSubmit">
<input type="hidden" id="saction1" name="saction1" value="">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">


<?php $config = $wpdb->get_row('SELECT * FROM '.$t_ap_config.' WHERE id ='.$id ); ?>

<div class="postbox">
  <h3 class="hndle" style="cursor:pointer;"><?php echo __("Basic Settings","wp-autopost"); ?></h3>
  <div class="inside" <?php if(!$showBox1)echo 'style="display:none;"' ?> >
	 <table width="100%"> 	         	  
       <tr> 
		 <td width="18%"><?php echo __('Task Name','wp-autopost'); ?>:</td>
		 <td><input type="text" name="config_name" id="config_name" size="80" value="<?php echo $config->name; ?>"></td>
	   </tr>
       
	   <tr> 
		 <td style="padding:10px 0 10px 0;"><?php echo __('Post Type','wp-autopost'); ?>:</td>
         <td style="padding:10px 0 10px 0;">
		   <?php $custom_post_types = get_post_types( array('_builtin' => false), 'objects'); ?>
		   <input type="radio" name="post_type" value="post" onchange="changePostType()" <?php if($config->post_type=='post') echo 'checked="true"'; ?> /> <?php echo __('Post'); ?>
		   &nbsp;&nbsp;
		   <input type="radio" name="post_type" value="page" onchange="changePostType()" <?php if($config->post_type=='page') echo 'checked="true"'; ?> /> <?php echo __('Page'); ?>
     <?php foreach ( $custom_post_types  as $post_type ) { ?>
		     &nbsp;&nbsp;
		   <input type="radio" name="post_type" value="<?php echo $post_type->name; ?>" onchange="changePostType()" <?php if($config->post_type==$post_type->name) echo 'checked="true"'; ?> /> <?php echo  $post_type->label; ?>
	 <?php } ?>	          
		 </td>
       </tr>

<?php
class Walker_Terms_Checklist extends Walker {
	var $tree_type = 'category';
	var $db_fields = array ('parent' => 'parent', 'id' => 'term_id'); 

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='children'>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		extract($args);
		if ( empty($taxonomy) )
			$taxonomy = 'category';

		if ( $taxonomy == 'category' )
			$name = 'post_category';
		else
			$name = 'post_category';

		$class = in_array( $category->term_id, $popular_cats ) ? ' class="popular-category"' : '';
		$output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" . '<label class="selectit"><input value="' . $category->term_id . '" type="checkbox" name="'.$name.'[]" id="in-'.$taxonomy.'-' . $category->term_id . '"' . checked( in_array( $category->term_id, $selected_cats ), true, false ) . disabled( empty( $args['disabled'] ), false, false ) . ' /> ' . esc_html( apply_filters('the_category', $category->name )) . '</label>';
	}

	function end_el( &$output, $category, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}
?>

<?php if($config->post_type=='post'): ?>
	   <tr> 
		 <td><?php echo __('Taxonomy','wp-autopost');  ?>:</td> 
		 <td>
<?php
          $Walker_Terms_Checklist = new Walker_Terms_Checklist();
	      $selected_cats = explode(',',$config->cat);
	      $taxonomy_names = get_object_taxonomies( 'post','objects');        
		  foreach($taxonomy_names as $taxonomy){
		    if($taxonomy->name=='post_tag' || $taxonomy->name =='post_format')continue;
			$args = array(
	         'descendants_and_self'  => 0,
	         'selected_cats'         => $selected_cats,
	         'popular_cats'          => false,
	         'walker'                => $Walker_Terms_Checklist,
	         'taxonomy'              => $taxonomy->name,
	         'checked_ontop'         => false
            );
		    echo '<ul id="categorychecklist" class="list:category categorychecklist form-no-clear">';	 
			echo '<strong>'.$taxonomy->label.'</strong>';
			wp_terms_checklist( 0, $args );
			echo '</ul>';
		  }
?>
		 </td>
	   </tr>
	   
<?php elseif($config->post_type=='page'): ?>	   
      <tr> 
         <td colspan="2"></td>
	  </tr>
<?php else: ?>
      <tr> 
		 <td><?php echo __('Taxonomy','wp-autopost');  ?>:</td> 
		 <td>
<?php
          $Walker_Terms_Checklist = new Walker_Terms_Checklist();
	      $selected_cats = explode(',',$config->cat);
	      $taxonomy_names = get_object_taxonomies( $config->post_type,'objects');        
		  foreach($taxonomy_names as $taxonomy){
			$args = array(
	         'descendants_and_self'  => 0,
	         'selected_cats'         => $selected_cats,
	         'popular_cats'          => false,
	         'walker'                => $Walker_Terms_Checklist,
	         'taxonomy'              => $taxonomy->name,
	         'checked_ontop'         => false
            );
		    echo '<ul id="categorychecklist" class="list:category categorychecklist form-no-clear">';	 
			echo '<strong>'.$taxonomy->label.'</strong>';
			wp_terms_checklist( 0, $args );
			echo '</ul>';
		  }
?>
		 </td>
	   </tr>
<?php endif; ?>

<?php if ( current_theme_supports( 'post-formats' ) ): ?>

<?php $post_formats = get_theme_support( 'post-formats' );
      if ( is_array( $post_formats[0] ) ) :	 $formatName = get_post_format_strings(); ?>
       <tr>
         <td style="padding:0 0 10px 0;"><?php echo __('Post Format','wp-autopost');  ?>:</td>
         <td style="padding:0 0 10px 0;">
		   <input type="radio" name="post_format" value="" <?php if($config->post_format==''||$config->post_format==null) echo 'checked="true"'; ?> /> <?php echo $formatName['standard']; ?>
    <?php foreach ( $post_formats[0]  as $post_format ) { ?>
		   &nbsp;&nbsp;
		   <input type="radio" name="post_format" value="<?php echo $post_format; ?>" <?php if($config->post_format==$post_format) echo 'checked="true"'; ?> /> <?php echo  $formatName[$post_format]; ?>		   
	 <?php } ?>	   

		 </td>
	   </tr>
      
<?php endif; ?>
   
<?php endif; ?>

	   <tr>
        <td><?php echo __('Author','wp-autopost'); ?>:</td>
        <td>
		<?php
		    $querystr = "SELECT $wpdb->users.ID,$wpdb->users.display_name FROM $wpdb->users";
            $users = $wpdb->get_results($querystr, OBJECT);		   
		?>
         <select name="author" >
		    <option value="0"><?php echo __('Random Author','wp-autopost'); ?></option>
          <?php foreach ($users as $user) { ?> 
		    <option value="<?php echo $user->ID; ?>" <?php if(($user->ID)==($config->author)) echo 'selected' ?> ><?php echo $user->display_name; ?></option>
		  <?php } ?>
		 </select>
		</td> 
	   </tr>
	   <tr>
        <td><?php echo __('Update Interval','wp-autopost'); ?>:</td>
        <td>
		   <input type="text" name="update_interval" id="update_interval" size="2" value="<?php echo $config->update_interval; ?>"> <?php echo __('Minute','wp-autopost'); ?> <span class="gray">( <?php echo __('How long Intervals detect whether there is a new article can be updated','wp-autopost'); ?> )</span>
		</td> 
	   </tr>
	   <tr>
        <td><?php echo __('Published Date Interval','wp-autopost'); ?>:</td>
        <td>
		   <input type="text" name="published_interval" id="published_interval" size="2" value="<?php echo $config->published_interval; ?>"> <?php echo __('Minute','wp-autopost'); ?> <span class="gray">( <?php echo __('The published date interval between each post','wp-autopost'); ?> )</span>
		</td> 
	   </tr>
       
	   <tr>
	   <?php
          $post_scheduled = json_decode($config->post_scheduled);
		  if(!is_array($post_scheduled)){
             $post_scheduled = array();
             $post_scheduled[0] = 0;
             $post_scheduled[1] = 12;
			 $post_scheduled[2] = 0; 
		  }
		?>
        <td><?php echo __('Post Scheduled','wp-autopost'); ?>:</td>
        <td>
		  <select id="post_scheduled" name="post_scheduled">
           <option value="0" <?php if($post_scheduled[0]==0) echo 'selected="true"'; ?>><?php echo __('No'); ?></option>
		   <option value="1" <?php if($post_scheduled[0]==1) echo 'selected="true"'; ?>><?php echo __('Yes'); ?></option>
		  </select>
		  
		</td> 
	   </tr>
       
       <tr>
         <td></td>
		 <td>
           <div id="post_scheduled_more" <?php if($post_scheduled[0]==0)echo 'style="display:none;"' ?> >
	        <table>
              <tr>
                <td><?php echo __('Start Time','wp-autopost'); ?>:</td>
				<td>
				 <input type="text" name="post_scheduled_hour" id="hh" size="2" maxlength="2"  value="<?php echo ($post_scheduled[1]<10)?'0'.$post_scheduled[1]:$post_scheduled[1];?>" />
			     :
                 <input type="text" name="post_scheduled_minute" id="mn" size="2" maxlength="2" value="<?php echo ($post_scheduled[2]<10)?'0'.$post_scheduled[2]:$post_scheduled[2];?>" />
				</td>
			  </tr>
			  <tr>
               <td><?php echo __('Published Date Interval','wp-autopost'); ?>:</td>
			   <td><input type="text" name="published_interval_1" id="published_interval_1" size="3" value="<?php echo $config->published_interval; ?>"> <?php echo __('Minute','wp-autopost'); ?> <span class="gray">( <?php echo __('The published date interval between each post','wp-autopost'); ?> )</span></td> 
			  </tr>
			  
			  <tr>
               <td colspan="2">
			     <?php 
				 if($post_scheduled[0]==1): 
                   $currentTime = current_time('timestamp');
			       
			       
				   if( ($config->post_scheduled_last_time) > 0){
                     $post_scheduled_last_time = $config->post_scheduled_last_time;
					 if($post_scheduled_last_time < $currentTime){
                       $postTime = mktime($post_scheduled[1],$post_scheduled[2],0,date('m',$currentTime),date('d',$currentTime),date('Y',$currentTime)); 
					 }else{
                       $postTime =  $post_scheduled_last_time + $config->published_interval*60 + rand(0,60);  
					 }
					 
			       }else{
					 $postTime = mktime($post_scheduled[1],$post_scheduled[2],0,date('m',$currentTime),date('d',$currentTime),date('Y',$currentTime));
         
				   }
                   
				   if($postTime<$currentTime){
                     $postTime += 86400; // add one day
                   }	
                   
				   echo __('Expected newest publish date','wp-autopost').': <code>'.date('Y-m-d H:i:s',$postTime).'</code>';


				   if( ($config->post_scheduled_last_time) > 0){ ?> 
                   
				   <a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php&saction=edit&id=<?php echo $id;?>&p=<?php echo $_REQUEST['p']; ?>&reset_scheduled=1" ><?php echo __('Reset','wp-autopost'); ?></a>
                 
				 <?php
				   }

                 endif; ?>
			   </td>
			  </tr>

			</table>
			
		   </div>
		 </td>
	   </tr>

       <tr>
        <td style="height:28px;"><?php echo __('Charset','wp-autopost'); ?>:</td>
        <td>
		   <input class="charset" type="radio" name="charset" value="0"  <?php if($config->page_charset=='0') echo 'checked="true"'; ?>> <?php echo __('Automatic Detection','wp-autopost'); ?> 
		   <input class="charset" type="radio" name="charset" value="1"  <?php if($config->page_charset!='0') echo 'checked="true"'; ?>> <?php echo __('Other','wp-autopost'); ?>
		   <span id="ohterSet" <?php if($config->page_charset=='0') echo 'style="display:none;"' ?>><input type="text" name="page_charset" id="page_charset"  value="<?php if($config->page_charset!='0') echo $config->page_charset; ?>"></span>		   
		</td> 
	   </tr>
	   <tr>
	    <?php
          $download_attachs = json_decode($config->download_img);
		  if(!is_array($download_attachs)){
             $download_attachs = array();
             $download_attachs[0] = $config->download_img;
             $download_attachs[1] = 0;  // Download Remote Attachments
		  }
		?>
        <td><?php echo __('Download Remote Images','wp-autopost'); ?>:</td>
        <td>
         <select id="download_img" name="download_img">
           <option value="0" <?php if($download_attachs[0]==0) echo 'selected="true"'; ?>><?php echo __('No'); ?></option>
		   <option value="1" <?php if($download_attachs[0]==1) echo 'selected="true"'; ?>><?php echo __('Yes'); ?></option>
		 </select>
		</td> 
	   </tr>
	   <tr>
         <td></td>
         <td>
         <span id="img_insert_attachment_div" <?php if($download_attachs[0]==0)echo 'style="display:none;"' ?> >
		  <?php
			 $img_insert_attachment = json_decode($config->img_insert_attachment);    
			 if(!is_array($img_insert_attachment)){
		        $img_insert_attachment = array();
				$img_insert_attachment[0] = $config->img_insert_attachment; // insert wordpress lib
				$img_insert_attachment[1] = 0;   // set_featured_image
				$img_insert_attachment[2] = 0;   // set_watermark_image
				$img_insert_attachment[3] = 0;   // attach_insert_attachment  insert wordpress lib
			    //$img_insert_attachment[4] = 0;   // 图片源地址属性 
			 }
		     
		  ?>
		   <p>
		     <div>
			   <input type="radio" name="img_insert_attachment"  value="0" <?php if($img_insert_attachment[0]==0)echo 'checked="true"'; ?> /> <?php echo __('Do not save','wp-autopost'); ?>
			   <br/>
			   <input type="radio" name="img_insert_attachment"  value="1" <?php if($img_insert_attachment[0]==1)echo 'checked="true"'; ?> /> <?php echo __('Save the images to wordpress media library','wp-autopost'); ?>
			   <br/>
			   <input type="radio" name="img_insert_attachment"  value="2" <?php if($img_insert_attachment[0]==2)echo 'checked="true"'; ?> /> <?php echo __('Save the images to Flickr','wp-autopost'); ?> <a title='<?php echo __('Automatically upload images to Flickr (1TB Free Storage), save bandwidth and space, speed up your website.','wp-autopost'); ?>'>[?]</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<a href="admin.php?page=wp-autopost-pro/wp-autopost-flickr.php" target="_blank"><?php echo __('Flickr Options','wp-autopost'); ?></a>)
               <br/>
			   <input type="radio" name="img_insert_attachment"  value="3" <?php if($img_insert_attachment[0]==3)echo 'checked="true"'; ?> /> <?php echo __('Save the images to Qiniu','wp-autopost'); ?> <a title='<?php echo __('Automatically upload images to Qiniu (10GB Free Storage), save bandwidth and space, speed up your website.','wp-autopost'); ?>'>[?]</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<a href="admin.php?page=wp-autopost-pro/wp-autopost-qiniu.php" target="_blank"><?php echo __('Qiniu Options','wp-autopost'); ?></a>)
			   <br/>
			   <input type="radio" name="img_insert_attachment"  value="4" <?php if($img_insert_attachment[0]==4)echo 'checked="true"'; ?> /> <?php echo __('Save the images to Upyun','wp-autopost'); ?> <a title='<?php echo __('Automatically upload images to Upyun, save bandwidth and space, speed up your website.','wp-autopost'); ?>'>[?]</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<a href="admin.php?page=wp-autopost-pro/wp-autopost-upyun.php" target="_blank"><?php echo __('Upyun Options','wp-autopost'); ?></a>)
			   <br/><br/>
			 </div>

			 <input type="checkbox" name="set_watermark_image" id="set_watermark_image" <?php if($img_insert_attachment[2]==1)echo 'checked="true"'; ?> /> <?php echo __('Add a watermark to downloaded images automatically','wp-autopost'); ?> (<a href="admin.php?page=wp-autopost-pro/wp-autopost-watermark.php" target="_blank"><?php echo __('Watermark Options','wp-autopost'); ?></a>)
			 <br/>
			 <br/>
             <?php if($img_insert_attachment[4]==null)$attribute='src';else $attribute = $img_insert_attachment[4]; ?> 
			 <?php echo __('The attribute of image\'s URL','wp-autopost'); ?> : <input type="text" name="img_url_attr" value="<?php echo $attribute; ?>" /> <span class="gray"><?php echo __('Usually is " src "','wp-autopost'); ?></span>
		   </p>
		 </span>
		 </td>
	   </tr>

	   <tr>
        <td><?php echo __('Set Featured Image','wp-autopost'); ?>:</td>
		<td>
         <select id="set_featured_image" name="set_featured_image">
           <option value="0" <?php if($img_insert_attachment[1]==0) echo 'selected="true"'; ?>><?php echo __('No'); ?></option>
		   <option value="1" <?php if($img_insert_attachment[1]>0) echo 'selected="true"'; ?>><?php echo __('Yes'); ?></option>
		 </select>
		 <span id="set_featured_image_div" <?php if($img_insert_attachment[1]==0)echo 'style="display:none;"' ?> >
            <?php echo __('Set images as the featured image automatically','wp-autopost'); ?>
            &nbsp;&nbsp;&nbsp;<?php echo __('Index','wp-autopost'); ?>:<input type="text" size="1" name="set_featured_image_index" value="<?php echo ($img_insert_attachment[1]==0)?'1':$img_insert_attachment[1]; ?>" /><a title='<?php echo __('1:the first image; 2:the second image','wp-autopost'); ?>'>[?]</a>
		 </span>
		</td>
	   </tr>

	   <tr>
         <td><?php echo __('Download Remote Attachments','wp-autopost'); ?>:</td>
         <td>
          <select id="download_attach" name="download_attach">
            <option value="0" <?php if($download_attachs[1]==0) echo 'selected="true"'; ?>><?php echo __('No'); ?></option>
		    <option value="1" <?php if($download_attachs[1]==1) echo 'selected="true"'; ?>><?php echo __('Yes'); ?></option>
		  </select>
		  <span class="download_attach_option" <?php if($download_attachs[1]==0)echo 'style="display:none;"' ?> >
		  (<a href="admin.php?page=wp-autopost-pro/wp-autopost-options.php#RemoteAttachmentDownloadOption" target="_blank"><?php echo __('Remote Attachment Download Option','wp-autopost'); ?></a>)
		 </span>
		 </td>
	   </tr>
	   <tr>
         <td></td>
         <td>
           <span class="download_attach_option" <?php if($download_attachs[1]==0)echo 'style="display:none;"' ?> >
		    <p>
			  <input type="checkbox" name="attach_insert_attachment" id="attach_insert_attachment" <?php if($img_insert_attachment[3]==1)echo 'checked="true"'; ?> /> <?php echo __('Save the attachments to wordpress media library','wp-autopost'); ?>
			</p>      
		   </span>
		 </td>
	   </tr>
       
	   <?php
          $auto_set = json_decode($config->auto_tags);
		  if(!is_array($auto_set)){
             $auto_set = array();
             $auto_set[0] = $config->auto_tags;
             $auto_set[1] = 0; // auto_excerpt
			 $auto_set[2] = 0; // publish_status
             $auto_set[3] = 1; // use_wp_tags
		  }
		?>
	   <tr>
        <td><?php echo __('Auto Tags','wp-autopost'); ?>:</td>
        <td>
         <select id="auto_tags" name="auto_tags">
           <option value="0" <?php if(($auto_set[0])==0) echo 'selected="true"'; ?>><?php echo __('No'); ?></option>
		   <option value="1" <?php if(($auto_set[0])==1) echo 'selected="true"'; ?>><?php echo __('Yes'); ?></option>
		 </select>	 
		</td> 
	   </tr>
	   <tr>
         <td></td>
		 <td>
		  <span id="tags_div" <?php if($auto_set[0]==0)echo 'style="display:none;"' ?> >
		   <p>
           <input type="checkbox" name="use_wp_tags" <?php if($auto_set[3]==1)echo 'checked="true"'; ?> /> <?php echo __('Use Wordpress Tags Library','wp-autopost'); ?>
           <br/><br/>
		   <?php echo __('Tags List','wp-autopost'); ?>: <span class="gray">(<?php echo __('Separated with a comma','wp-autopost'); ?>)</span><br/>
		   <textarea style="width:100%" name="tags" id="tags" ><?php echo $config->tags; ?></textarea>
		   <br/><br/>
		   <input type="checkbox" name="whole_word" id="whole_word" <?php if(($config->whole_word)==1)echo 'checked="true"'; ?> /> <?php echo __('Match Whole Word','wp-autopost'); ?> <span class="gray">(<?php echo __('Autotag only a post when terms finded in the content are a the same name','wp-autopost'); ?>)</span></p>
		 </span></td>
       </tr>
       
	   <tr>
        <td><?php echo __('Auto Excerpt','wp-autopost'); ?>:</td>
        <td>
         <select id="auto_excerpt" name="auto_excerpt">
           <option value="0" <?php if($auto_set[1]==0) echo 'selected="true"'; ?>><?php echo __('No'); ?></option>
		   <option value="1" <?php if($auto_set[1]>0) echo 'selected="true"'; ?>><?php echo __('Yes'); ?></option>
		 </select>
		 <span id="auto_excerpt_div" <?php if($auto_set[1]==0)echo 'style="display:none;"' ?> >
            <?php echo __('Set the paragraph as an excerpt automatically','wp-autopost'); ?>
            &nbsp;&nbsp;&nbsp;<?php echo __('Index','wp-autopost'); ?>:<input type="text" size="1" name="auto_excerpt_index" value="<?php echo ($auto_set[1]==0)?'1':$auto_set[1]; ?>" /><a title='<?php echo __('1:beginning of paragraph 1; 2:beginning of paragraph 2','wp-autopost'); ?>'>[?]</a>
		 </span>
		</td>
	   </tr>

	   <tr>
        <td><?php echo __('Publish Status','wp-autopost'); ?>:</td>
        <td>
         <select id="publish_status" name="publish_status">
           <option value="0" <?php if($auto_set[2]==0) echo 'selected="true"'; ?>><?php echo __('Published'); ?></option>
		   <option value="1" <?php if($auto_set[2]==1) echo 'selected="true"'; ?>><?php echo __('Draft'); ?></option>
		   <option value="2" <?php if($auto_set[2]==2) echo 'selected="true"'; ?>><?php echo __('Pending Review'); ?></option>
		 </select>
		</td>
	   </tr>

	   <tr>
        <td><?php echo __('Manually Selective Extraction','wp-autopost'); ?>:</td>
        <td>
         <select id="manually_extraction" name="manually_extraction">
           <option value="0" <?php if(($config->m_extract)==0) echo 'selected="true"'; ?>><?php echo __('No'); ?></option>
		   <option value="1" <?php if(($config->m_extract)==1) echo 'selected="true"'; ?>><?php echo __('Yes'); ?></option>
		 </select>
		 <a title='<?php echo __('Manually select which article can be posted in your site','wp-autopost'); ?>'>[?]</a>
		</td>
	   </tr>

	   <tr> 
        <td style="padding:10px 0 10px 0;"><?php echo __('Check Extracted Method','wp-autopost'); ?>:</td>
        <td style="padding:10px 0 10px 0;">
          <input type="radio" name="check_duplicate"  value="0" <?php if(($config->check_duplicate)==0)echo 'checked="true"'; ?> /> <?php echo __('URL','wp-autopost'); ?>
          &nbsp;&nbsp;&nbsp;
          <input type="radio" name="check_duplicate"  value="1" <?php if(($config->check_duplicate)==1)echo 'checked="true"'; ?> /> <?php echo __('URL + Title','wp-autopost'); ?>
		</td>
	   </tr>

	   <tr> 
        <td colspan="2"><hr/></td>
	   </tr>
       
	   <?php
         $proxy = json_decode($config->proxy);
	   ?>
	   <tr> 
        <td><?php echo __('Use Proxy','wp-autopost'); ?>:</td>
        <td>
         <select id="use_proxy" name="use_proxy"> 
           <option value="0" <?php if($proxy[0]==0) echo 'selected="true"'; ?>><?php echo __('No'); ?></option>
		   <option value="1" <?php if($proxy[0]==1) echo 'selected="true"'; ?>><?php echo __('Yes'); ?></option>
		 </select>
		</td>
	   </tr>

	   <tr> 
        <td><?php echo __('Hide IP','wp-autopost'); ?>:</td>
        <td>
         <select id="hide_ip" name="hide_ip">
           <option value="0" <?php if($proxy[1]==0) echo 'selected="true"'; ?>><?php echo __('No'); ?></option>
		   <option value="1" <?php if($proxy[1]==1) echo 'selected="true"'; ?>><?php echo __('Yes'); ?></option>
		 </select>
		</td>
	   </tr>


	   <tr> 
        <td colspan="2"><hr/></td>
	   </tr>
       

	   <tr> 
        <td colspan="2"><?php echo __('When extract error set the status to','wp-autopost'); ?>:
         &nbsp;&nbsp;
         <select id="err_status" name="err_status">
           <option value="1" <?php if($config->err_status==1) echo 'selected="true"'; ?>><?php echo __('Not set','wp-autopost'); ?></option>
		   <option value="0" <?php if($config->err_status==0) echo 'selected="true"'; ?>><?php echo __('Pending Extraction','wp-autopost'); ?></option>
		   <option value="-1" <?php if($config->err_status==-1) echo 'selected="true"'; ?>><?php echo __('Ignored','wp-autopost'); ?></option>
		 </select>
		</td>
	   </tr>


	   <tr>
         <td colspan="2">
		   <input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>"    onclick="edit()"/>
		 </td>
	   </tr>
    </table>
  </div>
</div>
<div class="clear"></div>
</form>



<form id="myform2"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save2">
<input type="hidden" name="saction2" id="saction2" value="">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">

<?php $urls = $wpdb->get_results('SELECT * FROM '.$t_ap_config_url_list.' WHERE config_id ='.$id.' ORDER BY id' ); ?>
<div class="postbox">
  <h3 class="hndle" style="cursor:pointer;"><?php echo __('Article Source Settings','wp-autopost'); ?></h3>
  <div class="inside" <?php if(!$showBox2)echo 'style="display:none;"' ?>>
     <table width="100%"> 
	   <tr>
        <td>
		 <input type="hidden" id="source_type" value="<?php echo $config->source_type; ?>" />
		 <input class="source_type" type="radio" name="source_type" value="0" <?php if(($config->source_type)== 0) echo 'checked="true"'; ?> /><?php echo __('Manually specify','wp-autopost'); ?> <b><?php echo __('The URL of Article List','wp-autopost'); ?></b> &nbsp;
		 <input class="source_type" type="radio" name="source_type" value="1" <?php if(($config->source_type)== 1) echo 'checked="true"'; ?> /><?php echo __('Batch generate','wp-autopost'); ?> <b><?php echo __('The URL of Article List','wp-autopost'); ?></b>		 
		</td>
	   </tr>
	   <tr> 
		 <td>	 
		   <div id="urlArea1" <?php if(($config->source_type)!=0) echo 'style="display:none;"'; ?> >
		     <textarea name="urls" id="urls" rows="8" style="width:100%"><?php if(($config->source_type)==0){foreach($urls as $url)echo $url->url."\n"; } ?></textarea>
			 <br/>
			 <span class="gray"><?php echo __('You can add multiple URLs, each URL begin at a new line','wp-autopost'); ?></span>
		   </div>
		
		   <div id="urlArea2" <?php if(($config->source_type)!=1) echo 'style="display:none;"'; ?>>
		     <input type="text" name="url" id="url" style="width:100%" value="<?php if(($config->source_type)==1){foreach($urls as $url)echo $url->url."\n"; } ?>" />
			 <br/>
			 <span class="gray"><?php echo __('For example','wp-autopost'); ?>：http://wp-autopost.org/html/test/list_(*).html</span><br/>
			 (*) <?php echo __('From','wp-autopost'); ?> <input type="text" name="start_num" id="start_num" value="<?php echo $config->start_num; ?>" size="1"> <?php echo __('To','wp-autopost'); ?> <input type="text" name="end_num" id="end_num" value="<?php echo $config->end_num; ?>" size="1">
		   </div>	 
		 </td>
	   </tr>
	   <tr><td></td></tr>
	   <tr>
         <td> <input type="checkbox" name="reverse_sort" id="reverse_sort" <?php if(($config->reverse_sort)==1)echo 'checked="true"'; ?> /> <?php echo __('Reverse the sort of articles','wp-autopost'); ?> <span class="gray">(<?php echo __('Click Test to see the difference','wp-autopost'); ?>)</span> </td>
	   </tr>
     </table>
	 <br/>
	 <h4><?php echo __('Article URL matching rules','wp-autopost'); ?></h4>
      <input type="hidden" id="a_match_type" value="<?php echo $config->a_match_type; ?>" />
	  <input class="a_match_type" type="radio" name="a_match_type" value="0" <?php if(($config->a_match_type)== 0) echo 'checked="true"'; ?> /><?php echo __('Use URL wildcards match pattern','wp-autopost'); ?> 
	  &nbsp;
	  <input class="a_match_type" type="radio" name="a_match_type" value="1" <?php if(($config->a_match_type)== 1) echo 'checked="true"'; ?> /><?php echo __('Use CSS Selector','wp-autopost'); ?> 
	  
	  <div id="a_match_0" <?php if(($config->a_match_type)!=0) echo 'style="display:none;"'; ?> >
	  <?php echo __('Article URL','wp-autopost'); ?>:
	  <input type="text" name="a_selector_0" id="a_selector_0" size="80" value="<?php if(($config->a_match_type)==0){echo $config->a_selector; }?>"><br/>
	  <span class="gray"><?php echo __('The articles URL, (*) is wildcards','wp-autopost'); ?>, <?php echo __('For example','wp-autopost'); ?>: http://www.domain.com/article/(*)/</span>
	  </div>
      
      <div id="a_match_1" <?php if(($config->a_match_type)!=1) echo 'style="display:none;"'; ?> >
	  <?php echo __('The Article URLs CSS Selector','wp-autopost'); ?>:
	  <input type="text" name="a_selector_1" id="a_selector_1" size="80" value="<?php if(($config->a_match_type)==1){echo $config->a_selector; }?>"><br/>
	  <span class="gray"><?php echo __('Must select to the HTML &lta> tag','wp-autopost'); ?>, <?php echo __('For example','wp-autopost'); ?>: #list a</span>
	  </div>
      <br/>
      
	  <div>
	    <?php 
           $add_source_url = json_decode($config->add_source_url);   
		?>
	    <input type="checkbox" name="add_source_url" id="add_source_url" <?php if($add_source_url[0]== 1) echo 'checked="true"'; ?> /> <?php echo __('Add the source URL to custom fields','wp-autopost'); ?>
		<a title='<?php echo __('Add the custom fields to each post, can use the get_post_meta() function get the value.','wp-autopost'); ?>'>[?]</a>

        <div id="source_url_custom_fields" <?php if($add_source_url[0] != 1) echo 'style="display:none;"'; ?> >
		  <?php echo __('Custom Fields'); ?>: <input type="text" name="source_url_custom_fields"  size="30" value="<?php echo $add_source_url[1]; ?>" />
		</div>
      </div>

	  <br/>
	  <h4><?php echo __('Article Filtering','wp-autopost'); ?></h4>

   <?php 
	  $ArticleFilter = $wpdb->get_var('SELECT content FROM '.$t_ap_more_content.' WHERE config_id ='.$id.' AND option_type=1' ); 
	  if($ArticleFilter==null){
        $af[0]=0;
		$af[1]=-1;
		$af[2]='';
	  }else{
	    $af = json_decode($ArticleFilter);
      }
	?>

	  <input type="radio" name="af0" value="0" <?php if($af[0]== 0) echo 'checked="true"'; ?> /> <?php echo __('<strong>Only Extract</strong> when title contains following keywords','wp-autopost'); ?> 
	  &nbsp;
	  <input type="radio" name="af0" value="1" <?php if($af[0]== 1) echo 'checked="true"'; ?> /> <?php echo __('<strong>Do Not Extract</strong> when title contains following keywords','wp-autopost'); ?> 
      <br/>
	  <br/>
      <?php echo __('Keyword List','wp-autopost'); ?>: <span class="gray">(<?php echo __('Separated with a comma','wp-autopost'); ?>)</span><br/>
	  <textarea style="width:100%" name="af2" ><?php echo $af[2]; ?></textarea>
	  <br/><br/>
	  <?php echo __('Filtered article status','wp-autopost'); ?>:&nbsp;
	  <input type="radio" name="af1" value="-1" <?php if($af[1] == -1) echo 'checked="true"'; ?> /> <?php echo __('Ignored','wp-autopost'); ?> 
	  &nbsp;
	  <input type="radio" name="af1" value="0"  <?php if($af[1] == 0) echo 'checked="true"'; ?> /> <?php echo __('Pending Extraction','wp-autopost'); ?> 

	  <br/>
	  <br/>
	  <input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>"  onclick="save2()"/>
	  <input type="button" class="button"  value="<?php echo __('Test','wp-autopost'); ?>"  onclick="test2()"/>

  </div>
</div>
<div class="clear"></div>
</form>

<form id="myform3"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save3">
<input type="hidden" name="saction3" id="saction3" value="">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">

<div class="postbox">
 <h3 class="hndle" style="cursor:pointer;"><?php echo __('Article Extraction Settings','wp-autopost'); ?></h3>
 <div class="inside" <?php if(!$showBox3)echo 'style="display:none;"' ?> >
  <table>
   <tr> 
    <td><strong><?php echo __('The Article Title Matching Rules','wp-autopost'); ?></strong></td>
   </tr>
   <tr> 
    <td>
	  <input type="hidden" id="title_match_type" value="<?php echo $config->title_match_type; ?>" />
	  <input class="title_match_type" type="radio" name="title_match_type" value="0" <?php if(($config->title_match_type)== 0) echo 'checked="true"'; ?> /><?php echo __('Use CSS Selector','wp-autopost'); ?>
	  &nbsp;
	  <input class="title_match_type" type="radio" name="title_match_type" value="1" <?php if(($config->title_match_type)== 1) echo 'checked="true"'; ?> /><?php echo __('Use Wildcards Match Pattern','wp-autopost'); ?> 
	</td>
   </tr>
   <tr> 
    <td>
	  <div id="title_match_0"  <?php if(($config->title_match_type)!=0) echo 'style="display:none;"'; ?>>
        <?php echo __('CSS Selector','wp-autopost'); ?>: 
	    <input type="text" name="title_selector_0" id="title_selector_0" size="40" value="<?php if(($config->title_match_type)== 0) echo htmlspecialchars($config->title_selector); ?>">
	    <span class="gray"><?php echo __('For example','wp-autopost'); ?>: #title h1</span>
	  </div>
	  <div id="title_match_1"  <?php if(($config->title_match_type)!=1) echo 'style="display:none;"'; ?>>
	    <?php echo __('Matching Rule','wp-autopost'); ?>: 
		<input type="text" name="title_selector_1" id="title_selector_1" size="65" value="<?php if(($config->title_match_type)== 1) echo htmlspecialchars($config->title_selector); ?>">
		<br/>	
	    <span class="gray">"<?php echo __('Starting unique HTML(*)End unique HTML','wp-autopost'); ?>"&nbsp;&nbsp;&nbsp;<?php echo __('For example','wp-autopost'); ?>: &lttitle>(*)&lt/title></span>
      </div>
	</td>
   </tr>
  </table>
  <br/>



  <?php
      $content_selector = json_decode($config->content_selector);
      if($content_selector==null){ //Compatible with previous versions
		  $content_selector = array();
		  $content_selector[0] = $config->content_selector;
	  }
      $content_match_types = json_decode($config->content_match_type);
      if(!is_array($content_match_types)){
		  $content_match_type = array();
		  $content_match_type[0] = $config->content_match_type;
		  $outer = array();
		  $outer[0] = 0;
		  $objective = array();
		  $objective[0]=0;
		  $index = array();
          $index[0] = 0;
	  }else{
	    $content_match_type = array();
		$outer = array();
		$objective = array();
		$index = array();
		foreach($content_match_types as $cmts){
          $cmt = explode(',',$cmts);
          $content_match_type[] = $cmt[0];
          $outer[]=$cmt[1];		  
		  if($cmt[2]==NULL||$cmt[2]=='')$objective[]=0;  //Compatible with previous versions
          else $objective[]=$cmt[2];    
		  if($cmt[3]==NULL||$cmt[3]=='')$index[]=0;  //Compatible with previous versions
          else $index[]=$cmt[3];		  
	    }
	  }
  ?>

<script type="text/javascript">


jQuery(document).ready(function($){ 
  
  <?php 
       $cmrNum = count($content_selector);
       for($i=0;$i<$cmrNum;$i++){ ?>  
    $('.content_match_type_<?php echo $i; ?>').change(function(){
	    var sSwitch = $(this).val();
        $("#content_match_type_<?php echo $i; ?>").val(sSwitch);
		if(sSwitch == 0){
           $("#content_match_0_<?php echo $i; ?>").show();
	       $("#content_match_1_<?php echo $i; ?>").hide();
		}else{
           $("#content_match_1_<?php echo $i; ?>").show();
	       $("#content_match_0_<?php echo $i; ?>").hide();
		}
	});
	
	$('#index_<?php echo $i; ?>').click(function(){
	   var s = $('#index_show_<?php echo $i; ?>').val(); 
	   if(s==0){
	     $("#index_num_<?php echo $i; ?>").show();
		 $('#index_show_<?php echo $i; ?>').val('1');
	   }else{
         $("#index_num_<?php echo $i; ?>").hide();
		 $('#index_show_<?php echo $i; ?>').val('0');
	   }
    });
  <?php } ?>

  <?php 
       for($i=1;$i<$cmrNum;$i++){ ?>  
    $('#objective_<?php echo $i; ?>').change(function(){
	    var sSwitch = $(this).val();
		if(sSwitch == -1){
           $("#objective_customfields_<?php echo $i; ?>").show();
		}else{
           $("#objective_customfields_<?php echo $i; ?>").hide();
		}
	});
  <?php } ?>
	 

});
</script>

  <strong><?php echo __('The Article Content Matching Rules','wp-autopost'); ?></strong>
  <table id="cmr" class="autoposttable">
   <tr> 
    <td>
	  <div>
	   <input type="hidden" id="content_match_type_0" value="<?php echo $content_match_type[0]; ?>" />
	   <input class="content_match_type_0" type="radio" name="content_match_type_0" value="0" <?php if($content_match_type[0]== 0) echo 'checked="true"'; ?> /><?php echo __('Use CSS Selector','wp-autopost'); ?> 
	  &nbsp;
	   <input class="content_match_type_0" type="radio" name="content_match_type_0" value="1" <?php if($content_match_type[0]== 1) echo 'checked="true"'; ?> /><?php echo __('Use Wildcards Match Pattern','wp-autopost'); ?>
	   &nbsp;
       <input type="checkbox" name="outer_0" id="outer_0" <?php if($outer[0]==1)echo 'checked="true"'; ?> /> <?php echo __('Contain The Outer HTML Text','wp-autopost'); ?>
	  </div> 
	  <div id="content_match_0_0"  <?php if($content_match_type[0]!=0) echo 'style="display:none;"'; ?>>
        <?php echo __('CSS Selector','wp-autopost'); ?>: 
	    <input type="text" name="content_selector_0_0" id="content_selector_0_0" size="40" value="<?php if($content_match_type[0]==0) echo htmlspecialchars($content_selector[0]); ?>" />     
		<span class="clickBold" id="index_0"><?php echo __('Index','wp-autopost'); ?></span><span id="index_num_0" <?php if($index[0]==0) echo 'style="display:none;"'; ?> >: 
		 <a title='<?php echo __('Default is 0:[extraction all matched content], 1:[extraction first matched content], -1:[extraction last matched content]','wp-autopost'); ?>'>[?]</a>
		 <input type="text" name="index_0" size="1" value="<?php echo $index[0]; ?>" />
		 <input type="hidden" id="index_show_0" value="<?php echo ($index[0]==0)?'0':'1'; ?>" />
		</span>
	    <br/><span class="gray"><?php echo __('For example','wp-autopost'); ?>: #entry</span>
	  </div>
	  <div id="content_match_1_0"  <?php if($content_match_type[0]!=1) echo 'style="display:none;"'; ?>>
	    <?php echo __('Matching Rule','wp-autopost'); ?>: 
	    <input type="text" name="content_selector_1_0" id="content_selector_1_0" size="65" value="<?php if($content_match_type[0]==1) echo htmlspecialchars($content_selector[0]); ?>">	
	    <br/><span class="gray">"<?php echo __('Starting unique HTML(*)End unique HTML','wp-autopost'); ?>"&nbsp;&nbsp;&nbsp;<?php echo __('For example','wp-autopost'); ?>: &ltdiv id="entry">(*)&lt/div>&lt!-- end entry --></span>
      </div>
	</td>
   </tr>
   <?php 
      $cmrNum = count($content_selector);
	  if($cmrNum>1){  
   ?>
<?php  for($i=1;$i<$cmrNum;$i++){ ?>
   
   <tr id="cmr<?php echo $i; ?>"> 
    <td>
	  <div>
	   <input type="hidden" id="content_match_type_<?php echo $i; ?>" value="<?php echo $content_match_type[$i]; ?>" />
	   <input class="content_match_type_<?php echo $i; ?>" type="radio" name="content_match_type_<?php echo $i; ?>" value="0" <?php if($content_match_type[$i]== 0) echo 'checked="true"'; ?> /><?php echo __('Use CSS Selector','wp-autopost'); ?> 
	  &nbsp;
	   <input class="content_match_type_<?php echo $i; ?>" type="radio" name="content_match_type_<?php echo $i; ?>" value="1" <?php if($content_match_type[$i]== 1) echo 'checked="true"'; ?> /><?php echo __('Use Wildcards Match Pattern','wp-autopost'); ?>
	  &nbsp;
       <input type="checkbox" name="outer_<?php echo $i; ?>" id="outer_<?php echo $i; ?>" <?php if($outer[$i]==1)echo 'checked="true"'; ?> /> <?php echo __('Contain The Outer HTML Text','wp-autopost'); ?>
	  </div> 
	  <span id="content_match_0_<?php echo $i; ?>"  <?php if($content_match_type[$i]!=0) echo 'style="display:none;"'; ?>>
        <?php echo __('CSS Selector','wp-autopost'); ?>: 
	    <input type="text" name="content_selector_0_<?php echo $i; ?>" id="content_selector_0_<?php echo $i; ?>" size="40" value="<?php if($content_match_type[$i]==0) echo htmlspecialchars($content_selector[$i]); ?>">
        
		<span class="clickBold" id="index_<?php echo $i; ?>"><?php echo __('Index','wp-autopost'); ?></span><span id="index_num_<?php echo $i; ?>" <?php if($index[$i]==0) echo 'style="display:none;"'; ?> >: 
		 <input type="text" name="index_<?php echo $i; ?>" size="1" value="<?php echo $index[$i]; ?>" />
		 <input type="hidden" id="index_show_<?php echo $i; ?>" value="<?php echo ($index[$i]==0)?'0':'1'; ?>" />
		</span>

	  </span>
	  <span id="content_match_1_<?php echo $i; ?>"  <?php if($content_match_type[$i]!=1) echo 'style="display:none;"'; ?>>
	    <?php echo __('Matching Rule','wp-autopost'); ?>: 
	    <input type="text" name="content_selector_1_<?php echo $i; ?>" id="content_selector_1_<?php echo $i; ?>" size="65" value="<?php if($content_match_type[$i]==1) echo htmlspecialchars($content_selector[$i]); ?>" />
      </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo __('To: ','wp-autopost'); ?>
	  <select name="objective_<?php echo $i; ?>" id="objective_<?php echo $i; ?>">
           <option value="0" <?php selected( 0,$objective[$i] ); ?>><?php echo __('Post Content','wp-autopost'); ?></option>
		   <option value="2" <?php selected( 2,$objective[$i] ); ?>><?php echo __('Post Excerpt','wp-autopost'); ?></option>
		   <option value="3" <?php selected( 3,$objective[$i] ); ?>><?php echo __('Post Tags','wp-autopost'); ?></option>
		   <option value="4" <?php selected( 4,$objective[$i] ); ?>><?php echo __('Featured Image'); ?></option>
		   <option value="1" <?php selected( 1,$objective[$i] ); ?>><?php echo __('Post Date','wp-autopost'); ?></option>
	       <option value="-1" <?php if($objective[$i]!='0'&&$objective[$i]!='1'&&$objective[$i]!='2'&&$objective[$i]!='3'&&$objective[$i]!='4')echo 'selected = "true"'; ?>><?php echo __('Custom Fields'); ?></option>
	  </select>
	  <span>
        <input id="objective_customfields_<?php echo $i; ?>" name="objective_customfields_<?php echo $i; ?>" <?php if($objective[$i]=='0'||$objective[$i]=='1'||$objective[$i]=='2'||$objective[$i]=='3'||$objective[$i]=='4')echo 'style="display:none;"';  ?>  type="text" value="<?php if($objective[$i]!='0'&&$objective[$i]!='1'&&$objective[$i]!='2'&&$objective[$i]!='3'&&$objective[$i]!='4') echo $objective[$i];?>" />
	  </span>
	  <input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowCmr('cmr<?php echo $i; ?>')"/>
	</td>
   </tr>   

<?php  }//end for ?>
<?php }//end if($cmrNum>1) ?>
  </table>


  <a class="button" title="<?php echo __('If you also need to extract content on different areas','wp-autopost'); ?>"  onclick="addMoreMR()"/><?php echo __('Add More Matching Rules','wp-autopost'); ?></a>
  <input type="hidden" name="cmrNum" id="cmrNum"  value="<?php echo $cmrNum-1; ?>" />
  <input type="hidden" name="cmrTRLastIndex" id="cmrTRLastIndex"  value="<?php echo $cmrNum; ?>" />
  
  <br/>
  <br/>
  
  <?php
     $page_selector = json_decode($config->page_selector);
     if($page_selector==null){ //Compatible with previous versions
		$page_selector = array();
		$page_selector[0] = 0;
		$page_selector[1] = $config->page_selector;
	 }
  ?>
  <input type="checkbox" name="fecth_paged" id="fecth_paged" <?php if(($config->fecth_paged)==1)echo 'checked="true"'; ?> /> <?php echo __('Extract The Paginated Content','wp-autopost'); ?> <span class="gray">(<?php echo __('If the article is divided into multiple pages','wp-autopost'); ?>)</span>
  
  <div id="page" <?php if(($config->fecth_paged)==0)echo 'style="display:none;"'; ?> >
  <table>
   <tr><td>  
	 <input class="fecth_paged_type" type="radio" name="fecth_paged_type" value="0" <?php if($page_selector[0]== 0) echo 'checked="true"'; ?> /><?php echo __('Use CSS Selector','wp-autopost'); ?> 
	  &nbsp;
	 <input class="fecth_paged_type" type="radio" name="fecth_paged_type" value="1" <?php if($page_selector[0]== 1) echo 'checked="true"'; ?> /><?php echo __('Use Wildcards Match Pattern','wp-autopost'); ?>

	<div id="page_match_0" <?php if($page_selector[0]!=0) echo 'style="display:none;"'; ?> >
	   <?php echo __('The Article Pagination URLs CSS Selector','wp-autopost'); ?>: <input type="text" name="page_selector_0" id="page_selector_0" size="80" value="<?php if($page_selector[0]==0) echo htmlspecialchars($page_selector[1]); ?>"><br/><span class="gray"><?php echo __('Must select to the HTML &lta> tag','wp-autopost'); ?>, <?php echo __('For example','wp-autopost'); ?>: #page_list a</span>
	</div>

	<div id="page_match_1" <?php if($page_selector[0]!=1) echo 'style="display:none;"'; ?>>
	   <?php echo __('The Article Pagination URLs Matching Rule','wp-autopost'); ?>: <input type="text" name="page_selector_1" id="page_selector_1" size="80" value="<?php if($page_selector[0]==1) echo htmlspecialchars($page_selector[1]); ?>"><br/><span class="gray">"<?php echo __('Starting unique HTML(*)End unique HTML','wp-autopost'); ?>"&nbsp;&nbsp;&nbsp;<?php echo __('For example','wp-autopost'); ?>: &ltdiv id="paged">(*)&lt/div></span>
	</div>
   
   </td></tr>
   <tr><td>
    <input type="checkbox" name="same_paged" id="same_paged" <?php if(($config->same_paged)==1)echo 'checked="true"'; ?> /> <?php echo __('Use the same pagination when published','wp-autopost'); ?>	 
   <td></tr>
  </table>
  </div>
 
  <div><br/><input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>"  onclick="save3()"/>
  <input type="button" class="button"  value="<?php echo __('Test','wp-autopost'); ?>"  onclick="showTest3()"/></div>
  <div id="test3" style="display:none;">
    <?php echo __('Enter the URL of test extraction','wp-autopost'); ?>:<input type="text" name="testUrl" id="testUrl" value="<?php echo $config->content_test_url; ?>" size="100" />
    <input type="button" class="button-primary"  value="<?php echo __('Submit'); ?>"  onclick="test3()"/>
  </div>
 </div>
</div>
<div class="clear"></div>
</form>


<form id="myform15"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save15">
<input type="hidden" name="saction15" id="saction15" value="">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">
<div class="postbox">
  <h3 class="hndle" style="cursor:pointer;"><?php echo __('Site Login Settings','wp-autopost'); ?></h3>
  <div class="inside" <?php if(!$showBox15)echo 'style="display:none;"' ?> >
    
	<p><?php echo __('Extract contents that need to login can view','wp-autopost'); ?></p>
	
	<p>
      <a class='add-new-h2' href='http://wp-autopost.org/zh/manual/how-to-get-cookie/' target='_blank' ><?php echo __('How to get Cookie?','wp-autopost'); ?></a>
	</p>

	<table width="100%"> 	         	  
       <tr> 
		 <td>Cookie:</td>
		 <td>
		   <textarea cols="100" rows="12" name="the_cookie"><?php echo $config->cookie; ?></textarea>
		 </td>
	   </tr>
	</table>
    
	<p>
     <span class="gray"><code>Tips: <?php echo __('Cookie may expire, then need to update the Cookie.','wp-autopost'); ?></code></span>
	</p>
	
    
	<p>
	 <input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>"  onclick="save15()"/>
	 <input type="button" class="button"  value="<?php echo __('Test','wp-autopost'); ?>"  onclick="showTestCookie()"/>
	</p>
	
	<div id="testCookie" style="display:none;" >
      <?php echo __('Enter the URL of test extraction','wp-autopost'); ?>:<input type="text" name="testcCookieUrl" id="testcCookieUrl" value="<?php echo $_POST['testcCookieUrl']; ?>" size="100" />
      <input type="button" class="button-primary"  value="<?php echo __('Submit'); ?>"  onclick="testCookie()"/>
    </div>

  </div>
</div>
</form>


<?php
   $rewrite = json_decode($config->use_rewrite);
   if(!is_array($rewrite)){
      $rewrite = array();
	  $rewrite[0]=0;
   }
?>

<?php
  $MicroTransOptions = get_option('wp-autopost-micro-trans-options');
  if($MicroTransOptions!=null)foreach($MicroTransOptions as $k => $v){ 
	if($v['clientID']!=null&&$v['clientSecret']!=null){
	  $transSetOk=true;
	  break;
	}
  }
?>
<form id="myform5"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save5">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">
<div class="postbox">
  <h3 class="hndle" style="cursor:pointer;"><?php echo __('Rewrite (Spinning)','wp-autopost'); ?></h3>
  <div class="inside" <?php if(!$showBox13)echo 'style="display:none;"' ?> >
    
	<table width="100%"> 	         	  
      <tr> 
	    <td width="16%"><?php echo __('Use Rewriter','wp-autopost'); ?>:</td>
		<td>
		  <select id="use_rewriter" name="use_rewriter" >
            <option value="0" <?php if($rewrite[0]==0) echo 'selected="true"'; ?>><?php echo __('No'); ?></option>
			<option value="1" <?php if($rewrite[0]==1) echo 'selected="true"'; ?>><?php echo __('Microsoft Translator','wp-autopost'); ?></option>
		    <option value="2" <?php if($rewrite[0]==2) echo 'selected="true"'; ?>><?php echo __('WordAi'); ?></option>
			<option value="3" <?php if($rewrite[0]==3) echo 'selected="true"'; ?>><?php echo __('Spin Rewriter'); ?></option>
		  </select>
		</td>
	  </tr>
    </table>

   <div id="MicrosoftTranslator" <?php if($rewrite[0]!=1){?> style="display:none;" <?php } ?> >
<?php
  if(!$transSetOk){ ?>
    <div style="background-color:#ffebe8;border-color:#cc0000;border-style:solid;border-width:1px;padding:10px;">    
	   <?php echo __('To use this feature, please set up correctly in','wp-autopost'); ?>
       <a href="admin.php?page=wp-autopost-pro/wp-autopost-translator.php" > 
	   <?php echo __('Microsoft Translator Options','wp-autopost'); ?>
	  </a>
    </div> 
<?php } ?>
   <p><?php echo __("Use Microsoft Translator can get very unique article, <strong>and is absolutely free</strong>.",'wp-autopost'); ?></p>
   
   <?php
   if($rewrite[0]!=1){
     $rewrite_origi_language = 'en';
     $rewrite_trans_language = 'fr';
   }else{
     $rewrite_origi_language = $rewrite[1];
	 $rewrite_trans_language = $rewrite[2];
   }

   ?>
   
    <table width="100%">
	  <tr> 
	    <td width="16%"><?php echo __('Original Language','wp-autopost'); ?>:</td>
		<td>
		  <select id="rewrite_origi_language" name="rewrite_origi_language" >
            <?php echo autopostMicrosoftTranslator::bulid_lang_options($rewrite_origi_language); ?>
		  </select>
		</td>
	  </tr>

	  <tr> 
	    <td width="16%"><?php echo __('Translate Language','wp-autopost'); ?>:</td>
		<td>
		  <select id="rewrite_trans_language" name="rewrite_trans_language" >
            <?php echo autopostMicrosoftTranslator::bulid_lang_options($rewrite_trans_language); ?>
		  </select>
		</td>
	  </tr>
    </table>

	<table width="100%">
	  <tr>
        <td colspan="2" style="height:36px;"><input type="checkbox" name="rewrite_title_1" <?php if($rewrite[3]==1)echo 'checked="true"'; ?> /> <?php echo __('Also Rewrite The Title','wp-autopost'); ?></td>
	  </tr>
	</table>
    
    <p><?php echo __('Will first translate into','wp-autopost'); ?> <strong><span id="rewrite_trans_language_span"><?php echo autopostMicrosoftTranslator::get_lang_by_code($rewrite_trans_language); ?></span></strong> <?php echo __('and then translated back to','wp-autopost'); ?> <strong><span id="rewrite_origi_language_span"><?php echo autopostMicrosoftTranslator::get_lang_by_code($rewrite_origi_language); ?></span></strong></p>

   </div><!-- end <div id="MicrosoftTranslator" -->


   <div id="WordAi" <?php if($rewrite[0]!=2){?> style="display:none;" <?php } ?> >
    <p><?php echo __("Use WordAi can get unique and readable article.",'wp-autopost'); ?></p>
	<p><?php echo __("Has no <strong>WordAi</strong> account, <a class='add-new-h2' href='http://wp-autopost.org/go/?site=WordAi' target='_blank' >visit WordAi for service</a>",'wp-autopost'); ?></p>
	<table width="100%">
	  <tr> 
	    <td width="16%"><?php echo __('User Email','wp-autopost'); ?>:</td>
		<td>
		  <input type="text" name="wordai_user_email"  value="<?php echo $rewrite[1]; ?>" />
		</td>
	  </tr>
	  <tr> 
	    <td width="16%"><?php echo __('User Password','wp-autopost'); ?>:</td>
		<td>
		  <input type="text" name="wordai_user_password"  value="<?php echo $rewrite[2]; ?>" />
		</td>
	  </tr>
      <tr> 
	    <td width="16%"><?php echo __('Spinner','wp-autopost'); ?>:</td>
		<td>
		  <select name="wordai_spinner" id="wordai_spinner">
            <option value="1" <?php if($rewrite[3]==1) echo 'selected="true"'; ?>><?php echo __('Standard Spinner'); ?></option>
		    <option value="2" <?php if($rewrite[3]==2) echo 'selected="true"'; ?>><?php echo __('Turing Spinner'); ?></option>
		  </select>
		</td>
	  </tr>
	  <tr> 
	    <td width="16%"><?php echo __('Spinning Quality','wp-autopost'); ?>:</td>
		<td>
		   <select name="standard_quality" id="standard_quality" <?php if($rewrite[3]!=1&&$rewrite[3]!=null)echo 'style="display:none;"'; ?> >
			   <option value="0" <?php if($rewrite[4]==0) echo 'selected="true"'; ?> >Extremely Unique</option>
               <option value="25" <?php if($rewrite[4]==25) echo 'selected="true"'; ?>>Very Unique</option>
               <option value="50" <?php if($rewrite[4]==50) echo 'selected="true"'; ?>>Unique</option>
               <option value="75" <?php if($rewrite[4]==75) echo 'selected="true"'; ?>>Regular</option>
               <option value="100" <?php if($rewrite[4]==100||$rewrite[4]==null) echo 'selected="true"'; ?>>Readable</option>
               <option value="150" <?php if($rewrite[4]==150) echo 'selected="true"'; ?>>Very Readable</option>
               <option value="200" <?php if($rewrite[4]==200) echo 'selected="true"'; ?>>Extremely Readable</option>
           </select>

		   <select name="turing_quality" id="turing_quality" <?php if($rewrite[3]!=2)echo 'style="display:none;"'; ?> >
              <option value="Very Unique" <?php if($rewrite[4]=='Very Unique') echo 'selected="true"'; ?> >Very Unique</option>
              <option value="Unique" <?php if($rewrite[4]=='Unique') echo 'selected="true"'; ?>>Unique</option>
			  <option value="Normal" <?php if($rewrite[4]=='Normal') echo 'selected="true"'; ?>>Regular</option>
			  <option value="Readable" <?php if($rewrite[4]=='Readable'||$rewrite[4]==null) echo 'selected="true"'; ?>>Readable</option>
			  <option value="Very Readable" <?php if($rewrite[4]=='Very Readable') echo 'selected="true"'; ?>>Very Readable</option>
		  </select>

		</td>
	  </tr>
      
	  <tr> 
	    <td width="16%"></td>
		<td>
          <select name="standard_nonested" id="standard_nonested" <?php if($rewrite[3]!=1&&$rewrite[3]!=null)echo 'style="display:none;"'; ?>>
            <option value="off" <?php if($rewrite[5]=='off') echo 'selected="true"'; ?>>Automatically Rewrite Sentences (Nested Spintax)</option>
            <option value="on" <?php if($rewrite[5]=='on') echo 'selected="true"'; ?>>Don't Automatically Rewrite Sentences</option>
          </select>

		  <select name="turing_nonested" id="turing_nonested" <?php if($rewrite[3]!=2)echo 'style="display:none;"'; ?>>
            <option value="on" <?php if($rewrite[5]=='on') echo 'selected="true"'; ?>>Automatically Rewrite Sentences (Nested Spintax)</option>
            <option value="off" <?php if($rewrite[5]=='off') echo 'selected="true"'; ?>>Don't Automatically Rewrite Sentences</option>
          </select>
		</td>
      </tr>

	  <tr> 
	    <td width="16%"></td>
		<td>
          <select name="wordai_sentence">
            <option value="on" <?php if($rewrite[6]=='on') echo 'selected="true"'; ?>>Automatically Add/Remove Sentences (Nested Spintax)</option>
            <option value="off" <?php if($rewrite[6]=='off') echo 'selected="true"'; ?>>Don't Automatically Add/Remove Sentences</option>
          </select>
		</td>
      </tr>

	  <tr> 
	    <td width="16%"></td>
		<td>
          <select name="wordai_paragraph">
            <option value="on" <?php if($rewrite[7]=='on') echo 'selected="true"'; ?>>Automatically Spin Paragraphs and Lists (Nested Spintax)</option>
            <option value="off" <?php if($rewrite[7]=='off') echo 'selected="true"'; ?>>Don't Automatically Spin Paragraphs and Lists</option>
          </select>
		</td>
      </tr>
    </table>

	<table width="100%">
	  <tr>
        <td colspan="2" style="height:36px;"><input type="checkbox" name="rewrite_title_2" <?php if($rewrite[8]==1)echo 'checked="true"'; ?> /> <?php echo __('Also Rewrite The Title','wp-autopost'); ?></td>
	  </tr>
	</table>

   </div><!-- end  id="WordAi" -->


   <div id="SpinRewriter" <?php if($rewrite[0]!=3){?> style="display:none;" <?php } ?> >
    <p><?php echo __("Use Spin Rewriter can get unique and readable article.",'wp-autopost'); ?></p>
	<p><?php echo __("Has no <strong>Spin Rewriter</strong> account, <a class='add-new-h2' href='http://wp-autopost.org/go/?site=SpinRewriter' target='_blank' >visit Spin Rewriter for service</a>",'wp-autopost'); ?></p>
	<table width="100%">
	  <tr> 
	    <td width="16%"><?php echo __('User Email','wp-autopost'); ?>:</td>
		<td>
		  <input type="text" name="spin_rewriter_user_email"  value="<?php echo $rewrite[1]; ?>" />
		</td>
	  </tr>
	  <tr> 
	    <td width="16%"><?php echo __('Your Unique API Key','wp-autopost'); ?>:</td>
		<td>
		  <input type="text" name="spin_rewriter_api_key"  value="<?php echo $rewrite[2]; ?>" />
		</td>
	  </tr>
	</table>
    
	<table width="100%">
	  <tr> 
	    <td colspan="2">
		  <input type="checkbox" name="spin_rewriter_auto_sentences" <?php if($rewrite[3]==1)echo 'checked="true"'; ?> /> I want Spin Rewriter to automatically rewrite complete sentences.
		</td>
	  </tr>
	  <tr> 
	    <td colspan="2">
		  <input type="checkbox" name="spin_rewriter_auto_paragraphs" <?php if($rewrite[4]==1)echo 'checked="true"'; ?> /> I want Spin Rewriter to automatically rewrite entire paragraphs.
		</td>
	  </tr>
	  <tr> 
	    <td colspan="2">
		  <input type="checkbox" name="spin_rewriter_auto_new_paragraphs" <?php if($rewrite[5]==1)echo 'checked="true"'; ?> /> I want Spin Rewriter to automatically write additional paragraphs on its own.
		</td>
	  </tr>
	  <tr> 
	    <td colspan="2">
		  <input type="checkbox" name="spin_rewriter_auto_sentence_trees" <?php if($rewrite[6]==1)echo 'checked="true"'; ?> /> I want Spin Rewriter to automatically change the entire structure of phrases and sentences.
		</td>
	  </tr>
	</table>

	<table width="100%">
	  <tr> 
	    <td width="23%">How Adventurous Are You Feeling?</td>
		<td>
		  <select name="spin_rewriter_confidence_level" >
		    <option value="high" <?php if($rewrite[7]=='high') echo 'selected="true"'; ?> >generate as many suggestions as possible (high risk)</option>
			<option value="medium" <?php if($rewrite[7]=='medium'||$rewrite[7]==null) echo 'selected="true"'; ?>>use suggestions that you believe are correct (recommended)</option>
			<option value="low" <?php if($rewrite[7]=='low') echo 'selected="true"'; ?> >only use suggestions that you're really confident about (low risk)</option>
		  </select>
		</td>
	  </tr>

	  <tr> 
	    <td colspan="2">
		  <input type="checkbox" name="spin_rewriter_nested_spintax" <?php if($rewrite[8]==1)echo 'checked="true"'; ?> /> find synonyms for single words inside spun phrases as well (multi-level nested spinning)
		</td>
	  </tr>

	  <tr> 
	    <td colspan="2">
		  <input type="checkbox" name="spin_rewriter_auto_protected_terms" <?php if($rewrite[9]==1)echo 'checked="true"'; ?> /> automatically protect Capitalized Words (except in the title of the article)
		</td>
	  </tr>

	</table>


    
	<table width="100%">
	  <tr>
        <td colspan="2" style="height:36px;"><input type="checkbox" name="rewrite_title_3" <?php if($rewrite[10]==1)echo 'checked="true"'; ?> /> <?php echo __('Also Rewrite The Title','wp-autopost'); ?></td>
	  </tr>
	</table>


   </div> <!-- end  id="SpinRewriter" -->
   

   <p><input type="submit" class="button-primary"  value="<?php echo __('Save Changes'); ?>" /></p>
	
  </div>
</div>


</form>



<form id="myform4"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save4">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">

<div class="postbox">
  <h3 class="hndle" style="cursor:pointer;"><?php echo __('Microsoft Translator','wp-autopost'); ?></h3>
  <div class="inside" <?php if(!$showBox10)echo 'style="display:none;"' ?> >
<?php
  if(!$transSetOk){ ?>
    <div style="background-color:#ffebe8;border-color:#cc0000;border-style:solid;border-width:1px;padding:10px;">    
	   <?php echo __('To use this feature, please set up correctly in','wp-autopost'); ?>
       <a href="admin.php?page=wp-autopost-pro/wp-autopost-translator.php" > 
	   <?php echo __('Microsoft Translator Options','wp-autopost'); ?>
	  </a>
    </div> 
<?php } ?>
<?php
   $use_trans = json_decode($config->use_trans);
   if(!is_array($use_trans)){
      $use_trans = array();
	  $use_trans[0]=0;
	  $use_trans[1]='';
	  $use_trans[2]='';
	  $use_trans[3]=-1;
   }
?>
    <table width="100%"> 	         	  
      <tr> 
	    <td width="16%"><?php echo __('Use Microsoft Translator','wp-autopost'); ?>:</td>
		<td>
		  <select id="use_trans" name="use_trans" >
            <option value="0" <?php if($use_trans[0]==0) echo 'selected="true"'; ?>><?php echo __('No'); ?></option>
		    <option value="1" <?php if($use_trans[0]==1) echo 'selected="true"'; ?>><?php echo __('Yes'); ?></option>
		  </select>
		</td>
	  </tr> 
      <tr> 
	    <td width="16%"><?php echo __('Original Language','wp-autopost'); ?>:</td>
		<td>
		  <select id="from_Language" name="from_Language" >
            <?php echo autopostMicrosoftTranslator::bulid_lang_options($use_trans[1]); ?>
		  </select>
		</td>
	  </tr>

	  <tr> 
	    <td width="16%"><?php echo __('Translated into','wp-autopost'); ?>:</td>
		<td>
		  <select id="to_Language" name="to_Language" >
            <?php echo autopostMicrosoftTranslator::bulid_lang_options($use_trans[2]); ?>
		  </select>
		</td>
	  </tr>

	  <tr> 
	    <td width="16%"><?php echo __('Post Method','wp-autopost'); ?>:</td>
		<td>
		  <select id="post_method" name="post_method" >
            <option value="-1" <?php if($use_trans[3]==-1) echo 'selected="true"'; ?>><?php echo __('Only Post Translated Text','wp-autopost'); ?></option>
		    <option value="1" <?php if($use_trans[3]!=-1) echo 'selected="true"'; ?>><?php echo __('Post Original And Translated Text','wp-autopost'); ?></option>
		  </select>
		</td>
	  </tr>

	  <tr id="translated_cat" <?php if($use_trans[3]==-1) echo 'style="display:none;"'; ?> >
       <td> 
	     <?php echo __('Translated Categories','wp-autopost'); ?>:
       </td>
	   <td>
         <?php $selected_cats = explode(',',$use_trans[3]);   ?>
         <ul id="categorychecklist" class="list:category categorychecklist form-no-clear">
            <?php wp_category_checklist( $post_id, $descendants_and_self, $selected_cats, $popular_cats, $walker, $checked_ontop);?>
         </ul> 
	   </td>
	  </tr>
    </table>
	<p><input type="submit" class="button-primary"  value="<?php echo __('Save Changes'); ?>" /></p>
  </div>
</div>
<div class="clear"></div>
</form>



<?php $options = $wpdb->get_results('SELECT * FROM '.$t_ap_config_option.' WHERE config_id ='.$id.' ORDER BY id' ); ?>

<form id="myform6"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save6">
<input type="hidden" name="saction6" id="saction6" value="save6">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">

<div class="postbox">
  <h3 class="hndle" style="cursor:pointer;"><?php echo __('Article Content Filtering','wp-autopost'); ?></h3>
  <div class="inside" <?php if(!$showBox4)echo 'style="display:none;"' ?> >

	<p><?php echo __('Delete the content selected by CSS Selector','wp-autopost'); ?></p>

	<p><span class="gray">
	 <code><?php echo __('Tips: if <b>Index</b> is <b>0</b> means find all matched element ; <b> 1 </b> means find the first matched element ; <b> -1 </b> means find the last matched element.','wp-autopost'); ?></code>
	 </span>
	</p>
	<table  id="OptionType5" class="tdCenter">
    <thead>
     <th style="width:400px;"><?php echo __('CSS Selector','wp-autopost'); ?></th>
     <th style="width:200px;"><?php echo __('Index','wp-autopost'); ?></th>
     <th style="width:200px;"></th>
    </thead>
    <tbody>
    <?php $num=0; foreach($options as $option){ if(($option->option_type)!=5)continue; $num++; ?>  
     <tr id="type5<?php echo $num; ?>">
      <td><input type="text" name="type5_para1[]" value="<?php echo htmlspecialchars($option->para1); ?>" style="width:100%" /></td> 
	  <td><input type="text" name="type5_para2[]" value="<?php echo htmlspecialchars($option->para2); ?>" size="1" /></td>
	  <td><input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType5('type5<?php echo $num; ?>')"/></td> 
     </tr>
<?php } ?> 
    </tbody>
    </table>
	<p>
    <input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>"    onclick="SaveOption5()"/>
    <input type="button" class="button" value="<?php echo __('Add New','wp-autopost'); ?>"    onclick="AddRowType5()"/>
    <input type="hidden" name="Type5TRLastIndex" id="Type5TRLastIndex"  value="<?php echo $num+1; ?>" />
    </p>
    
	<br/>
 
    <p><?php echo __('Delete the content between the two key words','wp-autopost'); ?> <span class="gray">(<?php echo __('Keyword 2 can be empty, which means that delete everything after the keyword 1','wp-autopost'); ?>)</span></p>
	<table  id="OptionType1" width="100%">
    <thead>
     <th width="40%"><?php echo __('Keyword','wp-autopost'); ?> 1</th>
     <th width="40%"><?php echo __('Keyword','wp-autopost'); ?> 2</th>
     <th width="20%"></th>
    </thead>
    <tbody>
    <?php $num=0; foreach($options as $option){ if(($option->option_type)!=1)continue; $num++; ?>  
     <tr id="type1<?php echo $num; ?>">
      <td><input type="text" name="type1_para1[]" value="<?php echo htmlspecialchars($option->para1); ?>" style="width:100%"></td> 
	  <td><input type="text" name="type1_para2[]" value="<?php echo htmlspecialchars($option->para2); ?>" style="width:100%"></td>
	  <td><input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType1('type1<?php echo $num; ?>')"/></td> 
     </tr>
<?php } ?> 
    </tbody>
    </table>
	<p>
    <input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>"    onclick="SaveOption1()"/>
    <input type="button" class="button" value="<?php echo __('Add New','wp-autopost'); ?>"    onclick="AddRowType1()"/>
    <input type="hidden" name="Type1TRLastIndex" id="Type1TRLastIndex"  value="<?php echo $num+1; ?>" />
	</p>



  </div>
</div>
<div class="clear"></div>
</form>

<form id="myform7"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save7">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">

<div class="postbox">
  <h3 class="hndle" style="cursor:pointer;"><?php echo __('HTML tags Filtering','wp-autopost'); ?></h3>
  <div class="inside"  <?php if(!$showBox5)echo 'style="display:none;"' ?> >
   <p><span class="gray">(<?php echo __('For example','wp-autopost'); ?>, <?php echo __('If you want to filter out html &lta> tag, only need to fill out &nbsp; " a "','wp-autopost'); ?> )</span></p>                             
   <table id="OptionType2" class="tdCenter" >
   <thead>
    <th style="width:200px;"><?php echo __('HTML tag','wp-autopost'); ?></th>
    <th style="width:200px;"><?php echo __('Delete the contents of the HTML tag','wp-autopost'); ?></th>
    <th style="width:200px;"></th>
   </thead>
   <tbody>
   <?php $num=0; foreach($options as $option){ if(($option->option_type)!=2)continue; $num++; ?>  
    <tr id="type2<?php echo $num; ?>">
     <td><input type="text" name="type2_para1[]" value="<?php echo htmlspecialchars($option->para1); ?>"></td> 
	 <td><select name="type2_para2[]" > 
         <option value="0" <?php if($option->para2==0) echo 'selected';?> ><?php echo __('No'); ?></option>
	     <option value="1" <?php if($option->para2==1) echo 'selected';?> ><?php echo __('Yes'); ?></option>
	  </select></td>
	 <td><input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType2('type2<?php echo $num; ?>')"/></td> 
    </tr>
  <?php } ?> 
   </tbody>
   </table>
   <p>
   <input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>"    onclick="SaveOption2()"/>
   <input type="button" class="button" value="<?php echo __('Add New','wp-autopost'); ?>"    onclick="AddRowType2()"/>
   <input type="hidden" name="Type2TRLastIndex" id="Type2TRLastIndex"  value="<?php echo $num+1; ?>" />
   </p>
  </div>
</div>
<div class="clear"></div>
</form>

<form id="myform8"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save8">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">
<div class="postbox">
  <h3 class="hndle" style="cursor:pointer;"><?php echo __('Article Content Keywords Replacement','wp-autopost'); ?></h3>
  <div class="inside" <?php if(!$showBox6)echo 'style="display:none;"' ?> >
   <p><span class="gray">(<?php echo __('For example','wp-autopost'); ?>, <b><?php echo __('Keyword','wp-autopost'); ?></b> : <i>wordpress</i> &nbsp;&nbsp;<b><?php echo __('Replace With','wp-autopost'); ?></b> : <i>&lt;a href="http://wordpress.org/">wordpress&lt;/a></i> )
   <br/><br/>
   <code><?php echo __('Tips: support use variables : ','wp-autopost'); ?> <strong>{post_id}</strong> <strong>{post_title}</strong> <strong>{post_permalink}</strong> <strong>{<?php echo __('custom_field_name','wp-autopost');?>}</strong> </code>
   </span></p>            
   <table id="OptionType3" width="100%">
    <thead>
     <th width="20%"><?php echo __('Keyword','wp-autopost'); ?></th>
     <th width="60%"><?php echo __('Replace With','wp-autopost'); ?></th>
     <th width="20%"></th>
    </thead>
    <tbody>
    <?php $num=0; foreach($options as $option){ if(($option->option_type)!=3)continue; $num++; ?>  
     <tr id="type3<?php echo $num; ?>">
      <td><input type="text" name="type3_para1[]" value="<?php echo htmlspecialchars($option->para1); ?>" style="width:100%"></td> 
	  <td><input type="text" name="type3_para2[]" value="<?php echo htmlspecialchars($option->para2); ?>" style="width:100%"></td>
	  <td><input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType3('type3<?php echo $num; ?>')"/></td> 
     </tr>
    <?php } ?> 
    </tbody>
   </table>
   <p>
   <input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>"    onclick="SaveOption3()"/>
   <input type="button" class="button" value="<?php echo __('Add New','wp-autopost'); ?>"    onclick="AddRowType3()"/>
   <input type="hidden" name="Type3TRLastIndex" id="Type3TRLastIndex"  value="<?php echo $num+1; ?>" />
   </p>
  </div>
</div>
<div class="clear"></div>
</form>

<form id="myform9"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save9">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">
<div class="postbox">
  <h3 class="hndle" style="cursor:pointer;"><?php echo __('Article Title Keywords Replacement','wp-autopost'); ?></h3>
  <div class="inside" <?php if(!$showBox7)echo 'style="display:none;"' ?> >
    <p><span class="gray">(<?php echo __('For example','wp-autopost'); ?>, <b><?php echo __('Keyword','wp-autopost'); ?></b> : <i>Wordpress</i> &nbsp;&nbsp;<b><?php echo __('Replace With','wp-autopost'); ?></b> : <i>WP</i> )</span></p>
	<table  id="OptionType4" width="100%">
    <thead>
     <th width="40%"><?php echo __('Keyword','wp-autopost'); ?></th>
     <th width="40%"><?php echo __('Replace With','wp-autopost'); ?></th>
     <th width="20%"></th>
    </thead>
    <tbody>
    <?php $num=0; foreach($options as $option){ if(($option->option_type)!=4)continue; $num++; ?>  
     <tr id="type4<?php echo $num; ?>">
      <td><input type="text" name="type4_para1[]" value="<?php echo htmlspecialchars($option->para1); ?>" style="width:100%"></td> 
	  <td><input type="text" name="type4_para2[]" value="<?php echo htmlspecialchars($option->para2); ?>" style="width:100%"></td>
	  <td><input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType4('type4<?php echo $num; ?>')"/></td> 
     </tr>
    <?php } ?> 
    </tbody>
   </table>
   <p>
   <input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>"    onclick="SaveOption4()"/>
   <input type="button" class="button" value="<?php echo __('Add New','wp-autopost'); ?>"    onclick="AddRowType4()"/>
   <input type="hidden" name="Type4TRLastIndex" id="Type4TRLastIndex"  value="<?php echo $num+1; ?>" />
   </p>
  </div>
</div>
<div class="clear"></div>
</form>


<form id="myform14"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save14">
<input type="hidden" name="saction14" id="saction14" value="save14">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">

<div class="postbox">
  <h3 class="hndle" style="cursor:pointer;"><?php echo __('Custom Article Style','wp-autopost'); ?></h3>
  
  <?php $customStyles = $wpdb->get_results('SELECT * FROM '.$t_ap_more_content.' WHERE config_id ='.$id.' AND option_type=2 ORDER BY id' ); ?>
  
  <div class="inside" <?php if(!$showBox14)echo 'style="display:none;"' ?> >
   <p><?php echo __('Can add Attribute of CLASS ( or STYLE ) to any HTML Element','wp-autopost'); ?></p>
   
   <p><span class="gray"><?php echo __('For example','wp-autopost'); ?> : <?php echo __('If you want to all images align center, we just need to set the following','wp-autopost'); ?>:<br/>
   <code><b><?php echo __('HTML Element (Use CSS Selector)','wp-autopost'); ?>:</b> img &nbsp;&nbsp;&nbsp;
   <b><?php echo __('Attribute','wp-autopost'); ?>:</b> style &nbsp;&nbsp;&nbsp;
   <b><?php echo __('Value'); ?>:</b> display:block; margin-left:auto; margin-right:auto; </code>
   <br/>
   <?php echo __('Of course, if you konw CSS, you also can use CLASS attribute','wp-autopost'); ?><br/><br/>
   
   <code><?php echo __('Tips: if <b>Index</b> is <b>0</b> means find all matched element ; <b> 1 </b> means find the first matched element ; <b> -1 </b> means find the last matched element.','wp-autopost'); ?></code><br/><br/>

   <code><?php echo __('Tips: if need to remove a attribute, set the value is "null"','wp-autopost'); ?></code><br/><br/>
   
   <code><?php echo __('Tips: support use variables : ','wp-autopost'); ?> <strong>{post_id}</strong> <strong>{post_title}</strong> <strong>{post_permalink}</strong> <strong>{<?php echo __('custom_field_name','wp-autopost');?>}</strong> <strong>[<?php echo __('html_attribute_name','wp-autopost');?>]</strong></code>

   </span>
   </p>

   <table  id="OptionType14"  class="tdCenter"  > <!-- class="autoposttable" -->
    <thead>
     <th style="width:200px;"><?php echo __('HTML Element (Use CSS Selector)','wp-autopost'); ?></th>
	 <th style="width:50px;"><?php echo __('Index','wp-autopost'); ?></th>
     <th style="width:150px;"><?php echo __('Attribute','wp-autopost'); ?></th>
     <th style="width:450px;"><?php echo __('Value'); ?></th>
	 <th style="width:50px;"></th>
    </thead>
	<tbody>
    <?php $num=0; foreach($customStyles as $customStyle){ $num++; ?>
	<?php
          $customStylePara = json_decode($customStyle->content);   
	?>
     <tr id="type14<?php echo $num; ?>">
       <td>
         <input type="text" name="type14_para1[]" value="<?php echo $customStylePara[0]; ?>" >
	   </td>

	   <td>
         <input type="text" name="type14_para2[]" size="1" value="<?php echo $customStylePara[1]; ?>" >
	   </td>

	   <td>
	    <input type="text" name="type14_para3[]" size="8" value="<?php echo $customStylePara[2]; ?>" >

	   </td>
       
	   <td>
	     <input type="text" name="type14_para4[]" size="60" value="<?php echo $customStylePara[3]; ?>" >
	   </td>
       
       <td>
          <input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType14('type14<?php echo $num; ?>')"/>
	   </td>

	 </tr>
    <?php } ?>
    </tbody>  
   </table>
   <p>
   <input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>"    onclick="SaveOption14()"/>
   <input type="button" class="button" value="<?php echo __('Add New','wp-autopost'); ?>"    onclick="AddRowType14()"/>
   <input type="hidden" name="Type14TRLastIndex" id="Type14TRLastIndex"  value="<?php echo $num+1; ?>" />
   </p>

  </div>
</div>

</form>


<form id="myform10"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save10">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">
<div class="postbox">
 <h3 class="hndle" style="cursor:pointer;"><?php echo __('Insert Content In Anywhere','wp-autopost'); ?></h3>

<?php $insertContents = $wpdb->get_results('SELECT * FROM '.$t_ap_more_content.' WHERE config_id ='.$id.' AND option_type=0 ORDER BY id' ); ?>

 <div class="inside" <?php if(!$showBox9)echo 'style="display:none;"' ?> >
  <p><?php echo __('Find the specified HTML Element, then insert content in front of the HTML Element ( or behind it )','wp-autopost'); ?></p> 
  <p><span class="gray"><?php echo __('For example','wp-autopost'); ?> : <?php echo __('If you want to insert some content( like &lt;!-- more --> )  behind the first paragraph, We just need to set the following','wp-autopost'); ?>:<br/>
  <code>
  <b><?php echo __('HTML Element (Use CSS Selector)','wp-autopost'); ?>:</b> p &nbsp;&nbsp;&nbsp;
  <b><?php echo __('Index','wp-autopost'); ?>:</b> 1 &nbsp;&nbsp;&nbsp;
  <b><?php echo __('Behind','wp-autopost'); ?></b></code>
  <br/>
  <code><b><?php echo __('Content','wp-autopost'); ?>:</b> &lt;!-- more --></code><br/><br/>
  <code><?php echo __('Tips: if <b>Index</b> is <b>0</b> means find all matched element ; <b> 1 </b> means find the first matched element ; <b> -1 </b> means find the last matched element.','wp-autopost'); ?></code><br/><br/>

  <code><?php echo __('Tips: support use variables : ','wp-autopost'); ?> <strong>{post_id}</strong> <strong>{post_title}</strong> <strong>{post_permalink}</strong> <strong>{<?php echo __('custom_field_name','wp-autopost');?>}</strong> <strong>[<?php echo __('html_attribute_name','wp-autopost');?>]</strong></code>

  </span></p>
  
  <table  id="OptionType6" width="100%" class="autoposttable">
    <?php $num=0; foreach($insertContents as $insertContent){ $num++; ?>
	<?php
          $insertContentPara = json_decode($insertContent->content);   
	?>
     <tr id="type6<?php echo $num; ?>">
      <td>
	  <?php echo __('HTML Element (Use CSS Selector)','wp-autopost'); ?>:
	  <input type="text" name="type6_para1[]" value="<?php echo $insertContentPara[0]; ?>" >&nbsp;&nbsp;&nbsp;
  
	  <?php echo __('Index','wp-autopost'); ?>:
	  <input type="text" name="type6_para2[]" value="<?php echo $insertContentPara[1]; ?>" size="2">&nbsp;&nbsp;&nbsp;
	  
	  <select name="type6_para3[]" >
	     <option value="0" <?php if($insertContentPara[2]=='0') echo 'selected="true"'; ?> ><?php echo __('Behind','wp-autopost'); ?></option>
		 <option value="1" <?php if($insertContentPara[2]=='1') echo 'selected="true"'; ?> ><?php echo __('Front','wp-autopost'); ?></option>
	  </select>&nbsp;&nbsp;&nbsp;
	  
	  <table>
       <tr>
         <td><?php echo __('Content','wp-autopost'); ?><br/>(<i>HTML</i>):</td>
		 <td><textarea name="type6_para4[]" id="type6_para4[]" cols="102" rows="3"><?php echo htmlspecialchars($insertContentPara[3]); ?></textarea></td>
		 <td>
            <input type="button" class="button"  value="<?php echo __('Delete'); ?>"  onclick="deleteRowType6('type6<?php echo $num; ?>')"/>
		 </td>
	   </tr>
	  </table>

	  </td> 
     </tr>
    <?php } ?> 
  </table>
  <p>
   <input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>"    onclick="SaveOption6()"/>
   <input type="button" class="button" value="<?php echo __('Add New','wp-autopost'); ?>"    onclick="AddRowType6()"/>
   <input type="hidden" name="Type6TRLastIndex" id="Type6TRLastIndex"  value="<?php echo $num+1; ?>" />
  </p>
 </div> 
</div>
</form>

<form id="myform11"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save11">
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">
<div class="postbox">
 <h3 class="hndle" style="cursor:pointer;"><?php echo __('Prefix / Suffix','wp-autopost'); ?></h3>
 <div class="inside" <?php if(!$showBox8)echo 'style="display:none;"' ?> >
  <p><span class="gray">
    <code><?php echo __('Tips: support use variables : ','wp-autopost'); ?> <strong>{post_id}</strong> <strong>{post_title}</strong> <strong>{post_permalink}</strong> <strong>{<?php echo __('custom_field_name','wp-autopost');?>}</strong></code>
  </span></p>
  
  <table>
   <tr>
    <td><b><?php echo __('Article Title Prefix','wp-autopost'); ?>:</b></td>
    <td><input type="text" name="title_prefix" id="title_prefix" value="<?php echo htmlspecialchars($config->title_prefix); ?>" size="100" /> </td>
   </tr>
   <tr>
    <td><b><?php echo __('Article Title Suffix','wp-autopost'); ?>:</b></td>
    <td><input type="text" name="title_suffix" id="title_suffix" value="<?php echo htmlspecialchars($config->title_suffix); ?>" size="100" /> </td>
   </tr>
   <tr>
    <td><b><?php echo __('Article Content Prefix','wp-autopost'); ?>:<br/></b><i>HTML</i></td>
    <td><textarea name="content_prefix" id="content_prefix" cols="100" rows="3"><?php echo htmlspecialchars($config->content_prefix); ?></textarea></td>
   </tr>
   <tr>
    <td><b><?php echo __('Article Content Suffix','wp-autopost'); ?>:<br/></b><i>HTML</i></td>
    <td><textarea name="content_suffix" id="content_suffix" cols="100" rows="3"><?php echo htmlspecialchars($config->content_suffix); ?></textarea></td>
   </tr>
  </table>
  <input type="button" class="button-primary"  value="<?php echo __('Save Changes'); ?>"    onclick="SaveConfigOption()"/>
 </div> 
</div>
</form>


<?php
  $custom_field = json_decode($config->custom_field);
  if(!is_array($custom_field)){

  }
?>

<form id="myform12"  method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
<input type="hidden" name="saction" value="save12">
<input type="hidden" name="saction12" id="saction12" value="">
<input type="hidden" name="custom_field_key" id="custom_field_key" value="">  
<input type="hidden" name="id"  value="<?php echo $id; ?>">
<input type="hidden" name="p"  value="<?php echo $_REQUEST['p']; ?>">
<div class="postbox">
 <h3 class="hndle" style="cursor:pointer;"><?php echo __('Custom Fields'); ?></h3>
 <div class="inside" <?php if(!$showBox12)echo 'style="display:none;"' ?> >
  
  <div id="postcustomstuff">
<?php if($custom_field!=null): ?>    
  <table id="list-table">
	<thead>
	<tr>
		<th class="left"><?php _ex( 'Name', 'meta name' ) ?></th>
		<th><?php _e( 'Value' ) ?></th>
	</tr>
	</thead>
	<tbody id='the-list'>
<?php $i=0; foreach($custom_field as $key => $value){ $i++; ?>
    <tr <?php if($i%2==1) echo 'class="alternate";'?> >
		<td class='left'>
		  <input type='text' size='20' value='<?php echo $key; ?>' />
		  <input type="button" class="button" value="<?php _e( 'Delete' ) ?>" style="width:auto;" onclick="DeleteCustomField('<?php echo $key; ?>')"/>
		</td>
		<td><textarea  rows='2' cols='30'><?php echo $value; ?></textarea></td>
	</tr>
<?php } ?>
    </tbody>
  </table>
<?php endif; ?>
  <p><strong><?php _e( 'Add New Custom Field:' ) ?></strong></p>
  <table id="newmeta">
  <thead>
   <tr>
    <th class="left"><label for="metakeyselect"><?php _ex( 'Name', 'meta name' ) ?></label></th>
    <th><label for="metavalue"><?php _e( 'Value' ) ?></label></th>
   </tr>
  </thead>
  <tbody>
   <tr>
    <td id="newmetaleft" class="left">
      <input type="text" id="metakey" name="metakey" value="" /> 
    </td>
    <td><textarea id="metavalue" name="metavalue" rows="2" cols="25"></textarea></td>
   </tr>
  </tbody>
  <tfoot>
   <tr>
    <td colspan="2">
       <input type="button" class="button" value="<?php echo __('Add Custom Field'); ?>" style="width:auto;" onclick="newCustomField()" />
	</td>
   </tr>
  </tfoot>
  </table>
  </div><!-- end <div id="postcustomstuff"> -->

 </div> 
</div>
</form>




<a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php" class="button"><?php echo __('Return','wp-autopost'); ?></a>
<?php
 break; // end  case 'edit':

 case 'deleteSubmit':
 case 'update':
 case 'updateAll':
 case 'ignore':
 case 'abort':
 case 'changePerPage':
 default:
 
 include WPAPPRO_PATH.'/wp-autopost-saction.php';
?>


<div class="wrap">
  <div class="icon32" id="icon-wp-autopost"><br/></div>
  <h2>Auto Post <a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php&saction=new" class="add-new-h2"><?php echo __('Add New Task','wp-autopost'); ?></a> </h2>
   <div class="clear"></div>
<?php
 if($_GET['activate']!=null){
    $wpdb->query('UPDATE '.$t_ap_config.' SET activation = 1, last_update_time = '.current_time('timestamp').' WHERE id = '.$_GET['activate']);
	echo '<div id="message" class="updated fade"><p>'.__('Task activated.','wp-autopost').'</p></div>'; 
 }
 if($_GET['deactivate']!=null){
    $wpdb->query('UPDATE '.$t_ap_config.' SET activation = 0 WHERE id = '.$_GET['deactivate']);
	echo '<div id="message" class="updated fade"><p>'.__('Task deactivated.','wp-autopost').'</p></div>';
 }
 

 
 if($_GET['createExample']==1){
    createExample();
 }

 if($_POST['bulkAction']!=-1){
  if($_POST['ids']!=null){ 
   if($_POST['bulkAction']=='Activate'){
     foreach($_POST['ids'] as $id){
       $wpdb->query('UPDATE '.$t_ap_config.' SET activation = 1, last_update_time = '.current_time('timestamp').' WHERE id = '.$id);
	 }
	 echo '<div id="message" class="updated fade"><p>'.__('Task activated.','wp-autopost').'</p></div>'; 
   }
   
   elseif($_POST['bulkAction']=='Deactivate'){
     foreach($_POST['ids'] as $id){
       $wpdb->query('UPDATE '.$t_ap_config.' SET activation = 0  WHERE id = '.$id);
	 }
	 echo '<div id="message" class="updated fade"><p>'.__('Task deactivated.','wp-autopost').'</p></div>';

   }

   elseif($_POST['bulkAction']=='Delete'){
    foreach($_POST['ids'] as $id){
      $wpdb->query('delete from '.$t_ap_config.' where id ='.$id);
	  $wpdb->query('delete from '.$t_ap_config_option.' where config_id ='.$id);
	  $wpdb->query('delete from '.$t_ap_config_url_list.' where config_id ='.$id);
      $wpdb->query('delete from '.$t_ap_more_content.' where config_id ='.$id);
	}
   
    echo '<div id="message" class="updated fade"><p>'.__('Deleted!','wp-autopost').'</p></div>';
 
   }
  }
 }


?>

<?php
$expiration = get_option('wp_autopost_admin_expiration')+604800;
if(current_time('timestamp')>$expiration){
  $querystr = "SELECT $wpdb->users.ID,$wpdb->users.display_name FROM $wpdb->users";
  $users = $wpdb->get_results($querystr, OBJECT);		   
  foreach($users as $user){
    $capabilities= get_user_meta($user->ID, 'wp_capabilities', true);
    if($capabilities['administrator']==1){
      update_option('wp_autopost_admin_id',$user->ID);
	  break;
	}
  }
  update_option('wp_autopost_admin_expiration',current_time('timestamp'));
}
?>

<?php
 //检测如果都没有任务在运行，重置 update_option('wp_autopost_runOnlyOneTaskIsRunning', 0);
 $isTaskRunning = $wpdb->get_var('select max(is_running) from '.$t_ap_config.' where activation = 1');
 if($isTaskRunning==null||$isTaskRunning==0){
   update_option('wp_autopost_runOnlyOneTaskIsRunning', 0);
 }
?>

<?php
if( ini_get('safe_mode') ){ ?>
<div class="error">
 <p><strong>
 <?php 
   if(get_bloginfo('language')=='zh-CN'): 
     echo '请关闭PHP安全模式，在 php.ini 配置文件里设置 safe_mode = Off，否则你的服务器只允许 php 脚本的最大执行时间为 '.ini_get('max_execution_time').' 秒，可能会影响该插件的正常使用'; 
   else:
     echo 'Please turn off the PHP safe mode( Change the line "safe_mode=on" to "safe_mode=off" in php.ini ), otherwise, your server will only allow a maximum php script execution time is '.ini_get('max_execution_time').' seconds, may affect the normal use of the plugin.'; 
   endif;
  ?>
 </strong></p>
</div>
<?php } ?>

<?php
if(!function_exists('curl_init')) { ?>
<div class="error">
 <p><strong>
 <?php 
   if(get_bloginfo('language')=='zh-CN'): 
     echo 'cURL扩展未开启，部分功能特性可能会受影响'; 
   else:
     echo 'cURL extension is not enable, some features may be affected'; 
   endif;
  ?>
 </strong></p>
</div>
<?php } ?>

<?php
  $tasks = $wpdb->get_results('SELECT id,last_update_time,update_interval,is_running FROM '.$t_ap_config);  
  foreach($tasks as $task){
	if(($task->is_running)==1 && current_time('timestamp')>(($task->last_update_time)+(15)*60)){
       $wpdb->query('update '.$t_ap_config.' set is_running = 0 where id='.$task->id);
	}
  }
?>

 <?php
  $AllNum = $wpdb->get_var('SELECT count(*) FROM '.$t_ap_updated_record);
  $PublishedNum = $wpdb->get_var('SELECT count(*) FROM '.$t_ap_updated_record.' WHERE url_status = 1');
  $PendingNum = $wpdb->get_var('SELECT count(*) FROM '.$t_ap_updated_record.' WHERE url_status = 0');
  $IgnoredNum = $wpdb->get_var('SELECT count(*) FROM '.$t_ap_updated_record.' WHERE url_status = -1');
  $duplicateIds = get_option('wp-autopost-duplicate-ids');
  if($duplicateIds!=''&&$duplicateIds!=null){
     $queryIds = '';
     if($duplicateIds!=''&&$duplicateIds!=null){
       foreach($duplicateIds  as $id ){ $queryIds .= $id.',';}
       $queryIds=substr($queryIds, 0, -1);
     }else{ $queryIds = 0; }
    $DuplicateNum = $wpdb->get_var('SELECT count(*) FROM '.$t_ap_updated_record.' WHERE id in ('.$queryIds.')');
  }
 ?>
 <ul class='subsubsub'>
    <li><a class="current"><?php echo __('Posts'); ?></a> :</li>

	<li><a href="admin.php?page=wp-autopost-pro/wp-autopost-updatedpost.php" ><?php echo __('All'); ?> <span class="count">(<?php echo number_format($AllNum);?>)</span></a> |</li>

	<li><a href="admin.php?page=wp-autopost-pro/wp-autopost-updatedpost.php&url_status=1" ><?php echo __('Published'); ?> <span class="count">(<?php echo number_format($PublishedNum);?>)</span></a> |</li>

	<li><a href="admin.php?page=wp-autopost-pro/wp-autopost-updatedpost.php&url_status=0" ><?php echo __('Pending Extraction','wp-autopost'); ?> <span class="count">(<?php echo number_format($PendingNum);?>)</span></a> |</li>

	<li><a href="admin.php?page=wp-autopost-pro/wp-autopost-updatedpost.php&url_status=-1" ><?php echo __('Ignored','wp-autopost'); ?> <span class="count">(<?php echo number_format($IgnoredNum);?>)</span></a> |</li>

	<li><a href="admin.php?page=wp-autopost-pro/wp-autopost-updatedpost.php&duplicate=show"><?php echo __('Duplicate Posts','wp-autopost'); ?><?php if($DuplicateNum>0){ ?> <span class="count">(<?php echo number_format($DuplicateNum);?>)</span><?php } ?></a></li>
 </ul>

<form id="myform" method="post" action="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php">
  <input type="hidden" name="saction" id="saction" value="" />
  <input type="hidden" name="configId" id="configId" value="" />
     

	 <div class="tablenav">
       <div class="alignleft actions">
         <select name="bulkAction" id="bulkAction">
           <option value="-1" selected="selected"><?php echo __('Bulk Actions'); ?></option>
		   <option value="Activate"><?php echo __('Activate'); ?></option>
	       <option value="Deactivate"><?php echo __('Deactivate'); ?></option>
		   <option value="Delete"><?php echo __('Delete'); ?></option>
		 </select>
		 <input type="submit"  class="button action" value="<?php echo __('Apply'); ?>"  />
	   </div>

	   <div class="alignright">
           <input type="button" class="button-primary" value=" <?php echo __('Update All','wp-autopost'); ?> "  onclick="updateAll()"/>
	   </div>

     </div>

     <table class="widefat plugins"  style="margin-top:4px"> 
	   <thead>
	   <tr>
	    <th scope="col" id='cb' class='manage-column column-cb check-column'><input type="checkbox" name="All" id="checkAll" ></th>
	
	    <th scope="col" style="text-align:center"><?php echo __('Task Name','wp-autopost'); ?></th>
		<th scope="col" style="text-align:center"><?php echo __('Log','wp-autopost'); ?></th>
		<th scope="col" style="text-align:center"><?php echo __('Updated Articles','wp-autopost'); ?></th>
		<th scope="col" style="text-align:center"></th>
	   </tr>
	   </thead>   
       <tbody id="the-list">         
<?php 
if(!isset($_REQUEST['p'])){ 
  $page = 1; 
} else { 
  $page = $_REQUEST['p']; 
}
$wp_autopost_per_page = get_option('wp_autopost_per_page');
if($wp_autopost_per_page['task']==null) $perPage=7;
else $perPage=$wp_autopost_per_page['task'];

// Figure out the limit for the query based on the current page number. 
$from = (($page * $perPage) - $perPage);
$total = $wpdb->get_var('SELECT count(*) FROM '.$t_ap_config);
$total_pages = ceil($total / $perPage);
$configs = $wpdb->get_results('SELECT * FROM '.$t_ap_config.' ORDER BY id LIMIT '.$from.','.$perPage); 
?>   	   
<?php  
      foreach ($configs as $config) { 
	    $errCode = checkCanUpdate($config);
?>
       <tr style="text-align:center"  <?php if(($config->activation)==0){ ?> class="inactive" <?php }else{ ?> class="active"  <?php  } ?>> 
		 <th scope='row' class='check-column'> <input type="checkbox" name="ids[]" value="<?php echo $config->id; ?>" class="checkrow" /> </th>
	
		 <td>
		   <strong><?php echo $config->name; ?></strong>
		   <div class="row-actions-visible">
		  <?php if(($config->activation)==0){ ?>
		     <a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php&activate=<?php echo $config->id; ?>&p=<?php echo $page; ?>"><?php echo __('Activate'); ?></a>
		  <?php }else{ ?>
             <a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php&deactivate=<?php echo $config->id; ?>&p=<?php echo $page; ?>"><?php echo __('Deactivate'); ?></a>
		  <?php } ?>					    
			| <a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php&saction=edit&id=<?php echo $config->id; ?>&p=<?php echo $page; ?>" title="Setting"><?php echo __('Setting','wp-autopost'); ?></a> | 
			<span class="trash"><a class="submitdelete" title="delete" href="javascript:;" onclick="Delete(<?php echo $config->id; ?>)" ><?php echo __('Delete'); ?></a></span>
		   </div>
		 </td>
		 <td>   
      
	  <?php if($errCode==1){ ?>
	    <?php if($config->last_update_time>0){ ?>		 
		 <?php echo __('Last detected','wp-autopost'); ?> <b><?php echo maktimes($config->last_update_time); ?></b>, <?php echo __('Expected next detect','wp-autopost'); ?> <b><?php echo maktimes($config->last_update_time+$config->update_interval*60); ?></b>
		 
		 <?php if(($config->m_extract)==1){
                 $PendingNum = $wpdb->get_var('SELECT count(*) FROM '.$t_ap_updated_record.' WHERE url_status = 0 AND config_id='.$config->id);

				 echo '<br/>'.__('Manually Selective Extraction','wp-autopost').': <a href="'.$_SERVER['PHP_SELF'].'?page=wp-autopost-pro/wp-autopost-updatedpost.php&taskId='.$config->id.'&url_status=0"><b>'.$PendingNum.'</b> '.__('Posts Pending Extraction','wp-autopost').'</a>';
		       
			   }else{
                 if(($config->post_id)>0){
					echo '<br/>'.__('Recently updated articles','wp-autopost').': <b><a href="'.get_permalink($config->post_id).'" target="_blank">'.get_the_title($config->post_id).'</a></b>';  
				 }
			   }  
         ?>

	    <?php }else{ ?>
           <b><?php echo __('Has not updated any post','wp-autopost'); ?></b>
		<?php } ?>

	  <?php }else{ ?>
	   <?php foreach($errCode as $c){    
               if($c==-1){ echo '<span class="red"><b>'.__('[Article Source URL] is not set yet','wp-autopost').'</b></span>'; break; }
			   if($c==-2){ echo '<span class="red"><b>'.__('[The Article URL matching rules] is not set yet','wp-autopost').'</b></span>'; break; }
			   if($c==-3){ echo '<span class="red"><b>'.__('[The Article Title Matching Rules] is not set yet','wp-autopost').'</b></span>'; break; }
			   if($c==-4){ echo '<span class="red"><b>'.__('[The Article Content Matching Rules] is not set yet','wp-autopost').'</b></span>'; break; }  
		     } ?>
	  <?php } ?>


      <?php if(($config->last_error)>0){ ?>
         <br/><b><?php echo __('An error occurred','wp-autopost'); ?></b>: <span class="trash"><a href="admin.php?page=wp-autopost-pro/wp-autopost-logs.php&taskId=<?php echo $config->id ?>&logId=<?php echo $config->last_error; ?>"><b><?php echo $wpdb->get_var('SELECT info FROM '.$t_ap_log.' WHERE id='.$config->last_error); ?></b></a></span> [<a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php&saction=ignore&id=<?php echo $config->id; ?>&p=<?php echo $page; ?>"><?php echo __('Ignore','wp-autopost'); ?></a>]
	  <?php } ?>
		 </td>

		 <td>
		   <a href="admin.php?page=wp-autopost-pro/wp-autopost-updatedpost.php&taskId=<?php echo $config->id; ?>&url_status=1"><?php echo $config->updated_num; ?></a>
		 </td>
		 <td>
		<?php if(($config->is_running)==1){ ?>
		  <?php echo __('Is running','wp-autopost'); ?> <img src="<?php echo $wp_autopost_root; ?>images/running.gif" width="15" height="15" style="vertical-align:text-bottom;" />
		  <div class="row-actions-visible">
            <a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php&saction=abort&id=<?php echo $config->id; ?>"><?php echo __('Abort','wp-autopost'); ?></a>	
		  </div>
		<?php }elseif(($config->activation)==1){ ?>
		  <a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php&saction=update&id=<?php echo $config->id; ?>"><?php echo __('Update Now','wp-autopost'); ?></a>
		<?php }else{ ?>
           <?php echo  __('Task deactivated.','wp-autopost'); ?>
		<?php } ?>
		 </td>
       </tr>
 <?php } // end foreach ($systemConfigs as $systemConfig) { ?>
	   </tbody>
	   <tfoot>
<?php if($configs!=null): ?>  

<?php else: ?>
        <tr style="text-align:center">
		  <td colspan="5">
		    <strong><?php echo  __('Please add new task.','wp-autopost'); ?></strong>
		    <strong><a href="admin.php?page=wp-autopost-pro/wp-autopost-tasklist.php&createExample=1"><?php echo  __('Or Create an &lt;Example Task> to quick start.','wp-autopost'); ?></a></strong>
		  </td>
		</tr>
<?php endif; ?>  
       </tfoot>
	 </table>
	 <div class="tablenav">
	  <div class="actions alignleft">
        <?php echo  __('Number per page','wp-autopost'); ?> : <input type="text" name="taskPerPage" value="<?php echo $perPage; ?>" size="1" onchange="changePerPage()"/>
	  </div>
      <div class="tablenav-pages alignright">
	   <?php
					if ($total_pages>1) {						
						$arr_params = array (
						  'page' => 'wp-autopost-pro/wp-autopost-tasklist.php',  
						  'p' => "%#%"
						);
						$query_page = add_query_arg( $arr_params , $query_page );				
						echo paginate_links( array(
							'base' => $query_page,
							'prev_text' => __('&laquo; Previous'),
							'next_text' => __('Next &raquo;'),
							'total' => $total_pages,
							'current' => $page,
							'end_size' => 1,
							'mid_size' => 5,
						));
					}
		?>	
       </div> 
	</div>
  </form>
</div>

<?php 
}// end switch($saction){

function createExample(){
  
  global $wpdb,$t_ap_config,$t_ap_config_url_list;
  
  $num = $wpdb->get_var("SELECT count(*) FROM $t_ap_config");
  if($num>0)return;

  if(get_bloginfo('language')=='zh-CN'||get_bloginfo('language')=='zh-TW'):   
    $name = '示例任务-作为参考以快速掌握该插件的使用';
	$page_charset = '0';
	$a_selector = '.contList  a';
    $title_selector = '#artibodyTitle';
    $content_selector = '["#artibody"]';
    $a_match_type = 1;
	$title_match_type = 0;
    $content_match_type = '["0,0"]';
	$url = 'http://roll.tech.sina.com.cn/internet_worldlist/index_1.shtml';
  else:
    $name = 'Example Task - As a reference, you can quickly master use of this plugin';
	$page_charset = '0';
	$a_selector = 'http://www.engadget.com/(*)/(*)/(*)/(*)/';
    $title_selector = 'title';
    $content_selector = '[".post-body"]';
    $a_match_type = 0;
	$title_match_type = 0;
    $content_match_type = '["0,0"]';
	$url = 'http://www.engadget.com/';  
  endif;
    
  $wpdb->query($wpdb->prepare("insert into $t_ap_config(name,page_charset,a_selector,title_selector,content_selector,a_match_type,title_match_type,content_match_type) values (%s,%s,%s,%s,%s,%d,%d,%s)",$name,$page_charset,$a_selector,$title_selector,$content_selector,$a_match_type,$title_match_type,$content_match_type));

  $configId = $wpdb->get_var("SELECT LAST_INSERT_ID()");

  $wpdb->query($wpdb->prepare("insert into $t_ap_config_url_list(config_id,url) values (%d,%s)",$configId,$url));

  echo '<div id="message" class="updated fade"><p>'.__('An Example Task has been created. As a reference, you can quickly master use of this plugin.','wp-autopost').'</p></div>';

}
function checkCanUpdate($config){
  global $wpdb,$t_ap_config_url_list;
  $urls = $wpdb->get_var('SELECT count(*) FROM '.$t_ap_config_url_list.' WHERE config_id ='.$config->id );
  $i=0;
  if($urls==0){ $errCode[$i++]= -1;}
  if(trim($config->a_selector)==''){$errCode[$i++]= -2;}
  if(trim($config->title_selector)==''){$errCode[$i++]= -3;}
  if(trim($config->content_selector)==''){$errCode[$i++]= -4;}
  if($i>0)return $errCode;
  else return 1;
}

function maktimes($time){
 $now = current_time('timestamp');
 if($now >= $time){$t=$now-$time; $s=__(' ago','wp-autopost'); }
 else { $t=$time-$now; $s=__(' after','wp-autopost'); }
 if($t==0)$t=1;
 $f=array(
   '31536000'=> __(' years','wp-autopost'),
   '2592000' => __(' months','wp-autopost'),
   '604800'  => __(' weeks','wp-autopost'),
   '86400'   => __(' days','wp-autopost'),
   '3600'    => __(' hours','wp-autopost'),
   '60'      => __(' minutes','wp-autopost'),
   '1'       => __(' seconds','wp-autopost')
 );
 foreach ($f as $k=>$v){        
  if (0 !=$c=floor($t/(int)$k)){
    return $c.$v.$s;
  }
 }
}
?>
<?php
include WPAPPRO_PATH.'/wp-autopost-js.php';
?>