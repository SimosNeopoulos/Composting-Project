<?php

include("functions.php");
include("connect.php");

// came here from button not from putting the link
if (isset($_POST["reset-password-submit"])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $email = $_POST["email"];
    $password = $_POST["new-password"];
    $passwordRepeat = $_POST["new-password-repeat"];
    
    $url = "html/create-new-password.php?selector=" . $selector . "&email=" . $email . "&validator=" . $validator;
    
    if (empty($password) || empty($passwordRepeat)) {
        header($url . "&newpwd=empty");
        exit();
    } elseif (!preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/', $password)) {
        header("Location:../" . $url . "&newpwd=incorrect");
        exit();
    } elseif ($password !== $passwordRepeat) {
        header("Location:../" . $url . "&newpwd=notsame");
        exit();
    } else {
        updatePassword($conn, $email, $password);
        echo "<script>if(confirm('Ο κωδικός σας άλλαξε επιτυχώς')){document.location.href='../html/log_in.php'};</script>";
    }

    
} else {

    $currentDate = date("U");

    require "dbh.inc.php";
    
}