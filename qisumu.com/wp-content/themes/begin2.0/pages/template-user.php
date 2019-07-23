<?php
/*
Template Name: 用户中心
*/
?>
<?php if(is_user_logged_in()){?>
<?php get_header(); ?>

<style type="text/css">
#personal {
	background: #fff;
	border: 1px solid #ddd;
	border-radius: 2px;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
}
#personal h3 {
	text-align: center;
	margin: 0 0 20px 15px;
}
.m-personal{
	width: 140px;
	height: 160px;
	text-align: center;
	margin-bottom: 10px;
}
.m-personal .avatar{
	width: 64px;
	height: 64px;
	margin: 0 auto;
	display: block;
}
#personal > ul > li {
	width: 151px;
	height: 40px;
	color: #999;
	line-height: 40px;
	background: #fff;
	display: block;
	text-align: center;
	margin-bottom: 20px;
	position: relative;
	border-right: none;
	cursor: pointer;
}
#personal > ul > li.selected {
	color: #555;
	border: 1px solid #ddd;
	border-right: none;
	border-left: none;
	z-index: 10;
	position: relative;
}
#personal > ul {
	float: left;
	width: 110px;
	text-align: left;
	display: block;
	margin: auto 0;
	padding: 0;
	position: relative;
	top: 30px;
}
#personal > div {
	margin-left: 150px;
	min-height: 500px;
	padding: 12px;
	position: relative;
	border-left: 1px solid #ddd;
	z-index: 9;
	-moz-border-radius: 20px;
}
#personal > div > h4 {
	font-size: 14px;
	margin: 15px 0;
}
thead td {
	font-weight: 700;
	text-align: center;
}
.tc {
	text-align: center;
}
.my-comment li {
	width: 99%;
	line-height: 37px; 
	border-bottom: 1px dashed #dadada;
}
.tou-url {
	width: 149px;
	height: 40px;
	color: #999;
	line-height: 40px;
	display: block;
	text-align: center;
}
.tou-url a {
	color: #999;
}
.tou-url a:hover {
	color: #555;
}
.m-number {
	font-weight: normal;
}
.page-template-template-user table tr:nth-child(even) {
	background: #f9f9f9;
}
.page-template-template-user thead tr:nth-child(odd)  {
	background: #f8f8f8;
	line-height: 35px;
}
</style>

<script type="text/javascript">
    $(function() {
        var $items = $('#personal>ul>li');
        $items.click(function() {
            $items.removeClass('selected');
            $(this).addClass('selected');

            var index = $items.index($(this));
            $('#personal>div').hide().eq(index).fadeIn(200);
        }).eq(0).click();
    });
</script>

 <div id="personal">
    <ul>
         <h3>个人中心</h3>
    	<div class="m-personal">
			<?php global $current_user;	get_currentuserinfo();
				echo get_avatar( $current_user->user_email, 64); 
				echo '' . $current_user->display_name . "\n";
			?><br/>
			<a href="<?php echo wp_logout_url( home_url() ); ?>" title="">退出</a>
			<?php if ( zm_get_option('tou_url') == '' ) { ?>
			<?php } else { ?>
				<div class="tou-url"><a href="<?php echo get_permalink( zm_get_option('tou_url') ); ?>" target="_blank"><i class="fa fa-pencil-square-o"></i> 我要投稿</a></div>
			<?php } ?>
		</div>

        <li class="m-article"><i class="fa fa-file-text-o"></i> 我的文章</li>
        <li class="m-article"><i class="fa fa-comment-o"></i> 我的评论</li>
        <li class="m-article"><i class="fa fa-cog"></i> 个人资料</li>
    </ul>

	<div>
		<h4>我的文章<span class="m-number">（<?php $userinfo=get_userdata(get_current_user_id()); $authorID= $userinfo->id; echo num_of_author_posts($authorID); ?>篇）<span></h4>
		
		<?php get_template_part( 'inc/user/my-post' ); ?>
	</div>
	<div>
		<h4>我的评论</h4>
		<?php get_template_part( 'inc/user/my-comment' ); ?>
	</div>
	<div>
		<h4>个人设置</h4>
		<?php get_template_part( 'inc/user/my-data' ); ?>
	</div>

</div>

<?php get_footer(); ?>
<?php }else{
 wp_redirect( home_url() );
 exit;
}?>