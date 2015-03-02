<h1 class="rounded"><?php echo $xliff_reader->get('gbl-blocked-users'); ?></h1>

<div class="box1 rounded" style="padding: 1em;">
	<?php
	if (isset($blockList)) {
		echo "<ul>";
		foreach ($blockList as $user) {
			echo "<li>" . anchor('/user/'.$user->screen_name, $user->name) . " | ";
			echo '<span aria-hidden="true" class="icon-blocked"></span> <span id="span-user-blocked">'.$xliff_reader->get('gbl-blocked').'</span> <a href="/block_destroy/'.$user->screen_name.'/false">'.$xliff_reader->get('user-unblock').'</a>';
			echo "</li>";
		}
		echo "</ul>";
	}
	else {
		echo "<p>".$xliff_reader->get('search-saved-none')."</p>";
	}
	?>
</div>

<?php #debug_object( $blockList ); ?>
