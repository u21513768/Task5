<?php
    

    $dbHost = "localhost:3305";
    $dbUser = "root";
    $dbPass = "Quintin12";
    $dbName = "swimmer_db";

    if(!$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName))
    {
        die("Failed to connect.");
    }

    //echo("connected");
