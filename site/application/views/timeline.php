<h1 class="rounded"><?php echo $xliff_reader->get('nav-timeline'); ?></h1>
<style>
.tweet-meta {
	font-size: 0.9em;
	font-style: italic;
	margin-top: 8px;
}
</style>
<?php
require_once 'fragments/write_tweet.php';
?>

<div id="timeline">
<?php echo $tweets; ?>
</div>

<p>[INCLUDE PAGINATION]</p>

