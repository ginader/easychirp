<?php
if (isset($_GET["action"])) {
	if ($_GET["action"] == "favorite_created") {
		echo '<div class="msgBoxPos rounded">' . $xliff_reader->get('gbl-tweet-fav-alert-added') . '</div>';
	}
	elseif ($_GET["action"] == "favorite_destroyed") {
		echo '<div class="msgBoxPos rounded">' . $xliff_reader->get('gbl-tweet-fav-alert-removed') . '</div>';
	}
}
?>
<h1 class="rounded"><?php echo $xliff_reader->get('status-h1'); ?></h1>

<div class="tweetSingle">
<?php
echo $tweets;
?>
</div>

<?php
if (isset($rtList)) {
	echo "<h2>Retweeted by</h2>";
	echo "<p>";
	foreach ($rtList as $retweeter) {
		echo anchor('/user/'.$retweeter->screen_name, $retweeter->name);
		if ($retweeter !== end($rtList)) {
			echo ", ";
		}
	}
	echo "</p>";
}
?>

<h2><?php echo $xliff_reader->get('about-h2-more'); ?></h2>

<ul>
	<li><span class="icon-twitter2" aria-hidden="true"></span> <a href="https://twitter.com/<?php echo $show->user->screen_name; ?>/status/<?php echo $show->id; ?>" rel="external" target="_blank"><?php echo $xliff_reader->get('status-on-twitter'); ?></a></li>
	<li><span class="icon-list2" aria-hidden="true"></span> <a href="/user_lists/<?php echo $show->user->screen_name; ?>">Lists by <?php echo $show->user->name; ?></a></li>
</ul>

<?php
//echo '<h2>'.$xliff_reader->get('write-tweet-h2-label').'</h2>';
//require_once 'fragments/write_tweet.php';


//echo debug_object( $show );
?>
