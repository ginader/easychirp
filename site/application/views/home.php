<h1 class="hide">Easy Chirp 2</h1>

<div class="box1 rounded boxAccent">
	<h2><?php echo $xliff_reader->get('home-h2-lead'); ?></h2>
	<p><?php echo $xliff_reader->get('home-lead-p1'); ?></p>
	<p><?php echo $xliff_reader->get('home-lead-p2'); ?></p>
</div>

<div class="box1 rounded">
	<h2 id="sign_in" tabindex="-1"><?php echo $xliff_reader->get('home-h2-signin'); ?></h2>
	<div><a href="/sign_in"><img src="/images/sign-in-with-twitter.png" alt="<?php echo $xliff_reader->get('home-signin-btn-alt'); ?>" width="151" height="24" /></a></div>

	<h2><?php echo $xliff_reader->get('home-h2-donate'); ?></h2>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick" />
		<input type="hidden" name="hosted_button_id" value="2JSYK7TQNL5GA" />
		<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="<?php echo $xliff_reader->get('home-donate-btn-alt'); ?>" />
		<img alt="" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/scr/pixel.gif" width="1" height="1" />
	</form>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('home-h2-latest-tweets'); ?></h2>
	<?php if ($error): ?>
		<p class="error">
		<?php echo $error; ?>
		</p>
	<?php else: ?>
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
	<p><?php echo $xliff_reader->get('home-h2-follow-me'); ?> <a href="http://twitter.com/EasyChirp" rel="nofollow">@EasyChirp</a>.</p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('home-h2-share'); ?></h2>
	<div>
		<a href="http://twitter.com/home?status=Try+this+user-friendly+%23Twitter+web+app!+http%3a%2f%2fwww.EasyChirp.com+%40EasyChirp+%23a11y+%23app"><img src="/images/share/twitter.png" width="50" height="50" alt="Twitter" /></a> &nbsp;
		<a href="http://www.facebook.com/sharer.php?u=http://www.EasyChirp.com"><img src="/images/share/facebook.png" width="50" height="50" alt="Facebook" /></a> &nbsp;
		<a href="https://plus.google.com/share?url=http://www.easychirp.com/"><img src="/images/share/googleplus.png" width="50" height="50" alt="Google Plus" /></a> &nbsp;
		<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://www.easychirp.com&amp;title=Check+out+Easy+Chirp!&amp;summary=Easy+Chirp+is+a+user-friendly+Twitter+web+application.+It+is+designed+to+be+easier+to+use+and+is+optimized+for+disabled+users.+It+also+works+with+keyboard-only%2C+older+browsers+like+IE6%2C+lowband+internet+connection%2C+and+without+JavaScript."><img src="/images/share/linkedin.png" width="50" height="50" alt="LinkedIn" /></a> &nbsp;
		<!--<a href="#"><img src="/images/share/pinterest.png" width="50" height="50" alt="Pinterest" /></a> &nbsp;-->
		<a href="http://del.icio.us/post?url=http://www.EasyChirp.com/&amp;title=Easy%20Chirp"><img src="/images/share/delicious.png" width="50" height="50" alt="delicious" /></a> &nbsp; 
		<a href="http://www.stumbleupon.com/submit?url=http://www.EasyChirp.com/"><img src="/images/share/stumbleupon.png" width="50" height="50" alt="stumbleupon" /></a> &nbsp; 
		<!--<a href="http://digg.com/"><img src="/images/share/digg.png" width="50" height="50" alt="digg" /></a> &nbsp;--> 
		<a href="http://www.reddit.com/submit?url=http://www.EasyChirp.com/&amp;t=Easy+Chirp"><img src="/images/share/reddit.png" width="50" height="50" alt="reddit" /></a> &nbsp; 
		<a href="mailto:?subject=Easy Chirp&amp;body=Check out this awesome, user-friendly Twitter web app! http://www.easychirp.com"><img src="/images/share/email.png" width="50" height="50" alt="email" /></a> &nbsp;
	</div>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('home-h2-articles'); ?></h2>
	<p><?php echo $xliff_reader->get('home-articles-highlights'); ?></p>
	<ul>
		<li><a rel="nofollow" href="http://preparednessforall.wordpress.com/2012/06/04/report-sociability-social-media-for-people-with-a-disability/">Report: Sociability, Social Media for People with a Disability</a> (Preparedness For All)</li>
		<li><a rel="nofollow" href="http://www.lessfussdesign.com/blog/2009/07/accessible-twitter/">Accessible Twitter: how it should have been done to start with</a> (Less Fuss Design)</li>
		<li><a rel="nofollow" href="http://www.nomensa.com/blog/2010/accessible-twitter-advancement-through-technology/">Accessible Twitter: Advancement through technology</a> (Nomensa)</li>
	</ul>
	<p><?php echo $xliff_reader->get('home-articles-more'); ?></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('home-h2-what-tweeting'); ?></h2>
	<p class="alert">[UNDER DEVELOPMENT, MOCKUP]</p>
	
	<blockquote>
		<p>I would not B on Twitter 'tall, if not 4 Twitter app: @EasyChirp, makes Twitter simple even rock in space can understand. #SavePlanetPluto</p>
		<div><cite><a rel="nofollow" href="http://twitter.com/plutosgems/status/323641393530695680">from Pluto Major Planet</a> (plutosgems)</cite></div>
	</blockquote>
	<blockquote>
		<p>I would not B on Twitter 'tall, if not 4 Twitter app: @EasyChirp, makes Twitter simple even rock in space can understand. #SavePlanetPluto</p>
		<div><cite><a rel="nofollow" href="http://twitter.com/plutosgems/status/323641393530695680">from Pluto Major Planet</a> (plutosgems)</cite></div>
	</blockquote>
	<blockquote>
		<p>I would not B on Twitter 'tall, if not 4 Twitter app: @EasyChirp, makes Twitter simple even rock in space can understand. #SavePlanetPluto</p>
		<div><cite><a rel="nofollow" href="http://twitter.com/plutosgems/status/323641393530695680">from Pluto Major Planet</a> (plutosgems)</cite></div>
	</blockquote>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('home-h2-features'); ?></h2>
      <ul>
        <li><?php echo $xliff_reader->get('home-features-shorten'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-search'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-lists'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-no-js'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-keyboard'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-thread'); ?></li>
        <li><?php echo $xliff_reader->get('home-features-devices'); ?></li>
      </ul>
      <p><a href="/features">More Features</a></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('home-h2-awards'); ?></h2>
	<ul class="ulList1">
		<li><?php echo $xliff_reader->get('home-awards-afb'); ?></li>
		<li><?php echo $xliff_reader->get('home-awards-it'); ?></li>
		<li><?php echo $xliff_reader->get('home-awards-rnib'); ?></li>
	</ul>
	<p><?php echo $xliff_reader->get('home-awards-more'); ?></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('home-h2-dev-tasks'); ?></h2>

	<h3>Known Issues</h3>
	<p>TBD</p>

	<h3>Current Tasks</h3>
	<p>TBD</p>

	<h3>Wish List</h3>
	<p>TBD</p>
</div>


