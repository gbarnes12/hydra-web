<?php
    include("framework.php");
    
    $framework = new framework();
    $framework->ParseData(); // parses the commands send to the framework
    echo $framework->ReturnData(); // returns the data which was requested or the result of the command!