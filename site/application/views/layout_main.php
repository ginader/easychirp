<!doctype html>
<html lang="<?php echo $lang_code; ?>" class="no-js">
<head>
	<?php echo $head_codes; ?>

	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if lte IE 7]><script src="include/js/lte-ie7.js"></script><![endif]-->
</head>

<body class="theme-default">

<script>
	document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/g, '') + ' js ';
</script>

<div id="wrapper">

<div id="skip">
<?php if ($skip_to_sign_in): ?> 
<a href="#signin"><?php echo $xliff_reader->get('skip to sign in'); ?></a> | 
<?php endif; ?> <a href="#main"><?php echo $xliff_reader->get('skip to main content'); ?></a></div>

<header role="banner">
	<div><img src="images/brand/EasyChirp_Logo2_300.png" alt="Easy Chirp 2" width="300" height="109" /></div>
	<div id="welcome">
		<h2 class="hide">My Info</h2>
		<p><?php  printf( $xliff_reader->get("welcome %s"), "webaxe"); ?> [<a href="#">sign out</a>]</p>
		<p id="hdUserStats"><a href="/following"><?php printf( $xliff_reader->get("following: %d"), 270); ?></a> | <a href="/followers"><?php printf( $xliff_reader->get("followers: %d"), 3021); ?></a> | <a href="/mytweets"><?php printf( $xliff_reader->get("tweets: %d"), 16000); ?></a></p>
	</div>
</header>

<nav role="navigation">
	<h2 class="hide">Menu</h2>
	<h3 class="hide">App Menu</h3>
	<?php echo $main_menu; ?>

	<h3 class="hide">Tweet Menu</h3>
	<?php echo $tweet_menu; ?>
</nav>

<main role="main" id="main" tabindex="-1">
	<div class="content">
		<?php echo $content; ?>
	</div>	
</main>

<footer role="contentinfo" class="smallText">
	<h2 class="hide">Footer</h2>
	<p>Select language: English (selected) | <a href="#">Arabic</a> | Espa&ntilde;ol (coming soon) | Fran&ccedil;ais (coming soon)</p>
	<p>&copy; Copyright 2009-2013 <a href="http://www.dennislembree.com" title="web site professional | www.dennislembree.com">Dennis Lembree</a>, 
	<a href="http://www.weboverhauls.com" title="tune-up your web site! | www.weboverhauls.com">Web Overhauls</a></p>
	<p><img src="images/powered-by-twitter-sig.gif" width="137" height="11" alt="powered by Twitter" /></p>
</footer>

</div><!--wrapper-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="include/js/general.js"></script>
<script>
(function(){
	initCharacterCount();
})();
</script>

<!-- analytics (start) -->
<!--<script>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-36257159-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>-->
<!-- analytics (end) -->

</body>
</html>
