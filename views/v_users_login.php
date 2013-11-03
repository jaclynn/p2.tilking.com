<h2>Log in</h2>

<form method='POST' action='/users/p_login'>
    <?php if(isset($error)): ?>
        <div class='error'>
            Login failed. Please double check your email and password.
        </div>
        <br>
    <?php endif; ?>
	<fieldset>
		<legend>Enter your credentials</legend>
		<p><label class="field" for="email">Email:</label> <input type='text' name='email'/></p>
		<p><label class="field" for="password">Pasword:</label> <input type='password' name='password'/></p>
		
		<input type='submit' value='Login'/>
	</fieldset>
</form>
