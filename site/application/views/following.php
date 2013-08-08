<h1 class="rounded">
<?php
	echo $xliff_reader->get('following-h1');
	if ( isset($_GET["id"])) {
		echo ' : ' . $_GET["id"];
	}
?>
</h1>

<?php
if ( !isset($_GET["id"])) {
	if (count($f->users) == 0) { 
		echo '<p>' . $xliff_reader->get('following-none') . '</p>';
	}
	else {
		echo '<p class="marginAdjustment">You are following '.$following_count.' users. (<a href="/followers">View Followers</a>)</p>';
	}
}
else {
	echo '<p class="marginAdjustment"><a href="/user?id=' . $_GET["id"] . '">' . $_GET["id"] . '</a> is following these users. (<a href="/followers?id=' . $_GET["id"] . '">View Followers</a>)</p>';	
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
		<span aria-hidden="true" class="icon-close"></span> <?php echo '<a href="#">' . $xliff_reader->get('user-unfollow') . '</a> &nbsp; '; ?>
		<span aria-hidden="true" class="icon-blocked"></span> <a href="#"><?php echo $xliff_reader->get('user-block'); ?></a>
	</div>
	*/ ?>
</div>
<?php
endforeach;
?>
