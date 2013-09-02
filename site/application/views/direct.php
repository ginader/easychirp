<?php
if (isset($action)) {
	if ($action == "sent") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get('gbl-msg-dm-sent').'</div>';
	}
	elseif ($action == "error-not-followed") {
		echo '<div class="msgBoxNeg rounded">'.$xliff_reader->get('gbl-msg-dm-error-not-followed');
		echo anchor('/timeline/' . $screen_name, $xliff_reader->get('gbl-tweet-tweet-message') . ' @' . $screen_name);
		echo '</div>';
	}
	elseif ($action == "error-other") {
		echo '<div class="msgBoxNeg rounded">Error. ' . $_GET["msg"] . '</div>';
	}
	elseif ($action == "deleted") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get('gbl-msg-dm-deleted').'</div>';
	}
}
?>

<h1 class="rounded"><?php echo $xliff_reader->get('dm-h1'); ?></h1>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('dm-h2-send'); ?></label></h2>
	<form id="frmDirectMessage" action="/direct_send" method="post" class="clear" 
		data-char-remain="<?php echo $xliff_reader->get('write-tweet-char-remain'); ?>"
		data-error-over="<?php echo $xliff_reader->get('error-over-140'); ?>"
		data-error-empty="<?php echo $xliff_reader->get('error-dm-empty'); ?>"
		data-error-tweep-empty="<?php echo $xliff_reader->get('error-tweep-empty'); ?>">
		<h3 class="fl"><label for="tweep"><?php echo $xliff_reader->get('dm-label-tweep'); ?></label></h3>
		<div id="enterTweep">
			<input type="text" size="18" id="tweep" name="tweep" class="input1" value="<?php
			// Output screen_name if defined
			if ($screen_name !== FALSE):
				echo $screen_name;
			endif; ?>" />
		</div>
		<div class="clear"></div>

		<h3 style="padding-top:0"><label for="txtDirectMessage"><?php echo $xliff_reader->get('dm-label-txtDirectMessage'); ?></label></h3>

		<p id="charlimit" style="margin:0" data-char-remain="<?php echo $xliff_reader->get('write-tweet-char-remain'); ?>">
			<span id="displayCharCountMessage"><?php echo $xliff_reader->get('write-tweet-char-limit'); ?></span>
			<strong span id="displayCharCountNumber" aria-live="polite"></strong>
		</p>

		<div class="clearfix">
			<textarea id="txtDirectMessage" name="message" rows="2" cols="40" required aria-required="true"></textarea>
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
if ($screen_name !== FALSE) {
	echo '<script>document.getElementById("txtDirectMessage").focus();</script>';
}

