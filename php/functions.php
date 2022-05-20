<?php
session_start();
include("../php/connect.php");
include("../php/classes.php");

function nameExists($conn, $username) {
    $sql_query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql_query);
    if(!$result) {
        return null;
    }
    $resultCheck = mysqli_num_rows($result);
    mysqli_free_result($result);

    if($resultCheck > 0) {
        return true;
    }
    return false;
}

function emailExists($conn, $email) {
    $sql_query = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql_query);
    if(!$result) {
        return null;
    }
    $resultCheck = mysqli_num_rows($result);
    mysqli_free_result($result);

    if($resultCheck > 0) {
        return true;
    }
    return false;
}

function signUp($conn, $user) {
     return addAccountToDB($conn ,$user);
}

function addAccountToDB($conn, $user) {
    $username = $user->getUsername();
    $email = $user->getEmail();
    $address = $user->getAddress();
    $password = $user->getPassword();
    $telephone = $user->getTelephone();
    $sql_query = "INSERT INTO users(username, email, address, password, telephone) VALUES ('$username', '$email', '$address', '$password','$telephone')";
    if(mysqli_query($conn, $sql_query)) {
        if(logIn($conn, $user, false)) {
            return true;
        } else {
            return false;
        }
            
    }
    echo "query error " . mysqli_error($conn);
    return false;
}

function logIn($conn, $user, $checkExistance) {
    if($checkExistance) {
        $email = $user->getEmail();
        $sql_query = "SELECT email, password FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql_query);
        $rows = mysqli_num_rows($result);
        $data = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($rows <= 0) {
            return false;
        }
        if($data["password"] != $user->getPassword()) {
            return false;
        }
        
    }
    $_SESSION["user"] = $user;
    return true;
}


?>