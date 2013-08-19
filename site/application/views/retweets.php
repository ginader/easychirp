<h1 class="rounded"><?php echo $xliff_reader->get('nav-retweets'); ?></h1>

<div class="box1 rounded" style="margin-bottom: -.5rem;">
	<h2><?php echo $xliff_reader->get('gbl-select-page'); ?></h2>
	<ul class="clearfix">
		<li class="fl"><a href="/retweets/by_me"><?php echo $xliff_reader->get('nav-retweets-by-me'); if ($type=="by_me") echo " (current)"; ?></a></li>
		<li class="fl"><a href="/retweets/of_me"><?php echo $xliff_reader->get('nav-retweets-of-me'); if ($type=="of_me") echo " (current)"; ?></a></li>
		<li class="fl"><a href="/retweets/to_me"><?php echo $xliff_reader->get('nav-retweets-to-me'); if ($type=="to_me") echo " (current)"; ?></a></li>
	</ul>
</div>

<?php

echo $write_tweet_form;

if ($type=="by_me") {
	echo "<h2>".$xliff_reader->get('nav-retweets-by-me')."</h2>";
}
elseif ($type=="of_me") {
	echo "<h2>".$xliff_reader->get('nav-retweets-of-me')."</h2>";
}
elseif ($type=="to_me") {
	echo "<h2>".$xliff_reader->get('nav-retweets-to-me')."</h2>";
}

if ($num > 0) {
	echo $tweets;
}
else {
	echo '<div class="box1 rounded">';
	echo '<p style="margin: 1rem 0 .5rem;">'.$xliff_reader->get('search-saved-none').'</p>';
	echo '</div>';
}

?>
