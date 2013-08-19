<h1 class="rounded"><?php echo $xliff_reader->get('profile-h1'); ?></h1>

<?php #debug_object( $profile ); ?>

<p id="top-pull-link"><a href="/profile_edit"><?php echo $xliff_reader->get('profile-edit-link'); ?></a></p>

<h2 class="marginAdjustment"><?php echo $xliff_reader->get('user-h2-details'); ?></h2>

<div class="box1 rounded no-margin" style="background: url('<?php echo $profile->profile_image_url; ?>') no-repeat 15px 5px;">
	<dl id="profile" class="clearfix">
		<dt><?php echo $xliff_reader->get('profile-dt-username'); ?></dt>
		<dd><?php echo $profile->screen_name; ?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-name'); ?></dt>
		<dd><?php echo $profile->name; ?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-location'); ?></dt>
		<dd><?php
		if ($profile->location != '') { echo $profile->location; }
		else { echo '&nbsp;'; }
		?></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-since'); ?></dt>
		<dd><?php 
			$date = date_create($profile->created_at);
			echo date_format($date, 'd F Y'); 
		?></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-bio'); ?></dt>
		<dd><?php
		if ($profile->description != '') { echo $profile->description; }
		else { echo '&nbsp;'; }
		?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-website'); ?></dt>
		<dd>
		<?php
		if ($profile->url != null) {
			echo '<a href="' . $profile->entities->url->urls[0]->expanded_url . '">' . $profile->entities->url->urls[0]->expanded_url . '</a>';
		}
		else {
			echo '&nbsp;';
		}
		?>
		</dd>

		<dt><?php echo $xliff_reader->get('profile-dt-tweets'); ?></dt>
		<dd><a href="/mytweets" title="view my tweets"><?php echo $profile->statuses_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-following'); ?></dt>
		<dd><a href="/following" title="view users that I'm following"><?php echo $profile->friends_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-followers'); ?></dt>
		<dd><a href="/followers" title="view users following me"><?php echo $profile->followers_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('nav-favorites'); ?></dt>
		<dd><a href="/favorites"><?php echo $profile->favourites_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('gbl-listed-count'); ?></dt>
		<dd><?php echo $profile->listed_count; ?></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-lists'); ?></dt>
		<dd><a href="/lists"><?php echo $xliff_reader->get('profile-dd-my-lists'); ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-bg-image'); ?></dt>
		<dd><?php
			if ( isset( $profile->profile_background_image_url )) {
				echo '<a href="' . $profile->profile_background_image_url . '">' . $xliff_reader->get('profile-view-image') . '</a> ' . $xliff_reader->get('profile-no-alt');
			}
			else {
				echo $xliff_reader->get('profile-no-img');
			}
		?></dd>
	</dl>
</div>

<h2 class="marginAdjustment"><?php echo $xliff_reader->get('profile-h2-latest'); ?></h2>

<h2 class='alert'>CAN WE USE TWEET FRAGMENT HERE?!</h2>


