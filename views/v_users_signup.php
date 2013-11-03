<h2>Sign up for an account</h2>
<?php if(isset($error)): ?>
        <div class='error'>
            Passwords must match.
        </div>
        <br>
    <?php endif; ?>
<form method='POST' action='/users/p_signup'/>
    
	First  Name: <input type='text' name='first_name'/><br/>
	Last  Name: <input type='text' name='last_name'/><br/>
	Email: <input type='text' name='email'/><br/>
	Password: <input type='password' name='password'/><br/>
	Confirm Password: <input type='password' name='pass2'/><br/>
	
	<input type='submit'value='Sign Up'/>
</form>