<?php get_header(); ?>

	<div id="content" class="widecolumn">
				
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="‫קישור קבוע לפוסט &rsquo;<?php the_title(); ?>&lsquo;"><?php the_title(); ?></a></h2>
	
			<div class="entrytext">
				<?php the_content('<p class="serif">לקרוא את שאר הפוסט &raquo;</p>'); ?>
	
				<?php link_pages('<p><strong>עמודים:</strong> ', '</p>', 'number'); ?>
			</div>
		</div>
		
	<?php comments_template(); ?>
	
	<?php endwhile; else: ?>
	
		<p>לא מצאתי את מה שחיפשת.</p>
	
<?php endif; ?>
	
	</div>

<?php get_footer(); ?>
