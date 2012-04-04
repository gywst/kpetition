	<div id="sidebar">
		<ul>
			<?php wp_list_pages('title_li=<h2>עמודים</h2>' ); ?>
			
		<li><h2>לחתימה על העצומה</h2>
			<ul>
			<?php wp_get_archives('type=postbypost&limit=1'); ?>
			</ul>
		</li>
			
			<li><h2>חתימות</h2>
			<ul>
<?php
$numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'");
if (0 < $numposts) $numposts = number_format($numposts); 

$numcomms = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '1'");
if (0 < $numcomms) $numcomms = number_format($numcomms);

$numcats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->categories");
if (0 < $numcats) $numcats = number_format($numcats);
?>
<p><?php printf(__('נאספו %3$s חתימות.'), $numposts, 'edit.php',  $numcomms, 'edit-comments.php', $numcats, 'categories.php'); ?></p>
		</ul>
			</li>
		</ul>
	</div>