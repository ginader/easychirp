<?php
$months = array();
$months['jan'] = '01';
$months['feb'] = '02';
$months['mar'] = '03';
$months['apr'] = '04';
$months['may'] = '05';
$months['jun'] = '06';
$months['jul'] = '07';
$months['aug'] = '08';
$months['sep'] = '09';
$months['oct'] = '10';
$months['nov'] = '11';
$months['dec'] = '12';
?>
<?php foreach($tweets AS $tweet): ?>
<?php 
	$date =   $tweet->created_at;  // Fri Jun 14 00:49:09 +0000 2013	
	$regex = '/(\w{3}) (\w{3}) (\d\d) (\d\d:\d\d:\d\d) ([+\-]\d\d\d\d) (\d\d\d\d)/';


	$is_matched = preg_match($regex, $tweet->created_at, $matches);
	if ($is_matched){
		$month_abbr = strtolower($matches[2]);
		$month = $months[ $month_abbr ]; 
		
		$date = sprintf("%s %d-%s-%s %s%s", $matches[1],  $matches[6], $month, $matches[3], $matches[4], $matches[5]);
	}
?>
<div class="tweet rounded clearfix">
	<div class="tweetAvatar" style="background-image:url(<?php echo $tweet->user->profile_image_url; ?>)"></div>
	<h2 class="hide"><?php echo $tweet->user->screen_name; ?></h2>
	<q><?php echo $tweet->text; ?></q>
	<p>from <a href="/user?id=<?php echo $tweet->id; ?>" title="<?php echo $tweet->user->name; ?>; followers <?php echo $tweet->user->followers_count; ?>; following <?php echo $tweet->user->friends_count; ?>"> <?php echo $tweet->user->screen_name; ?></a> | <a href="/status?id=<?php echo $tweet->id; ?>"><?php echo $date; ?></a> | 
		 Reply or Retweet? |
		 Retweeted? | 
		 via <?php echo $tweet->source; ?></p>
	<div class="btnOptions">
		<h3><a href="#tweetOptions_3" class="btnOptionsTweet" title="tweet options" data-icon="&#x29;"><span class="hide">tweet options</span></a></h3>
		<ul id="tweetOptions_3">
			<li><a href="/favorite?id=<?php echo $tweet->id; ?>" data-icon="&#x2a;" title="favorite"><span class="hide">favorite</span></a></li>
			<li><a href="/reply?id=<?php echo $tweet->id; ?>" data-icon="&#x41;" title="reply"><span class="hide">reply</span></a></li>
			<li><a href="/reply_to_all?id=<?php echo $tweet->id; ?>" data-icon="&#x3b;" title="reply to all"><span class="hide">reply to all</span></a></li>
			<li><a href="/retweet?id=<?php echo $tweet->id; ?>" data-icon="&#x3f;" title="retweet"><span class="hide">retweet</span></a></li>
			<li><a href="/quote?id=<?php echo $tweet->id; ?>" data-icon="&#x30;" title="quote tweet"><span class="hide">quote tweet</span></a></li>
			<li><a href="mailto:foo@bar.com?subject=Tweet from <?php echo $tweet->user->screen_name; ?>&amp;body=<?php echo $tweet->text; ?>" data-icon="&#x31;" title="email tweet"><span class="hide">email tweet</span></a></li>
		</ul>
	</div>
	<div class="btnOptions">
		<h3><a href="#userOptions_3" class="btnOptionsUser" title="user options" data-icon="&#x3c;"><span class="hide">user options</span></a></h3>
		<ul id="userOptions_3">
			<li><a href="/timeline?id=<?php echo $tweet->user->screen_name; ?>" data-icon="&#x3e;" title="view this user's timeline"><span class="hide">timeline</span></a></li>
			<li><a href="/direct?id=<?php echo $tweet->user->screen_name; ?>" data-icon="&#x37;" title="direct message this user"><span class="hide">direct message</span></a></li>
			<li><a href="/timeline?twmess=<?php echo $tweet->user->screen_name; ?>" data-icon="&#x38;" title="tweet message"><span class="hide">tweet message</span></a></li>
			<li><a href="/mute?id=<?php echo $tweet->user->screen_name; ?>" data-icon="&#x3d;" title="mute user"><span class="hide">mute user</span></a></li>
			<li><a href="/report_spammer?id=<?php echo $tweet->user->screen_name; ?>" data-icon="&#x33;" title="report spammer" class="spammer"><span class="hide">report spammer</span></a></li>
		</ul>
	</div>
</div>
<?php endforeach; ?>
