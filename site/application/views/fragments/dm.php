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
	foreach($dms->events AS $dm):

	// $state = "inbox";
	// if ($dm->sender->screen_name===$this->session->userdata('screen_name')) { NEED TO FIX
	// if ($dm->message_create->sender_id===$this->session->userdata('screen_name')) {
	// 	$state = "sent";
	// }

	$dm_text = $dm->message_create->message_data->text;

	// Link links
	$dm_text = preg_replace('#\b(https?://[\w\d\/\.]+)\b#', '<a rel="noopener noreferrer" target="_blank" href="\1">\1</a>', $dm_text);

	// Link @usernames
	$dm_text = preg_replace('/@+([-_0-9a-zA-Z]+)/', '<a href="/user/$1">$0</a>', $dm_text);

	// Link #hashtags
	$dm_text = preg_replace('/\B#([-_0-9a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ]+)/', '<a href="/search_results?query=%23$1">$0</a>', $dm_text);

	
	$senderName = $dm->message_create->sender_id;
	if ($user_id == $senderName) {
		$senderName = $screen_name;
		$dmIncoming = false;
	}
	
	$recipientName = $dm->message_create->target->recipient_id;
	if ($user_id == $recipientName) {
		$recipientName = $screen_name;
		$dmIncoming = true;
	}
?>
<div class="tweet rounded clearfix dm">
	<h2 class="hide"><?php //echo $dm->sender->name?></h2>
	<?php /* <div class="dmAvatars">
		<a href="/user/<?php echo $dm->sender->screen_name?>"><img src="<?php echo $dm->sender->profile_image_url; ?>" width="48" height="48" alt="<?php echo $dm->sender->screen_name?>" /></a>
		<span aria-hidden="true" class="icon-arrow2"></span><span class="hide">sent to</span>
		<a href="/user/<?php echo $dm->recipient->screen_name?>"><img src="<?php echo $dm->recipient->profile_image_url; ?>" width="48" height="48" alt="<?php echo $dm->recipient->screen_name?>" /></a>
	</div> */?>

	<?php /* <div class="dmAvatars">
		<a href="/user/<?php echo $senderName ?>"><img src="foo" width="48" height="48" alt="<?php echo $senderName ?>" /></a>
		<span aria-hidden="true" class="icon-arrow2"></span><span class="hide">sent to</span>
		<a href="/user/<?php echo $recipientName ?>"><img src="foo" width="48" height="48" alt="<?php echo $recipientName ?>" /></a>
	</div> */?>

	<q><?php echo $dm_text; ?></q>
	
	<p>
		from <?php echo $senderName; ?>
		to <?php echo $recipientName; ?> | 

		<?php /* from <a href="/user/<?php echo $senderName; ?>"><?php echo $senderName; ?></a> 
		to <a href="/user/<?php echo $recipientName; ?>"><?php echo $recipientName; ?></a> |  */?>
		<?php
		//date
		$api_date = gmdate("D M d G:i:s",$dm->created_timestamp); // TO Fri Jun 14 00:49:09 FROM 1529259015420
		$z = new DateTime('@' . strtotime($api_date));
		$x  = $this->session->userdata('utc_offset') . " seconds";
		$date = date_modify($z, $x);
		$date = date_format($date,"d M g:i a");
		echo $date;
		?>
	</p>
	<?php /* <p class="dmActions"><a href="/direct_send_page/<?php 
		if ($dmIncoming == true) {
			echo $dm->message_create->sender_id;
		}
		else {
			echo $dm->message_create->target->recipient_id;
		}
		?>" class="btn">
			<span aria-hidden="true" class="icon-bubbles"></span>
			<?php echo $xliff_reader->get('gbl-tweet-dm'); ?>
		</a>
		<a href="/direct_delete/<?php echo $dm->id; ?>/false" class="btn">
			<span aria-hidden="true" class="icon-close"></span>
			<?php echo strtolower($xliff_reader->get('global-delete')); ?>
		</a></p> */?>
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
