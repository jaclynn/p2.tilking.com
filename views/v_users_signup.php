<h2>Sign up for an account</h2>
<?php if(isset($error)): ?>
        <div class='error'>
            Passwords must match.
        </div>
        <br>
    <?php endif; ?>
<form method='POST' action='/users/p_signup'>
<fieldset>
		<legend>Enter your credentials</legend>    
		<p><label class="field" for="first_name">First  Name:</label><input type='text' id='first_name' name='first_name'/></p>
		<p><label class="field" for="last_name">Last  Name:</label><input type='text' id='last_name' name='last_name'/></p>
		<p><label class="field" for="email">Email:</label><input type='text' id='email' name='email'/></p>
		<p><label class="field" for="password">Password:</label><input type='password' id='password' name='password'/></p>
		<p><label class="field" for="pass2">Confirm Password:</label><input type='password' id='pass2' name='pass2'/></p>
				
		<input type='submit' value='Sign Up'/>
</fieldset>
</form>