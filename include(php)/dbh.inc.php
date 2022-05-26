<?php

    $dBServername = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "loginsystem";

    // create connection
    $conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName); // simos

    // check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
