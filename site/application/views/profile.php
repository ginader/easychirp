<h1 class="rounded"><?php echo $xliff_reader->get('profile-h1'); ?></h1>

<p id="editProfileLink"><a href="/profile_edit"><?php echo $xliff_reader->get('profile-edit-link'); ?></a></p>
<?php
	$styles = 'background-color: #' . $profile->profile_background_color . ';';
	if ( isset( $profile->profile_background_image_url ))
	{
		$styles .= 'background-image: url(' . $profile->profile_background_image_url . ');'
			. ' background-repeat: no-repeat;';
	}
	$styles .= 'color: #' . $profile->profile_text_color . ';';
?>
<?php #debug_object( $profile ); ?>
<h2 class="marginAdjustment">Details</h2>
<div class="box1 rounded no-margin" style="<?php echo $styles; ?>">
	<dl id="profile" class="clearfix">
		<dt><?php echo $xliff_reader->get('profile-dt-username'); ?></dt>
		<dd><?php echo $profile->screen_name; ?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-name'); ?></dt>
		<dd><?php echo $profile->name; ?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-location'); ?></dt>
		<dd><?php echo $profile->location; ?></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-since'); ?></dt>
		<dd><?php echo $profile->created_at; ?></dd>
		
		<dt><abbr title="one-line biography">Bio</abbr></dt>
		<dd><?php echo $profile->description; ?></dd>
		
		<dt><?php echo $xliff_reader->get('profile-dt-website'); ?></dt>
		<dd><a href="<?php echo $profile->url; ?>"><?php echo $profile->url; ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-tweets'); ?></dt>
		<dd><a href="/mytweets" title="view my tweets"><?php echo $profile->statuses_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-following'); ?></dt>
		<dd><a href="/following" title="view users that I'm following"><?php echo $profile->friends_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-followers'); ?></dt>
		<dd><a href="/followers" title="view users following me"><?php echo $profile->followers_count; ?></a></dd>

		<dt><?php echo $xliff_reader->get('profile-dt-lists'); ?></dt>
		<dd><a href="/lists"><?php echo $xliff_reader->get('profile-dd-my-lists'); ?></a></dd>

		<!-- [IF DATA READILY AVAILABLE] -->
		<dt><?php echo $xliff_reader->get('profile-dt-api-hits'); ?></dt>
		<dd>[COUNT]</dd>

		<dt><?php echo $xliff_reader->get('profile-dt-bg-image'); ?></dt>
		<dd>[VIEW IMAGE | YOU HAVE NO BACKGROUND IMAGE] (No alternative text is offered from Twitter.)</dd>
	</dl>
</div>

<h2 class="marginAdjustment"><?php echo $xliff_reader->get('profile-h2-latest'); ?></h2>
<div class="tweet rounded clearfix">
	<div class="tweetAvatar" style="background-image:url(images/avatar_todd.png);"></div>
	<h2 class="hide">Username 3</h2>
	<q>The end of the tweet the tweetthe tweet the tweetthe tweet the tweetthe tweet the tweeweetthe tweet the tweetthe tweet the et the tweetthe tweet the tweet</q>
	<p>from <a href="#" title="fullname; followers; following">username</a> | <a href="#">date</a> | retweet/responding | via <a href="#">app</a></p>
	<div class="btnOptions">
		<h3><a href="#tweetOptions_3" class="btnOptionsTweet" title="tweet options" data-icon="&#x29;"><span class="hide">tweet options</span></a></h3>
		<ul id="tweetOptions_3">
			<li><a href="#" data-icon="&#x2a;" title="favorite"><span class="hide">favorite</span></a></li>
			<li><a href="#" data-icon="&#x41;" title="reply"><span class="hide">reply</span></a></li>
			<li><a href="#" data-icon="&#x3b;" title="reply to all"><span class="hide">reply to all</span></a></li>
			<li><a href="#" data-icon="&#x3f;" title="retweet"><span class="hide">retweet</span></a></li>
			<li><a href="#" data-icon="&#x30;" title="quote tweet"><span class="hide">quote tweet</span></a></li>
			<li><a href="#" data-icon="&#x31;" title="email tweet"><span class="hide">email tweet</span></a></li>
		</ul>
	</div>
	<div class="btnOptions">
		<h3><a href="#userOptions_3" class="btnOptionsUser" title="user options" data-icon="&#x3c;"><span class="hide">user options</span></a></h3>
		<ul id="userOptions_3">
			<li><a href="#" data-icon="&#x3e;" title="view this user's timeline"><span class="hide">timeline</span></a></li>
			<li><a href="#" data-icon="&#x37;" title="direct message this user"><span class="hide">direct message</span></a></li>
			<li><a href="#" data-icon="&#x38;" title="tweet message"><span class="hide">tweet message</span></a></li>
			<li><a href="#" data-icon="&#x3d;" title="muter user"><span class="hide">mute user</span></a></li>
			<li><a href="#" data-icon="&#x33;" title="report spammer" class="spammer"><span class="hide">report spammer</span></a></li>
		</ul>
	</div>
</div>


