<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $con = mysqli_connect("localhost", "root", "", "myproj");

    if(mysqli_connect_error()){
        echo "Failed to connect to mySql".mysqli_connect_error();
        exit();
    }