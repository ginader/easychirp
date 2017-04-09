<?php
if (isset($_GET["action"])) {
	if ($_GET["action"] == "tweet_deleted") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get('msg-tweet-deleted').'</div>';
	}
}
if (isset($_GET["url_short"])) {
	if ($_GET["url_short"] != "") {
		echo '<div class="msgBoxPos rounded">Success! The shortened URL has been added to the input field.</div>';
	}
}
if (isset($_GET["img_url"])) {
	if ($_GET["img_url"] != "") {
		echo '<div class="msgBoxPos rounded">Success! The image URL has been added to the input field.</div>';
	}
}
?>

<h1 class="rounded"><?php echo $page_heading; ?></h1>

<?php

if (isset($error)) {
	if ($error === "not_found") {
		echo '<h2 class="marginAdjustment">Error. Did not find "' . $user . '".</h2>';
	}
}
else {
	echo $write_tweet_form;
	echo $tweets;
	if (isset($more)) {
		echo $more;
	}
}
