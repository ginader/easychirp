<h1 class="rounded"><?php echo $xliff_reader->get('dm-inbox-h1'); ?></h1>

<?php 
echo $dms;
?>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('gbl-select-page'); ?></h2>
	<ul>
		<li><a href="/direct_send_page"><?php echo $xliff_reader->get('dm-h2-send'); ?></a></li>
		<li><a href="/direct_sent"><?php echo $xliff_reader->get('dm-sent'); ?></a></li>
	</ul>
</div>
