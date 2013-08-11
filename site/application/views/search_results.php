<h1 class="rounded"><?php echo $xliff_reader->get('search-results-h1'); ?></h1>

<p class="marginAdjustment">Search results for: <?php echo $meta->query; ?></p>

<?php
if ($num > 0) {
	echo $tweets;
}
else {
?>
	<div class="box1 rounded">
		<p style="margin: 1rem 0 .5rem;"><?php echo $xliff_reader->get('search-saved-none'); ?></p>
	</div>
<?php
}

//debug_object($meta);

?>
