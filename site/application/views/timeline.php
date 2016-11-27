<?php
if (isset($_GET["action"])) {
	if ($_GET["action"] == "tweet_deleted") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get('msg-tweet-deleted').'</div>';
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
