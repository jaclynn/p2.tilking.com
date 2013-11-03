<?php foreach($users as $currentuser): ?>

    <!-- Print this user's name if that user is not the current user -->
    <?php if ($user->user_id!=$currentuser['user_id']): ?>
    
	    <a href='/users/profile/<?=$currentuser['user_id']?>'><?=$currentuser['first_name']?> <?=$currentuser['last_name']?></a>

	
	
    <!-- If there exists a connection with this user, show a unfollow link -->
    <?php if(isset($connections[$currentuser['user_id']])): ?>
        <a class="follow" href='/posts/unfollow/<?=$currentuser['user_id']?>'>Unfollow</a>

    <!-- Otherwise, show the follow link -->
    <?php else: ?>
        <a class="follow" href='/posts/follow/<?=$currentuser['user_id']?>'>Follow</a>
    <?php endif; ?><br/><br/>
<?php endif;?>
    

<?php endforeach; ?>