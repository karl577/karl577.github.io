<?php get_header();?>

<div class="row-fluid">
  <div id="main" class="span8 image-preloader">
    <div id="home-slider" class="home-slider2">
      <div class="flexslider loading">
        <ul class="slides">
          <?php 
			   	    $new = get_option('new');
			   	    $a='0';$b='1';$c='2';$d='3';//$a标题;$b描述;$c链接;$d图片
			   	    for ($i=1; $i <=4 ; $i++) { 
			   	?>
          <li> <img title="<?php echo $new[$a]?>" alt="<?php echo $new[$a]?>" src="<?php echo $new[$d]?>" />
            <div class="content">
              <div class="header">
                <h3><a href="<?php echo $new[$c]?>"><?php echo $new[$a]?></a></h3>
              </div>
              <p><?php echo $new[$b]?> [..]</p>
              <a href="<?php echo $new[$c]?>" class="btn btn-small">Read More</a> </div>
          </li>
          <?php $a+=4;$b+=4;$c+=4;$d+=4; }?>
        </ul>
      </div>
    </div>
    <?php 
	    $display = get_option('display_model');
        if($display['0']=='blog'){
        	include('inc/blog.php');
        }else{
        	include('inc/cms.php');
        }
	 ?>
  </div>
  <?php get_sidebar(); ?>
</div>
</div>
<?php get_footer(); ?>
