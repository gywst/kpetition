<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php query_posts('showposts=1');?>
			<?php if (have_posts()) : ?>
				<?php $first = true; ?>
				<?php while (have_posts()) : the_post(); ?>
					<div class="post<?php if($first == true) echo "" ?>">
				<h2><a href="<?php comments_link(); ?>"><?php the_title(); ?></a></h2>

				<div class="entry">
					<?php the_content('המשך &raquo;'); ?>
				</div>
		
				<p class="postmetadata"><a href="<?php comments_link(); ?>">לחתימה על העצומה</a></p> 
				

	
					<?php $first = false; ?>
	
		<?php endwhile; ?>
		
	<?php else : ?>

		<h2 class="center">לא מצאתי</h2>
		<p class="center">לא מצאתי את מה שחיפשת.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

	<?php
$numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'");
if (0 < $numposts) $numposts = number_format($numposts); 

$numcomms = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '1'");
if (0 < $numcomms) $numcomms = number_format($numcomms);

$numcats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->categories");
if (0 < $numcats) $numcats = number_format($numcats);
?>

<h3 id="comments">החתימות האחרונות - <?php printf(__('נאספו %3$s חתימות.'), $numposts, '',  $numcomms, '', $numcats, ''); ?></h3> 

<?php

if (empty($_GET['mode'])) $mode = 'view';
else $mode = wp_specialchars($_GET['mode'], 1);
?>

<!--  gywst Was Here -->
<?php
if (isset($_GET['s'])) {
	$s = $wpdb->escape($_GET['s']);
	$comments = $wpdb->get_results("SELECT * FROM $wpdb->comments  WHERE
		(comment_author LIKE '%$s%' OR
		comment_author_email LIKE '%$s%' OR
		comment_author_url LIKE ('%$s%') OR
		comment_author_IP LIKE ('%$s%') OR
		comment_content LIKE ('%$s%') ) AND
		comment_approved != 'spam'
		ORDER BY comment_date DESC");
} else {
	if ( isset($_GET['offset']) )
		$offset = (int) $_GET['offset'] * 20;
	else
		$offset = 0;

	$comments = $wpdb->get_results("SELECT comment_author, comment_author_url, comment_ID, comment_post_ID, comment_content FROM $wpdb->comments WHERE comment_approved = '1' ORDER BY comment_date_gmt DESC LIMIT 10");
	$numcomments = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '0'");

}
if ('view' == $mode) {
	if ($comments) {
		if ($offset)
			$start = " start='$offset'";
		else
			$start = '';

		echo "<ul class='commentlist'$start>";
		$i = 0;
		foreach ($comments as $comment) {
		++$i; $class = '';
		$authordata = get_userdata($wpdb->get_var("SELECT post_author FROM $wpdb->posts WHERE ID = $comment->comment_post_ID"));
			$comment_status = wp_get_comment_status($comment->comment_ID);
			if ('unapproved' == $comment_status) 
				$class .= 'unapproved';
			if ($i % 2)
				$class .= 'alt';
			echo "";
			echo "<li id='comment-$comment->comment_ID' class='$class'>";
?>		
       <?php comment_author_link() ?>, <?php comment_excerpt(); ?></li>

<?php } // end foreach ?>
</ul>

<?php
	} else {
?>
<p>
<strong><?php _e('אין חתימות') ?></strong>
</p>
<?php
	} // end if ($comments)
}
	?>
	
	<p class="postmetadata"><strong><a href="<?php comments_link(); ?>">לחתימה על העצומה</a></strong></p> 
		
<?php if ( $numcomments ) : ?>
<p><?php echo sprintf(__('%s חתימות ממתינות לאישור'), number_format($numcomments) ); ?></p>

<?php endif; ?>
</div>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
