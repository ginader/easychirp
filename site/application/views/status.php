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

echo $more;
?>

<?php
//echo '<h2>'.$xliff_reader->get('write-tweet-h2-label').'</h2>';
//require_once 'fragments/write_tweet.php';


//echo debug_object( $show );
?>
