<div id="step_1" style="position: relative;">
    <h1>Register an account.</h1>
    <form  action="" method="post" accept-charset="ISO-8859-1">
    	<input class="formfield" name="email" id="email" type="text" onfocus="emptyField(this, 'onFocus', 'Enter your email adress.');" onblur="emptyField(this, 'onBlur', 'Enter your email adress.');" onchange="yaapps.checkIfUserExists(this, true);" size="40" maxlength="40" value="Enter your email adress." />
        <input class="button" type="button" name="go" value="Go" onclick="proceedToStep(1, 2, {method: checkIfValidEmail, params: {email:$('#email').val(), mode: true}}, {method: getImages, params: {}});" />
        <p><a href="?page=login">Log in.</a></p>
    </form>
</div>
<div id="step_2" style="display: none;position:relative;left: 2000px">

    <h1>Choose a picture.</h1>
		<form action="button.htm">
		  <div>
		    <button id="upload" name="upload" type="button"
		      value="Upload" onclick="alert('uoload!');">
		      <p>
		        Or upload your own.
		      </p>
		    </button>
		  </div>
		</form>
		<div class="carousell">
			<div id="gallery"></div>
				<a href="#" class="arrow_right"> <img src="resource/images/arrow_right.png" alt="arrow"/></a>
		</div>	
        <input class="button" id="button_gallery" style="display: none;" type="button" name="go" value="Go" onclick="proceedToStep(2, 3, {method: function() {if(yaapps.imageID != -1) return true; else return false;}, params: {}}, {method: function() { $('#image_background').css('background-image',  'url(generated/gallery/large/'+yaapps.imageName+')'); }, params: {}});" />		
</div>
<div id="step_3" style="display: none;position:relative;left: 2000px">
    <div id="image_background" style="float: left;margin-right: 20px;width: 600px;height: 450px;background-repeat: no-repeat;" onclick="yaapps.setPoint(event, this, function() {$('#button_usercreate').show();});"></div>
    <div style="float: left;">
        <button class="button" id="button_usercreate" style="display: none;" id="ok" name="ok" type="button" value="Upload" onclick="yaapps.createUser(userCreated);">
	      <p>Ok</p>
        </button>
    </div>
</div>
<div style="clear: both;"></div>
<br />