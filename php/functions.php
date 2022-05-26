<?php
session_start();
include("../php/connect.php");
include("../php/classes.php");

/********** LOG IN / SIGN UP VERIFICATION **********/

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

function signUp($conn, $username, $email, $address, $password, $telephone) {
     return addAccountToDB($conn, $username, $email, $address, $password, $telephone);
}

function addAccountToDB($conn, $username, $email, $address, $password, $telephone) {
    $sql_query = "INSERT INTO users(username, email, address, password, telephone) VALUES ('$username', '$email', '$address', '$password','$telephone')";
    if(mysqli_query($conn, $sql_query)) {
        $id = mysqli_insert_id($conn);
        $user = new User($id, $username, $email, $address, $password, $telephone);
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
    $user = new User($data["id"], $data["username"], $data["email"], $data["address"], $data["password"], $data["telephone"]);
    return logIn($user);
}

function logIn($user) {
    $_SESSION["user"] = $user;
    return true;
}

function logOut() {
    unset($_SESSION["user"]);
    header("Location: ../html/log_in.php");
    return true;
}

/****************************** *****************************/

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


/************* POSTS / COMMENTS / TAGS *************/

function deletePost($conn, $id) {
    $sql_query = "DELETE FROM posts WHERE id = '$id'";
    if(mysqli_query($conn, $sql_query)) 
        return true;
    return false;
}

function updatePost($conn, $id, $newBody) {
    $sql_query = "UPDATE posts SET body = '$newBody' WHERE id = '$id'";
    if(mysqli_query($conn, $sql_query))
        return true;
    return false;
}

function getUserPosts($conn, $userId) {
    $sql_query = "SELECT * FROM posts WHERE id_user = '$userId' ORDER BY post_date DESC";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        echo "Δεν επιστρέφηκαν αποτελέσματα";
        return;
    }
    return $data;
}

function getPostsFromArea($conn, $city) {
    $sql_query = "SELECT posts.id, id_user, posts.body, posts.post_date 
                  FROM users, posts 
                  WHERE users.address = '$city' AND id_user = users.id 
                  ORDER BY post_date DESC 
                  LIMIT 5";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        echo "Δεν επιστρέφηκαν αποτελέσματα";
        return;
    }
    return $data;
}

function getPostsWithTag($conn, $tags, $numberOfPosts=30) {
    $where_query = getArrayWhereStatment($tags, "tag_name");
    $sql_query = "SELECT id, id_user, body, post_date
                  FROM posts INNNER JOIN posts_has_tags
                  ON id = posts_id
                  INNER JOIN tags
                  ON id_tag = tags_id
                  WHERE $where_query
                  ORDER BY post_date DESC 
                  LIMIT $numberOfPosts";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($rows < 1) {
        echo "Δεν επιστρέφηκαν αποτελέσματα";
        return;
    }
    return $data;
}

function createPost($conn, $userId, $body, $tags) {
    $post_date = date('Y-m-d H:i:s');
    if(!$post_date) {
        return null;
    }
    $sql_query = "INSERT INTO posts(id_user, body, post_date) VALUES ('$userId', '$body', '$post_date')";
    if(!mysqli_query($conn, $sql_query)) {
        return null;
    }
    $id = mysqli_insert_id($conn);
    createPostsTagsAssociation($conn, $id, $tags);

}

function createPostsTagsAssociation($conn, $post_id, $tags) {
    $where_query = getArrayWhereStatment($tags, "tag_name");
    $sql_query = "SELECT id FROM tags WHERE $where_query";
    $result = mysqli_query($conn, $sql_query);
    $rows = mysqli_num_rows($result);
    
    if($rows < 1) {
        echo "Δεν επιστρέφηκαν αποτελέσματα";
        return;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $tag_id = $row['id'];
        $sql_query = "INSERT INTO posts_has_tags(posts_id, tags_id) VALUES ('$post_id', '$tag_id')";
        mysqli_query($conn, $sql_query);
    }
    mysqli_free_result($result);
}

function getArrayWhereStatment($array, $columnName) {
    $where_query = "( ";
    $numElements = count($array);
    for($i=0; $i<$numElements; $i++) {
        $elemnt = $array[$i];
        $where_query .= "$columnName = '$elemnt'";
        if($i+1 !== $numElements) {
            $where_query .= " OR ";
        }
    }
    $where_query .= ")";
    return $where_query;
}

/************************  *************************/
?>

