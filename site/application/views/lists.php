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

<div class="box1 rounded">
	<h2>My Lists</h2>
	<p></p>
	<ul>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>

<div class="box1 rounded">
	<h2>Subscribed Lists</h2>
	<p></p>
	<ul>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
