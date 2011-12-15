<div id="step_1" style="position: relative;">
    <h1>Register an account.</h1>
    <form  action="" method="post" accept-charset="ISO-8859-1">
    	<input class="formfield" name="email" id="email" type="text" onfocus="emptyField(this, 'onFocus', 'Enter your email adress.');" onblur="emptyField(this, 'onBlur', 'Enter your email adress.');" onchange="framework.checkIfUserExists(this);" size="40" maxlength="40" value="Enter your email adress." />
        <input class="button" type="button" name="go" value="Go" onclick="proceedToStep(1, 2, {method: checkIfValidEmail, params: {email:$('#email').val()}}, {method: getImages, params: {}});" />
        <p><a href="?page=login">Log in.</a></p>
    </form>
</div>
<div id="step_2" style="display: none;position:relative;left: 2000px">
	<h1>Choose a picture.</h1>
	<form action="button.htm">
	  <div>
	    <button id="upload" name="upload" type="button"
	      value="Upload" onclick="alert('upload!');">
	      <p>
	        Or upload your own.
	      </p>
	    </button>
	  </div>
	</form>
	<div id="gallery">	
	</div>
	<button id="ok" name="ok" type="button" value="Upload" onclick="alert('ok!');">
	      <p>Ok</p>
    </button>
</div>