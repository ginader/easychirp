
<div id="enterTweet" class="rounded">
	<h2>
		<label for="txtEnterTweet"><a href="#enterTweetContent"><span data-icon="&#x27;" aria-hidden="true"></span>Write tweet</a></label>
	</h2>
	<div id="enterTweetContent">
		<p id="charlimit"><span id="displayCharCountMessage">The character limit is 140.</span><strong id="displayCharCountNumber" aria-live="polite"></strong></p>
		<form id="frmSubmitTweet" action="actions/submitStatus.php" method="post" class="clearfix">
			<div>
				<textarea id="txtEnterTweet" name="status" rows="3"></textarea>
				<button class="btnPost" type="submit">Post</button>
			</div>
		</form>

		<h3>Shorten URL</h3>
		<form id="frmUrlShort" method="post" action="actions/doUrlShorten.php">
			<label for="urlLong">Enter URL:</label>
			<input type="text" name="urlLong" id="urlLong" size="50" class="input1" placeholder="http://" />
			<span id="urlService">
				Service:
				<input type="radio" name="urlService" id="bitly" value="bitly" checked="checked" />
				<label for="bitly">bit.ly</label>
				<input type="radio" name="urlService" id="webaim" value="webaim" />
				<label for="webaim">weba.im</label>
			</span>
			<button type="submit" id="btnShorten" class="btn3">Shorten</button>
		</form>
	</div>
</div>
