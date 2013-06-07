<h1 class="rounded">Edit Profile</h1>

<p id="editProfileLink"><a href="profile">My Profile</a></p>

<div class="box1 rounded" style="margin-top: 1.65rem">
	<h2>[AVATAR] Edit Profile</h2>
	<form id="frmProfileEdit" action="actions/doSettings.php" method="post">
		<dl id="profile" class="editProfile">
			<dt style="padding-top: 0;">Username</dt>
			<dd>USERNAME</dd>
			
			<dt><label for="name">Name <span class="smallText">(required)</span></label></dt>
			<dd><input class="input1" type="text" id="name" name="name" maxlength="20" size="30" value="" /></dd>
			
			<dt><label for="email">Email</label></dt>
			<dd><input class="input1" type="text" id="email" name="email" maxlength="40" size="30" value="" /></dd>
				
			<dt><label for="location">Location</label></dt>
			<dd><input class="input1" type="text" id="location" name="location" maxlength="30" size="30" value="" /></dd>
			
			<dt><label for="description">Bio</label></dt>
			<dd><input class="input1" type="text" id="description" name="description" maxlength="160" size="70" style="width:98%;" value="" /></dd>
			
			<dt><label for="url">Web Site</label></dt>
			<dd><input class="input1" type="text" id="url" name="url" maxlength="100" size="50" style="width:98%;" value="" /></dd>
		</dl>
		<div id="editProfileUpdateBtn" class="clear">
			<button type="submit" style="margin-left: .5rem;">Update</button>
		</div>
	</form>
</div>

<div class="box1 rounded">
	<h2>Change Avatar</h2>
	<p>Must be a valid GIF, JPG, or PNG image of less than 700 kilobytes in size.</p>
	<form id="frmSettingsAvatar" action="actions/doSettingsAvatar.php" method="post" enctype="multipart/form-data">
		<div>
			<label for="avatar">Path of New Avatar Image</label>: 
			<input class="input1" type="file" id="avatar" name="avatar" />
		</div>
		<div style="padding-top: .5rem;">
			<button type="submit">Update</button>
		</div>
	</form>
</div>


