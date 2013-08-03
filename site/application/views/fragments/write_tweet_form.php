<div id="enterTweetContent" data-char-remain="<?php echo $xliff_reader->get('write-tweet-char-remain'); ?>">
	<p id="charlimit">
		<span id="displayCharCountMessage"><?php echo $xliff_reader->get('write-tweet-char-limit'); ?></span>
		<strong id="displayCharCountNumber" aria-live="polite"></strong>
	</p>
	<form id="frmSubmitTweet" action="actions/submitStatus.php" method="post" class="clearfix">
		<div>
			<textarea id="txtEnterTweet" name="status" rows="3"></textarea>
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
