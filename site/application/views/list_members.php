<h1 class="rounded">
<?php
echo $xliff_reader->get('lists-h1') . " : ". rawurldecode($list_name) . " : " . $xliff_reader->get('lists-mems');
?>
</h1>

<p class="marginAdjustment"><a href="/list_timeline/<?php echo $list_id; ?>/false">View list timeline</a>. 
	The owner of this list is <a href="/user/<?php echo $list_owner; ?>"><?php echo $list_owner; ?></a>.
	View <a href="/list_subscribers/<?php echo $list_owner; ?>/<?php echo $list_id; ?>/<?php echo $list_name; ?>">subscribers of this list</a>. 
</p>

<?php
if (count($f->users) == 0): 
	echo '<div class="box1 rounded">';
	echo '<p style="margin-top: 1em;">' . $xliff_reader->get('search-saved-none') . '</p>';
	echo '</div>';
endif;
?>

<?php
foreach ($f->users as $user):
?>
<div class="box1 rounded follow">
	<div class="tweetAvatar" style="background-image:url(<?php echo $user->profile_image_url; ?>)"></div>
	<h2><?php echo anchor('/user/'.$user->screen_name, $user->name); ?> @<?php echo $user->screen_name; ?></h2>
	<?php
		if ($user->location != '') { 
			echo '<p>' . $user->location . '</p>';
		}
	?>
	<p><?php echo $user->description; ?></p>
	<p>
		<?php echo $xliff_reader->get('profile-dt-tweets'); ?> 
		<?php echo anchor('/user_timeline/' . $user->screen_name, $user->statuses_count); ?> 
		<?php echo $xliff_reader->get('profile-dt-following'); ?> 
		<?php echo anchor('/following/' . $user->screen_name, $user->friends_count); ?> 
		<?php echo $xliff_reader->get('profile-dt-followers'); ?> 
		<?php echo anchor('/followers/' . $user->screen_name, $user->followers_count); ?> 
	</p>
</div>
<?php
endforeach;

// Pagination
if ($f->next_cursor != 0 || $f->previous_cursor != 0) {
	echo '<div class="box1 rounded load-more load-more-1-line">';
	if ($f->previous_cursor != 0) {
		// also show previous set link
		echo '<a href="/list_members/'.$list_owner.'/'.$list_id.'/'.$list_name.'/'.$f->previous_cursor.'">Previous Set</a>';
	}
	if ($f->next_cursor != 0 && $f->previous_cursor != 0) {
		echo ' | ';
	}
	if ($f->next_cursor != 0) {
		echo '<a href="/list_members/'.$list_owner.'/'.$list_id.'/'.$list_name.'/'.$f->next_cursor.'">Next Set</a>';
	}
	echo '</div>';
}

