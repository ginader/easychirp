<h1 class="rounded">Edit List</h1>

<p id="top-pull-link" style="margin-bottom: 1.5rem;"><a href="/lists">Back to Lists</a></p>

<div class="box1 rounded twList">
	<h2><?php echo $list->name; ?></h2>
	<form action="#" method="post">
		<dl class="clearfix">
			<dt class="twListDtAdj"><label id="labelName" for="txt_listName">Name <span class="smallText">(required)</span></label></dt>
			<dd><input aria-describedby="labelNameHint" type="text" id="txt_listName" name="name" maxlength="25" size="25" value="<?php echo $list->name; ?>" />
				<div id="labelNameHint">(required, under 25 characters, letters and numbers only)</div>
			</dd>
			
			<dt class="twListDtAdj"><label id="labelDesc" for="txt_listDesc">Description</label></dt>
			<dd><input aria-describedby="labelDescHint" class="input1" type="text" id="txt_listDesc" name="description" maxlength="100" size="80" value="<?php echo $list->description; ?>" />
				<div id="labelDescHint">(optional, under 100 characters)</div>
			</dd>
			
			<dt>Mode</dt>
			<dd>
				<input <? if ($list->mode=='public') { echo 'checked'; } ?> type="radio" value="public" name="mode" id="modePublic" /><label for="modePublic">Public</label> &nbsp; 
				<input <? if ($list->mode=='private') { echo 'checked'; } ?> type="radio" value="private" name="mode" id="modePrivate" /><label for="modePrivate">Private</label>
			</dd>
		</dl>
		<div class="clear" style="margin-left:31%;">
			<button type="submit">Update List</button>
		</div>
	</form>

	<div class="clearfix" style="font-size: 1.25rem;">
		<a rel="deleteList" class="delete-link fr" href="actions/doDeleteList.php?lstid=33678339"><span aria-hidden="true" class="icon-close1"></span> Delete</a>
	</div>

</div>
