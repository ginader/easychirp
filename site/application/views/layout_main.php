<!doctype html>
<html lang="en-US" class="no-js">
<head>
	<?php echo $head_codes; ?>

	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if lte IE 7]><script src="include/js/lte-ie7.js"></script><![endif]-->
</head>

<body class="theme-default"><!--theme-inverse-->

<script>
	document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/g, '') + ' js ';
</script>

<div id="wrapper">

<div id="skip"><a href="#signin">skip to sign in</a> | <a href="#main">skip to main content</a></div>

<header role="banner">
	<div><img src="images/brand/EasyChirp_Logo2_300.png" alt="Easy Chirp 2" width="300" height="109" /></div>
	<div id="welcome">
		<h2 class="hide">My Info</h2>
		<p>welcome webaxe! [<a href="#">sign out</a>]</p>
		<p id="hdUserStats"><a href="#">following: 270</a> | <a href="#">followers: 2724</a> | <a href="#">tweets: 10120</a></p>
	</div>
</header>

<nav role="navigation">
	<h2 class="hide">Menu</h2>
	<h3 class="hide">App Menu</h3>
	<ul id="navMain">
		<li><a href="/" id="m_home" accesskey="0" data-icon="&#x36;"><span class="hide">Home</span></a></li>
		<li><a href="app/profile.php" id="m_profile">My Profile</a></li>
		<li><a href="/tips" id="m_tips">Tips</a></li>
		<li><a href="/articles" id="m_articles">Articles &amp; Feedback</a></li>
		<li><a href="/features" id="m_features">Features</a></li>
		<li><a href="/about" id="m_about">About</a></li>
	</ul>

	<h3 class="hide">Tweet Menu</h3>
	<ul id="navTweet">
		<li><a href="app/tweetroll.php" id="m_roll" accesskey="1">Timeline</a></li>
		<li><a href="app/mytweets.php" id="m_mytweets" accesskey="2">My Tweets</a></li>
		<li><a href="app/retweets.php" id="m_retweets" accesskey="3">Retweets</a>
			<ul>
				<li><a href="/app/retweets_by_me.php">ReTweets By Me</a></li>
				<li><a href="/app/retweets_of_me.php">ReTweets Of Me</a></li>
				<li><a href="/app/retweets_to_me.php">ReTweets To Me</a></li>
			</ul>
		</li>
		<li><a href="app/mentions.php" id="m_replies" accesskey="4">Mentions</a></li>
		<li><a href="app/favorites.php" id="m_favorites" accesskey="5">Favorites</a></li>
		<li><a href="app/direct.php" id="m_direct" accesskey="6"><abbr title="Direct Messages">DM</abbr></a>
			<ul>
				<li><a href="app/direct.php?type=inbox">Inbox</a></li>
				<li><a href="app/direct.php?type=sent">Sent</a></li>
			</ul>
		</li>
		<li><a href="app/tools.php" id="m_tools" accesskey="7"><span data-icon="&#x26;" aria-hidden="true"></span>Tools</a>
			<ul>
				<li><a href="app/go-to-user.php">Go to User</a></li>
				<li><a href="app/search.php">Search</a></li>
				<li><a href="app/search-quick.php">Quick Search</a></li>
				<li><a href="app/lists.php">Lists</a></li>
				<li><a href="app/trends.php">Trends</a></li>
			</ul>
		</li>
	</ul>
</nav>

<main role="main" id="main" tabindex="-1">
	<div class="content">
		<?php echo $content; ?>
	</div>	
</main>

<footer role="contentinfo" class="smallText">
	<h2 class="hide">Footer</h2>
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
