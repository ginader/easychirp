<?php
if (isset($_GET["action"])) {
	if ($_GET["action"] == "subscribed") {
		echo '<div class="msgBoxPos rounded">You have subscribed to the list.</div>';
	}
}
?>

<h1 class="rounded"><?php echo $xliff_reader->get('lists-h1')." : @".$_GET["id"]; ?></h1>

<div class="p-row-r">
	<div class="p-col-1-2">

<div class="box1 rounded twList">
	<h2><?php echo $xliff_reader->get('lists-h1'); ?></h2>

<?php
if (count($ownedLists->lists) != 0) {
	foreach($ownedLists->lists AS $lists):
?>
<h3><span aria-hidden="true" class="icon-list"></span> <a title="view tweets from members of this list" href="/list_timeline?id=<?php echo $lists->id; ?>"><?php echo $lists->name; ?></a></h3>
<dl class="clearfix">
	<dt><?php echo $xliff_reader->get('lists-fullname'); ?></dt>
	<dd><?php echo $lists->full_name; ?></dd>
	
	<dt><?php echo $xliff_reader->get('lists-desc'); ?></dt>
	<dd><?php echo $lists->description; ?>&nbsp;</dd>
	
	<dt><?php echo $xliff_reader->get('lists-subs'); ?></dt>
	<?php /*<dd><a href="/list_subscribers?id=<?php echo $lists->id; ?>"><?php echo $lists->subscriber_count; ?></a></dd>*/?>
	<dd><?php echo $lists->subscriber_count; ?></dd>
	
	<dt><?php echo $xliff_reader->get('lists-mems'); ?></dt>
	<?php /*<dd><a href="/list_members?id=<?php echo $lists->id; ?>"><?php echo $lists->member_count; ?></a></dd>*/?>
	<dd><?php echo $lists->member_count; ?></dd>

	<?php /*
	<dt><?php echo $xliff_reader->get('lists-mode'); ?></dt>
	<dd><?php echo $lists->mode; ?></dd>
	*/ ?>

	<dt><?php echo $xliff_reader->get('lists-actions'); ?></dt>
	<dd><a rel="subList" href="/list_subscribe?id=<?php echo $lists->id; ?>&user=<?php echo $lists->user->screen_name; ?>">Subscribe</a></dd>

	<dt><?php echo $xliff_reader->get('lists-owner'); ?></dt>
	<dd><a href="/user?id=<?php echo $lists->user->screen_name; ?>"><?php echo $lists->user->name; ?></a></dd>

	<dt><?php echo $xliff_reader->get('lists-on-twitter'); ?></dt>
	<dd><a rel="external" target="_blank" href="http://twitter.com<?php echo $lists->uri; ?>"><?php echo $lists->name; ?></a></dd>
</dl>
<?php 
	endforeach;
}
else {
	echo '<p>'.$xliff_reader->get('search-saved-none').'</p>';
}
?>
</div>

	</div>
	<div class="p-col-1-2">

<div class="box1 rounded twList">
	<h2><?php echo $xliff_reader->get('lists-h2-sub'); ?></h2>

<?php
if (count($subLists->lists) != 0) {
	foreach($subLists->lists AS $lists):
?>

<h3><span aria-hidden="true" class="icon-list"></span> <a title="view tweets from members of this list" href="/list_timeline?id=<?php echo $lists->id; ?>&subscriber=true"><?php echo $lists->name; ?></a></h3>
<dl class="clearfix">
	<dt><?php echo $xliff_reader->get('lists-fullname'); ?></dt>
	<dd><?php echo $lists->full_name; ?></dd>
	
	<dt><?php echo $xliff_reader->get('lists-desc'); ?></dt>
	<dd><?php echo $lists->description; ?>&nbsp;</dd>
	
	<dt><?php echo $xliff_reader->get('lists-subs'); ?></dt>
	<?php /*<dd><a href="/list_subscribers?id=<?php echo $lists->id; ?>"><?php echo $lists->subscriber_count; ?></a></dd>*/?>
	<dd><?php echo $lists->subscriber_count; ?></dd>
	
	<dt><?php echo $xliff_reader->get('lists-mems'); ?></dt>
	<?php /*<dd><a href="/list_members?id=<?php echo $lists->id; ?>"><?php echo $lists->member_count; ?></a></dd>*/?>
	<dd><?php echo $lists->member_count; ?></dd>

	<?php /*
	<dt><?php echo $xliff_reader->get('lists-mode'); ?></dt>
	<dd><?php echo $lists->mode; ?></dd>
	*/ ?>

	<dt><?php echo $xliff_reader->get('lists-actions'); ?></dt>
	<dd><a rel="subList" href="/list_subscribe?id=<?php echo $lists->id; ?>&user=<?php echo $_GET["id"]; ?>">Subscribe</a></dd>

	<dt><?php echo $xliff_reader->get('lists-owner'); ?></dt>
	<dd><a href="/user?id=<?php echo $lists->user->screen_name; ?>"><?php echo $lists->user->name; ?></a></dd>

	<dt><?php echo $xliff_reader->get('lists-on-twitter'); ?></dt>
	<dd><a rel="external" target="_blank" href="http://twitter.com<?php echo $lists->uri; ?>"><?php echo $lists->name; ?></a></dd>
</dl>
<?php 
	endforeach;
}
else {
	echo '<p>'.$xliff_reader->get('search-saved-none').'</p>';
}
?>
</div>

	</div>
</div>
