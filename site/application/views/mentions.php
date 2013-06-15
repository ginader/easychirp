<h1 class="rounded"><?php echo $xliff_reader->get('mentions-h1'); ?></h1>

<?php
require_once 'fragments/write_tweet.php';
?>

<div id="mentions">
<?php echo $tweets; ?>
</div>

