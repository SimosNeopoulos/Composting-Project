<?php

include("../php/functions.php");
include("../php/connect.php");

// came here from button
if (isset($_POST["submit-btn"])) {

    $userEmail = $_POST["forgot-password-email"];
    if (emailExists($conn, $userEmail)) {

        //create unique tokens
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        $validator = bin2hex($token);

        //page url
        $PORT_NUMBER = 3000;
        $url = "http://localhost:$PORT_NUMBER/Composting-Project/html/create-new-password.php?selector=" . $selector . "&email=" . $userEmail . "&validator=" . $validator;
        
        //expired time
        $expires = date("U") + 1800;

        /*
        //import database
        require 'dbh.inc.php';
        $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "There was an error! (reset-request.inc.php)";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $userEmail);
            mysqli_stmt_execute($stmt);
        }

        $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "There was an error! (reset-request.inc.php)";
            exit();
        } else {
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $token, $expires);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        */
        
        $to = $userEmail;
        //if (emailExists($conn, $to)) { // exists
            $subject = 'Reset your password for Composting-Project';

            $message = '<p>We received a password request. The link to reset your passowrd is below.';
            $message .= 'If you did not make this request, you can ignore this email </p>';
            $message .= '<p><strong>Here is your password reset link: </strong>';
            if (strpos($to, "hotmail"))
                $message .= $url;
            else
                $message .= '<a href="' . $url . '">Click here to change your password</a></p>';


            $headers = "From: Composting-Project <teamcompostingproject@gmail.com>";
            $headers .= "Reply-To: teamCompostingProject\r\n";
            $headers .= "Content-type: text/html\r\n";

            if (mail($to, $subject, $message, $headers)) {
                header("Location:../html/forgot-password.php?reset=success");
            } else {
                header("Location:../html/forgot-password.php?reset=fail");
            }
        } else {
            $_POST["reset"] = "fail";
            header("Location:../html/forgot-password.php?reset=fail");
        }

} else {
    // μπηκαν με λαθος τροπο
    header("Location:../html/homepage.html");
}