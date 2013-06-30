<?php
/**
* HTML of the About page   
*
* @package EasyChirp
* @subpackage Views
*/ 
?>
<h1 class="rounded"><?php echo $xliff_reader->get('about-h1'); ?></h1>

<div class="p-row-r">
	<div class="p-col-1-2">

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('about-h2-name'); ?></h2>
	<p><?php echo $xliff_reader->get('about-name-p1'); ?></p>
	<p><?php echo $xliff_reader->get('about-name-p2'); ?></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('about-h2-donate'); ?></h2>
	<p><?php echo $xliff_reader->get('about-donate-p1'); ?></p>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="frmDonate">
		<input type="hidden" name="cmd" value="_s-xclick" />
		<input type="hidden" name="hosted_button_id" value="2JSYK7TQNL5GA" />
		<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="<?php echo $xliff_reader->get('about-donate-alt'); ?>" />
		<img alt="" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/scr/pixel.gif" width="1" height="1" />
	</form>
</div>

<div class="box1 rounded">
	<h2><span aria-hidden="true" class="icon-twitter2"></span> <?php echo $xliff_reader->get('about-h2-account'); ?></h2>
	<p><?php echo $xliff_reader->get('about-account-p1'); ?></p>
</div>

<div class="box1 rounded">
	<h2><span aria-hidden="true" class="icon-mail"></span> <?php echo $xliff_reader->get('about-h2-feedback'); ?></h2>
	<p><?php echo $xliff_reader->get('about-feedback-p1'); ?></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('about-h2-promote'); ?></h2>
	<p><img class="fr" style="margin:0 1em;" src="/images/brand/easy_chirp_icon1.png" alt="Easy Chirp icon" width="48" height="48" /> <?php echo $xliff_reader->get('about-promote-p1'); ?></p>
	<ul>
		<li><?php echo $xliff_reader->get('about-promote-li-use'); ?></li>
		<li><?php echo $xliff_reader->get('about-promote-li-tweet'); ?></li>
		<li><?php echo $xliff_reader->get('about-promote-li-mention'); ?></li>
		<li><?php echo $xliff_reader->get('about-promote-li-email'); ?></li>
		<li><?php echo $xliff_reader->get('about-promote-li-write'); ?></li>
	</ul>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('about-h2-tech'); ?></h2>
	<p><?php echo $xliff_reader->get('about-tech-p1'); ?></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('about-h2-disclaimer'); ?></h2>
	<p><?php echo $xliff_reader->get('about-disclaimer-p1'); ?></p>
	<p><?php echo $xliff_reader->get('about-disclaimer-p2'); ?></p>
</div>

	</div>
	<div class="p-col-1-2">

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('about-h2-awards'); ?></h2>

	<h3><?php echo $xliff_reader->get('about-awards-h3-afb'); ?></h3>
	<p><?php echo $xliff_reader->get('about-awards-afb'); ?></p>

	<h3><?php echo $xliff_reader->get('about-awards-h3-accessit'); ?></h3>
	<p class="clearfix"><img src="/images/awards/access-it-2009-award-sm.jpg" alt="award icon; man in wheelchair holding globe over head" width="55" height="88" class="fl" style="margin-right:10px;" /> <?php echo $xliff_reader->get('about-awards-accessit'); ?></p>

	<h3><?php echo $xliff_reader->get('about-awards-h3-bestweb'); ?></h3>
	<p class="clearfix"><img src="images/awards/net_mag_awards_2010_sm.png" alt=".net Magazine Awards 2010" width="70" height="58" class="fl" style="margin:0 10px 8px 0;" /> <?php echo $xliff_reader->get('about-awards-bestweb'); ?></p>

	<h3><?php echo $xliff_reader->get('about-awards-h3-bb'); ?></h3>
	<p><?php echo $xliff_reader->get('about-awards-bb'); ?></p>

	<h3><?php echo $xliff_reader->get('about-awards-h3-rnib'); ?></h3>
	<p><?php echo $xliff_reader->get('about-awards-rnib'); ?></p>
</div>

<div class="box1 rounded">
	<h2><span aria-hidden="true" class="icon-users"></span> <?php echo $xliff_reader->get('about-h2-authors'); ?></h2>
	<p><?php echo $xliff_reader->get('about-authors-p1'); ?></p>
</div>

<div class="box1 rounded" id="kickstarter">
	<h2><?php echo $xliff_reader->get('about-h2-kick'); ?></h2>
	<p><?php echo $xliff_reader->get('about-kick-p1'); ?></p>
	<p><?php echo $xliff_reader->get('about-kick-p2'); ?></p>
	<p><em><?php echo $xliff_reader->get('about-kick-names'); ?></em></p>
</div>

<div class="box1 rounded">
	<h2><?php echo $xliff_reader->get('about-h2-more'); ?></h2>
	<p><?php echo $xliff_reader->get('about-more-p1'); ?></p>
</div>

	</div>
</div>
