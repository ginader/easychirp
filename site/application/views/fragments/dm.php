<?php
if (count($dms) != 0) {
	foreach($dms AS $dm):

	$state = "inbox";
	if ($dm->sender->screen_name===$this->session->userdata('screen_name')) {
		$state = "sent";
	}
?>
<div class="tweet rounded clearfix dm">
	<h2 class="hide"><?=$dm->sender->name?></h2>
	<div class="dmAvatars">
		<a href="/user?id=<?=$dm->sender->screen_name?>"><img src="<?=$dm->sender->profile_image_url; ?>" width="48" height="48" alt="<?=$dm->sender->screen_name?>" /></a>
		<img src="/images/arrowDm.png" width="12" height="24" alt="sent to" />
		<a href="/user?id=<?=$dm->recipient->screen_name?>"><img src="<?=$dm->recipient->profile_image_url; ?>" width="48" height="48" alt="<?=$dm->recipient->screen_name?>" /></a>
	</div>
	<q><?=$dm->text?></q>
	<p>
		from <a href="/user?id=<?=$dm->sender->screen_name?>"><?=$dm->sender->name?></a> 
		to <a href="/user?id=<?=$dm->recipient->screen_name?>"><?=$dm->recipient->name?></a> | 
		<?=$dm->created_at?> 
	</p>
	<div>
		<a href="/direct?user=<?php 
		if ($state == "inbox") {
			echo $dm->sender->screen_name;
		}
		else {
			echo $dm->recipient->screen_name;
		}
		?>" class="icon-bubbles btn" title="<?php echo $xliff_reader->get('gbl-tweet-dm'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-dm'); ?></span></a>
		<a href="/direct_delete/<?php echo $dm->id; ?>/false" class="btn icon-close" title="<?php echo $xliff_reader->get('global-delete'); ?>"><span class="hide"><?php echo $xliff_reader->get('global-delete'); ?></span></a>
	</div>
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
