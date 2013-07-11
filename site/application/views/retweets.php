<h1 class="rounded"><?php echo $xliff_reader->get('nav-retweets'); ?></h1>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('gbl-select-page'); ?></h2>
	<ul>
		<li><a href="/retweets/by_me"><?php echo $xliff_reader->get('nav-retweets-by-me'); if ($type=="by_me") echo " (current)"; ?></a></li>
		<li><a href="/retweets/of_me"><?php echo $xliff_reader->get('nav-retweets-of-me'); if ($type=="of_me") echo " (current)"; ?></a></li>
		<li><a href="/retweets/to_me"><?php echo $xliff_reader->get('nav-retweets-to-me'); if ($type=="to_me") echo " (current)"; ?></a></li>
	</ul>
</div>

<?php

if ($type=="by_me") {
	echo "<h2>".$xliff_reader->get('nav-retweets-by-me')."</h2>";
	echo $tweets;
}
elseif ($type=="of_me") {
	echo "<h2>".$xliff_reader->get('nav-retweets-of-me')."</h2>";
	echo $tweets;
}
elseif ($type=="to_me") {
	echo "<h2>".$xliff_reader->get('nav-retweets-to-me')."</h2>";
	echo $tweets;
}

?>
