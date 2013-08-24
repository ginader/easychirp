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

?>
<div id="timeline">
<?php

if (isset($tweets) && sizeof($tweets) > 0):

$i = sizeof($tweets) - 1;
$last_id = $tweets[$i]->id;


foreach($tweets AS $tweet):

	$date = $tweet->created_at;  // Fri Jun 14 00:49:09 +0000 2013

	// http://www.php.net/manual/en/datetime.createfromformat.php
	$twitter_date_format = 'D M d H:i:s e Y';
	$tweet_date = DateTime::createFromFormat($twitter_date_format, $date);
	$tweet_date->timezone = $utc_offset;

	$date_seconds = (int) $tweet_date->format('U'); // get Unix Epoch seconds

	// http://www.php.net/manual/en/function.strftime.php
	$date = strftime('%b %d, %I:%M %p %z', $date_seconds);	// Jan 1, 3:50 pm

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
<div id="<?php echo $tweet->id; ?>" class="tweet rounded clearfix<?php
	if ($isReply) { echo ' reply'; }
	else if ($isRetweet) { echo ' retweet'; }
	?>">
	<?php if (isset($tweet->user)): ?>
	<div class="tweetAvatar" style="background-image:url(<?php echo $tweet->user->profile_image_url; ?>)"></div>
	<h2 class="hide"><?php echo $tweet->user->screen_name; ?></h2>
	<?php endif; ?>
	<q><?php
	// Define the text of the tweet
	if ($isRetweet) {
		$tweet_text = "RT @" . $tweet->retweeted_status->user->screen_name . " " . $tweet->retweeted_status->text;
	}
	else {
		$tweet_text = $tweet->text;
	}

	// Link links
	$tweet_text = preg_replace('#\b(https?://[\w\d\/\.]+)\b#', '<a href="\1">\1</a>', $tweet_text);

	// Link @usernames
	$tweet_text = preg_replace('/@+([-_0-9a-zA-Z]+)/', '<a href="/user?id=$1">$0</a>', $tweet_text);

	// Link #hashtags
	$tweet_text = preg_replace('/\B#([-_0-9a-zA-Z]+)/', '<a href="/search_results?query=%23$1" title="search this term">$0</a>', $tweet_text);

	echo $tweet_text;
	?></q>
	<?php if (isset($tweet->user)): ?>
	<p><?php echo $xliff_reader->get('gbl-from'); ?> <a href="/user?id=<?php echo $tweet->user->screen_name; ?>" title="<?php echo $tweet->user->name; ?>; followers <?php echo $tweet->user->followers_count; ?>; following <?php echo $tweet->user->friends_count; ?>"> <?php echo $tweet->user->screen_name; ?></a> | <a href="/status?id=<?php echo $tweet->id; ?>"><?php echo $date; ?></a> |
	<?php endif; ?>
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
			if ($tweet->favorited === false) {
				echo '<a href="/favorite_create/' . $tweet->id . '/false" data-icon="&#x2a;" title="' . $xliff_reader->get('gbl-tweet-make-fav') . '"><span class="hide">' . $xliff_reader->get('gbl-tweet-make-fav') . '</span></a>';
			}
			else {
				echo '<a href="/favorite_destroy/' . $tweet->id . '/false" data-icon="&#x2a;" title="' . $xliff_reader->get('gbl-tweet-remove-fav') . '" class="favorited"><span class="hide">' . $xliff_reader->get('gbl-tweet-remove-fav') . '</span></a>';
			}
			?></li>
			<li><a href="/reply/<?php echo $tweet->id; ?>" data-icon="&#x41;" title="<?php echo $xliff_reader->get('gbl-tweet-reply'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-reply'); ?></span></a></li>
			<li><a href="/reply_all/<?php echo $tweet->id; ?>" data-icon="&#x3b;" title="<?php echo $xliff_reader->get('gbl-tweet-reply-all'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-reply-all'); ?></span></a></li>
			<li><?php
				if ($tweet->retweeted === false) {
					echo '<a href="/retweet?id=' . $tweet->id . '" data-icon="&#x3f;" title="' . $xliff_reader->get('gbl-tweet-retweet') . '"><span class="hide">' . $xliff_reader->get('gbl-tweet-retweet') . '</span></a>';
				}
				else {
					echo '<a data-icon="&#x3f;" class="retweeted" title="retweeted"><span class="hide">retweeted</span></a>';
				}
			?></li>
			<li><a href="/quote/<?php echo $tweet->id; ?>" data-icon="&#x30;" title="<?php echo $xliff_reader->get('gbl-tweet-quote'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-quote'); ?></span></a></li>
			<?php if (isset($tweet->user)): ?>
			<li><a href="mailto:?subject=Tweet from <?php echo $tweet->user->screen_name; ?> [via Easy Chirp]&amp;body=<?php echo urlencode($tweet->text); ?> [via EasyChirp.com]" data-icon="&#x31;" title="<?php echo $xliff_reader->get('gbl-tweet-email'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-email'); ?></span></a></li>
			<?php endif; ?>
		</ul>
	</div>
	<?php if (isset($tweet->user)): ?>
	<div class="btnOptions">
		<h3><a href="#userOptions_<?php echo $index; ?>" class="btnOptionsUser" title="<?php echo $xliff_reader->get('gbl-tweet-user-options'); ?>" data-icon="&#x3c;"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-user-options'); ?></span></a></h3>
		<ul id="userOptions_<?php echo $index; ?>">
			<li><a href="/user_timeline?user=<?php echo $tweet->user->screen_name; ?>" data-icon="&#x3e;" title="<?php echo $xliff_reader->get('gbl-tweet-timeline'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-timeline'); ?></span></a></li>
			<li><a href="/direct?user=<?php echo $tweet->user->screen_name; ?>" data-icon="&#x37;" title="<?php echo $xliff_reader->get('gbl-tweet-dm'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-dm'); ?></span></a></li>
			<li><a href="/timeline/<?php echo $tweet->user->screen_name; ?>" rel="twmess" data-icon="&#x38;" title="<?php echo $xliff_reader->get('gbl-tweet-tweet-message'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-tweet-message'); ?></span></a></li>
			<li><a href="/mute?user=<?php echo $tweet->user->screen_name; ?>" data-icon="&#x3d;" title="<?php echo $xliff_reader->get('gbl-tweet-mute'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-mute'); ?></span></a></li>
			<li><a href="/report_spam/<?php echo $tweet->user->screen_name; ?>/false" data-icon="&#x33;" title="<?php echo $xliff_reader->get('gbl-tweet-report'); ?>" class="spammer"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-report'); ?></span></a></li>
		</ul>
	</div>
	<?php endif; ?>
</div>
<?php

$index++;
endforeach;
	if (isset($paginate) && $paginate):
?>
	<a href="/timeline/<?php echo $last_id; ?>" class="button load_more" >Get Older Tweets</a>
<?php
	endif;
endif;
?>
</div>
<?php

