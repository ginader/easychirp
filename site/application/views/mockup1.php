<!doctype html>
<html lang="en-US">
<head>
	<meta charset="utf-8" />
	<title>Easy Chirp : a simple and accessible web-based Twitter application</title>
	<meta name="description" content="Easy Chirp : a simple and accessible web-based Twitter application. Developed with strict web standards and web accessibility. Great for screen readers, low-vision, elderly, and beginners; and for older browsers, text-only browsers, and non-JavaScript." />
	<meta name="author" content="Dennis E Lembree, Web Overhauls" />
	<meta name="keywords" content="accessible,Twitter,twitter,twitter.com,easy,web site,Web,web,site,accessibility,Accessibility,app,client,screenreader,screen reader,JAWS,NVDA,application,low vision" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="verify-v1" content="3gSFkFi1HCTZp2MP2dUh9mteuUJdRlMzx+HrFKopQN4=" />
	
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@EasyChirp" />
	<meta name="twitter:creator" content="@DennisL" />
	<meta name="twitter:url" content="http://www.easychirp.com/" />
	<meta name="twitter:title" content="Easy Chirp, a user-friendly web-based Twitter application" />
	<meta name="twitter:description" content="Easy Chirp has a simple interface and is optimized for disabled users and also works on older technology. It also functions well with keyboard-only, IE6, lowband internet connection, and without JavaScript." />
	<meta name="twitter:image" content="http://www.easychirp.com/images/easy_chirp_icon_200.jpg" />

	<link rel="shortcut icon" href="images/brand/favicon.ico" />
	<link rel="stylesheet" href="include/css/general.css" />
	<link rel="stylesheet" href="include/css/ico-moon-fonts2.css" />

	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<!--[if lte IE 7]><script src="include/js/lte-ie7.js"></script><![endif]-->
</head>

<body class="theme-default no-js"><!--theme-inverse js-->

<script>
	document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/g, '') + ' js ';
</script>

<div id="wrapper">

<div id="skip"><a href="#signin">skip to sign in</a> | <a href="#main">skip to main content</a></div>

