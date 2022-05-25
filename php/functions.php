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
        if(logIn($user)) {
            return true;
        } else {
            return false;
        }
            
    }
    echo "query error " . mysqli_error($conn);
    return false;
}

function authenticate($conn, $email, $password) {
    $sql_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql_query);
    if(!$result) {
        return null;
    }
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    if($rows < 1 || $data["password"] != $password) {
        return false;
    }
    $user = new User($data["username"], $data["email"], $data["address"], $data["password"], $data["telephone"]);
    return logIn($user);
}

function logIn($user) {
    $_SESSION["user"] = $user;
    $_SESSION["username"] = $user->getUsername();///////////////
    $_SESSION["email"] = $user->getEmail();
    $_SESSION["address"] = $user->getAddress();
    $_SESSION["password"] = $user->getPassword();
    $_SESSION["telephone"] = $user->getTelephone();
    return true;
}

function logOut() {
    unset($_SESSION["user"]);
    header("Location: ../html/log_in.php");
    return true;
}

function getCurrentUserData(){

}

function displayName(){
    if(isset($_SESSION['username'])){
        echo $_SESSION['username'];
    }else{
        echo '';
    }
}

function displayEmail(){
    if(isset($_SESSION['email'])){
        echo $_SESSION['email'];
    }else{
        echo '';
    }
}

function dipslayAddress(){
    if(isset($_SESSION['address'])){
        echo $_SESSION['address'];
    }else{
        echo '';
    }
}

function displayPassword(){
    if(isset($_SESSION['password'])){
        echo $_SESSION['password'];
    }else{
        echo '';
    }
}

function displayTelephone(){
    if(isset($_SESSION['telephone'])){
        echo $_SESSION['telephone'];
    }else{
        echo '';
    }
}
?>

