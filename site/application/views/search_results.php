<h1 class="rounded"><?php echo $xliff_reader->get('search-results-h1'); ?></h1>

<ul style="margin-top: .5rem;">
<?php
	echo '<li>Search results for: '.urldecode($meta->query).'</li>';
	echo '<li><a href="/search_quick" rel="modal">modify search</a></li>';
	if ( isset($_GET["saved"]) ) {
		echo '<li>This search is saved.</li>';
	}
	else {
		echo '<li><a href="/search_save/false?query='.$meta->query.'">'.$xliff_reader->get('search-results-save-this').'</a></li>';
	}
?>
</ul>

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

<div id="srch-msgs" data-msg-search-saved="<?php echo $xliff_reader->get('msg-search-saved'); ?>" data-msg-search-deleted="<?php echo $xliff_reader->get('msg-search-deleted'); ?>"></div>
