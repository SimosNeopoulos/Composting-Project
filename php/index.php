<?php
    include("functions.php");
    include("connect.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>

<body>
<h1>Works</h1>

<a href="../html/homepage.html">Homepage</a> <br>
<?php

    if(upadtePassword($conn, "simneo22@gmail.com", "159456753sim!")) {
        echo "worked";
    } else {
        echo "Didn't work";
    }
?>

</body>



</html>