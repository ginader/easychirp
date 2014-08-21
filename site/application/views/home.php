<h1 class="hide">Easy Chirp 2</h1>

<div class="p-row-r">
	<div class="p-col-1-2">

		<div class="box1 rounded boxAccent">
			<h2><?php echo $xliff_reader->get('home-h2-lead'); ?></h2>
			<p><?php echo $xliff_reader->get('home-lead-p1'); ?></p>
			<p><?php echo $xliff_reader->get('home-lead-p2'); ?></p>
		</div>

	</div>
	<div class="p-col-1-2">

		<div class="box1 rounded">
			<h2 id="sign_in" tabindex="-1"><?php echo $xliff_reader->get('home-h2-signin'); ?></h2>
				<?php if (! empty($screen_name)): ?>
					<p><?php echo $xliff_reader->get('home-signin-signed-in-as'); ?> <?php echo $screen_name; ?>.</p>
				<?php else: ?>
					<div><a href="/sign_in"><img src="/images/sign-in-with-twitter-gray.png" alt="<?php echo $xliff_reader->get('home-signin-btn-alt'); ?>" width="158" height="28" /></a></div>
				<?php endif; ?>

			<h2><?php echo $xliff_reader->get('home-h2-donate'); ?></h2>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="frmDonate">
				<input type="hidden" name="cmd" value="_s-xclick" />
				<input type="hidden" name="hosted_button_id" value="2JSYK7TQNL5GA" />
				<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="<?php echo $xliff_reader->get('home-donate-btn-alt'); ?>" />
				<img alt="" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/scr/pixel.gif" width="1" height="1" />
			</form>
		</div>

	</div>
</div>

<div class="box1 rounded" style="margin-top:0;">
	<?php if($easychirp_statuses): ?>
		<?php if (isset($error)): ?>
			<p class="error">
			<?php echo $error; ?>
			</p>
		<?php else: ?>
			<h2><?php echo $xliff_reader->get('home-h2-latest-tweets'); ?></h2>
			<ul id="homeECtweets">
			<?php $count = 0; ?>
			<?php foreach($easychirp_statuses AS $tweet): ?>
				<?php $count++; ?>
				<?php if ($count > 7){ break; }  ?>
			<?php /*?><?php $tweet_url = 'http://twitter.com/' . $tweet->user->screen_name 
				. '/status/' . $tweet->id_str; ?><?php */?>
				<li>
					<?php echo $tweet->text; ?><?php /*?><br />
					<a href="<?php echo $tweet_url; ?>"><?php echo $tweet->user->name; ?></a> 
					(<?php echo $tweet->user->screen_name; ?>)<?php */?>
				</li>
			<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	<?php endif; ?>
	<p<?php if (!$easychirp_statuses) echo ' style="margin: .5em 0 0;"' ?>><?php echo $xliff_reader->get('home-h2-follow-me'); ?> <a href="http://twitter.com/EasyChirp" rel="nofollow">@EasyChirp</a>.</p>
</div>

