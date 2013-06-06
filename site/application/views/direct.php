<h1 class="rounded"><?php echo $xliff_reader->get('dm-h1'); ?></h1>

<!-- <div class="p-row-r">
	<div class="p-col-1-2">
 -->
<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('dm-h2-send'); ?></label></h2>
	<form id="frmDirectMessage" action="actions/submitDirect.php" method="post" class="clear">
		<h3 class="fl"><label for="tweep"><?php echo $xliff_reader->get('dm-label-tweep'); ?></label></h3>
		<div id="enterTweep">
			<input type="text" size="18" id="tweep" name="tweep" class="input1" value="" />
		</div>
		<div class="clear"></div>

		<h3 style="padding-top:0"><label for="txtDirectMessage"><?php echo $xliff_reader->get('dm-label-txtDirectMessage'); ?></label></h3>

		<p id="charlimit" style="margin:0"><span id="displayCharCountMessage">The character limit is 140.</span><strong span id="displayCharCountNumber" aria-live="polite"></strong></p>

		<div class="clearfix">
			<textarea id="txtDirectMessage" name="message" rows="2" cols="40" aria-required="true"></textarea>
			<button class="btnPost" type="submit"><?php echo $xliff_reader->get('dm-send'); ?></button>
		</div>
	</form>

	<p class="smallText notes"><?php echo $xliff_reader->get('dm-note1'); ?></p>
	<p class="smallText notes"><?php echo $xliff_reader->get('dm-note2'); ?></p>
</div>

<!-- 	</div>
	<div class="p-col-1-2">
 -->
<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('dm-h2-page'); ?></h2>
	<ul>
		<li><a href="/direct_inbox"><?php echo $xliff_reader->get('dm-inbox'); ?></a></li>
		<li><a href="/direct_sent"><?php echo $xliff_reader->get('dm-sent'); ?></a></li>
	</ul>
</div>

<!-- 	</div>
</div>
 -->