<h1 class="rounded">
<?php 
echo $xliff_reader->get('favorites-h1');
if ( isset($_GET["id"])) {
	echo ' : ' . $_GET["id"];
}
?>
</h1>

<?php
require_once 'fragments/write_tweet.php';
?>

<div id="favorites">
	<?php echo $tweets; ?>
</div>
