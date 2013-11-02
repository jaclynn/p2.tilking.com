<h2>Log in</h2>

<form method='POST' action='/users/p_login'>
    <?php if(isset($error)): ?>
        <div class='error'>
            Login failed. Please double check your email and password.
        </div>
        <br>
    <?php endif; ?>

Email: <input type='text' name='email'/><br/>
Password: <input type='password' name='password'/><br/>

<input type='submit' value='Login'/>

</form>
