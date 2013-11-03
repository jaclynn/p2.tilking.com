


<?php foreach($profile as $currentuser): ?>
<h1>This is the profile of <?=$currentuser['first_name']?></h1>
<img src='<?=$currentuser['avatar']?>' /><br/>
	<?=$user->first_name?>&#160;<?=$user->last_name?><br/>
	<a href="mailto:<?=$user->email?>"><?=$user->email?></a><br/><br/><br/>
	<a href="/users/updateprofile">Update Profile Info</a>
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