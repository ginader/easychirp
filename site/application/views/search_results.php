<h1 class="rounded"><?php echo $xliff_reader->get('search-results-h1'); ?></h1>

<ul style="margin-top: .5rem;">
<?php
	echo '<li>Search results for: '.urldecode($meta->query);
	echo '<li><a href="/search_quick" rel="modal">modify search</a>';
	if ( isset($_GET["saved"]) ) {
		echo '<li>This search is saved.</a>';
	}
	else {
		echo '<li><a href="/search_save?query='.$meta->query.'">'.$xliff_reader->get('search-results-save-this').'</a>';
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
