<h1 class="rounded"><?php echo $xliff_reader->get('mytweets-h1'); ?></h1>

<?php
require_once 'fragments/write_tweet.php';
?>

<div id="my-tweets">
<?php echo $tweets; ?>
</div>

