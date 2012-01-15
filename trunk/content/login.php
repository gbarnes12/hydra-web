<div id="step_1" style="position: relative;">
<h1>Welcome. Log in.</h1>
<form  action="" method="post" accept-charset="ISO-8859-1">
	<input class="formfield" name="email" id="email" type="text" size="40" onfocus="emptyField(this, 'onFocus', 'Enter your email adress.');" onchange="yaapps.checkIfUserExists(this, false);" onblur="emptyField(this, 'onBlur', 'Enter your email adress.');" maxlength="40" value="Enter your email adress." />
    <input class="button" type="button" name="go" value="Go" onclick="proceedToStep(1, 2, {method: checkIfValidEmail, params: {email:$('#email').val(), mode: false}}, {method: getUserImage, params: {email: $('#email').val()}});" />
    <p><a href="?page=register">Register an account.</a></p>
</form>	
</div>
<div id="step_2" style="display: none;position:relative;left: 2000px">
    <div id="img_background" style="float: left;margin-right: 20px;width: 600px;height: 450px;background-repeat: no-repeat" onclick="yaapps.checkPoint(event, this);"></div>
    <div style="float: left;">
        <button class="button" id="button_login" style="display: none;" id="ok" name="ok" type="button" value="Upload" onclick="window.location='index.php?page=secure'">
	      <p>Ok</p>
        </button>
    </div>
</div>