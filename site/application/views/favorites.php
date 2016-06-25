<h1 class="rounded">
<?php 
echo $xliff_reader->get('favorites-h1');
if ($screen_name !== $this->session->userdata('screen_name')) 
{
	echo ' : @' . $screen_name;
}
?>
</h1>

<?php
require_once 'fragments/write_tweet.php';
?>

<?php echo $tweets; ?>
