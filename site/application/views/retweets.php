<h1 class="rounded"><?php echo $xliff_reader->get('nav-retweets'); ?></h1>

<?php

$page = "";
if(isset($_GET['page'])) {
	$page = $_GET['page'];
}

$type = "";
if(isset($_GET['type'])) {
	$type = $_GET['type'];
}

?>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('gbl-select-page'); ?></h2>
	<ul>
		<li><a href="/retweets?type=by"><?php echo $xliff_reader->get('nav-retweets-by-me'); if ($type=="by") echo " (current)"; ?></a></li>
		<li><a href="/retweets?type=of"><?php echo $xliff_reader->get('nav-retweets-of-me'); if ($type=="of") echo " (current)"; ?></a></li>
		<li><a href="/retweets?type=to"><?php echo $xliff_reader->get('nav-retweets-to-me'); if ($type=="to") echo " (current)"; ?></a></li>
	</ul>
</div>

<?php

if ($type=="by") {
	echo "<h2>".$xliff_reader->get('nav-retweets-by-me')."</h2>";
	echo $tweets;
}
elseif ($type=="of") {
	echo "<h2>".$xliff_reader->get('nav-retweets-of-me')."</h2>";
	echo $tweets;
}
elseif ($type=="to") {
	echo "<h2>".$xliff_reader->get('nav-retweets-to-me')."</h2>";
	echo $tweets;
}

?>
