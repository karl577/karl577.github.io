<?php
/*
* ----------------------------------------------------------------------------------------------------
* Template Name: Contact
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
get_header();
$email_to = theme_get_option('general','email');
?>
<!--Begin Container-->
<div id="container" class="clearfix side-right">

<?php theme_page_banner(); ?>

<div id="container-wrap" class="col-width clearfix">

<!--Begin Content-->
<article id="content">

<div class="post post-single post-contact-page" id="post-<?php the_ID(); ?>">

<?php 
	if (have_posts()) : the_post();  
	$content = get_the_content(); 
?>
<?php if($content) : ?>
	<div class="post-content">
	<?php the_content(); ?>
	</div>
<?php endif; ?>
<?php endif; ?>

<div class="contact-form-wrap">
	<form action='' method='post' id='contact-form'>

	<p id='name-error' class='error'><?php esc_html_e("我不要和陌生人说话。",'HK'); ?></p>
	<dl class="clearfix">
	<dt><?php esc_html_e('昵称','HK'); ?></dt>
	<dd>
	<input type='text' name='name' class="text-file" id='name' />
	</dd>
	</dl>

	<p id='email-error' class='error'><?php esc_html_e("你不希望我回答吗?",'HK'); ?></p>
	<dl class="clearfix">
	<dt><?php esc_html_e('邮箱','HK'); ?></dt>
	<dd>
	<input type='text' name='email' class="text-file" id='email' />
	</dd>
	</dl>

	<p id='subject-error' class='error'><?php esc_html_e("为什么要联系我呢?",'HK'); ?></p>
	<dl class="clearfix">
	<dt><?php esc_html_e('主题','HK'); ?></dt>
	<dd>
	<input type='text' name='subject' class="text-file" id='subject' />
	</dd>
	</dl>

	<p id='message-error' class='error'><?php esc_html_e("忘了你为什么来到这里?",'HK'); ?></p>
	<div class="message">
	<textarea name='message' class='contact-form-content' id='message'></textarea>
	</div>

	<p id='mail-success' class='success'><?php esc_html_e("谢谢你，邮差已经在路上了。",'HK'); ?></p>
	<p id='mail-fail' class='error'><?php esc_html_e("对不起,不知道发生了什么。请稍后再试。",'HK'); ?></p>

	<div id='romove-submit'>
	<input type='submit' id='send-message' value='发送邮件'>
	<input type="hidden" id="email_to" name="email_to" value="<?php echo $email_to; ?>"/>
	</div>

	</form>  
</div>

<?php 
echo '<script type="text/javascript">'."\n";
echo '//<![CDATA['."\n";
echo 'jQuery(document).ready(function(){'."\n";
echo '	jQuery("#send-message").click(function(e){'."\n";
echo '		//stop the form from being submitted'."\n";
echo '		e.preventDefault();'."\n";
echo '		/* declare the variables, var error is the variable that we use on the end'."\n";
echo '            to determine if there was an error or not */'."\n";
echo '		var error = false;'."\n";
echo '		var email_to = jQuery("#email_to").val();'."\n";
echo '		var name = jQuery("#name").val();'."\n";
echo '		var email = jQuery("#email").val();'."\n";
echo '		var subject = jQuery("#subject").val();'."\n";
echo '		var message = jQuery("#message").val();'."\n";
echo '		if(name.length == 0){'."\n";
echo '			var error = true;'."\n";
echo '			jQuery("#name-error").fadeIn(500);'."\n";
echo '		}else{'."\n";
echo '			jQuery("#name-error").fadeOut(500);'."\n";
echo '		}'."\n";
echo '		if(email.length == 0 || email.indexOf("@") == "-1"){'."\n";
echo '			var error = true;'."\n";
echo '			jQuery("#email-error").fadeIn(500);'."\n";
echo '		}else{'."\n";
echo '			jQuery("#email-error").fadeOut(500);'."\n";
echo '		}'."\n";
echo '		if(subject.length == 0){'."\n";
echo '			var error = true;'."\n";
echo '			jQuery("#subject-error").fadeIn(500);'."\n";
echo '		}else{'."\n";
echo '			jQuery("#subject-error").fadeOut(500);'."\n";
echo '		}'."\n";
echo '		if(message.length == 0){'."\n";
echo '			var error = true;'."\n";
echo '			jQuery("#message-error").fadeIn(500);'."\n";
echo '		}else{'."\n";
echo '			jQuery("#message-error").fadeOut(500);'."\n";
echo '		}'."\n";

echo '		//now when the validation is done we check if the error variable is false (no errors)'."\n";
echo '		if(error == false){'."\n";
echo '			jQuery("#send-message").attr({"disabled" : "true", "value" : "Sending..." });'."\n";
			
echo '			jQuery.post("'.WRAPS_URI.'/wrap_send_email.php", jQuery("#contact-form").serialize(),function(result){'."\n";
		
echo '				if(result == "sent"){'."\n";
echo '					//if the mail is sent remove the submit paragraph'."\n";
echo '					 jQuery("#romove-submit").remove();'."\n";
echo '					//and show the mail success div with fadeIn'."\n";
echo '					jQuery("#mail-success").fadeIn(500);'."\n";
echo '				}else{'."\n";
echo '					//show the mail failed div'."\n";
echo '					jQuery("#mail-fail").fadeIn(500);'."\n";
echo '					//reenable the submit button by removing attribute disabled and change the text back to Send The Message'."\n";
echo '					jQuery("#send-message").removeAttr("disabled").attr("value", "Send The Message");'."\n";
echo '				}'."\n";
echo '			});'."\n";
echo '		}'."\n";
echo '	});'."\n";
echo '});'."\n";
echo '//]]>'."\n";
echo '</script>'."\n";
?>
<!--end contact form-->

</div>
<!--end post page-->

</article>
<!--End Content-->

<?php theme_contact_sidebar(); ?> 

</div>
</div>
<!--End Container-->
<?php get_footer(); ?>