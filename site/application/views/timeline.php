<?php
if (isset($_GET["action"])) {
	if ($_GET["action"] == "tweet_deleted") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get('msg-tweet-deleted').'</div>';
	}
}
?>

<h1 class="rounded"><?php echo $page_heading; ?></h1>

<?php
echo $write_tweet_form;
echo $tweets;

