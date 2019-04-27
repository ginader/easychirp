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

function doMedia ($arMedia, $xliff_reader) {
	foreach ($arMedia as $medium) {

		echo '<div class="imgThumb"><img src="' . $medium->media_url . ':small" alt="';
		if (isset($medium->ext_alt_text)) {
			echo htmlentities($medium->ext_alt_text);
		}
		echo '" /></div>';

		// show alt
		if (isset($medium->ext_alt_text)) {
			echo "<button class=\"btnSecondary\"><span aria-hidden=\"true\"></span>".$xliff_reader->get('gbl-img-desc')."</button>";
			echo "<div class=\"imageDesc rounded\"><p>".htmlentities($medium->ext_alt_text)."</p></div>";
		}

		// Video/gif link
		if (isset($medium->video_info->variants)) {
			echo '<div class="vidLink">';
			$arVideos = $medium->video_info->variants;
			if (isset($arVideos[0]->url) && (strpos($arVideos[0]->url, 'mp4') !== false) ) {
				$videoHTML = '<a rel="noopener noreferrer" target="_blank" href="'.$arVideos[0]->url.'"><svg class="icon"><use xlink:href="#icon-play"></use></svg>'.$xliff_reader->get('gbl-play-video').'</a>';
			}
			else if (isset($arVideos[1]->url) && (strpos($arVideos[1]->url, 'mp4') !== false) ) {
				$videoHTML = '<a rel="noopener noreferrer" target="_blank" href="'.$arVideos[1]->url.'"><svg class="icon"><use xlink:href="#icon-play"></use></svg>'.$xliff_reader->get('gbl-play-video').'</a>';
			}
			else {
				$videoHTML = "Video link not found.";
			}
			echo $videoHTML;
			echo '</div>';
		}
	}
}

$index = 0;

if (isset($tweets) && sizeof($tweets) > 0):

$i = sizeof($tweets) - 1;
$last_id = $tweets[$i]->id;

