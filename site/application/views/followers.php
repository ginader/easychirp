<h1 class="rounded">
<?php
	echo $xliff_reader->get('followers-h1');
	if ( isset($_GET["id"])) {
		echo ' : ' . $_GET["id"];
	}
?>
</h1>

<?php
if ( !isset($_GET["id"])) {
	if (count($f->users) == 0) { 
		echo '<p>' . $xliff_reader->get('followers-none') . '</p>';
	}
	else {
		echo '<p class="marginAdjustment">You are followed by '.$follower_count.' Tweeps. (<a href="/following">View Following</a>)</p>';
	}
}
else {
	echo '<p class="marginAdjustment"><a href="/user?id=' . $_GET["id"] . '">' . $_GET["id"] . '</a> is followed by these users. (<a href="/following?id=' . $_GET["id"] . '">View Following</a>)</p>';	
}
?>

<?php
foreach ($f->users as $user):
?>
<div class="box1 rounded follow">
	<div class="tweetAvatar" style="background-image:url(<?php echo $user->profile_image_url; ?>)"></div>
	<h2><?php echo '<a href="/user?id='.$user->screen_name.'">' . $user->name.'</a> @'.$user->screen_name; ?></h2>
	<p><?php echo $user->location . ". " . $user->description; ?></p>
	<p>
		<?php echo $xliff_reader->get('profile-dt-tweets'); ?> <a href="user_timeline?user=<?php echo $user->screen_name; ?>"><?php echo $user->statuses_count; ?></a> 
		<?php echo $xliff_reader->get('profile-dt-following'); ?> <a href="/following?id=<?php echo $user->screen_name; ?>" title="view users that I'm following"><?php echo $user->friends_count; ?></a> 
		<?php echo $xliff_reader->get('profile-dt-followers'); ?> <a href="/followers?id=<?php echo $user->screen_name; ?>" title="view users following me"><?php echo $user->followers_count; ?></a>
	</p>
	<?php /*
	<div class="ar">
		<span aria-hidden="true" class="icon-blocked"></span> <a href="#"><?php echo $xliff_reader->get('user-block'); ?></a>
	</div>
	*/ ?>
</div>
<?php
endforeach;
?>
