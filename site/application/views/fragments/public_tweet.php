<?php
/**
 * description of package
 *
 * @package YourPackage
 * @subpackage Subpackage name
 * @author firstname lastname <user@host.com>
 */ 
?>
<h2><?php echo $xliff_reader->get('home-h2-what-tweeting'); ?></h2>
<?php 
	foreach ($tweets AS $tweet): 
		$tweet_path = array('status', $tweet->id);	
		$link_label = 'from ' . $tweet->user->name; 
?>
	<blockquote>
		<p><?php echo $tweet->text; ?></p>

		<div>
		<cite><?php echo anchor($tweet_path, $link_label, 'rel="no-follow"'); ?> 
		(<?php echo $tweet->user->screen_name; ?>)</cite>
		</div>
	</blockquote>
<?php 
	endforeach;	
?>


