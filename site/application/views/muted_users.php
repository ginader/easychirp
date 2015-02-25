<h1 class="rounded"><?php echo $xliff_reader->get('gbl-muted-users'); ?></h1>

<div class="box1 rounded" style="padding: 1em;">
	<?php
	if (isset($muList)) {
		echo "<ul>";
		foreach ($muList as $user) {
			echo "<li>" . anchor('/user/'.$user->screen_name, $user->name) . " | ";
			echo '<span aria-hidden="true" class="icon-mute"></span> <span id="span-user-muted">'.$xliff_reader->get('gbl-muted').'</span> <a href="/mute_destroy/'.$user->screen_name.'/false">'.$xliff_reader->get('gbl-unmute').'</a>';
			echo "</li>";
		}
		echo "</ul>";
	}
	else {
		echo "<p>".$xliff_reader->get('search-saved-none')."</p>";
	}
	?>
</div>

<?php #debug_object( $muList ); ?>
