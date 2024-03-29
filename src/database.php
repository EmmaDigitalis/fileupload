<?php
    //Login info
    $hostname     = "HOSTNAME";
    $username     = "USERNAME";
    $password     = "PASSWORD";
    $databasename = "DATABASENAME";
    
    //Establish connection
    $connect=mysqli_connect($hostname, $username, $password, $databasename);

    //Check connection
    if($connect === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>