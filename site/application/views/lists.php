<h1 class="rounded"><?php echo $xliff_reader->get('lists-h1'); ?></h1>

<p class="marginAdjustment"><?php echo $xliff_reader->get('lists-note1'); ?></p>

<div id="createList" class="box1 rounded" data-open="<?php echo $xliff_reader->get('lists-create-open'); ?>" data-close="<?php echo $xliff_reader->get('lists-create-close'); ?>">
	<h2><?php echo $xliff_reader->get('lists-h2-create'); ?></h2>
	<form action="actions/doListCreate.php" method="post" id="frmCreateList">
	<div class="row">
		<label id="labelName" for="txt_listName"><?php echo $xliff_reader->get('lists-create-name'); ?></label>
		<span id="nameTip"><?php echo $xliff_reader->get('lists-create-name-tip'); ?></span>
		<input class="input1" aria-describedby="nameTip" required="required" id="txt_listName" name="txt_listName" type="text" size="25" maxlength="25" />
	</div>
	<div class="row">
		<label id="labelDesc" for="txt_listDesc"><?php echo $xliff_reader->get('lists-create-desc'); ?></label>
		<span id="descTip"><?php echo $xliff_reader->get('lists-create-desc-tip'); ?></span>
		<input class="input1" aria-describedby="descTip" id="txt_listDesc" name="txt_listDesc" type="text" size="50" maxlength="100" />
	</div>
	<div class="row">
		<fieldset>
			<legend><?php echo $xliff_reader->get('lists-create-privacy'); ?> <span class="normalText">(required)</span></legend>
			<input value="public" id="modePublic" name="mode" type="radio" /> <label for="modePublic"><?php echo $xliff_reader->get('lists-create-privacy-public'); ?></label> &nbsp;  
			<input value="private" id="modePrivate" name="mode" type="radio" checked="checked" /> <label for="modePrivate"><?php echo $xliff_reader->get('lists-create-privacy-private'); ?></label>
		</fieldset>
	</div>
	<div><button type="submit"><?php echo $xliff_reader->get('lists-create-submit'); ?></button></div>
	</form>
</div>

<div class="p-row-r">
	<div class="p-col-1-2">

<div class="box1 rounded twList" style="margin-top:0;">
	<h2><?php echo $xliff_reader->get('lists-h2-my'); ?></h2>

<?php
foreach($myLists->lists AS $lists):
?>
<h3><span aria-hidden="true" class="icon-list2"></span> <a title="view tweets from members of this list" href="/list_timeline?id=<?php echo $lists->id; ?>"><?php echo $lists->name; ?></a></h3>
<dl class="clearfix">
	<dt><?php echo $xliff_reader->get('lists-fullname'); ?></dt>
	<dd><?php echo $lists->full_name; ?></dd>
	
	<dt><?php echo $xliff_reader->get('lists-desc'); ?></dt>
	<dd><?php echo $lists->description; ?>&nbsp;</dd>
	
	<dt><?php echo $xliff_reader->get('lists-subs'); ?></dt>
	<dd><a href="/list_subscribers?id=<?php echo $lists->id; ?>"><?php echo $lists->subscriber_count; ?></a></dd>
	
	<dt><?php echo $xliff_reader->get('lists-mems'); ?></dt>
	<dd><a href="/list_members?id=<?php echo $lists->id; ?>"><?php echo $lists->member_count; ?></a></dd>

	<dt><?php echo $xliff_reader->get('lists-mode'); ?></dt>
	<dd><?php echo $lists->mode; ?></dd>

	<?php /*
	<dt class="twListDtAdj"><label for="add<?php echo $lists->id; ?>"><?php echo $xliff_reader->get('lists-add-mem'); ?></label></dt>
	<dd>
		<form action="#" class="frmListAddMember">
			<input type="hidden" name="listSlug" value="<?php echo $lists->slug; ?>" />
			<input type="hidden" name="lstid" value="<?php echo $lists->id; ?>" />
			<input type="text" size="12" name="userNameToAdd" value="" id="add<?php echo $lists->id; ?>" placeholder="<?php echo $xliff_reader->get('lists-add-placeholder'); ?>" />
			<button type="submit" class="btnSmall"><?php echo $xliff_reader->get('lists-add-submit'); ?></button>
		</form>
	</dd>

	<dt><?php echo $xliff_reader->get('lists-actions'); ?></dt>
	<dd><a href="list_edit?id=<?php echo $lists->id; ?>"><?php echo $xliff_reader->get('lists-edit'); ?></a> | <a rel="deleteList" class="delete-link" href="actions/doDeleteList.php?id=<?php echo $lists->id; ?>"><span aria-hidden="true" class="icon-close1"></span> <?php echo $xliff_reader->get('global-delete'); ?></a></dd>
	*/?>

	<dt><?php echo $xliff_reader->get('lists-on-twitter'); ?></dt>
	<dd><a rel="external" href="http://twitter.com<?php echo $lists->uri; ?>"><?php echo $lists->name; ?></a></dd>
</dl>
<?php 
endforeach;
?>
</div>

	</div>
	<div class="p-col-1-2">

<div class="box1 rounded twList" style="margin-top:0;">
	<h2><?php echo $xliff_reader->get('lists-h2-sub'); ?></h2>

<?php
foreach($subLists->lists AS $lists):
?>

<h3><span aria-hidden="true" class="icon-list2"></span> <a title="view tweets from members of this list" href="/list_timeline?id=<?php echo $lists->id; ?>&subscriber=true"><?php echo $lists->name; ?></a></h3>
<dl class="clearfix">
	<dt><?php echo $xliff_reader->get('lists-fullname'); ?></dt>
	<dd><?php echo $lists->full_name; ?></dd>
	
	<dt><?php echo $xliff_reader->get('lists-desc'); ?></dt>
	<dd><?php echo $lists->description; ?>&nbsp;</dd>
	
	<dt><?php echo $xliff_reader->get('lists-subs'); ?></dt>
	<dd><a href="/list_subscribers?id=<?php echo $lists->id; ?>"><?php echo $lists->subscriber_count; ?></a></dd>
	
	<dt><?php echo $xliff_reader->get('lists-mems'); ?></dt>
	<dd><a href="/list_members?id=<?php echo $lists->id; ?>"><?php echo $lists->member_count; ?></a></dd>

	<?php /*
	<dt><?php echo $xliff_reader->get('lists-mode'); ?></dt>
	<dd><?php echo $lists->mode; ?></dd>
	*/ ?>

	<dt>Owner</dt>
	<dd><a href="/user?id=<?php echo $lists->user->screen_name; ?>"><?php echo $lists->user->name; ?></a></dd>	

<?php /*
	<dt><?php echo $xliff_reader->get('lists-actions'); ?></dt>
	<dd><a rel="unsubList" href="#" title="remove the list PayPal-Access-Team" class="delete-link"><span aria-hidden="true" class="icon-close1"></span> <?php echo $xliff_reader->get('lists-unsubscribe'); ?></a></dd>
*/ ?>

	<dt><?php echo $xliff_reader->get('lists-on-twitter'); ?></dt>
	<dd><a rel="external" href="http://twitter.com<?php echo $lists->uri; ?>"><?php echo $lists->name; ?></a></dd>
</dl>
<?php 
//$index++;
endforeach;
?>
</div>

	</div>
</div>
