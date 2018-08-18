<?php
if (isset($_GET["action"])) {
	if ($_GET["action"] == "deleted") {
		echo '<div class="msgBoxPos rounded">'.$xliff_reader->get('gbl-msg-dm-deleted').'</div>';
	}
}
?>

<h1 class="rounded"><?php echo $xliff_reader->get('dm-h1'); ?></h1>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('gbl-select-page'); ?></h2>
	<ul>
		<li><a href="/direct_send_page"><?php echo $xliff_reader->get('dm-h2-send'); ?></a></li>
		<li><a href="/direct_inbox"><?php echo $xliff_reader->get('dm-inbox'); ?></a></li>
	</ul>
</div>
