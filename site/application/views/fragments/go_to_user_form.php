<form action="actions/goUser.php" method="post" id="frmGoUser">
	<h3><label for="goUser">Go to User</label></h3>
	<input placeholder="@UserName" type="text" size="15" name="uid" id="goUser" /> 
	<input type="radio" name="goUserAction" id="goUserTypeTimeline" value="timeline" checked="checked" />
	<label for="goUserTypeTimeline">Timeline</label>
	<input type="radio" name="goUserAction" id="goUserTypeProfile" value="profile" /> 
	<label for="goUserTypeProfile">Profile</label>
	<button type="submit">Go</button>
</form>