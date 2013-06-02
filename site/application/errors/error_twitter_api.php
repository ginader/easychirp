<!DOCTYPE html>
<html lang="en">
<head>
<title>Bird Poop! (<?php echo $heading; ?>)</title>
<link rel="shortcut icon" href="/images/brand/favicon.ico">

<!-- <link href="http://<?php echo $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']; ?>/images/brand/favicon.ico" rel="shortcut icon">
<link href="http://<?php echo $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']; ?>/include/css/general.css" type="text/css">
<link href="http://<?php echo $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']; ?>/include/css/ico-moon-fonts2.css" type="text/css">
 -->
<style type="text/css">
#container {
	width: 50%; 
	margin: 2rem auto;
}
#errorImage {
	text-align: left; 
	margin: 1rem 1rem 0 2.25rem;
}
.boxError {
	padding: 0 2rem 2rem 2rem;
}
</style>
</head>
<body>

	<div id="container">
		<div id="errorImage"><img src="http://<?php echo $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']; ?>/images/brand/easy_chirp_icon1.png" alt="Easy Chirp icon" width="48" height="48" /></div>
		<div class="boxError">
			<h1>Oh, bird poop!</h1>
			<p>Apologies, the data from Twitter is unavailable at this time.</p>
			<p>We are unable to connect to the Twitter API. Please try again soon.</p>
			<p>You may:</p>
			<ul>
				<li>Go to previous page using the browser back button.</li>
				<li>Report error by emailing: info [AT] Easy Chirp [DOT] com.</li>
				<li><a href="http://www.EasyChirp.com/">Go to Easy Chirp home page</a>.</li>
			</ul>
		</div>

</body>
</html>
