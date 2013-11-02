
<h1>This is the profile of <?=$user->first_name?></h1>
<img src='<?=$user->avatar_small?>' /><br/>
	<?=$user->first_name?>&#160;<?=$user->last_name?><br/>
	<a href="mailto:<?=$user->email?>"><?=$user->email?></a><br/>
	<a href="/users/updateaccount">Update Account Info</a>
	<br/><br/>

<div class="contentside">
<article>
<br/><br/>
<?php foreach($profile as $currentuser): ?>
Gender: <?=$currentuser['gender']?><br/>
Married <?=$currentuser['married']?><br/>
Location: 
<?=$currentuser['city']?>,&#160;
<?=$currentuser['state']?><br/>
Birthdate: <?=$currentuser['dob']?><br/>

<?php endforeach; ?>
</article>
</div>