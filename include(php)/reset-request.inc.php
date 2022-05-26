<?php

// came here from button
if (isset($_POST["submit-btn"])) {

    //create unique tokens
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    //page url
    $url = "www.Compostring-Project/newpassword/create-new-passowrd.php?selector=" . $selector . "&validator=" . bin2hex($token);

    //expired time
    $expires = date("U") + 1800;

    //import database
    require 'dbh.inc.php';

    $userEmail = $_POST["forgot-password-email"];

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

    $to = $userEmail;

    $subject = 'Reset your password for Composting-Project';

    $message = '<p>We received a password request. The link to reset your passowrd is below.';
    $message .= 'If you did not make this request, you can ignore this email </p>';
    $message .= '<p><strong>Here is your password reset link: </strong>';
    $message .= '<a href="' . $url . '">Click here to change your password</a></p>';

    $headers = "From: Composting-Project <teamcompostingproject@gmail.com>";
    $headers .= "Reply-To: teamCompostingProject\r\n";
    $headers .= "Content-type: text/html\r\n";

    if (mail($to, $subject, $message, $headers))
        echo "komple";
    else
        echo "fail";

    //header("Location:../html/forgot-password.php?reset=success");

} else {
    // μπηκαν με λαθος τροπο
    header("Location:../html/homepage.html");
}