<div class="box1 rounded" <?php if(!$easychirp_statuses) { echo 'style="margin-top:0;"'; } ?>>
	<h2><?php echo $xliff_reader->get('home-h2-share'); ?></h2>
	<div id="shareIcons">
		<a href="http://twitter.com/home?status=Try+this+user-friendly+%23Twitter+web+app!+http%3a%2f%2fwww.EasyChirp.com+%40EasyChirp+%23a11y+%23app"><img src="/images/share/twitter.png" width="50" height="50" alt="Twitter" title="Twitter" /></a> &nbsp;
		<a href="http://www.facebook.com/sharer.php?u=http://www.EasyChirp.com"><img src="/images/share/facebook.png" width="50" height="50" alt="Facebook" title="Facebook" /></a> &nbsp;
		<a href="https://plus.google.com/share?url=http://www.easychirp.com/"><img src="/images/share/googleplus.png" width="50" height="50" alt="Google Plus" title="Google Plus" /></a> &nbsp;
		<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://www.easychirp.com&amp;title=Check+out+Easy+Chirp!&amp;summary=Easy+Chirp+is+a+user-friendly+Twitter+web+application.+It+is+designed+to+be+easier+to+use+and+is+optimized+for+disabled+users.+It+also+works+with+keyboard-only%2C+older+browsers+like+IE8%2C+lowband+internet+connection%2C+and+without+JavaScript."><img src="/images/share/linkedin.png" width="50" height="50" alt="LinkedIn" title="LinkedIn" /></a> &nbsp;
		<a href="http://pinterest.com/pin/create/button/?url=http%3a%2f%2fwww.EasyChirp.com&amp;media=http%3A%2F%2Fwww.easychirp.com%2Fimages%2Fbrand%2FEasyChirp_Logo2_300_beta.png&amp;description=Try+this+user-friendly+Twitter+web+app!"><img src="/images/share/pinterest.png" width="50" height="50" alt="Pinterest" title="Pinterest" /></a> &nbsp;
		<a href="http://del.icio.us/post?url=http://www.EasyChirp.com/&amp;title=Easy%20Chirp"><img src="/images/share/delicious.png" width="50" height="50" alt="Delicious" title="Delicious" /></a> &nbsp; 
		<a href="http://www.stumbleupon.com/submit?url=http://www.EasyChirp.com/"><img src="/images/share/stumbleupon.png" width="50" height="50" alt="StumbleUpon" title="StumbleUpon" /></a> &nbsp; 
		<!--<a href="http://digg.com/"><img src="/images/share/digg.png" width="50" height="50" alt="digg" /></a> &nbsp;--> 
		<!--<a href="http://www.reddit.com/submit?url=http://www.EasyChirp.com/&amp;t=Easy+Chirp"><img src="/images/share/reddit.png" width="50" height="50" alt="reddit" /></a> &nbsp; -->
		<a href="mailto:?subject=Easy%20Chirp&amp;body=Check%20out%20this%20awesome,%20user-friendly%20Twitter%20web%20app!%20http://www.EasyChirp.com"><img src="/images/share/email.png" width="50" height="50" alt="email" title="email" /></a> &nbsp;
	</div>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('home-h2-articles'); ?></h2>
	<p><?php echo $xliff_reader->get('home-articles-highlights'); ?></p>
	<ul>
		<li><a rel="nofollow" href="http://accessibleinsights.info/blog/2013/10/29/easy-chirp-returns-with-new-sporty-features-and-more-power-under-the-hood/">Easy Chirp returns with new sporty features and more power under the hood</a> (Accessible Insights Blog)</li>
		<li><a rel="nofollow" href="http://poslepu.blogspot.cz/2013/10/easy-chirp-pristupna-alternativa.html">Easy Chirp: web-accessible alternative interface for Twitter [in Czech]</a> (Blindly)</li>
		<li><a rel="nofollow" href="http://www.webaxe.org/easy-chirp-2-soft-beta-launched/">Easy Chirp 2 soft beta launched!</a> (Web Axe)</li>
	</ul>
	<p><?php echo $xliff_reader->get('home-articles-more'); ?></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('home-h2-what-tweeting'); ?></h2>
	<?php 
	if ($favorites) {
		echo $favorites;
	}
	?>
	<p><?php echo $xliff_reader->get('home-easychirp-fav-link'); ?></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('home-h2-features'); ?></h2>
      <ul>
        <li><?php echo $xliff_reader->get('home-features-img'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-shorten'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-search'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-lists'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-no-js'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-keyboard'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-thread'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-devices'); ?></li>
      </ul>
      <p><a href="/features"><?php echo $xliff_reader->get('features-more'); ?></a></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('home-h2-awards'); ?></h2>
	<ul class="ulList1">
		<li><?php echo $xliff_reader->get('about-awards-h3-fcc'); ?>.</li>
		<li><?php echo $xliff_reader->get('home-awards-afb'); ?></li>
		<li><?php echo $xliff_reader->get('home-awards-it'); ?></li>
		<li><?php echo $xliff_reader->get('home-awards-rnib'); ?></li>
	</ul>
	<p><?php echo $xliff_reader->get('home-awards-more'); ?></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('home-h2-dev-tasks'); ?></h2>
	<ul>
		<li>When using reply-to-all, the user's Twitter handle should not be in the draft of the tweet.</li>
		<li>Pagination missing list subscriber/member pages.</li>
	</ul>
</div>
