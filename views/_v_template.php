<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" media="screen" href="/css/master.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>
	<div class="page-wrapper">

    <div id='menu'>

        <a href='/'>Home</a>&#160;|&#160;

        <!-- Menu for users who are logged in -->
        <?php if($user): ?>

            <a href='/users/logout'>Logout</a>&#160;|&#160;
            <a href='/users/profile'>Profile</a>

        <!-- Menu options for users who are not logged in -->
        <?php else: ?>

            <a href='/users/signup'>Sign up</a>&#160;|&#160;
            <a href='/users/login'>Log in</a>

        <?php endif; ?>

    </div>

    <br>

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	</div>
</body>
</html>