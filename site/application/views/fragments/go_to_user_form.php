<form action="/go_user_action" method="post" id="frmGoUser">
	<label id="goUserLabel" for="goUser"><?php echo $xliff_reader->get('gotouser-h1'); ?></label>
	<input placeholder="<?php echo $xliff_reader->get('gbl-at-username'); ?>" type="text" size="20" name="screen_name" id="goUser" required aria-required="true" /> 
	<span>
	<input type="radio" name="goUserAction" id="goUserTypeTimeline" value="timeline" checked="checked" />
	<label for="goUserTypeTimeline"><?php echo $xliff_reader->get('gotouser-timeline'); ?></label>
	<input type="radio" name="goUserAction" id="goUserTypeProfile" value="profile" /> 
	<label for="goUserTypeProfile"><?php echo $xliff_reader->get('gotouser-profile'); ?></label>
	</span>
	<button type="submit"><?php echo $xliff_reader->get('gotouser-go'); ?></button>
</form>