<h1 class="rounded">User Details : @{username}</h1>

<h2 class="marginAdjustment">Contact</h2>
<div class="box1 rounded no-margin">
	<div id="userAvatar">
		<a href="https://api.twitter.com/1/users/profile_image?screen_name=mariasharapova&size=original" title="view full image in new window" target="_blank">
		<img src="http://a0.twimg.com/profile_images/3107339665/1de166d6b00d5867925f9b25b4b8be62_normal.jpeg" width="48" height="48" alt="avatar" /></a>
	</div>
	<h3>{name}</h3>
	<p>Following (<a href="#">Unfollow</a>) | Not Following (<a href="#">Follow</a>)</p>
	<p><a href="#">Is {username} following me?</a> YES | NO</p>
	<p><span aria-hidden="true" class="icon-alert"></span> <a href="#">Report Spammer</a></p>
	<p><span aria-hidden="true" class="icon-blocked"></span> <a href="#">Block User</a></p>
	<p><span aria-hidden="true" class="icon-checkmark"></span> Verified User</p>
</div>

<h2 class="marginAdjustment">Details</h2>
<div class="box1 rounded no-margin">
	<dl id="profile" class="clearfix">
		<dt>Username</dt>
		<dd>USERNAME</dd>
		
		<dt>Name</dt>
		<dd>NAME</dd>
		
		<dt>Location</dt>
		<dd>LOCATION</dd>

		<dt>Member Since</dt>
		<dd>DATE</dd>
		
		<dt><abbr title="one-line biography">Bio</abbr></dt>
		<dd>BIO</dd>
		
		<dt>Website</dt>
		<dd><a href="#">URL</a></dd>

		<dt>Tweets</dt>
		<dd><a href="/mytweets" title="view my tweets">[COUNT]</a></dd>

		<dt>Following</dt>
		<dd><a href="/following" title="view users that I'm following">[COUNT]</a></dd>

		<dt>Followers</dt>
		<dd><a href="/followers" title="view users following me">[COUNT]</a></dd>

		<dt>Favorites</dt>
		<dd>[COUNT]</dd>

		<dt>Lists</dt>
		<dd><a href="/lists">My Lists</a></dd>

		<dt>Retweets</dt>
		<dd><a href="#">Retweets by {username}</a>; <a href="#">retweets to {username}</a></dd>

		<dt>Background image</dt>
		<dd>[VIEW IMAGE | HAS NO BACKGROUND IMAGE] (No alternative text is offered from Twitter.)</dd>
	</dl>
</div>

<h2 class="marginAdjustment">Latest Tweet</h2>
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


