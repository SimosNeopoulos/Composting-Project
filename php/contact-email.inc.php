<?php

if (isset($_POST["submit-btn"])) { // check if user has account
    $userName = $_POST["contact-name"];
    $userEmail = $_POST["contact-email"];
    $subject = $_POST["contact-subject"];
    $message = "<strong>User's name: " . $userName . "</strong><br>";
    $message .= "<strong>User's email: " . $userEmail . "</strong>";
    $message .= "<p>" . $_POST["contact-message"] . "</p>";

    $to = "compostingprojecteam@gmail.com";

    $headers = "From: $userName\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: ../html/contact.php?reset=success");

} else {
    header("Location: ../html/index.php");
}