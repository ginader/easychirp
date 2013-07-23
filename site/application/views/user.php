<h1 class="rounded"><?php echo $xliff_reader->get('user-h1'); ?> : @<?php echo $user->screen_name; ?></h1>

<h2 class="marginAdjustment"><?php echo $xliff_reader->get('user-h2-contact'); ?></h2>
<div class="box1 rounded no-margin">
	<div id="userAvatar">
		<a href="https://api.twitter.com/1/users/profile_image?screen_name=mariasharapova&amp;size=original" title="view full image in new window" target="_blank">
		<img src="http://a0.twimg.com/profile_images/3107339665/1de166d6b00d5867925f9b25b4b8be62_normal.jpeg" width="48" height="48" alt="avatar" /></a>
	</div>
	<h3>{name}</h3>
	<p><?php echo $xliff_reader->get('user-following'); ?> (<a href="#"><?php echo $xliff_reader->get('user-unfollow'); ?></a>) | <?php echo $xliff_reader->get('user-not-following'); ?> (<a href="#"><?php echo $xliff_reader->get('user-follow'); ?></a>)</p>
	<p><a href="#">Is {username} following me?</a> YES | NO</p>
	<p><span aria-hidden="true" class="icon-alert"></span> <a href="#"><?php echo $xliff_reader->get('user-spammer'); ?></a></p>
	<p><span aria-hidden="true" class="icon-blocked"></span> <a href="#"><?php echo $xliff_reader->get('user-block'); ?></a></p>
	<p><span aria-hidden="true" class="icon-checkmark"></span> <?php echo $xliff_reader->get('user-verified'); ?></p>
</div>

<h2 class="marginAdjustment"><?php echo $xliff_reader->get('user-h2-details'); ?></h2>
<div class="box1 rounded no-margin">
	<dl id="profile" class="clearfix">
		<dt><?php echo $xliff_reader->get('profile-dt-username'); ?></dt>
		<dd><?php echo $user->screen_name; ?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-name'); ?></dt>
		<dd><?php echo $user->name; ?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-location'); ?></dt>
		<dd><?php echo $user->location; ?></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-since'); ?></dt>
		<dd><?php echo $user->created_at; ?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-bio'); ?></dt>
		<dd><?php echo $user->description; ?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-website'); ?></dt>
		<dd><a href="<?php echo $user->url; ?>"><?php echo $user->url; ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-tweets'); ?></dt>
		<dd><a href="timeline?id=<?php echo $user->screen_name; ?>"><?php echo $user->statuses_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-following'); ?></dt>
		<dd><a href="/following?id=<?php echo $user->screen_name; ?>" title="view users that I'm following"><?php echo $user->friends_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-followers'); ?></dt>
		<dd><a href="/followers?id=<?php echo $user->screen_name; ?>" title="view users following me"><?php echo $user->followers_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('nav-favorites'); ?></dt>
		<dd><a href="/favorites?id=<?php echo $user->screen_name; ?>"><?php #echo $user->favorites_count; ?>COUNT</a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-lists'); ?></dt>
		<dd><a href="/lists?id=<?php echo $user->screen_name; ?>"><?php echo $xliff_reader->get('profile-dt-lists'); ?></a></dd>

		<dt><?php echo $xliff_reader->get('nav-retweets'); ?></dt>
		<dd><a href="#">Retweets by <?php echo $user->screen_name; ?></a>; <a href="#">retweets to <?php echo $user->screen_name; ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-bg-image'); ?></dt>
		<dd><?php
			if ( isset( $user->profile_background_image_url )) {
				echo '<a href="' . $user->profile_background_image_url . '">' . $xliff_reader->get('profile-view-image') . '</a> ' . $xliff_reader->get('profile-no-alt');
			}
			else {
				echo $xliff_reader->get('profile-no-img');
			}
		?></dd>
	</dl>
</div>

<h2 class="marginAdjustment"><?php echo $xliff_reader->get('profile-h2-latest'); ?></h2>

<h2 class='alert'>CAN WE USE TWEET FRAGMENT HERE?!</h2>

