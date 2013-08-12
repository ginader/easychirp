<h1 class="rounded"><?php echo $xliff_reader->get('trends-h1'); ?></h1>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('trends-worldwide'); ?></h2>

	<?php 

	//debug_object( $trends_worldwide );

	//echo '<h3>' . $trends_worldwide[0]->locations[0]->name . '</h3>'; // Worldwide

	echo '<ul>';
	foreach($trends_worldwide[0]->trends AS $trend):
		echo '<li><a href="/search_results?query=' . $trend->query . '">' . $trend->name . '</a></li>';
	endforeach;
	echo '</ul>';

	?>


	<?php /*>
	<h2>Available</h2>
	<p>Select a location:</p>
	<ul>
	<?php 
	foreach($trends_available AS $loc):
		echo '<li>' . $loc->name . '</li>';
	endforeach;
	?>
	<?php */ ?>

	</ul>
</div>
