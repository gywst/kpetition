<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">תוצאות החיפוש</h2>
		
		<div class="navigation">
			<div class="alignright"><?php next_posts_link('&laquo; פוסטים ישנים יותר') ?></div>
			<div class="alignleft"><?php previous_posts_link('פוסטים חדשים יותר &raquo;') ?></div>
		</div>


		<?php while (have_posts()) : the_post(); ?>
				
			<div class="post">
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="קישור קבוע לפוסט &rsquo;<?php the_title(); ?>&lsquo;"><?php the_title(); ?></a></h3>
				<small><?php the_time('d/m/Y') ?></small>
		
				<p class="postmetadata">שייך לנושא <?php the_category(', ') ?> | <?php edit_post_link('לערוך', '', ' | '); ?>  <?php comments_popup_link('אין חתימות &#187;', 'חתימה אחת &#187;', '% חתימות &#187;'); ?></p> 
			</div>
	
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignright"><?php next_posts_link('&laquo; פוסטים ישנים יותר') ?></div>
			<div class="alignleft"><?php previous_posts_link('פוסטים חדשים יותר &raquo;') ?></div>
		</div>
	
	<?php else : ?>

		<h2 class="center">לא מצאתי את מה שחיפשת</h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>
		
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>