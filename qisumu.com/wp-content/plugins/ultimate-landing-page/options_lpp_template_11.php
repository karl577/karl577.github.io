<?php

   $settings = array('media_buttons'=> false,'lpp_new_empty_template','textarea_rows'=>35);
   wp_editor($lpp_new_empty_template,'lpp_new_empty_template',$settings);

   ?>
   <h2>Advanced Options</h2>
   <br>
   <br>

<label for="lpp_load_wphead">Load wp_head :</label>
<select name="lpp_load_wphead" >
	<option value="no"  <?php selected( "no", $lpp_load_wphead); ?> >Choose</option>
	<option value="no"  <?php selected( "no", $lpp_load_wphead); ?> >Disable</option>
	<option value="yes" <?php selected( "yes", $lpp_load_wphead); ?> >Enable</option>
</select>
<span style="font-size:12px; font-style:italic;">This will load your theme header scripts.</span>

<br>
<br>

<label for="lpp_load_wpfooter">Load wp_footer :</label>
<select name="lpp_load_wpfooter" >
	<option value="no"  <?php selected( "no", $lpp_load_wpfooter); ?> >Choose</option>
	<option value="no"  <?php selected( "no", $lpp_load_wpfooter); ?> >Disable</option>
	<option value="yes" <?php selected( "yes", $lpp_load_wpfooter); ?> >Enable</option>
</select>
<span style="font-size:12px; font-style:italic;">This will load your theme footer scripts.</span>

<br>
<br>
<br>