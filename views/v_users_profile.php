


<?php foreach($profile as $currentuser): ?>
<h1>This is the profile of <?=$currentuser['first_name']?></h1>
<img src='<?=$currentuser['avatar']?>' /><br/>
	<?=$user->first_name?>&#160;<?=$user->last_name?><br/>
	<a href="mailto:<?=$user->email?>"><?=$user->email?></a><br/><br/><br/>
	<?php if($user->user_id==$currentuser['user_id']):?>
	<a href="/users/updateprofile"><img src="/images/updateprofile.png" alt="Register"/></a>
	<?php endif; ?>
	<br/><br/>

<div class="contentside">
<article>
<br/><br/>

Gender: <?=$currentuser['gender']?><br/>
Married: <?=$currentuser['married']?><br/>
Location: 
<?=$currentuser['city']?>,&#160;
<?=$currentuser['state']?><br/>
Birthdate: <?=$currentuser['dob']?><br/>

<?php endforeach; ?>
</article>
</div>