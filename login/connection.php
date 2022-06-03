<?php
    

    $dbHost = "localhost:3306";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "swimmer_db";

    if(!$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName))
    {
        die("Failed to connect.");
    }

    //echo("connected");
