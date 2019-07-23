<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
 <script type="text/javascript">
		 $(document).ready(function(){
			  $('#contact').ajaxForm(function(data) {
				 if (data==1){
					 $('#success').fadeIn("slow");
					 $('#bademail').fadeOut("slow");
					 $('#badserver').fadeOut("slow");
					 $('#contact').resetForm();
					 }
				 else if (data==2){
						 $('#badserver').fadeIn("slow");
					  }
				 else if (data==3)
					{
					 $('#bademail').fadeIn("slow");
					}
					});
				 });
		</script>
<!-- begin colLeft -->
	<div id="colLeft">

			<h1>Contact Us</h1>
			<p><?php echo stripslashes(stripslashes(get_option('journal_contact_text')))?></p>
			
			<p id="success" class="successmsg" style="display:none;">已经发送到您的邮箱，请注意查收！</p>

			<p id="bademail" class="errormsg" style="display:none;">请输入请的昵称，一个有效的邮箱.</p>
			<p id="badserver" class="errormsg" style="display:none;">验证邮箱失败，休息会儿再试试.</p>

			<form id="contact" action="<?php bloginfo('template_url'); ?>/sendmail.php" method="post">
			<label for="name">昵称: *</label>
				<input type="text" id="nameinput" name="name" value=""/>
			<label for="email">邮箱: *</label>

				<input type="text" id="emailinput" name="email" value=""/>
			<label for="comment">留点啥: *</label>
				<textarea cols="20" rows="7" id="commentinput" name="comment"></textarea><br />
			<input type="submit" id="submitinput" name="submit" class="submit" value="SEND MESSAGE"/>
			<input type="hidden" id="receiver" name="receiver" value="<?php echo strhex(get_option('journal_contact_email'))?>"/>
			</form>
			
	</div>
	<!-- end colleft -->

			<?php get_sidebar(); ?>	

<?php get_footer(); ?>


