<!DOCTYPE html>
<html lang="en">
<head>
<title>Bird Poop! (<?php echo $heading; ?>)</title>

<link rel="shortcut icon" href="/images/brand/favicon.ico"/>
<link rel="stylesheet" href="/include/css/general.css" type="text/css"/>
<link rel="stylesheet" href="/include/css/ico-moon-fonts2.css"/>

<style type="text/css">
#container {
	width: 50%; 
	margin: 2rem auto;
}
h1 {
	margin-bottom: .75rem;
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
		<div id="errorImage"><img src="/images/brand/easy_chirp_icon1.png" alt="Easy Chirp icon" width="48" height="48" /></div>
		<div class="boxError">
			<h1 class="rounded">Oh, bird poop!</h1>
			<p>Apologies, the following error an occurred: <?php echo $heading; ?></p>
			<?php echo $message; ?>
			<p>You may:</p>
			<ul>
				<li>Go to previous page using the browser back button.</li>
				<li>Report error by emailing: info [AT] Easy Chirp [DOT] com.</li>
				<li><a href="/">Go to Easy Chirp home page</a>.</li>
			</ul>
		</div>

</body>
</html>
