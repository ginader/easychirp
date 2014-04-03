<?php
/**
 * Display the contents of Direct Messages(DM) 
 *
 * @package EasyChirp
 * @subpackage Views
 * @author EasyChirp Dev Team
 * @see http://php.net/manual/en/class.datetime.php
 * @see http://www.php.net/manual/en/class.datetimezone.php
 * @see http://www.php.net/manual/en/function.date-format.php
 */
if (count($dms) != 0) {
	foreach($dms AS $dm):

	$state = "inbox";
	if ($dm->sender->screen_name===$this->session->userdata('screen_name')) {
		$state = "sent";
	}
?>
<div class="tweet rounded clearfix dm">
	<h2 class="hide"><?php echo $dm->sender->name?></h2>
	<div class="dmAvatars">
		<a href="/user/<?php echo $dm->sender->screen_name?>"><img src="<?php echo $dm->sender->profile_image_url; ?>" width="48" height="48" alt="<?php echo $dm->sender->screen_name?>" /></a>
		<img src="/images/arrowDm.png" width="12" height="24" alt="sent to" />
		<a href="/user/<?php echo $dm->recipient->screen_name?>"><img src="<?php echo $dm->recipient->profile_image_url; ?>" width="48" height="48" alt="<?php echo $dm->recipient->screen_name?>" /></a>
	</div>
	<q><?php echo $dm->text?></q>
	<p>
		from <a href="/user/<?php echo $dm->sender->screen_name?>"><?php echo $dm->sender->name?></a> 
		to <a href="/user/<?php echo $dm->recipient->screen_name?>"><?php echo $dm->recipient->name?></a> | 
		<?php
		$date = $dm->created_at;
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
		echo $date;
		?> 
	</p>
	<p class="dmActions"><a href="/direct_send_page/<?php 
		if ($state == "inbox") {
			echo $dm->sender->screen_name;
		}
		else {
			echo $dm->recipient->screen_name;
		}
		?>" class="btn" title="<?php echo $xliff_reader->get('gbl-tweet-dm'); ?>">
			<span aria-hidden="true" class="icon-bubbles"></span>
			<span class="hide"><?php echo $xliff_reader->get('gbl-tweet-dm'); ?></span>
		</a>
		<a href="/direct_delete/<?php echo $dm->id; ?>/false" class="btn" title="<?php echo $xliff_reader->get('global-delete'); ?>">
			<span aria-hidden="true" class="icon-close"></span>
			<span class="hide"><?php echo $xliff_reader->get('global-delete'); ?></span>
		</a></p>
</div>
<?php 
	endforeach;
}
else {
	echo '<div class="box1 rounded">';
	echo '<p style="margin: 1rem 0 .5rem;">'.$xliff_reader->get('search-saved-none').'</p>';
	echo '</div>';
}
?>
