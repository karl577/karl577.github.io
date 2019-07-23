<form method="get" id="searchform" class="search" action="<?php bloginfo('home');?>/">
  <input name="s" type="text"  class="search_text left"  onblur="if(this.value =='')this.value='Keywords';" onfocus="this.value='';" onclick="if(this.value=='Keywords')this.value=''" value="Keywords" />
  <input type="submit" name="button"  value="" class="search_submit right" />
</form>
