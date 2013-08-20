<h1 class="rounded"><?php echo $xliff_reader->get('nav-timeline')." : @".$_GET["user"]; ?></h1>

<?php
require_once 'fragments/write_tweet.php';
echo $tweets;
?>
