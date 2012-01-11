<?php
    include("yaapps.php");
    
    $yaapps = new yaapps();
    $yaapps->ParseData(); // parses the commands send to the framework
    echo $yaapps->ReturnData(); // returns the data which was requested or the result of the command!