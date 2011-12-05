<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Projekt Hydra</title>
<link href="resource/stylesheet/style.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Mako' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Bevan' rel='stylesheet' type='text/css'>
<link href="resource/stylesheet/gallery.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
<script type="text/javascript" src="resource/javascript/gallery.js"></script>
<script type="text/javascript">
   function sendAjaxRequest(file, data, callback)
    {
        $.ajax({
			url : "framework/connect.php",
			dataType: 'json',
			data: data,
			type: 'POST',
			success: callback
		});
    }

    function checkIfUserExists(obj)
    {
        var email = $(obj).val();
        if(email != "")
        {
            
            var callback = function(data) {
                     if(data.type == "return")
                     {
                        if(data.value == "true")
                            alert("The email address you want to register is already taken.");
                     }
                     else if(data.type == "error")
                     {
                        alert(data.message);
                     }
            };
            
            sendAjaxRequest("connect.php", "class=user&method=checkIfUserExists&email="+email, callback);  
        }
    } 
    
    function proceedToStep(oldStep, newStep)
    {
        var $lefty = $("#step_" + oldStep);
        $lefty.animate(
        {
          left: parseInt($lefty.css('left'),10) == 0 ?
            -$lefty.outerWidth() :
            0
        }, 
        "1000", 
        'linear', 
        function() 
        {
            $lefty.hide();
            
            var $righty = $("#step_" + newStep);
            $righty.show();
            $righty.animate({
              left: parseInt($righty.css('left'),10) == 0 ?
                -$righty.outerWidth() :
                0
            }, "10", "linear", function() {});
        });
        
        
    }
</script>

</head>

<body>
	<div id="header">
    <a href="?page=login"><img id="logo" src="resource/images/logo.jpg" alt="logo" /></a>
    </div>
	<div id="content">
	<?php
		if(!isset($_GET["page"]))
		{
		   if(!file_exists("content/login.php"))
		    	include("content/error.php");
		   else
		 		include("content/login.php"); 
		
		}
		else 
		{
		   if(!file_exists("content/".$_GET["page"].".php"))
		    	include("content/error.php");
		   else
		 		include("content/".$_GET["page"].".php"); 
		}
	?>
	</div>
    
    <div id="footer">
    	<ul id="footer_nav">
        	<li>
            <a href="?page=disclaimer">Disclaimer<a>
            </li>
         	<li>
            <a href="?page=contact">Contact<a>
            </li>           
            <li>
           <a href="?page=help">Help<a>
            </li>           
    	</ul>
    </div>
</body>
</html>
