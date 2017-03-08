<h1 class="rounded">
<?php
echo $xliff_reader->get('listed-h1');// . " : ". $username;
?>
</h1>

<p class="marginAdjustment"><?php echo $xliff_reader->get('listed-you-are-member'); ?></p>

<div class="box1 rounded twList">

<?php
if (count($listed->lists) != 0) {
	foreach($listed->lists AS $lists):
?>
<h3><span aria-hidden="true" class="icon-list"></span> <a href="/list_timeline/<?php echo $lists->id; ?>/subscribed"><?php echo $lists->name; ?></a></h3>
<dl class="clearfix listed">
	<dt><?php echo $xliff_reader->get('lists-fullname'); ?></dt>
	<dd><?php echo $lists->full_name; ?></dd>
	
	<dt><?php echo $xliff_reader->get('lists-desc'); ?></dt>
	<dd><?php echo $lists->description; ?>&nbsp;</dd>
	
	<dt><?php echo $xliff_reader->get('lists-subs'); ?></dt>
	<dd><a href="/list_subscribers/<?php echo $lists->user->screen_name; ?>/<?php echo $lists->id; ?>/<?php echo $lists->name; ?>"><?php echo $lists->subscriber_count; ?></a></dd>
	
	<dt><?php echo $xliff_reader->get('lists-mems'); ?></dt>
	<dd><a href="/list_members/<?php echo $lists->user->screen_name; ?>/<?php echo $lists->id; ?>/<?php echo $lists->name; ?>"><?php echo $lists->member_count; ?></a></dd>

	<dt><?php echo $xliff_reader->get('lists-owner'); ?></dt>
	<dd><a href="/user?id=<?php echo $lists->user->screen_name; ?>"><?php echo $lists->user->name; ?></a></dd>	

	<dt><?php echo $xliff_reader->get('lists-on-twitter'); ?></dt>
	<dd><?php 
		$listURL = "http://twitter.com/" . $lists->user->screen_name . "/lists/" . $lists->slug;
		echo '<a rel="noopener noreferrer" target="_blank" href="' . $listURL . '">' . $lists->name . '</a>';
		?>
	</dd>
</dl>
<?php 
	endforeach;
}
else {
	echo '<p>'.$xliff_reader->get('search-saved-none').'</p>';
}
?>

</div>

<?php
// Pagination
if ($listed->next_cursor != 0 || $listed->previous_cursor != 0) {
	echo '<div class="box1 rounded load-more load-more-1-line">';
	if ($listed->previous_cursor != 0) {
		// also show previous set link
		echo '<a href="/listed/'.$listed->previous_cursor.'">Previous Set</a>';
	}
	if ($listed->next_cursor != 0 && $listed->previous_cursor != 0) {
		echo ' | ';
	}
	if ($listed->next_cursor != 0) {
		echo '<a href="/listed/'.$listed->next_cursor.'">Next Set</a>';
	}
	echo '</div>';
}

