<!doctype html>
<html lang="<?php echo $lang_code; ?>" <?php
if ($this->layout->lang_code === "ar") {
	echo 'dir="rtl" ';
}
?>class="no-js">
<head>
	<?php echo $head_codes; ?>

	<link rel="apple-touch-icon" href="/images/brand/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="/images/brand/touch-icon-ipad.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="/images/brand/touch-icon-iphone-retina.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="/images/brand/touch-icon-ipad-retina.png" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<script src="/include/js/modernizr.js"></script>

	<!--[if lte IE 8]><link rel="stylesheet" href="/include/css/ie8.css" type="text/css"/><![endif]-->
	<!--[if lte IE 7]><script src="/include/js/lte-ie7.js"></script><![endif]-->
</head>
<body class="<?php echo $active_theme; ?>">
<?php include_once("images/svg/icons.svg"); ?>
<div id="wrapper">

<?php if ($pol_bool === "on"): ?>
	<div id="political_filter"><p><?php echo $xliff_reader->get('filter-pol-is-on'); ?></p></div>
<?php endif ?>

<div id="skip">
<?php if ($skip_to_sign_in): ?> 
<a href="#sign_in"><?php echo $xliff_reader->get('skip-sign-in'); ?></a> | 
<?php endif; ?> <a href="#main"><?php echo $xliff_reader->get('skip-main-content'); ?></a></div>

<header role="banner">
	
	<div id="logoContainer"><img src="/images/brand/EasyChirp_Logo2_300_beta.png" alt="Easy Chirp 2 beta" width="300" height="109" /></div>
	<div id="welcome">
		<?php if ($logged_in): ?>
			<h2 class="hide">My Info</h2>
			<p><?php 
				$linkedName = '<a href="/profile">' . $screen_name . '</a>';
				printf( $xliff_reader->get("nav-welcome-user"), $linkedName); ?> 
			[<a href="/sign_out"><?php echo $xliff_reader->get('nav-sign-out'); ?></a>]</p>
			<p id="hdUserStats"><a href="/following"><?php printf( $xliff_reader->get("nav-following"), $following_count); ?></a> | <a href="/followers"><?php printf( $xliff_reader->get("nav-followers"), $follower_count); ?></a> | <a href="/mytweets"><?php printf( $xliff_reader->get("nav-tweet-count"), $tweet_count); ?></a></p>
		<?php endif; ?>
	</div>
</header>

<div>
	<h2 class="hide"><?php echo $xliff_reader->get('nav-heading-menu'); ?></h2>
	<h3 class="hide" id="nav-menu-app"><?php echo $xliff_reader->get('nav-heading-app-menu'); ?></h3>
	<nav id="main_menu_wrapper" aria-labelledby="nav-menu-app">
		<?php echo $main_menu; ?>
	</nav>

	<?php if ($screen_name): ?>
		<h3 class="hide" id="nav-menu-tweet"><?php echo $xliff_reader->get('nav-heading-tweet-menu'); ?></h3>
		<nav id="tweet_menu_wrapper" aria-labelledby="nav-menu-tweet">
		<?php echo $tweet_menu; ?>
		</nav>
	<?php endif; ?>
</div>

<main id="main" tabindex="-1" 
	data-fav-make="<?php echo $xliff_reader->get('gbl-tweet-make-fav'); ?>" data-fav-remove="<?php echo $xliff_reader->get('gbl-tweet-remove-fav'); ?>"
	data-fav-alert-added="<?php echo $xliff_reader->get('gbl-tweet-fav-alert-added'); ?>" data-fav-alert-removed="<?php echo $xliff_reader->get('gbl-tweet-fav-alert-removed'); ?>"
	data-rt-make="<?php echo $xliff_reader->get('gbl-tweet-make-rt'); ?>" data-rt-remove="<?php echo $xliff_reader->get('gbl-tweet-remove-rt'); ?>"
	data-rt-alert-added="<?php echo $xliff_reader->get('gbl-tweet-rt-alert-added'); ?>" data-rt-alert-removed="<?php echo $xliff_reader->get('gbl-tweet-rt-alert-removed'); ?>"
	data-sure-delete="<?php echo $xliff_reader->get('gbl-sure-delete'); ?>" data-sure-spam="<?php echo $xliff_reader->get('gbl-sure-spam'); ?>"
	data-block="<?php echo $xliff_reader->get('user-block'); ?>" data-unblock="<?php echo $xliff_reader->get('user-unblock'); ?>"
	data-msg-block="<?php echo $xliff_reader->get('gbl-msg-block'); ?>" data-msg-unblock="<?php echo $xliff_reader->get('gbl-msg-unblock'); ?>"
	data-mute="<?php echo $xliff_reader->get('gbl-mute'); ?>" data-unmute="<?php echo $xliff_reader->get('gbl-unmute'); ?>"
	data-msg-mute="<?php echo $xliff_reader->get('gbl-msg-mute'); ?>" data-msg-unmute="<?php echo $xliff_reader->get('gbl-msg-unmute'); ?>"
	data-msg-dm-deleted="<?php echo $xliff_reader->get('gbl-msg-dm-deleted'); ?>" 
	data-msg-tweet-deleted="<?php echo $xliff_reader->get('msg-tweet-deleted'); ?>"
