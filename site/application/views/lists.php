<?php
if (isset($_GET["action"])) {
	if ($_GET["action"] == "deleted") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get("msg-list-deleted").'</div>';
	}
	elseif ($_GET["action"] == "created") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get("msg-list-created").'</div>';
	}
	elseif ($_GET["action"] == "empty_name") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get("msg-list-empty_name").'</div>';
	}
	elseif ($_GET["action"] == "unsubscribed") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get("msg-list-unsubscribed").'</div>';
	}
	elseif ($_GET["action"] == "member_added") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get("msg-list-member_added").'</div>';
	}
	elseif ($_GET["action"] == "empty_add_name") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get("msg-list-empty_add_name").'</div>';
	}
}
?>

<h1 class="rounded"><?php echo $xliff_reader->get('lists-h1'); ?></h1>

<p class="marginAdjustment"><?php echo $xliff_reader->get('lists-note1'); ?></p>

<div id="createList" class="box1 rounded" data-open="<?php echo $xliff_reader->get('lists-create-open'); ?>" data-close="<?php echo $xliff_reader->get('lists-create-close'); ?>">
	<h2><?php echo $xliff_reader->get('lists-h2-create'); ?></h2>
	<form action="list_create" method="post" id="frmCreateList">
	<div class="row">
		<label id="labelName" for="txt_listName"><?php echo $xliff_reader->get('lists-create-name'); ?></label>
		<span id="nameTip"><?php echo $xliff_reader->get('lists-create-name-tip'); ?></span>
		<input class="input1" aria-describedby="nameTip" required aria-required="true" id="txt_listName" name="txt_listName" type="text" size="25" maxlength="25" />
	</div>
	<div class="row">
		<label id="labelDesc" for="txt_listDesc"><?php echo $xliff_reader->get('lists-create-desc'); ?></label>
		<span id="descTip"><?php echo $xliff_reader->get('lists-create-desc-tip'); ?></span>
		<input class="input1" aria-describedby="descTip" id="txt_listDesc" name="txt_listDesc" type="text" size="50" maxlength="100" />
	</div>
	<div class="row">
		<fieldset>
			<legend><?php echo $xliff_reader->get('lists-create-privacy'); ?> <span class="normalText"><?php echo $xliff_reader->get('gbl-required'); ?></span></legend>
			<input value="public" id="modePublic" name="mode" type="radio" /> <label for="modePublic"><?php echo $xliff_reader->get('lists-create-privacy-public'); ?></label> &nbsp;  
			<input value="private" id="modePrivate" name="mode" type="radio" checked="checked" /> <label for="modePrivate"><?php echo $xliff_reader->get('lists-create-privacy-private'); ?></label>
		</fieldset>
	</div>
	<div><button type="submit"><?php echo $xliff_reader->get('lists-create-submit'); ?></button></div>
	</form>
</div>

<div class="p-row-r">
	<div class="p-col-1-2">

<div class="box1 rounded twList" style="margin-top: 0;" id="myLists" data-msg-list-added="<?php echo $xliff_reader->get("msg-list-member_added"); ?>">
	<h2><?php echo $xliff_reader->get('lists-h2-my'); ?></h2>

