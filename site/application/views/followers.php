<h1 class="rounded">
<?php
echo $xliff_reader->get('followers-h1');
if ($screen_name !== $this->session->userdata('screen_name')) 
{
	echo ' : @' . $screen_name;
}
?>
</h1>

<p class="marginAdjustment"><?php echo anchor('/user/' . $screen_name, $screen_name ); ?>  is followed by these users. 
(<?php echo anchor('/following/' . $screen_name, $xliff_reader->get('followers-view-following')); ?>)</p>

<?php
if (count($f->users) == 0): 
	echo '<div class="box1 rounded"><p style="margin: 1rem 0 .5rem;">' . $xliff_reader->get('search-saved-none') . '</p></div>';
endif;
?>

<?php
foreach ($f->users as $user):
?>
<div class="box1 rounded follow">
	<div class="tweetAvatar" style="background-image:url(<?php echo $user->profile_image_url; ?>)"></div>
	<h2><?php echo anchor('/user/'.$user->screen_name, $user->name); ?> @<?php echo $user->screen_name; ?></h2>
	<p><?php echo $user->location . ". " . $user->description; ?></p>
	<p>
	<?php echo $xliff_reader->get('profile-dt-tweets'); ?> 
	<?php echo anchor('/user_timeline/' . $user->screen_name, $user->statuses_count); ?> 
	<?php echo $xliff_reader->get('profile-dt-following'); ?> 
	<?php echo anchor('/following/' . $user->screen_name, $user->friends_count); ?> 
	<?php echo $xliff_reader->get('profile-dt-followers'); ?> 
	<?php echo anchor('/followers/' . $user->screen_name, $user->followers_count); ?> 
	<?
	// Show block link if this is followers of authenticated user 
	if ($screen_name == $this->session->userdata('screen_name')) {
		echo '<span class="fr"><span aria-hidden="true" class="icon-blocked"></span> <span class="span-user-blocked" style="display:none;">'.$xliff_reader->get('gbl-blocked').'</span> <a href="/block_create/'.$user->screen_name.'/false">'.$xliff_reader->get('user-block').'</a></span>';
	}
	?>
	</p>
</div>
<?php
endforeach;

// Pagination
if ($f->next_cursor != 0 || $f->previous_cursor != 0) {
	echo '<div class="box1 rounded load-more load-more-1-line">';
	if ($f->previous_cursor != 0) {
		// also show previous set link
		echo '<a href="/followers/'.$screen_name.'/'.$f->previous_cursor.'">Previous Set</a>';
	}
	if ($f->next_cursor != 0 && $f->previous_cursor != 0) {
		echo ' | ';
	}
	if ($f->next_cursor != 0) {
		echo '<a href="/followers/'.$screen_name.'/'.$f->next_cursor.'">Next Set</a>';
	}
	echo '</div>';
}
?>
