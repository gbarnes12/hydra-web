<div id="step_1" style="position: relative;">
    <h1>Register an account.</h1>
    <form  action="" method="post" accept-charset="ISO-8859-1">
    	<input class="formfield" name="email" type="text" onfocus="if(this.value=='Enter your email adress.') this.value=''" onblur="if(this.value=='')this.value='Enter your email adress.'" onchange="checkIfUserExists(this);" size="40" maxlength="40" value="Enter your email adress." />
        <input class="button" type="button" name="go" value="Go" onclick="proceedToStep(1, 2);" />
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
		<a href="resource/images/large.jpg" class="preview" rel="lightbox"> <img src="resource/images/img.jpg" alt="img" /></a>
		<a href="resource/images/large.jpg" class="preview" rel="lightbox"> <img src="resource/images/img.jpg" alt="img" /></a>
		<a href="resource/images/large.jpg" class="preview" rel="lightbox"> <img src="resource/images/img.jpg" alt="img" /></a>		
	</div>
	<button id="ok" name="ok" type="button" value="Upload" onclick="alert('ok!');">
	      <p>Ok</p>
    </button>
</div>