>
	<div class="content">
		<?php echo $content; ?>
	</div>	
</main>

<?php
if ($this->session->userdata('logged_in')) {
?>
<!-- modal windows -->
<div id="go_to_user" class="modal rounded" role="dialog" aria-label="<?php echo $xliff_reader->get('nav-goto-user'); ?>" tabindex="-1">
	<?php require('fragments/go_to_user_form.php'); ?>
	<a href="#" class="close" role="button"><span aria-hidden="true" class="icon-close1"></span><span class="hide"><?php echo $xliff_reader->get('lists-create-close'); ?></span></a>
</div>
<div id="search_quick" class="modal rounded" role="dialog" aria-label="<?php echo $xliff_reader->get('nav-quick-search'); ?>" tabindex="-1">
	<?php require('fragments/search_quick_form.php'); ?>
	<a href="#" class="close" role="button"><span aria-hidden="true" class="icon-close1"></span><span class="hide"><?php echo $xliff_reader->get('lists-create-close'); ?></span></a>
</div>
<div id="mask"></div>
<?php
}
?>

<footer role="contentinfo" aria-labelledby="foot-hd">
	<h2 class="hide" id="foot-hd"><?php echo $xliff_reader->get('footer-h2'); ?></h2>

	<?php ?>
	<p><?php echo $xliff_reader->get('footer-select-language'); ?>:
	<?php $langs = 0;   ?>
	<?php foreach($lang_menu AS $lang_id => $lang_name): ?>
		<?php echo ($langs) ? ' | ' : ''; ?>
		<?php if ($lang_id === $lang_code): ?>
			<?php echo $lang_name; ?>
		<?php else: ?>
			<?php $link = anchor('/switch_lang/' . $lang_id, $lang_name, 'lang="'.$lang_id.'"'); ?>
			<?php echo $link; ?>
		<?php endif; ?>
		<?php $langs++; ?>
	<?php endforeach; ?>
	</p>
	<?php ?>

	<p><?php echo $xliff_reader->get('gbl-theme-select'); ?>: 
	<?php $items = 0; ?>
	<?php foreach($theme_menu AS $theme_code => $theme_name): ?>
		<?php $theme_name = $xliff_reader->get($theme_name); ?>
		<?php echo ($items) ? ' | ' : ''; ?>
		<?php if ($active_theme === $theme_code): ?>
			<?php echo $theme_name; ?>
		<?php else: ?>
			<?php $link = anchor('/switch_theme/' . $theme_code, $theme_name); ?>
			<?php echo $link; ?>
		<?php endif; ?>
		<?php $items++; ?>
	<?php endforeach; ?>
	</p>

	<p>Operating System color theme detected: 
		<span id="os-color-scheme">none </span> (overrides app-level selection above<span id="os-color-js">, Javascript required</span>)</p>

	<p><?php echo $xliff_reader->get('filter-pol') . ": " ?>
		<?php if ($pol_bool === "on"): ?>
			<?php 
				$pol_name = $xliff_reader->get('filter-pol-turn-off');
				$pol_bool = "off";
			?>
		<?php else: ?>
			<?php 
				$pol_name = $xliff_reader->get('filter-pol-turn-on');
				$pol_bool = "on";
			?>
		<?php endif; ?>
		<?php $link = anchor('/switch_political_filter/' . $pol_bool, $pol_name); ?>
		<?php echo $link; ?>
	</p>

	<p>&copy; <?php echo $xliff_reader->get('footer-copyright'); ?> 2009-<?php echo date('Y'); ?> 
		<a rel="noopener noreferrer nofollow" target="_blank" href="http://www.dennislembree.com" title="web site professional | www.dennislembree.com">Dennis Lembree</a>, 
		<a rel="noopener noreferrer nofollow" target="_blank" href="http://www.weboverhauls.com" title="tune-up your web site! | www.weboverhauls.com">Web Overhauls</a>
	</p>
</footer>

</div><!--wrapper-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="/include/js/megamenu.js"></script>
<script src="/include/js/tooltip.js"></script>
<script src="/include/js/jquery.form.min.js"></script>
<script src="/include/js/ajax.js"></script>
<script src="/include/js/general.js"></script>

<!-- analytics (start) -->
<script>
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-36257159-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<!-- analytics (end) -->
</body>
</html>
