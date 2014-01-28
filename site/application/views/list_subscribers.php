<h1 class="rounded">
<?php
echo $xliff_reader->get('lists-h1') . " : ". $list_name . " : " . $xliff_reader->get('lists-subs');
?>
</h1>

<?php
if (count($f->users) == 0): 
	echo '<p>' . $xliff_reader->get('followers-none') . '</p>';
endif;
?>
<p class="marginAdjustment"><a href="/list_timeline/<?php echo $list_id; ?>/false">View list timeline</a>. The owner of this list is <a href="/user/<?php echo $list_owner; ?>"><?php echo $list_owner; ?></a>.</p>

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
		<?php echo anchor('/following/' . $user->screen_name, $user->friends_count, 
			'title="view users that I\'m following"'); ?> 
		<?php echo $xliff_reader->get('profile-dt-followers'); ?> 
		<?php echo anchor('/followers/' . $user->screen_name, $user->followers_count, 
			'title="view the users that follow me"'); ?> 
	</p>
</div>
<?php
endforeach;
?>