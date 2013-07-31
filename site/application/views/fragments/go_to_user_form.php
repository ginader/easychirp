<form action="actions/goUser.php" method="post" id="frmGoUser">
	<h3><label for="goUser"><?php echo $xliff_reader->get('gotouser-h1'); ?></label></h3>
	<input placeholder="<?php echo $xliff_reader->get('gotouser-username'); ?>" type="text" size="20" name="uid" id="goUser" /> 
	<span>
	<input type="radio" name="goUserAction" id="goUserTypeTimeline" value="timeline" checked="checked" />
	<label for="goUserTypeTimeline"><?php echo $xliff_reader->get('gotouser-timeline'); ?></label>
	<input type="radio" name="goUserAction" id="goUserTypeProfile" value="profile" /> 
	<label for="goUserTypeProfile"><?php echo $xliff_reader->get('gotouser-profile'); ?></label>
	</span>
	<button type="submit"><?php echo $xliff_reader->get('gotouser-go'); ?></button>
</form>