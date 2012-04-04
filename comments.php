<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		bail ("<strong>בעיה</strong>: נא לא להכנס לעמוד הזה ישירות. תודה!</p></body></html>
"); /* WPH - Directionality and Encoding - bail() provides a proper wraper */

        if (!empty($post->post_password)) { // if there's a password
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
				?>
				
				<p class="nocomments">הפוסט הזה מוגן. צריך להזין סיסמה כדי לראות את החתימות:<p>
				
				<?php
				return;
            }
        }

		/* This variable is for alternating comment background */
		$oddcomment = 'alt';
?>

<!-- You can start editing here. -->

<?php if ('open' == $post->comment_status) : ?>

<p id="comments"></p>
<h3 id="respond">לחתום</h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>צריך <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">להכנס למערכת</a> בשביל לחתום.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>שלום <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. לחתום <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account') ?>">בשם אחר &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small>שם ושם משפחה <?php if ($req) (חובה) ?></small></label></p>

<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small>דואל (אף אחד לא יראה את זה) <?php if ($req) (חובה) ?></small></label></p>

<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small>אתר</small></label></p>

<?php endif; ?>

<p><input type="text" name="comment" id="comment" size="22" tabindex="4" /><small>ישוב <span style="color: #cc0000">(חובה)</span></small></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="לחתום" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php if ($comments) : ?>

	<br />
	<h3>חתימות</h3> 

	<ul class="commentlist">

	<?php foreach ($comments as $comment) : ?>

		<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
			<cite><?php comment_author_link() ?>, <?php comment_excerpt(); ?></cite>
			<?php if ($comment->comment_approved == '0') : ?>
			<em>החתימה שלך ממתינה לאישור.</em>
			<?php endif; ?>
			<br />

			<small class="commentmetadata"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('d/m/Y') ?> בשעה <?php comment_time() ?></a> <?php edit_comment_link('לערוך','',''); ?></small>
		</li>

	<?php /* Changes every other comment to a different class */	
		if ('alt' == $oddcomment) $oddcomment = '';
		else $oddcomment = 'alt';
	?>

	<?php endforeach; /* end for each comment */ ?>

	</ul>

 <?php else : // this is displayed if there are no comments so far ?>

  <?php if ('open' == $post->comment_status) : ?> 
		<!-- If comments are open, but there are no comments. -->
		
	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">הפוסט הזה סגור לחתימות כרגע.</p>
		
	<?php endif; ?>
<?php endif; ?>


<?php endif; // if you delete this the sky will fall on your head ?>
