<?php
/**
* Fragment - Displays the contents of tweets and their controls  
*
* @package EasyChirp
* @subpackage Views
* @author EasyChirp Dev Team
* @see http://www.php.net/manual/en/function.date-format.php
* @see http://www.php.net/manual/en/class.datetimezone.php
* @see http://www.php.net/manual/en/class.datetime.php
*/

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
	try
	{
		$display_tz = new DateTimeZone($time_zone);
	}
	catch (Exception $e)
	{
		$display_tz = new DateTimeZone('America/Los_Angeles');
	}

	$tweet_date->setTimeZone($display_tz);

	$date = date_format($tweet_date, DISPLAY_DATETIME_FORMAT);

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
	<h2 class="hide"><?php echo $tweet->user->name; ?></h2>
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
	$tweet_text = preg_replace('/@+([-_0-9a-zA-Z]+)/', '<a href="/user/$1">$0</a>', $tweet_text);

	// Link #hashtags
	$tweet_text = preg_replace('/\B#([-_0-9a-zA-Z]+)/', '<a href="/search_results/%23$1" title="search this term">$0</a>', $tweet_text);

	echo $tweet_text;
	?></q>
	<?php if (isset($tweet->user)):
		$tweet_title = $tweet->user->name . '; followers ' . $tweet->user->followers_count . '; following ' . $tweet->user->friends_count;
	?>
	<p><?php echo $xliff_reader->get('gbl-from'); ?>
	<a href="/user/<?php echo $tweet->user->screen_name; ?>" title="<?php echo $tweet_title; ?>"> <?php echo $tweet->user->screen_name; ?></a>
		| <a href="/status/<?php echo $tweet->id; ?>"><?php echo $date; ?></a> |
	<?php endif; ?>
		<?php
		// Is reply or retweet?
		if ($isReply) {
			echo ' <a rel="response" title="View the tweet to which this tweet is responding" href="/status/'.$tweet->in_reply_to_status_id.'">' . $xliff_reader->get('gbl-tweet-responding') . '</a> | ';
		}
		if ($isRetweet) {
			echo ' <a rel="retweet" title="View the original tweet (this is a retweet)" href="/status/'.$tweet->retweeted_status->id.'">' . $xliff_reader->get('gbl-tweet-retweet') . '</a> | ';
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
		<h3><a href="#tweetOptions_<?php echo $index; ?>" class="btnOptionsTweet" title="<?php echo $xliff_reader->get('gbl-tweet-tweet-options'); ?>"><span aria-hidden="true" class="icon-gear"></span><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-tweet-options'); ?></span></a></h3>
		<ul id="tweetOptions_<?php echo $index; ?>">
			<li><?php
			// If favorited or not
			if ($tweet->favorited === false) {
				echo '<a href="/favorite_create/' . $tweet->id . '/false" title="' . $xliff_reader->get('gbl-tweet-make-fav') . '"><span aria-hidden="true" class="icon-star"></span><span class="hide">' . $xliff_reader->get('gbl-tweet-make-fav') . '</span></a>';
			}
			else {
				echo '<a href="/favorite_destroy/' . $tweet->id . '/false" title="' . $xliff_reader->get('gbl-tweet-remove-fav') . '" class="favorited"><span aria-hidden="true" class="icon-star"></span><span class="hide">' . $xliff_reader->get('gbl-tweet-remove-fav') . '</span></a>';
			}
			?></li>
			<li><a href="/reply/<?php echo $tweet->id; ?>" title="<?php echo $xliff_reader->get('gbl-tweet-reply'); ?>"><span aria-hidden="true" class="icon-arrow3"></span><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-reply'); ?></span></a></li>
			<li><a href="/reply_all/<?php echo $tweet->id; ?>" title="<?php echo $xliff_reader->get('gbl-tweet-reply-all'); ?>"><span aria-hidden="true" class="icon-users"></span><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-reply-all'); ?></span></a></li>
			<li><?php 
				if ($tweet->retweeted === false) 
				{ 
					echo '<a href="/retweet_create/' . $tweet->id . '/false" title="' . $xliff_reader->get('gbl-tweet-make-rt') . '"><span aria-hidden="true" class="icon-reload1"></span><span class="hide">' . $xliff_reader->get('gbl-tweet-make-rt') . '</span></a>';
				}
				else 
				{
					echo '<a class="retweeted" title="retweeted"><span aria-hidden="true" class="icon-reload1"></span><span class="hide">retweeted</span></a>';
				}
			?></li>
			<li><a href="/quote/<?php echo $tweet->id; ?>" title="<?php echo $xliff_reader->get('gbl-tweet-quote'); ?>"><span aria-hidden="true" class="icon-quote"></span><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-quote'); ?></span></a></li>
			<?php if (isset($tweet->user)): ?>
			<li><a href="mailto:?subject=Tweet from <?php echo $tweet->user->screen_name; ?> [via Easy Chirp]&amp;body=<?php echo htmlentities($tweet->text); ?> [via EasyChirp.com]" title="<?php echo $xliff_reader->get('gbl-tweet-email'); ?>">
				<span aria-hidden="true" class="icon-mail"></span><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-email'); ?></span></a></li>
			<?php endif; ?>
			<?php 
			if ($tweet->user->screen_name == $this->session->userdata('screen_name')): 
				echo '<li><a href="/tweet_delete/'.$tweet->id.'/false" title="'.$xliff_reader->get('global-delete').'"><span aria-hidden="true" class="icon-close"></span><span class="hide">'.$xliff_reader->get('global-delete').'</span></a></li>';
			endif;
			?>
		</ul>
	</div>
	<?php 
	if (isset($tweet->user)): 
		if ($tweet->user->screen_name != $this->session->userdata('screen_name')): 
	?>
	<div class="btnOptions">
		<h3><a href="#userOptions_<?php echo $index; ?>" class="btnOptionsUser" title="<?php echo $xliff_reader->get('gbl-tweet-user-options'); ?>"><span aria-hidden="true" class="icon-user"></span><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-user-options'); ?></span></a></h3>
		<ul id="userOptions_<?php echo $index; ?>">
			<li><a href="/user_timeline/<?php echo $tweet->user->screen_name; ?>" title="<?php echo $xliff_reader->get('gbl-tweet-timeline'); ?>"><span aria-hidden="true" class="icon-list2"></span><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-timeline'); ?></span></a></li>
			<li><a href="/direct/<?php echo $tweet->user->screen_name; ?>" title="<?php echo $xliff_reader->get('gbl-tweet-dm'); ?>"><span aria-hidden="true" class="icon-bubbles"></span><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-dm'); ?></span></a></li>
			<li><a href="/timeline/<?php echo $tweet->user->screen_name; ?>" rel="twmess" title="<?php echo $xliff_reader->get('gbl-tweet-tweet-message'); ?>"><span aria-hidden="true" class="icon-at"></span><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-tweet-message'); ?></span></a></li>
			<li><a href="/user_lists/<?php echo $tweet->user->screen_name; ?>" title="<?php echo $xliff_reader->get('profile-dt-lists'); ?>"><span aria-hidden="true" class="icon-list"></span><span class="hide"><?php echo $xliff_reader->get('profile-dt-lists'); ?></span></a></li>
			<li><a href="/report_spam/<?php echo $tweet->user->screen_name; ?>/false" title="<?php echo $xliff_reader->get('gbl-tweet-report'); ?>" class="spammer"><span aria-hidden="true" class="icon-alert"></span><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-report'); ?></span></a></li>
		</ul>
	</div>
	<?php 
		endif;
	endif; 
	?>
</div>
<?php

$index++;
endforeach;
	if (empty($pagination_path)):
		$pagination_path = '/timeline/';
	endif;
	if (isset($paginate) && $paginate):
?>
	<div class="box1 rounded load-more">
		<a href="<?php echo $pagination_path . $last_id; ?>" class="button load_more" >Get Older Tweets</a>
	</div>
<?php
	endif;
endif;
?>
</div>
<?php

