<h1 class="rounded">Lists</h1>

<p class="marginAdjustment">Note: You may subscribe to a list from the Lists page of a specific user.</p>

<div id="createList" class="box1 rounded">
	<h2>Create List</h2>
	<form action="actions/doListCreate.php" method="post" id="frmCreateList">
	<div class="row">
		<label id="labelName" for="txt_listName">Name</label>
		<span id="nameTip">(required, under 25 characters, letters and numbers only)</span>
		<input class="input1" aria-describedby="nameTip" required="required" id="txt_listName" name="txt_listName" type="text" size="25" maxlength="25" />
	</div>
	<div class="row">
		<label id="labelDesc" for="txt_listDesc">Description</label>
		<span id="descTip">(optional, under 100 characters)</span>
		<input class="input1" aria-describedby="descTip" id="txt_listDesc" name="txt_listDesc" type="text" size="50" maxlength="100" />
	</div>
	<div class="row">
		<fieldset>
			<legend>Privacy <span class="normalText">(required)</span></legend>
			<input value="public" id="modePublic" name="mode" type="radio" /> <label for="modePublic">Public</label> &nbsp;  
			<input value="private" id="modePrivate" name="mode" type="radio" checked="checked" /> <label for="modePrivate">Private</label>
		</fieldset>
	</div>
	<div><button type="submit">Create</button></div>
	</form>
</div>

<div class="box1 rounded twList">
	<h2>My Lists</h2>
	
	<h3><span data-icon="&#x25;" aria-hidden="true"></span> <a title="view tweets from members of this list" href="#">HTML5</a></h3>
	<dl class="clearfix">
		<dt>Full name</dt>
		<dd>@dennisl/html5</dd>
		<dt>Description</dt>
		<dd>text here</dd>
		<dt>Subscribers</dt>
		<dd>0</dd>
		<dt>Members</dt>
		<dd><a class="listSubMemLink" href="#">11</a></dd>
		<dt class="twListDtAdj"><label for="txt33678339">Add Member</label></dt>
		<dd>
			<form action="actions/doListAddMember.php" class="frmListAddMember">
				<input type="hidden" name="listSlug" value="html5" />
				<input type="hidden" name="lstid" value="33678339" />
				<input type="text" size="12" name="userNameToAdd" value="" id="txt33678339" title="enter username" />
				<input type="submit" value="Add" class="btn4" />
			</form>
		</dd>
		<dt>Mode</dt>
		<dd>public</dd>
		<dt>Actions</dt>
		<dd><a href="listEdit.php?lstid=33678339">Edit Settings</a> | <a rel="deleteList" href="actions/doDeleteList.php?lstid=33678339">Delete</a></dd>
		<dt>View on Twitter</dt>
		<dd><a rel="external" href="http://twitter.com/dennisl/html5" title="View list on Twitter">html5</a></dd>
	</dl>

</div>

<div class="box1 rounded twList">
	<h2>Subscribed Lists</h2>

	<h3><span data-icon="&#x25;" aria-hidden="true"></span> <a title="view tweets from members of this list" href="#">HTML5</a></h3>
	<dl class="clearfix">
		<dt>Full name</dt>
		<dd>@dennisl/html5</dd>
		<dt>Description</dt>
		<dd>text here</dd>
		<dt>Subscribers</dt>
		<dd>0</dd>
		<dt>Members</dt>
		<dd><a class="listSubMemLink" href="#">11</a></dd>
		<dt>Mode</dt>
		<dd>public</dd>
		<dt>Actions</dt>
		<dd><a rel="unsubList" href="#" title="remove the list PayPal-Access-Team">Unsubscribe</a></dd>
		<dt>View on Twitter</dt>
		<dd><a rel="external" href="http://twitter.com/dennisl/html5" title="View list on Twitter">html5</a></dd>
	</dl>
</div>
