<?php
foreach($dms AS $dm):
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
		from <a href="#"><?=$dm->sender->name?></a> to <a href="#"><?=$dm->recipient->name?></a> | 
		<?=$dm->created_at?> 
		<a href="#" class="delete icon-close"><span class="hide"><?php echo $xliff_reader->get('global-delete'); ?></span></a>
	</p>

	<?/*<div class="btnOptions">
	<ul style="display:block;">
		<li><a href="/user_timeline?user=<?php echo $dm->sender->screen_name; ?>" data-icon="&#x3e;" title="<?php echo $xliff_reader->get('gbl-tweet-timeline'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-timeline'); ?></span></a></li>
		<li><a href="/direct?user=<?php echo $dm->sender->screen_name; ?>" data-icon="&#x37;" title="<?php echo $xliff_reader->get('gbl-tweet-dm'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-dm'); ?></span></a></li>
		<li><a href="/timeline?twmess=<?php echo $dm->sender->screen_name; ?>" rel="twmess" data-icon="&#x38;" title="<?php echo $xliff_reader->get('gbl-tweet-tweet-message'); ?>"><span class="hide"><?php echo $xliff_reader->get('gbl-tweet-tweet-message'); ?></span></a></li>
	</ul>
	</div>
	*/?>
</div>
<?php 
endforeach;
?>
