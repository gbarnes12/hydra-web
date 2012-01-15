<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>yaapps - Yet Another Awesome Picture Password System</title>
<link href="resource/stylesheet/style.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Mako' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Bevan' rel='stylesheet' type='text/css'>
<link href="resource/stylesheet/gallery.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
<script type="text/javascript" src="resource/javascript/yaapps/md5.js"></script>
<script type="text/javascript" src="resource/javascript/gallery.js"></script>
<script type="text/javascript" src="resource/javascript/yaapps/yaapps.js"></script>
<script type="text/javascript">
var yaapps = new yaapps("yaapps/connect.php");
</script>

<script type="text/javascript" src="resource/javascript/custom.js"></script>
</head>

<body>
<div id="wrapper">
	<div id="header">
        <a href="?page=login"><img id="logo" src="resource/images/logo.jpg" alt="logo" /></a>
    </div>
	<div id="content">
        <div id="content-inner">
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
	</div>
    
	<div class="helper">
		<a class="helper_move" href="?page=help">test</a>
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
           <a href="?page=about">About<a>
            </li>           
    	</ul>
    </div>
 </div>
</body>
</html>
