<h1 class="rounded"><?php echo $xliff_reader->get('user-h1'); ?> : <?php echo $user->name; ?></h1>

<h2 class="marginAdjustment"><?php echo $xliff_reader->get('user-h2-contact'); ?></h2>
<div class="box1 rounded no-margin">
	<h3><img src="<?php echo $user->profile_image_url; ?>" width="48" height="48" alt="" /> 
		<?php echo $user->name . " / @" . $user->screen_name; ?>
	</h3>
	
	<p><?php
		$isFollowing = $user->following;
		if ($isFollowing === true) {
			echo $xliff_reader->get('user-following') . ' (<a href="#">' . $xliff_reader->get('user-unfollow') . '</a>)';
		}
		else {
			echo $xliff_reader->get('user-not-following') . ' (<a href="#">' . $xliff_reader->get('user-follow') . '</a>)';
		}
	?></p>
	
	<p>Is <?php echo $user->name; ?> following me?</a> <?php
		$isFollowed = $friendship->relationship->target->following;
		if ($isFollowed == 1) {
			echo 'Yes';
		}
		else {
			echo 'No';
		}
	?></p>

	<p><span aria-hidden="true" class="icon-alert"></span> <a href="#"><?php echo $xliff_reader->get('user-spammer'); ?></a> 
	&nbsp; 
	<span aria-hidden="true" class="icon-blocked"></span> <a href="#"><?php echo $xliff_reader->get('user-block'); ?></a></p>
	
	<?php
		if ($user->verified === true) { ?>
			<p><span aria-hidden="true" class="icon-checkmark"></span> <?php echo $xliff_reader->get('user-verified'); ?></p>
	<?php } ?>
</div>

<h2 class="marginAdjustment"><?php echo $xliff_reader->get('user-h2-details'); ?></h2>
<div class="box1 rounded no-margin">
	<dl id="profile" class="clearfix">
		<dt><?php echo $xliff_reader->get('profile-dt-username'); ?></dt>
		<dd><?php echo $user->screen_name; ?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-name'); ?></dt>
		<dd><?php echo $user->name; ?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-location'); ?></dt>
		<dd><?php
		if ($user->location != '') { echo $user->location; }
		else { echo '&nbsp;'; }
		?></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-since'); ?></dt>
		<dd><?php echo $user->created_at; ?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-bio'); ?></dt>
		<dd><?php
		if ($user->description != '') { echo $user->description; }
		else { echo '&nbsp;'; }
		?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-website'); ?></dt>
		<dd>
		<?php
		if ($user->url != null) {
			echo '<a href="' . $user->entities->url->urls[0]->expanded_url . '">' . $user->entities->url->urls[0]->expanded_url . '</a>';
		}
		else {
			echo '&nbsp;';
		}
		?>
		</dd>

		<dt><?php echo $xliff_reader->get('profile-dt-tweets'); ?></dt>
		<dd><a href="timeline?id=<?php echo $user->screen_name; ?>"><?php echo $user->statuses_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-following'); ?></dt>
		<dd><a href="/following?id=<?php echo $user->screen_name; ?>" title="view users that I'm following"><?php echo $user->friends_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-followers'); ?></dt>
		<dd><a href="/followers?id=<?php echo $user->screen_name; ?>" title="view users following me"><?php echo $user->followers_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('nav-favorites'); ?></dt>
		<dd><a href="/favorites?id=<?php echo $user->screen_name; ?>"><?php echo $user->favourites_count; ?></a></dd>

		<dt>Listed count</dt>
		<dd><?php echo $user->listed_count; ?></dd>

		<?/*<dt><?php echo $xliff_reader->get('profile-dt-lists'); ?></dt>
		<dd><a href="/lists?id=<?php echo $user->screen_name; ?>"><?php echo $xliff_reader->get('profile-dt-lists'); ?></a></dd>*/?>

		<dt><?php echo $xliff_reader->get('nav-retweets'); ?></dt>
		<dd><a href="#">retweets by <?php echo $user->screen_name; ?></a><?php /*; <a href="#">retweets to <?php echo $user->screen_name; ?>*/?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-bg-image'); ?></dt>
		<dd><?php
			if ( isset( $user->profile_background_image_url )) {
				echo '<a href="' . $user->profile_background_image_url . '" target="_blank">' . $xliff_reader->get('profile-view-image') . '</a> ' . $xliff_reader->get('profile-no-alt');
			}
			else {
				echo $xliff_reader->get('profile-no-img');
			}
		?></dd>
	</dl>
</div>

<h2 class="marginAdjustment"><?php echo $xliff_reader->get('profile-h2-latest'); ?></h2>

<h2 class='alert'>CAN WE USE TWEET FRAGMENT HERE?!</h2>

