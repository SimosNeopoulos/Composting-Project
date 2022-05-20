<?php
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

    if(1) {
        echo "1";
    } else {
        echo "2";
    }
    //  $sql = "SELECT * FROM users;";
    //  $result = mysqli_query($conn, $sql);
    //  $resultCheck = mysqli_num_rows($result);

    // if ($resultCheck > 0) {
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         echo $row['username'] ."<br>";
    //         echo $row['email'] ."<br>";
    //         echo $row['address'] ."<br>";
    //         echo $row['password'] ."<br>";
    //     }
    // }
?>

</body>



</html>