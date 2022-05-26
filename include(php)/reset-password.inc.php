<?php

// came here from button not from putting the link
if (isset($_POST["reset-password-submit"])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["new-password"];
    $passwordRepeat = $_POST["new-password-repeat"];

    if (empty($password) || empty($passwordRepeat)) { // empty passwords,also passwords requirments
        header("Location: ../html/create-new-password.php?newpassword=empty");
        exit();
    } else if ($password != $passwordRepeat)
        header("Location: ../html/create-new-password.php?newpassword=notsame");
        exit();
} else {

    $currentDate = date("U");

    require "dbh.inc.php";

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error! (reset-password.inc.php)";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "Error maybe no row found";
            exit();
        } else {

            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false) {
                echo "Error";
                exit();
            } elseif ($tokenCheck === true) {

                $tokenEmail = $row["pwdResetEmail"];

                $sql = "SELECT * FROM users WHERE emailUsers=?"; // simos
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error! (reset-password.inc.php)";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "Error";
                        exit();
                    } else {

                        $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "There was an error! (reset-password.inc.php)";
                            exit();
                        } else {
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $$newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);


                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "There was an error! (reset-password.inc.php)";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../html/create-new-password.php?newpwd=passwordupdated");
                            }
                        }
                    }
                }
            }
        }
    }
}