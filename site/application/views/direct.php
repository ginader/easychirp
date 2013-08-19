<?php
if (isset($_GET["action"])) {
	if ($_GET["action"] == "sent") {
		echo '<div class="msgBoxPos rounded">The direct message was sent.</div>';
	}
	elseif ($_GET["action"] == "error-not-followed") {
		echo '<div class="msgBoxNeg rounded">Error. You cannot send messages to users who are not following you.</div>';
	}
	elseif ($_GET["action"] == "error-other") {
		echo '<div class="msgBoxNeg rounded">Error. ' . $_GET["msg"] . '</div>';
	}
	elseif ($_GET["action"] == "deleted") {
		echo '<div class="msgBoxPos rounded">The direct message was deleted.</div>';
	}
}
?>

<h1 class="rounded"><?php echo $xliff_reader->get('dm-h1'); ?></h1>

<?php

// Get screen_name of user if defined in URL (probably from DM link in a tweet)
$user = "";
if(isset($_GET['user'])) {
	$user = $_GET['user'];
}

?>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('dm-h2-send'); ?></label></h2>
	<form id="frmDirectMessage" action="/direct_send" method="post" class="clear" 
		data-char-remain="<?php echo $xliff_reader->get('write-tweet-char-remain'); ?>"
		data-error-over="<?php echo $xliff_reader->get('error-over-140'); ?>"
		data-error-empty="<?php echo $xliff_reader->get('error-dm-empty'); ?>"
		data-error-tweep-empty="<?php echo $xliff_reader->get('error-tweep-empty'); ?>">
		<h3 class="fl"><label for="tweep"><?php echo $xliff_reader->get('dm-label-tweep'); ?></label></h3>
		<div id="enterTweep">
			<input type="text" size="18" id="tweep" name="tweep" class="input1" value="<?
			// Output screen_name if defined
			if ($user !== "") {
				echo $user;
			} ?>" />
		</div>
		<div class="clear"></div>

		<h3 style="padding-top:0"><label for="txtDirectMessage"><?php echo $xliff_reader->get('dm-label-txtDirectMessage'); ?></label></h3>

		<p id="charlimit" style="margin:0" data-char-remain="<?php echo $xliff_reader->get('write-tweet-char-remain'); ?>">
			<span id="displayCharCountMessage"><?php echo $xliff_reader->get('write-tweet-char-limit'); ?></span>
			<strong span id="displayCharCountNumber" aria-live="polite"></strong>
		</p>

		<div class="clearfix">
			<textarea id="txtDirectMessage" name="message" rows="2" cols="40" aria-required="true"></textarea>
			<button class="btnPost" type="submit"><?php echo $xliff_reader->get('dm-send'); ?></button>
		</div>
	</form>

	<p class="smallText notes"><?php echo $xliff_reader->get('dm-note1'); ?></p>
	<p class="smallText notes"><?php echo $xliff_reader->get('dm-note2'); ?></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('gbl-select-page'); ?></h2>
	<ul>
		<li><a href="/direct_inbox"><?php echo $xliff_reader->get('dm-inbox'); ?></a></li>
		<li><a href="/direct_sent"><?php echo $xliff_reader->get('dm-sent'); ?></a></li>
	</ul>
</div>

<?php

// Set focus to textarea if user defined
if ($user !== "") {
	echo '<script>document.getElementById("txtDirectMessage").focus();</script>';
}

?>
