<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php bloginfo('name'); ?>: <?php bloginfo('description'); ?></title>
	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" type="text/css" media="print" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<link rel="index" href="<?php bloginfo(’url’); ?>" />

	<?php 
	
		/* meta links */
	if(!is_home()) { 
	        echo '<link rel="start" href="' . get_bloginfo('siteurl') . '" title="Home" />' . "\n"; 
	    } 

	    $firstpost = @$wpdb->get_row("SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_date ASC LIMIT 1"); 
	    if($firstpost) { 
	        $first_title = strip_tags(str_replace('"', '', $firstpost->post_title)); 
	        echo '<link rel="first" href="' . get_permalink($firstpost->ID) . '" title="' . $first_title. '" />' . "\n"; 
	    } 

	    $lastpost = @$wpdb->get_row("SELECT ID, post_title FROM $wpdb->posts WHERE post_status = 'publish' ORDER BY post_date DESC LIMIT 1"); 
	    if($lastpost) { 
	        $last_title = strip_tags(str_replace('"', '', $lastpost->post_title)); 
	        echo '<link rel="last" href="' . get_permalink($lastpost->ID) . '" title="' . $last_title. '" />' . "\n"; 
	    }
	
	    if(is_single()) { 
	        global $wpdb, $wp_query; 
	        $post = $wp_query->post; 

	        $wpdb->hide_errors(); // hide errors on invalid post queries 

	        $prev_post = get_previous_post(); 
	        if($prev_post) { 
	            $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title)); 
	            echo '<link rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title. '" />' . "\n"; 
	        } 

	        $next_post = get_next_post(); 
	        if($next_post) { 
	            $next_title = strip_tags(str_replace('"', '', $next_post->post_title)); 
	            echo '<link rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title. '" />' . "\n"; 
	        } 

	        $wpdb->show_errors(); // turn errors back on 

	    } 
	
	?>

	<?php wp_get_archives('type=monthly&format=link'); ?>


<?php wp_head(); ?>
</head>
<body>
<div id="page">


<div id="header">
	<div id="headerimg">
		<h1><a href="<?php echo get_settings('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
		<div class="description"><?php bloginfo('description'); ?></div>
		<br />
<?php
$numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'");
if (0 < $numposts) $numposts = number_format($numposts); 

$numcomms = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '1'");
if (0 < $numcomms) $numcomms = number_format($numcomms);

$numcats = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->categories");
if (0 < $numcats) $numcats = number_format($numcats);
?>
	</div>
</div>
<hr />
