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
		<label for="txtEnterTweet"><a href="#enterTweetContent" aria-controls="enterTweetContent" id="controlEnterTweet">
			<span data-icon="&#x27;" aria-hidden="true"></span><?php echo $xliff_reader->get('write-tweet-h2-label'); ?></a></label>
	</h2>
	<div id="enterTweetContent" aria-labelledby="controlEnterTweet" <?php
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
				else if ( isset($_GET["url_short"]) ) {
					echo $_GET["url_short"];
				}
				else if ( isset($_GET["img_url"]) ) {
					echo $_GET["img_url"];
				}

				?></textarea>
				<?php if (isset($in_reply_to)): ?>
					<input type="hidden" name="in_reply_to_status_id" value="<?php echo $in_reply_to; ?>">
				<?php endif;  ?>

				<button class="btnPost" type="submit"><?php echo $xliff_reader->get('write-tweet-post'); ?></button>
			</div>
		</form>

		<form id="frmUrlShort" method="post" action="/url_shorten" data-clear="<?php echo $xliff_reader->get('gbl-clear'); ?>">
		<fieldset>
		<legend><?php echo $xliff_reader->get('write-tweet-hd-shorten'); ?></legend>
			<input type="hidden" name="ajax" value="0" />
			<label for="urlLong"><?php echo $xliff_reader->get('write-tweet-enter-url'); ?></label>
			<input type="text" name="url_long" id="urlLong" size="50" class="input1" placeholder="http://" required aria-required="true" />
			<span id="urlService">
				<span id="urlServiceLabel"><?php echo $xliff_reader->get('write-tweet-service'); ?></span>
				<input type="radio" name="urlService" id="bitly" value="bitly" aria-describedby="urlServiceLabel" checked="checked" />
				<label for="bitly">bit.ly</label>
				<input type="radio" name="urlService" id="webaim" value="webaim" aria-describedby="urlServiceLabel" />
				<label for="webaim">weba.im</label>
			</span>
			<button type="submit" id="btnShorten" class="btn3"><?php echo $xliff_reader->get('write-tweet-shorten'); ?></button>
		</fieldset>
		</form>

		<form id="frmTweetImage" method="post" enctype="multipart/form-data" action="/img_post" data-clear="<?php echo $xliff_reader->get('gbl-clear'); ?>">
		<fieldset>
		<legend><?php echo $xliff_reader->get('add-image-hd'); ?></legend>
			<input type="hidden" name="ajax" value="0" />
			<div>
				<label for="imagePath"><?php echo $xliff_reader->get('add-image-path'); ?></label>
				<input type="file" name="imagePath" id="imagePath" size="50" class="input1" required aria-required="true" />
			</div>
			<div>
				<label for="imageTitle"><?php echo $xliff_reader->get('add-image-title'); ?></label>
				<input type="text" name="imageTitle" id="imageTitle" size="50" class="input1" required aria-required="true" />
			</div>
			<div>
				<label for="imageDesc"><?php echo $xliff_reader->get('add-image-desc'); ?></label>
				<textarea type="text" name="imageDesc" id="imageDesc" size="30" class="input1" required aria-required="true" /></textarea>
			</div>
			<div>
				<button type="submit" id="btnSubmitImage" class="btn3"><?php echo $xliff_reader->get('add-image-submit'); ?></button>
				<button type="reset"><?php echo $xliff_reader->get('gbl-clear'); ?></button>
			</div>
		</fieldset>
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
