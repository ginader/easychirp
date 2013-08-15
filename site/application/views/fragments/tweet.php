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

$index = 0;


foreach($tweets AS $tweet):

	$date =   $tweet->created_at;  // Fri Jun 14 00:49:09 +0000 2013	
	$regex = '/(\w{3}) (\w{3}) (\d\d) (\d\d:\d\d:\d\d) ([+\-]\d\d\d\d) (\d\d\d\d)/';

	$is_matched = preg_match($regex, $tweet->created_at, $matches);
	if ($is_matched){
		$month_abbr = strtolower($matches[2]);
		$month = $months[ $month_abbr ]; 
		
		$date = sprintf("%s %d-%s-%s %s%s", $matches[1],  $matches[6], $month, $matches[3], $matches[4], $matches[5]);
	}

	//check if this tweet is a reply
	$isReply = false;
	if ($tweet->in_reply_to_status_id !== null) {
		$isReply = true;
	}

	//check if this tweet is a retweet
	$isRetweet = false;
	if (isset($tweet->retweeted_status)) {
		$isRetweet = true;
	}
?>
<div class="tweet rounded clearfix<?
	if ($isReply) { echo ' reply'; }
	else if ($isRetweet) { echo ' retweet'; }
	?>">
	<div class="tweetAvatar" style="background-image:url(<?php echo $tweet->user->profile_image_url; ?>)"></div>
	<h2 class="hide"><?php echo $tweet->user->screen_name; ?></h2>
	<q><?php echo $tweet->text; ?></q>
	<p>from <a href="/user?id=<?php echo $tweet->user->screen_name; ?>" title="<?php echo $tweet->user->name; ?>; followers <?php echo $tweet->user->followers_count; ?>; following <?php echo $tweet->user->friends_count; ?>"> <?php echo $tweet->user->screen_name; ?></a> | <a href="/status?id=<?php echo $tweet->id; ?>"><?php echo $date; ?></a> | 
		<?php
		// Is reply or retweet?
		if ($isReply) {
			echo ' <a rel="response" title="View the tweet to which this tweet is responding" href="/status?id='.$tweet->in_reply_to_status_id.'">' . $xliff_reader->get('gbl-tweet-responding') . '</a> | ';
		}
		if ($isRetweet) {
			echo ' <a rel="retweet" title="View the original tweet (this is a retweet)" href="/status?id='.$tweet->retweeted_status->id.'">' . $xliff_reader->get('gbl-tweet-retweet') . '</a> | ';
		}

		// Has been retweeted?
		if ($tweet->retweet_count == 1) {
			echo 'Retweeted 1 time. | ';
		}
		else if ($tweet->retweet_count > 1) {
			echo 'Retweeted '.$tweet->retweet_count.' times. | ';
		}

		?>
		via <?php echo $tweet->source; ?></p>
	<div class="btnOptions">
		<h3><a href="#tweetOptions_<?php echo $index; ?>" class="btnOptionsTweet" title="<?php echo $xliff_reader->get('gbl-tweet-tweet-options'); ?>" data-icon="&#x29;"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-tweet-options'); ?></span></a></h3>
		<ul id="tweetOptions_<?php echo $index; ?>">
			<li><?php
			// If favorited or not
			if ($tweet->favorited == false) {
				echo '<a href="/favorite?id=' . $tweet->id . '" data-icon="&#x2a;" title="' . $xliff_reader->get('gbl-tweet-favorite') . '"><span class="hide">' . $xliff_reader->get('gbl-tweet-favorite') . '</span></a>';
			}
			else {
				echo '<a href="/favorite?id=' . $tweet->id . '" data-icon="&#x2a;" title="' . $xliff_reader->get('gbl-tweet-favorited') . '" class="favorited"><span class="hide">' . $xliff_reader->get('gbl-tweet-favorited') . '</span></a>';
			}
			?></li>
			<li><a href="/reply/<?php echo $tweet->id; ?>" data-icon="&#x41;" title="<?php echo $xliff_reader->get('gbl-tweet-reply'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-reply'); ?></span></a></li>
			<li><a href="/reply_to_all?id=<?php echo $tweet->id; ?>" data-icon="&#x3b;" title="<?php echo $xliff_reader->get('gbl-tweet-reply-all'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-reply-all'); ?></span></a></li>
			<li><a href="/retweet?id=<?php echo $tweet->id; ?>" data-icon="&#x3f;" title="<?php echo $xliff_reader->get('gbl-tweet-retweet'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-retweet'); ?></span></a></li>
			<li><a href="/quote?id=<?php echo $tweet->id; ?>" data-icon="&#x30;" title="<?php echo $xliff_reader->get('gbl-tweet-quote'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-quote'); ?></span></a></li>
			<li><a href="mailto:?subject=Tweet from <?php echo $tweet->user->screen_name; ?> [via Easy Chirp]&amp;body=<?php echo urlencode($tweet->text); ?> [via EasyChirp.com]" data-icon="&#x31;" title="<?php echo $xliff_reader->get('gbl-tweet-email'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-email'); ?></span></a></li>
		</ul>
	</div>
	<div class="btnOptions">
		<h3><a href="#userOptions_<?php echo $index; ?>" class="btnOptionsUser" title="<?php echo $xliff_reader->get('gbl-tweet-user-options'); ?>" data-icon="&#x3c;"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-user-options'); ?></span></a></h3>
		<ul id="userOptions_<?php echo $index; ?>">
			<li><a href="/user_timeline?user=<?php echo $tweet->user->screen_name; ?>" data-icon="&#x3e;" title="<?php echo $xliff_reader->get('gbl-tweet-timeline'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-timeline'); ?></span></a></li>
			<li><a href="/direct?user=<?php echo $tweet->user->screen_name; ?>" data-icon="&#x37;" title="<?php echo $xliff_reader->get('gbl-tweet-dm'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-dm'); ?></span></a></li>
			<li><a href="/timeline?twmess=<?php echo $tweet->user->screen_name; ?>" rel="twmess" data-icon="&#x38;" title="<?php echo $xliff_reader->get('gbl-tweet-tweet-message'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-tweet-message'); ?></span></a></li>
			<li><a href="/mute?user=<?php echo $tweet->user->screen_name; ?>" data-icon="&#x3d;" title="<?php echo $xliff_reader->get('gbl-tweet-mute'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-mute'); ?></span></a></li>
			<li><a href="/report_spammer?user=<?php echo $tweet->user->screen_name; ?>" data-icon="&#x33;" title="<?php echo $xliff_reader->get('gbl-tweet-report'); ?>" class="spammer"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-report'); ?></span></a></li>
		</ul>
	</div>
</div>
<?php 

$index++;
endforeach; 

?>
