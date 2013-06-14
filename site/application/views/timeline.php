<?php
$months = array();
$months['jan'] = '01';
$months['feb'] = '02';
$months['mar'] = '03';
$months['apr'] = '04';
$months['may'] = '05';
$months['jun'] = '06';
$months['jul'] = '07';
$months['aug'] = '08';
$months['sep'] = '09';
$months['oct'] = '10';
$months['nov'] = '11';
$months['dec'] = '12';
?>
<h1 class="rounded"><?php echo $xliff_reader->get('nav-timeline'); ?></h1>
<style>
.tweet-meta {
	font-size: 0.9em;
	font-style: italic;
	margin-top: 8px;
}
</style>
<?php
require_once 'fragments/write_tweet.php';
?>

<div id="timeline">
	<?php foreach($tweets AS $tweet): ?>
	<?php 
		$date =   $tweet->created_at;  // Fri Jun 14 00:49:09 +0000 2013	
		$regex = '/(\w{3}) (\w{3}) (\d\d) (\d\d:\d\d:\d\d) ([+\-]\d\d\d\d) (\d\d\d\d)/';

		$is_matched = preg_match($regex, $tweet->created_at, $matches);
		if ($is_matched){
			$month_abbr = strtolower($matches[2]);
			$month = $months[ $month_abbr ]; 
			
			$date = sprintf("%s %d-%s-%s %s%s", $matches[1],  $matches[6], $month, $matches[3], $matches[4], $matches[5]);
		}
	?>
		<div class="tweet">
			<?php echo $tweet->text; ?>
			<div class="tweet-meta">
				<span class="tweet-author"><?php echo $tweet->user->screen_name; ?></span>
				Created at: <span class="tweet-date"><?php echo $date; ?></span>
			</div>
		</div>
		
	<?php endforeach; ?>
</div>

<p>[INCLUDE PAGINATION]</p>

