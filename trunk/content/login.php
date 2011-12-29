<div id="step_1" style="position: relative;">
<h1>Welcome. Log in.</h1>
<form  action="" method="post" accept-charset="ISO-8859-1">
	<input class="formfield" name="email" id="email" type="text" size="40" onfocus="emptyField(this, 'onFocus', 'Enter your email adress.');" onblur="emptyField(this, 'onBlur', 'Enter your email adress.');" maxlength="40" value="Enter your email adress." />
    <input class="button" type="button" name="go" value="Go" onclick="proceedToStep(1, 2, {method: checkIfValidEmail, params: {email:$('#email').val()}}, {method: function() {}, params: {}});" />
    <p><a href="?page=register">Register an account.</a></p>
</form>	
</div>
<div id="step_2" style="display: none;position:relative;left: 2000px">
test
</div>