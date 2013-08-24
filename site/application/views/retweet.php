<?php
if (isset($_GET["action"])) {
	if ($_GET["action"] == "retweet_created") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get('gbl-tweet-rt-alert-added').'</div>';
	}
	elseif ($_GET["action"] == "retweet_destroyed") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get('gbl-tweet-rt-alert-removed').'</div>';
	}
}
?>

<h1 class="rounded" style="margin-bottom: 1rem;"><?php echo $xliff_reader->get('retweet-h1'); ?></h1>

<?php
echo $tweets;
require_once 'fragments/write_tweet.php';
?>
