<h1>Register an account.</h1>
<form  action="" method="post" accept-charset="ISO-8859-1">
	<input class="formfield" name="email" type="text" onfocus="if(this.value=='Enter your email adress.') this.value=''" onblur="if(this.value=='')this.value='Enter your email adress.'" onchange="checkIfUserExists(this);" size="40" maxlength="40" value="Enter your email adress." />
    <input class="button" type="button" name="go" value="Go" onclick="" />
    <p><a href="?page=login">Log in.</a></p>
</form>