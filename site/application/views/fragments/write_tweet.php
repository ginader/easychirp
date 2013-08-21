<?php
$classes = 'rounded';
if (isset($single) && $single)
{
	$classes .= ' single';
}



?>
<div id="enterTweet" class="<?php echo $classes; ?>">
<?php 
if (empty($single)):
?>
	<h2>
		<label for="txtEnterTweet"><a href="#enterTweetContent" aria-controls="enterTweetContent">
			<span data-icon="&#x27;" aria-hidden="true"></span><?php echo $xliff_reader->get('write-tweet-h2-label'); ?></a></label>
	</h2>
	<div id="enterTweetContent" <?php
	if (isset($expand) && $expand)
	{
		echo ' class="displayEnterTweet" ';
	}
	?>
	data-char-remain="<?php echo $xliff_reader->get('write-tweet-char-remain'); ?>">
		<p id="charlimit">
			<span id="displayCharCountMessage"><?php echo $xliff_reader->get('write-tweet-char-limit'); ?></span>
			<strong id="displayCharCountNumber" aria-live="polite"></strong>
		</p>
		<form id="frmSubmitTweet" action="/tweet/write" method="post" class="clearfix" 
			data-error-over="<?php echo $xliff_reader->get('error-over-140'); ?>"
			data-error-empty="<?php echo $xliff_reader->get('error-tweet-empty'); ?>">
			<div>
				<textarea id="txtEnterTweet" name="status" rows="3"><?php
				
				if ( isset($reply_to) ) 
				{
					echo $reply_to;
				}

				?></textarea>
				<?php if (isset($in_reply_to)): ?>
					<input type="hidden" name="in_reply_to_status_id" value="<?php echo $in_reply_to; ?>">
				<?php endif;  ?>

				<button class="btnPost" type="submit"><?php echo $xliff_reader->get('write-tweet-post'); ?></button>
			</div>
		</form>

		<h3><?php echo $xliff_reader->get('write-tweet-h3'); ?></h3>
		<form id="frmUrlShort" method="post" action="actions/doUrlShorten.php">
			<label for="urlLong"><?php echo $xliff_reader->get('write-tweet-enter-url'); ?></label>
			<input type="text" name="urlLong" id="urlLong" size="50" class="input1" placeholder="http://" />
			<span id="urlService">
				<span id="urlServiceLabel"><?php echo $xliff_reader->get('write-tweet-service'); ?></span>
				<input type="radio" name="urlService" id="bitly" value="bitly" checked="checked" aria-describedby="urlServiceLabel" />
				<label for="bitly">bit.ly</label>
				<input type="radio" name="urlService" id="webaim" value="webaim" aria-describedby="urlServiceLabel" />
				<label for="webaim">weba.im</label>
			</span>
			<button type="submit" id="btnShorten" class="btn3"><?php echo $xliff_reader->get('write-tweet-shorten'); ?></button>
		</form>
	</div>

<?php
else:
?>
	<br />
	<br />
<?php
endif; // if empty
?>
</div>
