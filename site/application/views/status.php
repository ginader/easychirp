<h1 class="rounded">View Single Tweet</h1>

<div class="tweetSingle">
<?php
echo $tweets;
?>
</div>

<h2>More</h2>

<ul>
	<li><span class="icon-twitter2" aria-hidden="true"></span> <a href="https://twitter.com/<?php echo $show->user->screen_name; ?>/status/<?php echo $show->id; ?>" rel="external">This tweet on Twitter</a></li>
	<li><span class="icon-list2" aria-hidden="true"></span> <a href="/lists?id=<?php echo $show->user->screen_name; ?>">Lists by <?php echo $show->user->name; ?></a></li>
	<li><a href="/user?id=<?php echo $show->user->screen_name; ?>">Details on <?php echo $show->user->name; ?></a></li>
	<li><a href="/timeline?id=<?php echo $show->user->screen_name; ?>">Tweets by <?php echo $show->user->name; ?></a></li>
</ul>

<?php
//echo debug_object( $show );
?>
