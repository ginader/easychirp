
<h2><?php echo $xliff_reader->get('about-h2-more'); ?></h2>

<ul class="list-more">
	<li><a href="https://twitter.com/<?php echo $name; ?>/status/<?php echo $id; ?>" rel="noopener noreferrer" target="_blank"><svg class="icon icon-large"><use xlink:href="#icon-twitter2"></use></svg><?php echo $xliff_reader->get('status-on-twitter'); ?></a></li>
	<li><a href="/user_lists/<?php echo $name; ?>"><svg class="icon icon-large"><use xlink:href="#icon-list2"></use></svg>Lists by <?php echo $screen_name; ?></a></li>
</ul>