<header role="banner">
	<div><a href="#"><img src="images/brand/EasyChirp_Logo2_300.png" alt="Easy Chirp 2" width="300" height="109" /></a></div>
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
		<!-- <li><a href="index.php" id="m_home" accesskey="0" data-icon="&#x36;"><span class="hide">Home</span></a></li> -->
		<li><a href="app/profile.php" id="m_profile">My Profile</a></li>
		<li><a href="app/tips.php" id="m_tips">Tips</a></li>
		<li><a href="articles.php" id="m_articles">Articles &amp; Feedback</a></li>
		<li><a href="features.php" id="m_features">Features</a></li>
		<li><a href="about.php" id="m_about">About</a></li>
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
	<h1>Timeline</h1>

	<div class="msgBoxPos rounded">
		<h2>Positive Message</h2>
		<p>This is an example of a (server-side?) container for a positive message.</p>
	</div>

	<div class="msgBoxNeg rounded">
		<h2>Negative Message</h2>
		<p>This is an example of a (server-side?) container for a negative message.</p>
	</div>
	
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

	<div class="tweet rounded clearfix">
		<h2 class="hide">Username 1</h2>
		<div class="tweetAvatar" style="background-image:url(images/avatar_time.png);"></div>
		<q>tweet the tweet the tweetthe tweet the tweetthe tweet the tweetthe tweet the tweetthe tweet the tweetthe tweet the tweet</q>
		<p>from <a href="#" title="fullname; followers; following">username</a> | <a href="#">date</a> | retweet/responding | via <a href="#">app</a></p>
		<div class="btnOptions">
			<h3><a href="#tweetOptions_1" class="btnOptionsTweet" title="tweet options" data-icon="&#x29;"><span class="hide">tweet options</span></a></h3>
			<ul>
				<li><a href="#" data-icon="&#x2a;" title="favorite"><span class="hide">favorite</span></a></li>
				<li><a href="#" data-icon="&#x41;" title="reply"><span class="hide">reply</span></a></li>
				<li><a href="#" data-icon="&#x3b;" title="reply to all"><span class="hide">reply to all</span></a></li>
				<li><a href="#" data-icon="&#x3f;" title="retweet"><span class="hide">retweet</span></a></li>
				<li><a href="#" data-icon="&#x30;" title="quote tweet"><span class="hide">quote tweet</span></a></li>
				<li><a href="#" data-icon="&#x31;" title="email tweet"><span class="hide">email tweet</span></a></li>
			</ul>
		</div>
		<div class="btnOptions">
			<h3><a href="#userOptions_1" class="btnOptionsUser" title="user options" data-icon="&#x3c;"><span class="hide">user options</span></a></h3>
			<ul>
				<li><a href="#" data-icon="&#x3e;" title="view this user's timeline"><span class="hide">timeline</span></a></li>
				<li><a href="#" data-icon="&#x37;" title="direct message this user"><span class="hide">direct message</span></a></li>
				<li><a href="#" data-icon="&#x38;" title="tweet message"><span class="hide">tweet message</span></a></li>
				<li><a href="#" data-icon="&#x3d;" title="muter user"><span class="hide">mute user</span></a></li>
				<li><a href="#" data-icon="&#x33;" title="report spammer" class="spammer"><span class="hide">report spammer</span></a></li>
			</ul>
		</div>
	</div>

	<div class="tweet rounded clearfix retweet">
		<h2 class="hide">Username 2</h2>
		<div class="tweetAvatar" style="background-image:url(images/avatar_cliff.png);"></div>
		<q>Yo mama the tweet the tweetthe tweet the tweetthe tweet the tweetthe tweet the tweetthe tweet the tweetthe tweet the tweetthe tweet the tweetthe tweet the tweet</q>
		<p>from <a href="#" title="fullname; followers; following">username</a> | <a href="#">date</a> | retweet/responding | retweeted 3 times | via <a href="#">app</a></p>
		<div class="btnOptions">
			<h3><a href="#tweetOptions_2" class="btnOptionsTweet" title="tweet options" data-icon="&#x29;"><span class="hide">tweet options</span></a></h3>
			<ul>
				<li><a href="#" data-icon="&#x2a;" title="favorite"><span class="hide">favorite</span></a></li>
				<li><a href="#" data-icon="&#x41;" title="reply"><span class="hide">reply</span></a></li>
				<li><a href="#" data-icon="&#x3b;" title="reply to all"><span class="hide">reply to all</span></a></li>
				<li><a href="#" data-icon="&#x3f;" title="retweet"><span class="hide">retweet</span></a></li>
				<li><a href="#" data-icon="&#x30;" title="quote tweet"><span class="hide">quote tweet</span></a></li>
				<li><a href="#" data-icon="&#x31;" title="email tweet"><span class="hide">email tweet</span></a></li>
			</ul>
		</div>
		<div class="btnOptions">
			<h3><a href="#userOptions_1" class="btnOptionsUser" title="user options" data-icon="&#x3c;"><span class="hide">user options</span></a></h3>
			<ul>
				<li><a href="#" data-icon="&#x3e;" title="view this user's timeline"><span class="hide">timeline</span></a></li>
				<li><a href="#" data-icon="&#x37;" title="direct message this user"><span class="hide">direct message</span></a></li>
				<li><a href="#" data-icon="&#x38;" title="tweet message"><span class="hide">tweet message</span></a></li>
				<li><a href="#" data-icon="&#x3d;" title="muter user"><span class="hide">mute user</span></a></li>
				<li><a href="#" data-icon="&#x33;" title="report spammer" class="spammer"><span class="hide">report spammer</span></a></li>
			</ul>
		</div>
	</div>
	
	<div class="tweet rounded clearfix reply">
		<div class="tweetAvatar" style="background-image:url(images/avatar_todd.png);"></div>
		<h2 class="hide">Username 3</h2>
		<q>The end of the tweet the tweetthe tweet the tweetthe tweet the tweetthe tweet the tweeweetthe tweet the tweetthe tweet the et the tweetthe tweet the tweet</q>
		<p>from <a href="#" title="fullname; followers; following">username</a> | <a href="#">date</a> | retweet/responding | via <a href="#">app</a></p>
		<div class="btnOptions">
			<h3><a href="#tweetOptions_3" class="btnOptionsTweet" title="tweet options" data-icon="&#x29;"><span class="hide">tweet options</span></a></h3>
			<ul>
				<li><a href="#" data-icon="&#x2a;" title="favorite"><span class="hide">favorite</span></a></li>
				<li><a href="#" data-icon="&#x41;" title="reply"><span class="hide">reply</span></a></li>
				<li><a href="#" data-icon="&#x3b;" title="reply to all"><span class="hide">reply to all</span></a></li>
				<li><a href="#" data-icon="&#x3f;" title="retweet"><span class="hide">retweet</span></a></li>
				<li><a href="#" data-icon="&#x30;" title="quote tweet"><span class="hide">quote tweet</span></a></li>
				<li><a href="#" data-icon="&#x31;" title="email tweet"><span class="hide">email tweet</span></a></li>
			</ul>
		</div>
		<div class="btnOptions">
			<h3><a href="#userOptions_1" class="btnOptionsUser" title="user options" data-icon="&#x3c;"><span class="hide">user options</span></a></h3>
			<ul>
				<li><a href="#" data-icon="&#x3e;" title="view this user's timeline"><span class="hide">timeline</span></a></li>
				<li><a href="#" data-icon="&#x37;" title="direct message this user"><span class="hide">direct message</span></a></li>
				<li><a href="#" data-icon="&#x38;" title="tweet message"><span class="hide">tweet message</span></a></li>
				<li><a href="#" data-icon="&#x3d;" title="muter user"><span class="hide">mute user</span></a></li>
				<li><a href="#" data-icon="&#x33;" title="report spammer" class="spammer"><span class="hide">report spammer</span></a></li>
			</ul>
		</div>
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
