<?php
if (isset($_GET["action"])) {
	if ($_GET["action"] == "favorite_created") {
		echo '<div class="msgBoxPos rounded">This tweet is now a favorite.</div>';
	}
	elseif ($_GET["action"] == "favorite_destroyed") {
		echo '<div class="msgBoxPos rounded">This tweet is no longer a favorite.</div>';
	}
}
?>
<h1 class="rounded">View Single Tweet</h1>

<div class="tweetSingle">
<?php
echo $tweets;
require_once 'fragments/write_tweet.php';
?>
</div>

<h2>More</h2>

<ul>
	<li><span class="icon-twitter2" aria-hidden="true"></span> <a href="https://twitter.com/<?php echo $show->user->screen_name; ?>/status/<?php echo $show->id; ?>" rel="external" target="_blank">This tweet on Twitter</a></li>
	<li><span class="icon-list2" aria-hidden="true"></span> <a href="/user_lists/<?php echo $show->user->screen_name; ?>">Lists by <?php echo $show->user->name; ?></a></li>
</ul>

<?php
//echo debug_object( $show );
?>
