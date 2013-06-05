<h1 class="rounded"><?php echo $xliff_reader->get('dm-h1'); ?></h1>

<!-- <div class="p-row-r">
	<div class="p-col-1-2">
 -->
<div class="box1 rounded">
	<h2>Send a DM</label></h2>
	<form id="frmDirectMessage" action="actions/submitDirect.php" method="post" class="clear">
		<h3 class="fl"><label for="tweep">Send a direct message to (username):</label></h3>
		<div id="enterTweep">
			<input type="text" size="18" id="tweep" name="tweep" class="input1" value="" />
		</div>
		<div class="clear"></div>

		<h3 style="padding-top:0"><label for="txtDirectMessage">Message:</label></h3>

		<p id="charlimit" style="margin:0"><span id="displayCharCountMessage">The character limit is 140.</span><strong span id="displayCharCountNumber" aria-live="polite"></strong></p>

		<div class="clearfix">
			<textarea id="txtDirectMessage" name="message" rows="2" cols="40" aria-required="true"></textarea>
			<button class="btnPost" type="submit">Send</button>
		</div>
	</form>

	<p class="smallText notes">The user to whom you're messaging must be following you.</p>
	<p class="smallText notes">You can also send a Direct Message thru the regular status update box with the command: d + username + message</p>
</div>

<!-- 	</div>
	<div class="p-col-1-2">
 -->
<div class="box1 rounded">
	<h2>Select a page:</h2>
	<ul>
		<li><a href="/direct_inbox">Inbox</a></li>
		<li><a href="/direct_sent">Sent</a></li>
	</ul>
</div>

<!-- 	</div>
</div>
 -->