foreach($tweets AS $tweet):

	// FILTER!
	// check tweet text against array of values
	if ($this->layout->pol_bool == "on") {
		$termsPolitics = array("trump","potus","politic","refugee","immigrant","republican","democrat");
		if (preg_match('/'.implode('|', $termsPolitics).'/i', $tweet->full_text)) {
			continue;
		}
		if (isset($tweet->quoted_status)) {
			if (preg_match('/'.implode('|', $termsPolitics).'/i', $tweet->quoted_status->text)) {
				continue;
			}
		}
	}

	//date
	$api_date = $tweet->created_at;  // Fri Jun 14 00:49:09 +0000 2013
	$z = new DateTime('@' . strtotime($api_date));
	$x  = $utc_offset . " seconds";
	$date = date_modify($z, $x);
	$date = date_format($date,"d M g:i a");

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
	<img src="<?php echo $tweet->user->profile_image_url; ?>" width="48" height="48" alt="" />
	<h2 class="hide"><?php echo $tweet->user->name; ?></h2>
	<?php endif; ?>

	<?php
		if ($tweet->favorited === true) {
			echo '<div class="fave" aria-hidden="true">★</div>';
		}
	?>

	<q lang="<?php echo $tweet->lang; ?>"><?php
	// Define the text of the tweet
	if ($isRetweet) {
		$tweet_text = "RT @" . $tweet->retweeted_status->user->screen_name . " " . $tweet->retweeted_status->full_text;
	}
	else {
		$tweet_text = $tweet->full_text;
	}

	// Link links
	$tweet_text = preg_replace('#\b(https?://[\w\d\/\.]+)\b#', '<a rel="noopener noreferrer" target="_blank" href="\1">\1</a>', $tweet_text);

	// Link @usernames
	$tweet_text = preg_replace('/@+([-_0-9a-zA-Z]+)/', '<a href="/user/$1">$0</a>', $tweet_text);

	// Link #hashtags
	$tweet_text = preg_replace('/\B#([-_0-9a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ]+)/', '<a href="/search_results?query=%23$1">$0</a>', $tweet_text);

	// Line breaks
	$tweet_text = preg_replace('/\n/', '<br>', $tweet_text);

	// Output tweet text;
	echo $tweet_text;
	?></q>

	<?php 
	// Quoted tweet exist?
	if (isset($tweet->quoted_status)) {

		$api_date = $tweet->quoted_status->created_at;  // Fri Jun 14 00:49:09 +0000 2013
		$z = new DateTime('@' . strtotime($api_date));
		$x  = $utc_offset . " seconds";
		$date1 = date_modify($z, $x);
		$date2 = date_format($date1,"d M g:i a");

		// Link links
		$quoted_tweet_text = preg_replace('#\b(https?://[\w\d\/\.]+)\b#', '<a rel="noopener noreferrer" target="_blank" href="\1">\1</a>', $tweet->quoted_status->full_text);

		// Link #hashtags
		$quoted_tweet_text = preg_replace('/\B#([-_0-9a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ]+)/', '<a href="/search_results?query=%23$1">$0</a>', $quoted_tweet_text);

		// Line breaks
		$quoted_tweet_text = preg_replace('/\n/', '<br>', $quoted_tweet_text);

		echo '<div class="box1 rounded quotedTweet">';
		echo '<h3 title="'.$tweet->quoted_status->user->name.'">@'.$tweet->quoted_status->user->screen_name;
		echo '<span class="hide"> - '.$xliff_reader->get('quote-h1').'</span></h3>';
		echo '<q lang="'.$tweet->quoted_status->lang.'">'.$quoted_tweet_text.'</q>';

		// Twitter image
		if (isset($tweet->quoted_status->entities->media[0]->media_url)) {
			doMedia($tweet->quoted_status->extended_entities->media, $xliff_reader);
		}

		echo '<p><a href="/status/'.$tweet->quoted_status_id.'">'.$date2.'</a></p>';
		echo '</div>';
	}

	// Insert Twitter image if it exists
	if (isset($tweet->extended_entities->media[0]->media_url)) {
		doMedia($tweet->extended_entities->media, $xliff_reader);
	}

	//echo debug_object( $tweet );
	
	// Imgur image
	foreach ($tweet->entities->urls as $xurl) {
		$ent_exp_url = $xurl->expanded_url;
		if (strpos($ent_exp_url,'easychirp.com/img/') !== false) {
			$pos = strpos($ent_exp_url, 'easychirp.com/img/');
			$imgurId = substr( $ent_exp_url, $pos+18, strlen($ent_exp_url) );
		    echo '<div class="imgThumb"><img src="http://i.imgur.com/' . $imgurId . 'b.jpg" width="160" height="160" alt="" /></div>';
		}
	}

	// Output tweet details
	if ($this->session->userdata('lang_code') != 'ar') { 
		$tweet_title = $tweet->user->name . '; ' . $xliff_reader->get('followers-h1'). ' ' . $tweet->user->followers_count . '; ' . $xliff_reader->get('following-h1') . ' ' . $tweet->user->friends_count;
	?>
		<p><?php echo $xliff_reader->get('gbl-from'); ?>
		<a href="/user/<?php echo $tweet->user->screen_name; ?>" title="<?php echo $tweet_title; ?>"><?php echo $tweet->user->screen_name; ?></a>
		| <a href="/status/<?php echo $tweet->id; ?>"><?php echo $date; ?></a> | 
		<?php
		// Is reply or retweet?
		if ($isReply) {
			echo ' <a rel="response" href="/status/'.$tweet->in_reply_to_status_id.'">' . $xliff_reader->get('gbl-tweet-responding') . '</a> | ';
		}
		if ($isRetweet) {
			echo ' <a rel="retweet" href="/status/'.$tweet->retweeted_status->id.'">' . $xliff_reader->get('gbl-tweet-retweet') . '</a> | ';
		}
		// title="View the tweet to which this tweet is responding"
		// title="View the original tweet (this is a retweet)"

		// Number of retweets - display if not zero
		if ($tweet->retweet_count > 0) {
			echo $xliff_reader->get('nav-retweets').': '.$tweet->retweet_count.' | ';
		}

		// Number of favorites - display if not zero
		if ($tweet->favorite_count > 0) {
			echo $xliff_reader->get('nav-favorites').': '.$tweet->favorite_count.' | ';
		}
		?>
		via <?php echo $tweet->source; ?></p>
	<?php 
	}
	// Arabic version of tweet details
	else { ?>
		<ul class="twtInfo clearfix">
			<li><?php echo $xliff_reader->get('gbl-from'); ?> <a href="/user/<?php echo $tweet->user->screen_name; ?>"><?php echo $tweet->user->screen_name; ?></a></li>
			<li><a href="/status/<?php echo $tweet->id; ?>"><?php echo $date; ?></a></li>
			<?
			if ($isReply) {
				echo '<li><a rel="response" href="/status/'.$tweet->in_reply_to_status_id.'">' . $xliff_reader->get('gbl-tweet-responding') . '</a></li>';
			}
			if ($isRetweet) {
				echo '<li><a rel="retweet" href="/status/'.$tweet->retweeted_status->id.'">' . $xliff_reader->get('gbl-tweet-retweet') . '</a></li>';
			}
			?>
			<li><?php echo $tweet->source; ?></li>
		</ul>
	<?php
	}
	?>
	<div class="btnOptions">
		<h3><a href="#tweetOptions_<?php echo $index; ?>" class="btnOptionsTweet"><span aria-hidden="true" class="icon-gear"></span><?php echo $xliff_reader->get('gbl-tweet-tweet-options'); ?><span aria-hidden="true"></span></a></h3>
		<ul id="tweetOptions_<?php echo $index; ?>">
			<li><?php
			// If favorited or not
			if ($tweet->favorited === false) {
				echo '<a href="/favorite_create/' . $tweet->id . '/false"><span aria-hidden="true" class="icon-star"></span><span>' . $xliff_reader->get('gbl-tweet-make-fav') . '</span></a>';
			}
			else {
				echo '<a href="/favorite_destroy/' . $tweet->id . '/false" class="favorited"><span aria-hidden="true" class="icon-star"></span><span>' . $xliff_reader->get('gbl-tweet-remove-fav') . '</span></a>';
			}
			?></li>
			<li><a href="/reply/<?php echo $tweet->id; ?>"><span aria-hidden="true" class="icon-arrow3"></span><?php echo $xliff_reader->get('gbl-tweet-reply'); ?></a></li>
			<li><a href="/reply_all/<?php echo $tweet->id; ?>"><span aria-hidden="true" class="icon-users"></span><?php echo $xliff_reader->get('gbl-tweet-reply-all'); ?></a></li>
			<li><?php 
				if ($tweet->retweeted === false) 
				{ 
					echo '<a href="/retweet_create/' . $tweet->id . '/false"><span aria-hidden="true" class="icon-reload1"></span><span>' . $xliff_reader->get('gbl-tweet-make-rt') . '</span></a>';
				}
				else 
				{
					echo '<a class="retweeted"><span aria-hidden="true" class="icon-reload1"></span>retweeted</a>';
				}
			?></li>
			<li><a href="/quote/<?php echo $tweet->id; ?>"><span aria-hidden="true" class="icon-quote"></span><?php echo $xliff_reader->get('gbl-tweet-quote'); ?></a></li>
			<?php if (isset($tweet->user)): ?>
			<li><a href="mailto:?subject=Tweet%20from%20@<?php echo $tweet->user->screen_name; ?>%20(via%20Easy%20Chirp)&amp;body=<?php echo $tweet->full_text . " %0D%0A%0D%0A" . $date . " %0D%0A%0D%0A"; ?>via%20@EasyChirp%20http://www.EasyChirp.com">
				<span aria-hidden="true" class="icon-mail"></span><?php echo $xliff_reader->get('gbl-tweet-email'); ?></a></li>
			<?php endif; ?>
			<?php 
			if ($tweet->user->screen_name == $this->session->userdata('screen_name')): 
				echo '<li><a href="/tweet_delete/'.$tweet->id.'/false"><span aria-hidden="true" class="icon-close"></span>'.strtolower($xliff_reader->get('global-delete')).'</a></li>';
			endif;
			?>
		</ul>
	</div>
	<?php 
	if (isset($tweet->user)): 
		if ($tweet->user->screen_name != $this->session->userdata('screen_name')): 
	?>
	<div class="btnOptions">
		<h3><a href="#userOptions_<?php echo $index; ?>" class="btnOptionsUser"><span aria-hidden="true" class="icon-user"></span><?php echo $xliff_reader->get('gbl-tweet-user-options'); ?><span aria-hidden="true"></span></a></h3>
		<ul id="userOptions_<?php echo $index; ?>">
			<li><a href="/user_timeline/<?php echo $tweet->user->screen_name; ?>"><span aria-hidden="true" class="icon-list2"></span><?php echo $xliff_reader->get('gbl-tweet-timeline'); ?></a></li>
			<?php /* <li><a href="/direct_send_page/<?php echo $tweet->user->screen_name; ?>"><span aria-hidden="true" class="icon-bubbles"></span><?php echo $xliff_reader->get('gbl-tweet-dm'); ?></a></li> */ ?>
			<li><a href="/timeline/<?php echo $tweet->user->screen_name; ?>" rel="twmess"><span aria-hidden="true" class="icon-at"></span><?php echo $xliff_reader->get('gbl-tweet-tweet-message'); ?></a></li>
			<li><a href="/user_lists/<?php echo $tweet->user->screen_name; ?>"><span aria-hidden="true" class="icon-list"></span><?php echo $xliff_reader->get('profile-dt-lists'); ?></a></li>
			<li><a href="/report_spam/<?php echo $tweet->user->screen_name; ?>/false" class="spammer"><span aria-hidden="true" class="icon-alert"></span><?php echo $xliff_reader->get('gbl-tweet-report'); ?></a></li>
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

// Pagination
if (empty($pagination_path)):
	$pagination_path = '/timeline/';
endif;
if (isset($paginate) && $paginate):
?>
	<div class="box1 rounded load-more">
		<a href="<?php echo $pagination_path . $last_id; ?>" class="button load_more"><?php echo $xliff_reader->get('gbl-pag-tweets'); ?></a>
	</div>
<?php
endif;
else:
	echo '<div class="box1 rounded">';
	echo '<p style="margin: 1rem 0 .5rem;">' . $xliff_reader->get('search-saved-none') . '</p>';
	echo '</div>';
endif;
?>

<?php
if (isset($paginateSearch) && $paginateSearch && sizeof($tweets) > 0) {
	echo '<div class="box1 rounded load-more">';
	if (sizeof($tweets) == 1) {
		echo 'No more found.';
	}
	else {
		$pagination_path = '/search_results?query='.$meta->query.'&max_id='.$last_id;
		echo '<a href="'.$pagination_path.'" class="button load_more">'.$xliff_reader->get('gbl-pag-tweets').'</a>';
	}
	echo '</div>';
}
?>

<?php
//debug_object( $tweet );
//echo json_encode($tweet); 

