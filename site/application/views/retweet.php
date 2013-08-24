<?php
if (isset($_GET["action"])) {
	if ($_GET["action"] == "retweet_created") {
		//echo '<div class="msgBoxPos rounded">'.$xliff_reader->get('msg-followed-user').'</div>';
		echo '<div class="msgBoxPos rounded">The retweet has been created.</div>';
	}
	elseif ($_GET["action"] == "retweet_destroyed") {
		echo '<div class="msgBoxPos rounded">The retweet has been undone.</div>';
	}
}
?>

<h1 class="rounded"><?php echo $xliff_reader->get('retweet-h1'); ?></h1>

<div>
	<form action="/retweet/create/<?php echo $id; ?>/false" method="get">
		<button type="submit">Retweet Now</button>
	</form>
</div>

<?php
echo $tweets;
require_once 'fragments/write_tweet.php';
?>