<?php
if (count($myLists->lists) != 0) {
	foreach($myLists->lists AS $lists):
?>
<h3><span aria-hidden="true" class="icon-list"></span> <a href="/list_timeline/<?php echo $lists->id; ?>/false"><?php echo $lists->name; ?></a></h3>
<dl class="clearfix">
	<dt><?php echo $xliff_reader->get('lists-fullname'); ?></dt>
	<dd><?php echo $lists->full_name; ?></dd>
	
	<dt><?php echo $xliff_reader->get('lists-desc'); ?></dt>
	<dd><?php echo $lists->description; ?>&nbsp;</dd>
	
	<dt><?php echo $xliff_reader->get('lists-subs'); ?></dt>
	<dd><a href="/list_subscribers/<?php echo $lists->user->screen_name; ?>/<?php echo $lists->id; ?>/<?php echo $lists->name; ?>"><?php echo $lists->subscriber_count; ?></a></dd>
	
	<dt><?php echo $xliff_reader->get('lists-mems'); ?></dt>
	<dd class="memCnt"><a href="/list_members/<?php echo $lists->user->screen_name; ?>/<?php echo $lists->id; ?>/<?php echo $lists->name; ?>"><?php echo $lists->member_count; ?></a></dd>

	<dt><?php echo $xliff_reader->get('lists-mode'); ?></dt>
	<dd><?php echo $lists->mode; ?></dd>

	<dt class="twListDtAdj"><label for="add<?php echo $lists->id; ?>"><?php echo $xliff_reader->get('lists-add-mem'); ?></label></dt>
	<dd>
		<form action="/list_add_member/false" method="post" class="frmListAddMember">
			<input type="hidden" name="listSlug" value="<?php echo $lists->slug; ?>" />
			<input type="hidden" name="lstid" value="<?php echo $lists->id; ?>" />
			<input type="text" size="11" name="userNameToAdd" value="" id="add<?php echo $lists->id; ?>" placeholder="<?php echo $xliff_reader->get('gbl-at-username'); ?>" required aria-required="true" />
			<button type="submit" class="btnSmall"><?php echo $xliff_reader->get('lists-add-submit'); ?></button>
		</form>
	</dd>

	<dt><?php echo $xliff_reader->get('lists-actions'); ?></dt>
	<dd>
		<a href="list_edit?id=<?php echo $lists->id; ?>"><?php echo $xliff_reader->get('lists-edit'); ?></a> | 
		<a class="delete-link" href="list_delete?id=<?php echo $lists->id; ?>"><span aria-hidden="true" class="icon-close1"></span> <?php echo $xliff_reader->get('global-delete'); ?></a>
	</dd>

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

	</div>
	<div class="p-col-1-2">

<div class="box1 rounded twList" style="margin-top:0;">
	<h2><?php echo $xliff_reader->get('lists-h2-sub'); ?></h2>

<?php
if (count($subLists->lists) != 0) {
	foreach($subLists->lists AS $lists):
?>

<h3><span aria-hidden="true" class="icon-list"></span> <a href="/list_timeline/<?php echo $lists->id; ?>/subscribed"><?php echo $lists->name; ?></a></h3>
<dl class="clearfix">
	<dt><?php echo $xliff_reader->get('lists-fullname'); ?></dt>
	<dd><?php echo $lists->full_name; ?></dd>
	
	<dt><?php echo $xliff_reader->get('lists-desc'); ?></dt>
	<dd><?php echo $lists->description; ?>&nbsp;</dd>
	
	<dt><?php echo $xliff_reader->get('lists-subs'); ?></dt>
	<dd><a href="/list_subscribers/<?php echo $lists->user->screen_name; ?>/<?php echo $lists->id; ?>/<?php echo $lists->name; ?>"><?php echo $lists->subscriber_count; ?></a></dd>
	
	<dt><?php echo $xliff_reader->get('lists-mems'); ?></dt>
	<dd><a href="/list_members/<?php echo $lists->user->screen_name; ?>/<?php echo $lists->id; ?>/<?php echo $lists->name; ?>"><?php echo $lists->member_count; ?></a></dd>

	<?php /*
	<dt><?php echo $xliff_reader->get('lists-mode'); ?></dt>
	<dd><?php echo $lists->mode; ?></dd>
	*/ ?>

	<dt><?php echo $xliff_reader->get('lists-owner'); ?></dt>
	<dd><a href="/user?id=<?php echo $lists->user->screen_name; ?>"><?php echo $lists->user->name; ?></a></dd>	

	<dt><?php echo $xliff_reader->get('lists-actions'); ?></dt>
	<dd><a href="/list_unsubscribe?id=<?php echo $lists->id; ?>" class="delete-link"><span aria-hidden="true" class="icon-close1"></span> <?php echo $xliff_reader->get('lists-unsubscribe'); ?></a></dd>

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

	</div>
</div>
