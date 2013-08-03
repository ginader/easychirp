<h1 class="rounded"><?php echo $xliff_reader->get('quote-h1'); ?></h1>

<div id="enterTweet" class="single rounded">
<?php
require_once 'fragments/write_tweet_form.php';
?>
</div>

<?php
echo $tweets;
?>
